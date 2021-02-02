<?php

namespace App\Http\Controllers;

use App\Destination;
use App\Http\Requests\DestinationMediaRequest;
use App\Http\Requests\DestinationRequest;
use App\Http\Requests\ResourceDestination;
use App\Http\Resources\Destination\DestinationResource;
use App\Repositories\Destination\DestinationRepositoryInterface;
use App\Repositories\DestinationMedia\DestinationMediaInterface;
use App\Repositories\ResourcesAllDestination\ResourcesDestinationInterfaceAll;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class DestinationController extends Controller
{

    protected $destination_repo;
    protected $resources_destination;
    protected $destinationMedia;

    use UploadTrait;

    public function __construct(DestinationRepositoryInterface $destination_repo, ResourcesDestinationInterfaceAll $resources_destination, DestinationMediaInterface $destinationMedia)
    {
        $this->destination_repo = $destination_repo;
        $this->resources_destination = $resources_destination;
        $this->destinationMedia = $destinationMedia;
    }
    /**
     * Display a listing of the resource.
     * @param \Illuminate\Http\Request
     * @return DataTables
     */
    public function index(Request $request)
    {
        $result = $this->destination_repo->getAllDestination();
        $data = DestinationResource::collection($result);
        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('image', function ($row) {
                    if ($row['image'] != null) {
                        return $row['image'];
                    } else {
                        return 'No Images';
                    }
                })
                ->editColumn('service', function ($row) {
                    if ($row['service'] != null) {
                        return $row['service'];
                    } else {
                        return 'No Images';
                    }
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="#"><button type="button" rel="tooltip" class="btn btn-success">
                            <i class="material-icons">edit</i>
                        </button></a>
                        <button onClick="deleteDestination(' . $row['id'] . ', this)" type="button" rel="tooltip" class="btn btn-danger">
                            <i class="material-icons">delete</i>
                        </button>';
                    return $btn;
                })
                ->rawColumns(['action', 'image', 'service'])
                ->make(true);
        }
        return view('content.Destination.index');
    }

    // public function test(Request $request)
    // {
    //     $result = $this->destination_repo->getAllDestination();
    //     $data = DestinationResource::collection($result);
    //     return $data;
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('content.Destination._form-one');
    }

    /**
     * Store a newly destination with media and resource.
     * @return \Illuminate\Http\Response
     */
    public function store(DestinationMediaRequest $request)
    {
        $destinationRequest = app()->make(DestinationRequest::class);
        $resourceRequest = app()->make(ResourceDestination::class);
        $mediaRequest = app()->make(DestinationMediaRequest::class);
        $destinationData = $destinationRequest->all();
        $resourceData = $resourceRequest->all();
        $service_id = $resourceData['service_id'];
        $resourceMedia = array();

        try {
            DB::beginTransaction();
            $destination = $this->destination_repo->createOrUpdateDestination(null, $destinationData);
            foreach ($service_id as $key => $no) {
                $resources['service_id'] = $service_id[$key];
                $resources['destination_id'] = $destination->id;
                $this->resources_destination->createOrUpdate(null, $resources);
            }
            if ($request->hasFile('images_destination')) {
                $images = $request->file('images_destination');
                // $folder = "/destination/$destination->destination_name";
                foreach ($images as $file) {
                    $name = Str::slug($destination->destination_name . '_' . time());
                    $imgName = $name . '.' . $file->getClientOriginalExtension();
                    $file->storeAs("/destination/$destination->destination_name", $imgName, 'public');

                    $media['images_destination'] = $imgName;
                    $media['destination_id'] = $destination->id;
                    $this->destinationMedia->createOrUpdateMedia(null, $media);
                }
            }
            DB::commit();
            return redirect()->route('destinations.index')->withSuccess("Destination Added Succesfully");
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            return redirect()->back()->with('errors', 'Insert Error Please Check Your Input');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = $this->destination_repo->getDestinationId($id);
        $data = new DestinationResource($result);
        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function edit(Destination $destination)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Destination $destination)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function destroy(Destination $destination)
    {
        //
    }
}
