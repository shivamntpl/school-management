<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentPayment;
use App\Models\Student;

class StudentPaymentController extends Controller
{
    public function monthlyPay(Request $request)
    {
        $paymentExists = StudentPayment::where('student_id', $request->student_id)
            ->where('month', $request->month)
            ->exists();

        if ($paymentExists) {
            return back()->with('error', 'This month already paid!');
        }
        $student = Student::findOrFail($request->student_id);
        $amount = $student->monthly;
        $fine   = calculateFine($student, $request->month);
        $totalPaid = $amount + $fine;
        StudentPayment::create([
            'student_id' => $request->student_id,
            'month' => $request->month,
            'amount' => $request->amount,
            'fine' =>  $fine,
            'total_paid' => $totalPaid,
            'payment_date' => now(),
        ]);

        return back()->with('success', 'Monthly Fees Paid Successfully');
    }

}
