<?php

namespace App\Http\Controllers;

use App\Models\CreditDetail;
use App\Models\Payment;
use App\Models\PlanType;
use App\Models\Program;
use App\Models\Register;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $payments = Payment::query()->where('amountPaid', '!=', 0)
            ->whereMonth('created_at', Carbon::now()->month)->paginate(10);
        return view('payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $plans = PlanType::all();
        $programs = Program::all();
        $student = Register::query()->where('card_number', '=', $request->cardRegNo)
            ->orWhere('reg_number', '=', $request->cardRegNo)->first();
        $currentDate = Carbon::now();
//        $payments = Payment::query()->where('expiryDate', '<=', $currentDate)->get();

        return view('payments.create', compact('student',  'plans', 'programs', 'currentDate'));
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
        $validateData = $request->validate([
            'amountPaid'    => 'required',
            'planType'      => 'required',
            'program'       => 'required',
            'startDate'     => 'required',
        ]);

        $regId = Register::where('id',  $request->reg_id)->first();
        $programType = Program::query()->where('name', '=', $request->program)->first();
        $plans       = PlanType::query()->where('name', '=', $request->planType)->first();
        $fees        = $programType->fees;
        $period      = $plans->period;
        $bill        = $fees * $period;
        $amountPaid  = $request->amountPaid;
        $balance     = $bill - $amountPaid;
        $expire = Carbon::createFromFormat('Y-m-d', $request->input('startDate'));
        $payment                        = new Payment();
        $payment->amountPaid            = $request->amountPaid;
        $payment->planType              = $request->planType;
        $payment->programType           = $request->program;
        $payment->paymentReadingDate    = $request->startDate;
        $payment->amountBilled          = $bill;
        $payment->balance               = $balance;
        $payment->status                = "Paid";
        $payment->expiryDate            = $expire->addMonths($period);


        if ($regId->payments()->save($payment)){

            $paymentId = Payment::where('id', $payment->id)->first();
            $detail = new CreditDetail();
            $detail->amountPaid = $request->amountPaid;
            $detail->collectedBy = Auth::user()->name;
            $paymentId->creditDetails()->save($detail);
        }

        $request->session()->flash('status', 'Payment Added Successfully');
//        dd($payment);
        return redirect('studentPayment');

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
        $payment = Payment::find($id);
        return view('payments.details', compact('payment'));

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

        $debtor = Payment::find($id);
        return view('payments.edit', compact('debtor'));
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
        $data = Payment::find($id);

        $oldAmount          = $data->amountPaid;
        $amount             = $request->balance;
        $newAmount          = $oldAmount + $amount;
        $amountBilled       = $data->amountBilled;
        $newBalance         = $amountBilled - $newAmount;

        $data->amountPaid   = $newAmount;
        $data->balance      = $newBalance;

        if ($data->save()){
            $detail                 = new CreditDetail();
            $detail->amountPaid     = $request->balance;
            $detail->collectedBy    = Auth::user()->name;
            $data->creditDetails()->save($detail);
        }

        $request->session()->flash('status', 'Update successful');

        return redirect('studentPayment');

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

    public function details(Request $request, $id){

        /*$detail = Register::query()->Where('card_number', '=', $request->input('cardReg'))
            ->orWhere('reg_number', '=', $request->input('cardReg'))->first();

        return view('payments.details', compact('detail'));*/

        $payment = Payment::find($id);

        $payment->amount    = $request->amount;
        /*if ($payment->save())
        {
           $detail          = $payment->creditDetails();

        }*/

    }
}
