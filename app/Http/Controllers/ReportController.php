<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Program;
use App\Models\Register;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use function GuzzleHttp\Promise\all;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $startDate = $request->input('startDate');
        $endDate   = $request->input('endDate');

        $lists = Register::query()->whereBetween('created_at', [$startDate, $endDate])->get();

        if (!empty($lists)){

            $request->session()->flash('status', 'List of All Registered Student Between '
                . $startDate . ' and ' . $endDate);

            return view('reports.registered', compact('lists', 'startDate', 'endDate'));

        }
        else{

            $request->session()->flash('status', 'No Registered Student Between '
                . $startDate . ' and ' . $endDate);

            return view('reports.registered', compact('lists', 'startDate', 'endDate'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $programs = Program::all();
        $studentClass = StudentClass::all();

        $stdC = $request->studentClass;
        $proId = $request->program_id;

        //using eager loading without parameters
//        $test = Register::with('programs')->get();

        //eager loading with parameters
        $test = Register::with(['programs' => function($query) use ($stdC, $proId){
          $query->where('program_id', $proId)
              ->wherePivot('student_class', $stdC);
      }])->get();




//         dd($lists);

//        print_r($lists);
        $name = Program::query()->where('id', '=', $request->program_id)->first();
        if (count($test) >= 1){

            if (isset($request->program_id)){
                $request->session()->flash('status', 'All Registered Student in ' . $name->name . ' ' . $request->studentClass );
            }
            return view('reports.student_class', compact('programs', 'studentClass', 'test'));

        }
        else
        {
            if (isset($request->program_id)){
                $request->session()->flash('status', 'No Registered Student in ' . $name->name . ' ' . $request->studentClass );
            }
            return view('reports.student_class', compact('programs', 'studentClass', 'test'));
        }

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

    public function paid(Request $request){

        $startDate = $request->input('startDate');
        $endDate   = $request->input('endDate');


        $lists = Payment::query()->whereBetween('created_at', [$startDate, $endDate])
            ->where('amountPaid', '!=', '0')->get();



        if (!empty($lists)){

            $request->session()->flash('status', 'All Payment Made Between '
                . $startDate . ' and ' . $endDate);

            return view('reports.paid', compact('lists', 'startDate', 'endDate'));

        }
        else{

            $request->session()->flash('status', 'No Payment Made Between '
                . $startDate . ' and ' . $endDate);

            return view('reports.paid', compact('lists', 'startDate', 'endDate'));
        }
    }

    public function studentByProgram(Request $request){

        $programs = Program::all();

        $proId = $request->program_id;

        //using eager loading without parameters
//        $test = Register::with('programs')->get();

        //eager loading with parameters
        $test = Register::with(['programs' => function($query) use ($proId){
            $query->where('program_id', $proId);
        }])->get();




//         dd($lists);

//        print_r($lists);
        $name = Program::query()->where('id', '=', $request->program_id)->first();
        if (count($test) >= 1){

            if (isset($request->program_id)){
                $request->session()->flash('status', 'All Registered Student in ' . $name->name );
            }
            return view('reports.student_program', compact('programs',  'test'));

        }
        else
        {
            if (isset($request->program_id)){
                $request->session()->flash('status', 'No Registered Student in ' . $name->name  );
            }
            return view('reports.student_program', compact('programs',  'test'));
        }

    }
}
