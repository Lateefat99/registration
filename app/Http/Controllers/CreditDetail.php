<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreditDetail extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $detail = \App\Models\CreditDetail::find($id);

        return view('payments.details', compact('detail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $creditDetail = \App\Models\CreditDetail::find($id);
        $oldAmount = $creditDetail->amountPaid;

        $creditDetail->amountPaid = $request->amount;
//        $creditDetail->modifiedBy = Auth::user()->name;

        if ($creditDetail->save()){

            $payment                = Payment::query()->where('id', '=', $creditDetail->payment_id)->first();

//            return dd($payment);

            $oldBalance             = $payment->amountPaid;
            $amountBilled           = $payment->amountBilled;
            $newBalance             = $oldBalance - $oldAmount;
            $bal                    = $request->amount;
            $amountPaid             = $newBalance + $bal;
            $balance                = $amountBilled - $amountPaid;

            $payment->amountPaid = $amountPaid;
            $payment->balance    = $balance;
            $payment->save();

            $request->session()->flash('status', 'Payment Update Successful');

            return redirect('studentPayment');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
