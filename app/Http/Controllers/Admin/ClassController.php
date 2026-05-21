<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassModel;
use Illuminate\Support\Facades\Validator;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = ClassModel::latest()->paginate(10);
        return view('admin.class.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.class.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'section' => 'required|string|max:20',
            'fees' => 'required|numeric|min:0',
            'status' => 'required|in:active,inactive'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        ClassModel::create($request->all());

        return redirect()->route('class.list')
            ->with('success', 'Class created successfully!');
    }

   
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $class = ClassModel::findOrFail($id);
        return view('admin.class.edit', compact('class'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $class = ClassModel::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'section' => 'required|string|max:20',
            'fees' => 'required|numeric|min:0',
            'status' => 'required|in:active,inactive'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $class->update($request->all());

        return redirect()->route('class.list')
            ->with('success', 'Class updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $class = ClassModel::findOrFail($id);
        
        // Check if class has students
        if ($class->students()->count() > 0) {
            return redirect()->route('class.list')
                ->with('error', 'Cannot delete class with enrolled students!');
        }
        $class->delete();
        return redirect()->route('class.list')
            ->with('success', 'Class deleted successfully!');
    }
}
