@extends('layout.admin-layout.admin')

@section('title', 'Edit Vehicle')

@section('page-title')
<i class="fas fa-bus-alt"></i> Edit Vehicle
@endsection

@section('content')
<div class="container-fluid">
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            <form method="POST" action="{{ route('vehicle.update',$vehicle->id) }}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <!-- Row 1 -->
                <div class="d-flex gap-3 mb-3 flex-wrap">
                    <div class="flex-fill">
                        <label class="form-label">Vehicle Number<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="vehicle_number"
                            value="{{ old('vehicle_number',$vehicle->vehicle_number) }}">
                        @error('vehicle_number')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="flex-fill">
                        <label class="form-label">Vehicle Type <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="vehicle_type"
                            value="{{ old('vehicle_type',$vehicle->vehicle_type) }}">
                        @error('vehicle_type')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="flex-fill">
                        <label for="driver_name" class="form-label">Driver Name</label>
                        <input type="text" class="form-control" id="driver_name" name="driver_name"
                            value="{{ old('driver_name',$vehicle->driver_name) }}">
                        @error('driver_name')<span class="text-danger">{{ $message }}</span>@enderror

                    </div>
                </div>

                <div class="d-flex gap-3 mb-3 flex-wrap">
                    <div class="flex-fill">
                        <label for="driver_phone" class="form-label">Driver Phone<span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="driver_phone" name="driver_phone"
                            value="{{ old('driver_phone',$vehicle->driver_phone) }}" min="1" max="100">
                        @error('driver_phone')<span class="text-danger">{{ $message }}</span>@enderror

                    </div>
                    <div class="flex-fill">
                        <label for="capacity" class="form-label">Capacity<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="capacity" name="capacity"
                            value="{{ old('capacity',$vehicle->capacity) }}" min="1" max="100">
                        @error('capacity')<span class="text-danger">{{ $message }}</span>@enderror

                    </div>
                    <div class="flex-fill">
                        <label for="route" class="form-label">Route<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="route" name="route"
                            value="{{ old('route',$vehicle->route) }}">
                        @error('route')<span class="text-danger">{{ $message }}</span>@enderror

                    </div>
                </div>

                <div class="d-flex gap-3 mb-3 flex-wrap">
                    <div class="flex-fill">
                        <label for="pickup_time" class="form-label">Picup Time<span class="text-danger">*</span></label>
                        <input type="text" class="form-control timepicker" id="pickup_time" name="pickup_time"
                            value="{{ old('pickup_time',$vehicle->pickup_time) }}">
                        @error('pickup_time')<span class="text-danger">{{ $message }}</span>@enderror

                    </div>
                    <div class="flex-fill">
                        <label for="drop_time" class="form-label">Drop Time<span class="text-danger">*</span></label>
                        <input type="text" class="form-control timepicker" id="drop_time" name="drop_time"
                            value="{{ old('drop_time',$vehicle->drop_time) }}">
                        @error('drop_time')<span class="text-danger">{{ $message }}</span>@enderror

                    </div>
                    <div class="flex-fill">
                        <label for="monthly_charge" class="form-label">Monthly Charge<span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="monthly_charge" name="monthly_charge"
                            value="{{ old('monthly_charge',$vehicle->monthly_charge) }}">
                        @error('monthly_charge')<span class="text-danger">{{ $message }}</span>@enderror

                    </div>
                </div>

                <div class="d-flex gap-3 mb-3 flex-wrap">
                    <div class="flex-fill">
                        <label for="description" class="form-label">Description<span
                                class="text-danger">*</span></label>
                        <textarea class="form-control"
                            name="description">{{ old('description',$vehicle->description) }}</textarea>

                    </div>
                    <div class="flex-fill">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-select" id="status" name="status">
                            <option value="active" {{ $vehicle->status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ $vehicle->status == 'inactive' ? 'selected' : '' }}>Inactive
                            </option>
                            <option value="maintenance" {{ $vehicle->status == 'maintenance' ? 'selected' : '' }}>
                                maintenance
                            </option>
                        </select>
                        @error('status')<span class="text-danger">{{ $message }}</span>@enderror

                    </div>

                </div>


                <div class="text-end">
                    <button class="btn btn-primary px-4">Submit</button>
                    <a href="{{ route('vehicle.list') }}" class="btn btn-danger px-4">Back</a>

                </div>
            </form>

        </div>
    </div>
</div>

@endsection
@push('scripts')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
flatpickr(".timepicker", {
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
    time_24hr: false
});
</script>

@endpush