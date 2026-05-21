<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\StudentFee;

class StudentFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fees = StudentFee::with('student')
                ->latest()
                ->get();
        return view('admin.fees-management.index', compact('fees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = Student::all();
        return view('admin.fees-management.create', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required',
            'session'    => 'required',
            'fee_type'   => 'required',
            'amount'     => 'required|numeric',
            'fee_date'   => 'required|date',
            'remarks'    => 'nullable',
        ]);
        StudentFee::create($validated);
        return redirect()->route('fees.list')->with('success', 'Fee Added Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $fee = StudentFee::findOrFail($id);
        $students = Student::all();
        return view('admin.fees-management.edit', compact('fee', 'students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $fee = StudentFee::findOrFail($id);
        $validated = $request->validate([
            'student_id' => 'required',
            'session'    => 'required',
            'fee_type'   => 'required',
            'amount'     => 'required|numeric',
            'fee_date'   => 'required|date',
            'remarks'    => 'nullable',
        ]);
        $fee->update($validated);
        return redirect() ->route('fees.list')->with('success', 'Fee Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $fee = StudentFee::findOrFail($id);
        $fee->delete();
        return redirect()->route('fees.list')->with('success', 'Fee Deleted Successfully');
    }
}
