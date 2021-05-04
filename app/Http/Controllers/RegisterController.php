<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Register;
use App\Models\StudentClass;
use App\Models\StudentType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        //list all registered students
        $registers = Register::paginate(10);

        $search = Register::query()->where('name', 'LIKE', '%' . $request->input('term') .  '%')
            ->orWhere('card_number', '=', $request->input('term'))
            ->orWhere('reg_number', '=', $request->input('term'))->get();

        if (empty($search)){
            $request->session()->flash('status', 'No records for ' . $request->input('term'));
        }
        else{
            $request->session()->flash('status', 'All records for ' . $request->input('term'));
        }
//        dd($search);
        return view('registers.index', compact('registers', 'search'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $studentClass = StudentClass::all();
        $studTypes = Program::all();
        return view('registers.create', compact('studTypes', 'studentClass'));
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
        $currentDate = Carbon::now();
        $validatedData = $request->validate(
            [
                'title'             => 'required',
                'name'              => 'required',
                'nationality'       => 'required',
                'health_status'     => 'required',
                'address'           => 'required',
                'd_o_b'             => 'required',
                'state_of_origin'   => 'required',
                'reg_date'          => 'required',
                'gender'            => 'required',
                'reg_number'        => 'required|unique:registers',
                'admitted_class'    => 'required',
//                'card_number'       => 'unique:registers,card_number',
                'studentType'       => 'required',
//                'phone'             => 'nullable|unique:registers,phone'
            ]
            );

            $programId = Program::where('id', $request->studentType)->first();
//            $studentTypeId   = $studentTypeName->id;

            $student = new Register();

            $student->title             = $request->title;
            $student->name              = $request->name;
            $student->phone             = $request->phone;
            $student->email             = $request->email;
            $student->nationality       = $request->nationality;
            $student->health_status     = $request->health_status;
            $student->address           = $request->address;
            $student->d_o_b             = $request->d_o_b;
            $student->state_of_origin   = $request->state_of_origin;
            $student->blood_group       = $request->blood_group;
            $student->guardian_name     = $request->guardian_name;
            $student->guardian_phone    = $request->guardian_phone;
            $student->genotype          = $request->genotype;
            $student->gender            = $request->gender;
            $student->allergy           = $request->allergy;
            $student->card_number       = $request->card_number;
            $student->reg_date          = $request->reg_date;
            $student->reg_number        = $request->reg_number;
            $student->teacher           = Auth::user()->name;
            $student->filename          = $request->image_name;

//            return dd($student);

             $programId->registers()->save($student, ['student_class' => $request->admitted_class, 'session' => $currentDate]);

        $request->session()->flash('status', 'New Student Added Successfully');
        return redirect('student');
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
        $student = Register::find($id);

        return view('registers.show', compact('student'));
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
        $student = Register::find($id);
        $studentClasses = StudentClass::all();
        $studTypes = Program::all();
        return view('registers.edit', compact('student', 'studentClasses', 'studTypes'));
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

        /*$validateData = $request->validate(
            [
                'title'             => 'required',
                'name'              => 'required',
                'nationality'       => 'required',
                'health_status'     => 'required',
                'address'           => 'required',
                'd_o_b'             => 'required',
                'state_of_origin'   => 'required',
                'reg_date'          => 'required',
                'gender'            => 'required',
                'reg_number'        => 'required|unique:registers',
                'admitted_class'    => 'required',
//                'card_number'       => 'unique:registers,card_number',
                'studentType'       => 'required',
//                'phone'             => 'nullable|unique:registers,phone'
            ]
        );*/

        $programId = Program::where('id', $request->studentType)->first();


        $currentDate = Carbon::now();
        $student = Register::find($id);
        $student->title             = $request->title;
        $student->name              = $request->name;
        $student->phone             = $request->phone;
        $student->email             = $request->email;
        $student->nationality       = $request->nationality;
        $student->health_status     = $request->health_status;
        $student->address           = $request->address;
        $student->d_o_b             = $request->d_o_b;
        $student->state_of_origin   = $request->state_of_origin;
        $student->blood_group       = $request->blood_group;
        $student->guardian_name     = $request->guardian_name;
        $student->guardian_phone    = $request->guardian_phone;
        $student->genotype          = $request->genotype;
        $student->gender            = $request->gender;
        $student->allergy           = $request->allergy;
        $student->card_number       = $request->card_number;
        $student->reg_date          = $request->reg_date;
        $student->reg_number        = $request->reg_number;
        $student->teacher           = Auth::user()->name;
        $student->filename          = $request->image_name;

//            return dd($student);

        $student->save();

        $request->session()->flash('status', 'Student Updated Successfully');
        return redirect('student');
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

    public function findStudent(Request $request){

        $programs = Program::all();
        $studentClasses = StudentClass::all();

        $student = Register::query()->where('card_number', '=', $request->cardRegNo)
            ->orWhere('reg_number', '=', $request->cardRegNo)->first();

        return view('registers.find', compact('student', 'programs', 'studentClasses'));

    }

    public function editStudent(Request $request){

        $programs = Program::all();
        $studentClasses = StudentClass::all();

        $student = Register::query()->where('card_number', '=', $request->cardRegNo)
            ->orWhere('reg_number', '=', $request->cardRegNo)->first();

        return view('registers.editStudent', compact('student', 'programs', 'studentClasses'));

    }


}
