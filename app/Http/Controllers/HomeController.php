<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\StudentPayment;
use App\Models\StudentFee;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $data['totalStudents'] = Student::count();

        // TOTAL EARNING
    
        $totalAdmission = Student::sum('amount');
        $totalStudentFees = StudentFee::sum('amount');
        $totalPaidFees = StudentPayment::sum('amount');
        $totalFine = StudentPayment::sum('fine');

        $data['totalEarning'] = $totalAdmission +  $totalStudentFees +$totalPaidFees +$totalFine;
           
        // MONTHLY EARNING
        $selectedMonth = $request->month
            ? Carbon::parse($request->month)
            : now();

        $monthlyAdmission = Student::whereMonth(
            'date_of_admission',
            $selectedMonth->month
        )->whereYear(
            'date_of_admission',
            $selectedMonth->year
        )->sum('amount');
        

        $monthlyStudentFees = StudentFee::whereMonth(
            'fee_date',
            $selectedMonth->month
        )->whereYear(
            'fee_date',
            $selectedMonth->year
        )->sum('amount');

        $monthlyPaid = StudentPayment::whereMonth(
            'payment_date',
            $selectedMonth->month
        )->whereYear(
            'payment_date',
            $selectedMonth->year
        )->sum('amount');

        $monthlyFine = StudentPayment::whereMonth(
            'payment_date',
            $selectedMonth->month
        )->whereYear(
            'payment_date',
            $selectedMonth->year
        )->sum('fine');

        $data['monthlyEarning'] = $monthlyAdmission + $monthlyStudentFees +$monthlyPaid +$monthlyFine;

        //TODAY EARNING
        $todayAdmission = Student::whereDate(
            'date_of_admission',
            today()
        )->sum('amount');

        $todayStudentFees = StudentFee::whereDate(
            'fee_date',
            today()
        )->sum('amount');

        $todayPaid = StudentPayment::whereDate(
            'payment_date',
            today()
        )->sum('amount');
        
        $todayFine = StudentPayment::whereDate(
            'payment_date',
            today()
        )->sum('fine');

        $data['todayEarning'] =$todayAdmission +$todayStudentFees +$todayPaid +$todayFine;
            
        //TABLE DATA
        $type = $request->type ?? 'total';
        if ($type == 'monthly') {

            $data['students'] = StudentPayment::with('student')
                ->whereMonth('payment_date', $selectedMonth->month)
                ->whereYear('payment_date', $selectedMonth->year)
                ->latest()
                ->get();
        } elseif ($type == 'today') {

            $data['students'] = StudentPayment::with('student')
                ->whereDate('payment_date', today())
                ->latest()
                ->get();
        } else {
            $data['students'] = StudentPayment::with('student')
                ->latest()
                ->get();
        }
        $data['type'] = $type;
        return view('admin.dashboard')->with($data);
    }
}