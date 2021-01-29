<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRequest;
use App\Repositories\Service\ServiceRepositoryInterface;
use App\Service;
use App\Traits\DeleteImagesTrait;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class ServiceController extends Controller
{
    protected $service_repo;
    use UploadTrait, DeleteImagesTrait;

    public function __construct(ServiceRepositoryInterface $service_repo)
    {
        $this->service_repo = $service_repo;
    }
    /**
     * Display a listing of the resource.
     * @param Illuminate\Http\Request
     * @return DataTables
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->service_repo->getAllService();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href=' . route('services.edit', $row->id) . '><button type="button" rel="tooltip" class="btn btn-success">
                                <i class="material-icons">edit</i>
                            </button></a>
                            <button onClick="deleteService(' . $row->id . ', this)" type="button" rel="tooltip" class="btn btn-danger">
                                <i class="material-icons">delete</i>
                            </button>';
                    return $btn;
                })->editColumn('logo', function ($row) {
                    if ($row->logo != 'icon.png') {
                        $icon = Storage::url('serviceicon/' . $row->logo);
                    } else {
                        $icon = Storage::url('serviceicon/default/' . $row->logo);
                    }
                    $img = '<div class="img-container">
                                <img src="' . $icon . '" rel="nofollow" alt="...">
                            </div>';
                    return $img;
                })
                ->rawColumns(['action', 'logo'])->make(true);
        }

        return view('content.Services.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\View
     */
    public function create()
    {
        return view('content.Services._form-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\ServiceRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request)
    {
        $input = $request->all();
        $request->validated();

        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $name = Str::slug($request->input('service_name') . '_' . time());
            $folder = '/serviceicon';
            $imgName = $name . '.' . $image->getClientOriginalExtension();
            $this->uploadOne($image, $folder, 'public', $name);
            $input['logo'] = $imgName;
        }

        try {
            $this->service_repo->createOrUpdate(null, $input);
            return redirect()->route('services.index')->withSuccess('Service Add Succesfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('errors', $e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = $this->service_repo->getServiceId($id);
        return view('content.Services._form-edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceRequest $request, $id)
    {
        $input = $request->all();
        $request->validated();
        $service = $this->service_repo->getServiceId($id);

        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $name = Str::slug($request->input('service_name') . '_' . time());
            $folder = '/serviceicon';
            $imgOld = $service->logo;
            $pathToImgOld = $folder . '/';
            $this->deleteImages($pathToImgOld, $imgOld, 'public');
            $imgName = $name . '.' . $image->getClientOriginalExtension();
            $this->uploadOne($image, $folder, 'public', $name);
            $input['logo'] = $imgName;
        } else {
            $imgName = $service->logo;
            $input['logo'] = $imgName;
        }
        try {
            $this->service_repo->createOrUpdate($id, $input);
            return redirect()->route('services.index')->withSuccess('Service Update Succesfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('errors', $e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $servicesImage = $this->service_repo->getServiceId($id);
        $image = $servicesImage->logo;
        $filePath = '/serviceicon';
        $pathToImg = $filePath . '/';
        $this->deleteImages($pathToImg, $image, 'public');
        $this->service_repo->deleteService($id);
        return response([
            'result' => 'success'
        ], 200);
    }
}
