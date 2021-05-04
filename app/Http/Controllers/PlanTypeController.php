<?php

namespace App\Http\Controllers;

use App\Models\PlanType;
use App\Models\StudentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlanTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $plans = PlanType::all();
        return view('plan.index', compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('plan.add_plan');
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
        $validate = $request->validate([
            'planName'          => 'required|unique:plan_types,name',
            'period'            => 'required',
        ]);

        $plan                   = new PlanType();
        $plan->name             = $request->planName;
        $plan->period           = $request->period;
        $plan->createdBy        = Auth::user()->name;
        $plan->save();

        $request->session()->flash('status', $request->planName . 'successfully added');
        return redirect('plan');
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
        $planType = PlanType::findOrFail($id);
        return view('plan.edit', compact('planType'));
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
        $planType                   = PlanType::findOrFail($id);
        $planType->name             = $request->planType;
        $planType->period           = $request->period;
        $planType->createdBy        = Auth::user()->name;
        $planType->save();

        $request->session()->flash('status', 'Plan Name ' . $request->planType . ' successfully updated');
        return redirect('plan');
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
        $planType = PlanType::findorFail($id);
        $planType->delete();

        session()->flash('status', 'Plan Name ' . $planType->name . ' successfully deleted');
        return redirect('plan');
    }
}
