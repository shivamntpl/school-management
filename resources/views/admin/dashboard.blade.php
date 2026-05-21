@extends('layout.admin-layout.admin')

@section('title', 'Dashboard')

@section('page-title')
<i class="fas fa-home"></i> Dashboard
@endsection

@section('content')

<!-- Students -->
<section class="cards-container">
    <a href="{{ route('student.list') }}">
        <div class="card bg-primary text-white">
            <div class="card-header">
                <div>
                    <p class="card-title text-white">
                        All Students
                    </p>

                    <p class="card-value">
                        {{ $totalStudents }}
                    </p>
                </div>
            </div>
        </div>
    </a>


</section>

<!-- Filter -->
<div class="filter-card p-3 mt-4">

    <form method="GET" action="{{ route('dashboard') }}">

        <div class="row" id="filtertag">

            <div class="col-md-3">
                <label>From Date</label>

                <input type="date" name="from_date" class="form-control" value="{{ request('from_date') }}">
            </div>

            <div class="col-md-3">
                <label>To Date</label>

                <input type="date" name="to_date" class="form-control" value="{{ request('to_date') }}">
            </div>

            <div class="col-md-3">
                <label>Select Month</label>

                <input type="month" name="month" class="form-control" value="{{ request('month') }}">
            </div>

            <div class="col-md-3 d-flex align-items-end">

                <button type="submit" class="btn btn-primary mr-2">
                    Filter
                </button>

                <a href="{{ route('dashboard') }}" class="btn btn-danger">
                    Reset
                </a>

            </div>

        </div>

    </form>

</div>

<!-- Earnings -->
<section class="cards-container mt-4">

    <!-- Total -->
    <a href="{{ route('dashboard', [
            'type' => 'total',
            'from_date' => request('from_date'),
            'to_date' => request('to_date'),
            'month' => request('month')
        ]) }}" class="text-decoration-none flex-fill">

        <div class="card bg-info text-white">

            <div class="card-header">

                <div>

                    <p class="card-title text-white">
                        Total Earnings
                    </p>

                    <p class="card-value">
                        ₹ {{ number_format($totalEarning, 2) }}
                    </p>

                </div>

            </div>

        </div>

    </a>

    <!-- Monthly -->
    <a href="{{ route('dashboard', [
            'type' => 'monthly',
            'month' => request('month'),
            'from_date' => request('from_date'),
            'to_date' => request('to_date')
        ]) }}" class="text-decoration-none flex-fill">

        <div class="card bg-warning text-white">

            <div class="card-header">

                <div>

                    <p class="card-title text-white">
                        Monthly Earnings
                    </p>

                    <p class="card-value">
                        ₹ {{ number_format($monthlyEarning, 2) }}
                    </p>

                </div>

            </div>

        </div>

    </a>

    <!-- Today -->
    <a href="{{ route('dashboard', [
            'type' => 'today',
            'from_date' => request('from_date'),
            'to_date' => request('to_date'),
            'month' => request('month')
        ]) }}" class="text-decoration-none flex-fill">

        <div class="card bg-secondary text-white">

            <div class="card-header">

                <div>

                    <p class="card-title text-white">
                        Today Earnings
                    </p>

                    <p class="card-value">
                        ₹ {{ number_format($todayEarning, 2) }}
                    </p>

                </div>

            </div>

        </div>

    </a>

</section>

<!-- TABLE -->
<div class="card mt-4">

    <div class="card-header">

        <h5 class="mb-0">

            @if($type == 'monthly')

            Monthly Students Payments

            @elseif($type == 'today')

            Today Students Payments

            @else

            Total Students Payments

            @endif

        </h5>

    </div>

    <div class="card-body table-responsive">

        <table id="paymentTable" class="table table-bordered table-striped">

            <thead class="bg-dark text-white">

                <tr>
                    <th>#</th>
                    <th>Student Name</th>
                    <th>Father Name</th>
                    <th>Class</th>
                    <th>Amount</th>
                    <th>Fine</th>
                    <th>Payment Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $key => $payment)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>
                        {{ $payment->student->student_name ?? '-' }}
                    </td>
                    <td>
                        {{ $payment->student->father_name ?? '-' }}
                    </td>
                    <td>
                        {{ $payment->student->classData->name ?? '-' }}
                    </td>
                    <td>
                        ₹ {{ number_format($payment->amount, 2) }}
                    </td>
                    <td>
                        ₹ {{ number_format($payment->fine, 2) }}
                    </td>
                    <td>
                        {{ \Carbon\Carbon::parse($payment->payment_date)->format('d-m-Y') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center">
                        No Record Found
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function() {
    $('#paymentTable').DataTable({
        pageLength: 10,
        lengthMenu: [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "All"]
        ],
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search Student...",
            lengthMenu: "Show _MENU_ entries",
            info: "Showing _START_ to _END_ of _TOTAL_ students",
            infoEmpty: "No students found",
            infoFiltered: "(filtered from _MAX_ total students)",
            paginate: {
                first: "First",
                last: "Last",
                next: "Next",
                previous: "Previous"
            }
        }
    });
});
</script>
@endpush