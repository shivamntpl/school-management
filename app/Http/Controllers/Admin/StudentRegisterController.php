<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Str; 
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\ClassModel;
use App\Models\Vehicle;



class StudentRegisterController extends Controller
{
    public function index()
    {
        $data['students'] = Student::all();
        return view('admin.student.index')->with($data);
    }

    public function create()
    {
        $classes = ClassModel::where('status', 1)->get();
        $vehicles = Vehicle::all();
        return view('admin.student.create',compact('classes','vehicles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_name'        => 'required|string|max:255',
            'father_name'         => 'required|string|max:255',
            'mother_name'         => 'required|string|max:255',
            'local_guardian_name' => 'nullable|string|max:255',
            'photo'               => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'village'   => 'required|string|max:255',
            'post'      => 'required|string|max:255',
            'ps'        => 'required|string|max:255',
            'district'  => 'required|string|max:255',
            'pin'       => 'required|digits:6',
            'dob'   => 'required|date',
            'age'   => 'required|numeric',
            'bpl'   => 'nullable|boolean',
            'religion' => 'required',
            'mother_tongue' => 'required',
            'caste'         => 'required',
            'sex'           => 'required',
            'class_id' => 'required|exists:classes,id',
            'disease' => 'required',
            'vehicle' => 'required',
            'aadhaar_number' => 'required|digits:12',
            'vehicle_number' => 'required|string|max:50',
            'details'        => 'nullable|string',
            'reg_no'     => 'required|string|max:50',
            'sr_no'      => 'required|string|max:50',
            'admission_type'    => 'required',
            'amount'            => 'required|numeric',
            'date_of_admission' => 'required|date',
            'age_wise'          => 'nullable|boolean',
            'monthly'         => 'nullable|numeric',
            'total_for_year'  => 'nullable|string',
            'discount'        => 'nullable|string',
            'after_discount'  => 'nullable|numeric',
            'aadhaar_file' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
            'birth_certificate' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);
         if($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            Storage::disk('public')->put('images/student-image/'.$imageName, file_get_contents($image));
            $validated['photo'] = $imageName;
        }

        if($request->hasFile('aadhaar_file')) {
            $aadhaar = $request->file('aadhaar_file');
            $aadhaarName = time().'_aadhaar.'.$aadhaar->getClientOriginalExtension();
            Storage::disk('public')->put(
                'documents/aadhaar/'.$aadhaarName,
                file_get_contents($aadhaar)
            );
            $validated['aadhaar_file'] = $aadhaarName;
        }

        if($request->hasFile('birth_certificate')) {
            $birth = $request->file('birth_certificate');
            $birthName = time().'_birth.'.$birth->getClientOriginalExtension();
            Storage::disk('public')->put(
                'documents/birth-certificate/'.$birthName,
                file_get_contents($birth)
            );
            $validated['birth_certificate'] = $birthName;
        }
        $validated['bpl'] = $request->has('bpl') ? 1 : 0;
        $validated['age_wise'] = $request->has('age_wise') ? 1 : 0;
        $namePart = strtoupper(substr($validated['student_name'], 0, 4));
        $randomNumber = mt_rand(10000, 99999);
        $validated['id'] = $namePart . $randomNumber;
        Student::create($validated);
        return redirect()->route('student.list')->with('success', 'Student registered successfully!');
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $classes = ClassModel::where('status', 1)->get();
        $vehicles = Vehicle::all();
        return view('admin.student.edit', compact('student','classes','vehicles'));
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        $validated = $request->validate([
            'student_name'        => 'required|string|max:255',
            'father_name'         => 'required|string|max:255',
            'mother_name'         => 'required|string|max:255',
            'local_guardian_name' => 'nullable|string|max:255',
            'photo'               => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'village'   => 'required|string|max:255',
            'post'      => 'required|string|max:255',
            'ps'        => 'required|string|max:255',
            'district'  => 'required|string|max:255',
            'pin'       => 'required|digits:6',
            'dob'       => 'required|date',
            'age'       => 'required|numeric',
            'bpl'       => 'nullable|boolean',
            'religion'  => 'required',
            'mother_tongue' => 'required',
            'caste'     => 'required',
            'sex'       => 'required',
            'class_id' => 'required|exists:classes,id',
            'disease'   => 'required',
            'vehicle'   => 'required',
            'aadhaar_number' => 'required|digits:12',
            'aadhaar_file' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
            'birth_certificate' =>'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
            'vehicle_number' => 'required|string|max:50',
            'details'        => 'nullable|string',
            'reg_no'     => 'required|string|max:50',
            'sr_no'      => 'required|string|max:50',
            'admission_type' => 'required',
            'amount' => 'required|numeric',
            'date_of_admission' => 'required|date',
            'age_wise'          => 'nullable|boolean',
            'monthly'           => 'nullable|numeric',
            'discount'          => 'nullable|string',
            'after_discount'    => 'nullable|numeric',
        ]);

        if($request->hasFile('photo')) {
            if ($student->photo && Storage::disk('public')->exists('images/student-image/'.$student->photo)) {
            Storage::disk('public')->delete('images/student-image/'.$student->photo);
            }
            $image = $request->file('photo');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            Storage::disk('public')->put('images/student-image/'.$imageName, file_get_contents($image));
            $validated['photo'] = $imageName;
        }

        if($request->hasFile('aadhaar_file')) {

            if ($student->aadhaar_file && Storage::disk('public')->exists('documents/aadhaar/'.$student->aadhaar_file )) 
            {
                Storage::disk('public')->delete( 'documents/aadhaar/'.$student->aadhaar_file);
            }

            $aadhaar = $request->file('aadhaar_file');
            $aadhaarName =time().'_aadhaar.'.$aadhaar->getClientOriginalExtension();
            Storage::disk('public')->put(
                'documents/aadhaar/'.$aadhaarName,
                file_get_contents($aadhaar)
            );
            $validated['aadhaar_file'] = $aadhaarName;
        }

        if($request->hasFile('birth_certificate')) {

            if ($student->birth_certificate && Storage::disk('public')->exists('documents/birth-certificate/'.$student->birth_certificate ))
            {
                Storage::disk('public')->delete('documents/birth-certificate/'.$student->birth_certificate);
            }
            $birth = $request->file('birth_certificate');
            $birthName = time().'_birth.'. $birth->getClientOriginalExtension();
            Storage::disk('public')->put(
                'documents/birth-certificate/'.$birthName,
                file_get_contents($birth)
            );
            $validated['birth_certificate'] = $birthName;
        }

        $validated['bpl'] = $request->has('bpl') ? 1 : 0;
        $validated['age_wise'] = $request->has('age_wise') ? 1 : 0;

        $student->update($validated);

        return redirect()
            ->route('student.list', $student->id)
            ->with('success', 'Student updated successfully!');
    }



    public function profile(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        $start = Carbon::parse($student->date_of_admission)->startOfMonth();
        $end   = now()->startOfMonth();
        $months = [];
        while ($start <= $end) {
            $months[] = $start->format('Y-m');
            $start->addMonth();
        }
        $paidMonths = $student->payments()
            ->pluck('month')
            ->toArray();
        return view('admin.student.profile', compact(
            'student',
            'months',
            'paidMonths'
        ));
    }

    public function invoice($id)
    {
        $student = Student::with('classData')->findOrFail($id);
        return view('admin.student.invoice', compact('student'));
    }


    public function destroy($id)
    {
        $student = Student::findOrFail($id);

        if (
            $student->photo &&
            Storage::disk('public')->exists('images/student-image/' . $student->photo)
        ) {
            Storage::disk('public')->delete('images/student-image/' . $student->photo);
        }

        if (
            $student->aadhaar_file &&
            Storage::disk('public')->exists('documents/aadhaar/' . $student->aadhaar_file)
        ) {
            Storage::disk('public')->delete('documents/aadhaar/' . $student->aadhaar_file);
        }

        if (
            $student->birth_certificate &&
            Storage::disk('public')->exists('documents/birth-certificate/' . $student->birth_certificate)
        ) {
            Storage::disk('public')->delete(
                'documents/birth-certificate/' . $student->birth_certificate
            );
        }

        $student->payments()->delete();
        $student->fees()->delete();
        $student->delete();
        return redirect()
            ->route('student.list')
            ->with('success', 'Student deleted successfully!');
    }
}