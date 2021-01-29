<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Model\Payment;
use App\Repositories\Payment\PaymentInterface;
use Illuminate\Http\Request;
use DataTables;


class PaymentController extends Controller
{
    protected $payment;

    public function __construct(PaymentInterface $payment)
    {
        $this->payment = $payment;
    }
    /**
     * Display a listing of the resource.
     * @param Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->payment->getAllPayment();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href=' . route('payments.edit', $row->id) . '><button type="button" rel="tooltip" class="btn btn-success">
                                <i class="material-icons">edit</i>
                            </button></a>
                            <button onClick="deletePayment(' . $row->id . ', this)" type="button" rel="tooltip" class="btn btn-danger">
                                <i class="material-icons">delete</i>
                            </button>';
                    return $btn;
                })->rawColumns(['action'])->make(true);
        }

        return view('content.Payment.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('content.Payment._form-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentRequest $request)
    {
        $data = $request->all();
        $request->validated();

        try {
            $this->payment->createOrUpdate(null, $data);
            return redirect()->route('payments.index')->withSuccess('Payment Add Succesfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('errors', $e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->payment->getPaymentId($id);

        return view('content.Payment._form-edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(PaymentRequest $request, $id)
    {
        $data = $request->all();
        $request->validated();

        try {
            $this->payment->createOrUpdate($id, $data);
            return redirect()->route('payments.index')->withSuccess('Payment Updated Succesfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('errors', $e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->payment->deletePayment($id);
        return response([
            'result' => 'success'
        ], 200);
    }
}
