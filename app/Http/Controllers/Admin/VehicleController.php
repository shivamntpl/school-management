<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicles = Vehicle::latest()->paginate(10);
        return view('admin.vehicle.index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.vehicle.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $validator = Validator::make($request->all(), [
            'vehicle_number' => 'required|string|max:20|unique:vehicles',
            'vehicle_type' => 'required|string|max:50',
            'driver_name' => 'nullable|string|max:100',
            'driver_phone' => 'nullable|string|max:15',
            'capacity' => 'required|integer|min:1|max:100',
            'route' => 'nullable|string|max:255',
            'pickup_time' => 'nullable|date_format:H:i',
            'drop_time' => 'nullable|date_format:H:i',
            'monthly_charge' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive,maintenance'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Vehicle::create($request->all());

        return redirect()->route('vehicle.list')
            ->with('success', 'Vehicle created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        return view('admin.vehicle.edit', compact('vehicle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $vehicle = Vehicle::findOrFail($id);

       $validator = Validator::make($request->all(), [
        'vehicle_number' => [
                'required',
                'string',
                'max:20',
                Rule::unique('vehicles')->ignore($vehicle->id),
            ],            
            'vehicle_type' => 'required|string|max:50',
            'driver_name' => 'nullable|string|max:100',
            'driver_phone' => 'nullable|string|max:15',
            'capacity' => 'required|integer|min:1|max:100',
            'route' => 'nullable|string|max:255',
            'pickup_time' => 'nullable|date_format:H:i',
            'drop_time' => 'nullable|date_format:H:i',
            'monthly_charge' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive,maintenance'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $vehicle->update($request->all());

        return redirect()->route('vehicle.list')
            ->with('success', 'Vehicle updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->delete();
        return redirect()->route('vehicle.list')
            ->with('success', 'Vehicle deleted successfully!');
    }
}