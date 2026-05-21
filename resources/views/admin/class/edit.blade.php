@extends('layout.admin-layout.admin')

@section('title', 'Edit Class')

@section('page-title')
<i class="fas fa-chalkboard-teacher"></i>Edit Class
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
            <form method="POST" action="{{ route('class.update',$class->id) }}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <!-- Row 1 -->
                <div class="d-flex gap-3 mb-3 flex-wrap">
                    <div class="flex-fill">
                        <label class="form-label">Class Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" value="{{ old('name',$class->name) }}">
                        @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="flex-fill">
                        <label class="form-label">Section <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="section"
                            value="{{ old('section',$class->section) }}">
                        @error('section')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                   
                </div>

                <div class="d-flex gap-3 mb-3 flex-wrap">
                    <div class="flex-fill">
                        <label for="fees" class="form-label">Fees (₹) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="fees" name="fees"
                            value="{{ old('fees', $class->fees) }}" min="0" step="0.01">
                        @error('fees')<span class="text-danger">{{ $message }}</span>@enderror

                    </div>
                    <div class="flex-fill">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-select" id="status" name="status">
                            <option value="active" {{ $class->status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ $class->status == 'inactive' ? 'selected' : '' }}>Inactive
                            </option>
                        </select>
                        @error('status')<span class="text-danger">{{ $message }}</span>@enderror

                    </div>
                </div>



                <div class="text-end">
                    <button class="btn btn-primary px-4">Submit</button>
                    <a href="{{ route('class.list') }}" class="btn btn-danger px-4">Back</a>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection