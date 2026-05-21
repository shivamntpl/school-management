@extends('layout.admin-layout.admin')

@section('title', 'Vehicles')

@section('page-title')
<i class="fas fa-bus-alt"></i>All Vehicles
@endsection

@section('content')
<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('vehicle.create') }}" class="btn btn-primary">
        Add Vehicles
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
                    <th>Vehicle Bumber</th>
                    <th>Vehicle Type</th>
                    <th>Driver Name</th>
                    <th>Driver Phone</th>
                    <th>Capacity</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($vehicles as $vehicle)
                <tr>
                    <td>{{ $vehicle->vehicle_number }}</td>
                    <td>{{ $vehicle->vehicle_type }}</td>
                    <td>{{ $vehicle->driver_name ?? 'N/A'  }}</td>
                    <td>{{ $vehicle->driver_phone ?? 'N/A' }}</td>
                    <td>{{ $vehicle->capacity }}</td>
                    <td>
                        <span class=" {{ $vehicle->status == 'active' ? 'success' : 'danger' }}">
                            {{ ucfirst($vehicle->status) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('vehicle.edit', $vehicle->id) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>

                        <form action="{{ route('vehicle.destroy', $vehicle->id) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Are you sure you want to delete this vehicle?')">
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
            searchPlaceholder: "Search Vehicle...",
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