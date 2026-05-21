@extends('layout.admin-layout.admin')

@section('title', 'Classes')

@section('page-title')
<i class="fas fa-chalkboard-teacher"></i> All Classes
@endsection

@section('content')
<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('class.create') }}" class="btn btn-primary">
        Add Class
    </a>
</div>
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<div class="card">
    <div class="card-body">
        <table id="classTable" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Class Name</th>
                    <th>Section</th>
                    <th>Fees</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($classes as $class)
                <tr>
                    <td>{{ $class->name }}</td>
                    <td>{{ $class->section }}</td>
                    <td>{{ $class->fees }}</td>
                    <td>
                        <span class=" {{ $class->status == 'active' ? 'success' : 'danger' }}">
                            {{ ucfirst($class->status) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('class.edit', $class->id) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>

                        <form action="{{ route('class.destroy', $class->id) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Are you sure you want to delete this class?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
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
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function() {
    $('#classTable').DataTable({
        pageLength: 10,
        lengthMenu: [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "All"]
        ],
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search Class...",
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