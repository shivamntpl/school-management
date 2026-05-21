<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\StudentPayment;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalStudents = Student::count();
        $paidStudents = Student::whereHas('payments')->count();
        $unpaidStudents = Student::whereDoesntHave('payments')->count();
        return view('admin.dashboard',compact('totalStudents','paidStudents','unpaidStudents'));
    }
}
