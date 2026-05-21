@extends('layout.admin-layout.admin')

@section('title', 'Dashboard')

@section('page-title')
<i class="fas fa-home"></i> Dashboard
@endsection
@section('content')
<!-- Cards -->
<section class="cards-container">
    <a href="{{ route('student.list') }}">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <div>
                    <p class="card-title text-white">Total Student</p>
                    <p class="card-value">{{ $totalStudents }}</p>
                </div>
            </div>
        </div>
    </a>

    <div class="card orange">
        <div class="card-header bg-success text-white">
            <div>
                <p class="card-title text-white">Paid Student</p>
                <p class="card-value">{{ $paidStudents }}</p>
            </div>
        </div>
    </div>

    <div class="card green">
        <div class="card-header bg-danger text-white">
            <div>
                <p class="card-title text-white">Unpaid Student</p>
                <p class="card-value">{{ $unpaidStudents }}</p>
            </div>
        </div>
    </div>


</section>
@endsection