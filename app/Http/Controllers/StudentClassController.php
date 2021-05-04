<?php

namespace App\Http\Controllers;

use App\Models\StudentClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $classes = StudentClass::all();
        return view('studentClass.index', compact('classes'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('studentClass.create');
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
        $validate = $request->validate(
            [
                'studClass' => 'required|unique:student_classes,name',
            ]
        );

        $newClass       = new StudentClass();
        $newClass->name = $request->studClass;
        $newClass->createdBy = Auth::user()->name;
        $newClass->save();

        $request->session()->flash('status', 'New Class has been added');

        return redirect('studentClass');
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
        $studClass = StudentClass::find($id);

        return view('studentClass.edit', compact('studClass'));
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
        $studClass = StudentClass::find($id);

        $studClass->name = $request->studClass;
        $studClass->save();

        $request->session()->flash('status', 'Class has been updated ' );

        return redirect('studentClass');

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
        $studentClass = StudentClass::find($id);
        $studentClass->delete();

        session()->flash('status', 'Class ' . $studentClass->name .  ' has been deleted');

        return redirect('studentClass');
    }
}
