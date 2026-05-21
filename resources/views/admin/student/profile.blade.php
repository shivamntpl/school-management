@extends('layout.admin-layout.admin')

@section('title', 'Student Profile')

@section('page-title')
<i class="fas fa-user-graduate me-2"></i> Student Profile
@endsection

@section('content')
<div class="container-fluid">

    {{-- SUCCESS / ERROR MESSAGE --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i>
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    {{-- STUDENT PROFILE CARD --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="mb-1">{{ $student->student_name }}</h4>
                    <p class="mb-0 text-muted">
                        <strong>ID:</strong> {{ $student->id }} |
                        <strong>Class:</strong> {{ $student->classData->name }}
                    </p>
                </div>
                <div class="col-md-4 text-end">
                    <span class="badge bg-primary fs-6">
                        Monthly Fees: ₹{{ number_format($student->monthly, 2) }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- FEES SUMMARY --}}
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-center border-success">
                <div class="card-body">
                    <h6>Total Paid</h6>
                    <h5 class="text-success">
                        ₹{{ number_format($student->payments->sum('total_paid'), 2) }}
                    </h5>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center border-danger">
                <div class="card-body">
                    <h6>Total Due</h6>
                    @php
                    $paidMonthsCount = count($paidMonths);
                    $totalMonths = count($months);
                    $unpaidMonths = $totalMonths - $paidMonthsCount;
                    $totalDue = max(0, $unpaidMonths * $student->monthly);
                    @endphp
                    <h5 class="text-danger">
                        ₹{{ number_format($totalDue, 2) }}
                    </h5>
                </div>
            </div>
        </div>
    </div>

    {{-- MONTH WISE FEES TABLE --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="mb-3">Month Wise Fees Status</h5>

            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Month</th>
                            <th>Fees</th>
                            <th>Fine</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th width="140">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($months as $month)
                        @php
                        $payment = $payments[$month] ?? null;
                        $fine = in_array($month, $paidMonths) ? 0 : calculateFine($student, $month);
                        $total = $student->monthly + $fine;
                        @endphp
                        <tr>
                            <td>{{ \Carbon\Carbon::createFromFormat('Y-m',$month)->format('F Y') }}</td>
                            <td>₹{{ number_format($student->monthly, 2) }}</td>

                            <td>
                                @if($fine > 0)
                                <span class="text-danger fw-bold">
                                    ₹{{ number_format($fine, 2) }}
                                </span>
                                @else
                                <span class="text-muted">₹0.00</span>
                                @endif
                            </td>
                            <td>
                                <strong>₹{{ number_format($total, 2) }}</strong>
                            </td>
                            @if(in_array($month, $paidMonths))
                            <td><span class="badge bg-success">Paid</span></td>
                            <td class="text-center">
                                <i class="fas fa-check text-success"></i>
                            </td>
                            @else
                            <td><span class="badge bg-danger">Unpaid</span></td>
                            <td>
                                <form method="POST" action="{{ url('admin/students/monthly-pay') }}">
                                    @csrf
                                    <input type="hidden" name="student_id" value="{{ $student->id }}">
                                    <input type="hidden" name="month" value="{{ $month }}">
                                    <input type="hidden" name="amount" value="{{$total }}">
                                    <input type="hidden" name="fine" value="{{ $fine }}">
                                    <button type="submit" class="btn btn-sm btn-primary w-100"
                                        onclick="return confirm('Are you sure you want to pay this month fees?')">
                                        Pay Now
                                    </button>
                                </form>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection