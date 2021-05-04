<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\ProgramRegister;
use App\Models\Register;
use App\Models\StudentClass;
use App\Models\StudentType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $types = Program::all();
        return view('studentType.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('studentType.create');
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
            'studType'          => 'required|unique:student_types,studentType',
            'fees'              => 'required',
        ]);

        $plan                   = new Program();
        $plan->name      = $request->studType;
        $plan->fees             = $request->fees;
        $plan->createdBy        = Auth::user()->name;
        $plan->save();

        $request->session()->flash('status', 'Student Type ' . strtoupper($request->studType) . ' successfully added');
        return redirect('studentType');
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
        $studentType = Program::findOrFail($id);
        return view('studentType.edit', compact('studentType'));

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
        /*$validateData = $request->validate([
            'studType'           => 'required|unique:student_types,studentType',
            'fees'                  => 'required',
        ]);*/

        $studentType                    = Program::findorFail($id);
        $studentType->name              = $request->studType;
        $studentType->fees              = $request->fees;
        $studentType->createdBy         = Auth::user()->name;
        $studentType->save();

        $request->session()->flash('status', 'Student Type ' . $request->studType . ' successfully updated');
        return redirect('studentType');
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
        $studentType = Program::find($id);
        $studentType->delete();
        session()->flash('status', 'Student Type ' . $studentType->studentType . ' successfully deleted');
        return redirect('studentType');
    }

    public function addProgram(Request $request){

        $regId = Register::where('id',  $request->reg_id)->first();
        $programId = Program::where('id', $request->program_id)->first();

        $programId->registers()->save($regId, ['student_class' => $request->studentClass]);

        return redirect('student');
    }

    public function editPro($id){

        $programs = Program::all();
        $studentClasses = StudentClass::all();
        $findProgram = Program::find($id);

        return view('registers.editStudent', compact('findProgram', 'programs', 'studentClasses'));
    }

    public function updateProgram(Request $request, $id){

        $findProgram = Program::find($id);

        $regId = Register::where('id',  $request->reg_id)->first();
//        $programId = Program::where('id', $request->program_id)->first();

        $findProgram->registers()->updateExistingPivot($regId, ['student_class' => $request->studentClass]);

        return redirect('student');

    }

}
