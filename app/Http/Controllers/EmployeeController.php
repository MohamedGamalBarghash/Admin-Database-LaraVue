<?php

namespace App\Http\Controllers;

use App\Models\Emplyee;
use Illuminate\Http\Request;
// use Illuminate\Database\DB;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = Emplyee::latest()->paginate(5);

        // return view('index', compact('data'))->with('i', (request()->input('page', 1) -1) * 5);

        // return view('employees', compact(Emplyee::latest()));
        return Emplyee::orderBy('department')->get();
        // return DB::select("select * from employee");
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
        Emplyee::create([
            'image' => $request->image,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'dependant' => $request->dependant,
            'age' => $request->age,
            'department' => $request->department
        ]);

        return response()->json(['message' => 'New entry created successfully!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Emplyee  $emplyee
     * @return \Illuminate\Http\Response
     */
    public function show(Emplyee $emplyee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Emplyee  $emplyee
     * @return \Illuminate\Http\Response
     */
    public function edit(Emplyee $emplyee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Emplyee  $emplyee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $existingEntry = Emplyee::find($id);
        $existingEntry->image      =  $request->image;
        $existingEntry->name       =  $request->name;
        $existingEntry->email      =  $request->email;
        $existingEntry->phone      =  $request->phone;
        $existingEntry->dependant  =  $request->dependant;
        $existingEntry->age        =  $request->age;
        $existingEntry->department =  $request->department;
        $existingEntry->save();
        return $existingEntry;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Emplyee  $emplyee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Emplyee $emplyee, $id)
    {
        $existingEntry = Emplyee::find($id);

        if($existingEntry) {
            $existingEntry->delete();
            return "Entry deleted successfully!";
        }

        return "Entry not found!";
    }
}
