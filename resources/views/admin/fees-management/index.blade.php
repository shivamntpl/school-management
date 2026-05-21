@extends('layout.admin-layout.admin')
@section('title', 'Fees Management')
@section('page-title')
<i class="fas fa-money-bill"></i> Student Fees
@endsection
@section('content')
<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('fees.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add Fees
    </a>
</div>
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="card">
    <div class="card-body">
        <table id="feesTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Student</th>
                    <th>Session</th>
                    <th>Fee Type</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                @foreach($fees as $fee)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        {{ $fee->student->student_name ?? '' }}
                    </td>
                    <td>{{ $fee->session }}</td>
                    <td>{{ $fee->fee_type }}</td>
                    <td>₹ {{ $fee->amount }}</td>
                    <td>{{ $fee->fee_date }}</td>
                    <td>
                        <a href="{{ route('fees.edit',$fee->id) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('fees.destroy',$fee->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#feesTable').DataTable();
});
</script>
@endpush