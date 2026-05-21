@extends('layout.admin-layout.admin')

@section('title', 'Student Management')

@section('page-title')
<i class="fas fa-users"></i> All Student
@endsection

@section('content')
<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('student.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add Student
    </a>
</div>
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<div class="card">
    <div class="card-body">
        <table id="studentsTable" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>IMage</th>
                    <th>Name</th>
                    <th>Father Name</th>
                    <th>Mother Name</th>
                    <th>Admission Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach( $students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td><img src="{{ asset('storage/images/student-image/'.$student->photo) }}"
                            alt="{{ $student->full_name}}" width="50"></td>
                    <td>{{ $student->student_name }}</td>
                    <td>{{ $student->father_name }}</td>
                    <td>{{ $student->mother_name }}</td>
                    <td>{{ $student->date_of_admission }}</td>
                    <td><span class="status-badge status-active">Active</span></td>
                    <td>

                        <a href="{{ route('student.edit',$student->id) }}" class="btn btn-sm btn-warning"
                            onclick="editStudent('STU001')">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('student.destroy', $student->id) }}" method="POST"
                            style="display:inline-block;">

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure want to delete this student?')">

                                <i class="fas fa-trash"></i>

                            </button>

                        </form>
                        <a href="{{ route('student.profile',$student->id) }}" class="btn btn-sm btn-info">
                            View
                        </a>

                        <a href="{{ route('student.invoice', $student->id) }}" class="btn btn-sm btn-success"
                            target="_blank">

                            <i class="fas fa-print"></i> Print Invoice
                        </a>
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
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function() {
    $('#studentsTable').DataTable({
        pageLength: 10,
        lengthMenu: [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "All"]
        ],
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search students...",
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