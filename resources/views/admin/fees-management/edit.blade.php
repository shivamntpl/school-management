@extends('layout.admin-layout.admin')
@section('title', 'Edit Fees')
@section('page-title')
<i class="fas fa-edit me-2"></i> Edit Student Fees
@endsection
@section('content')
<div class="container-fluid">
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('fees.update', $fee->id) }}" method="POST">
                @csrf
                @method('PUT')
                <!-- Row 1 -->
                <div class="d-flex gap-3 mb-3 flex-wrap">
                    <div class="flex-fill">
                        <label class="form-label">Student</label>
                        <select name="student_id" class="form-select" required>
                            <option value="">Select Student</option>

                            @foreach($students as $student)
                                <option value="{{ $student->id }}"
                                    {{ $fee->student_id == $student->id ? 'selected' : '' }}>
                                    {{ $student->student_name }}
                                </option>

                            @endforeach

                        </select>

                        @error('student_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="flex-fill">
                        <label class="form-label">Session</label>
                        <input type="text"
                               name="session"
                               class="form-control"
                               value="{{ old('session', $fee->session) }}"
                               placeholder="2026-27"
                               required>
                        @error('session')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="flex-fill">
                        <label class="form-label">Fee Type</label>
                        <select name="fee_type"
                                class="form-select"
                                required>
                            <option value="">Select Fee Type</option>
                            <option value="Session Fees"
                                {{ $fee->fee_type == 'Session Fees' ? 'selected' : '' }}>
                                Session Fees
                            </option>
                            <option value="Book Fees"
                                {{ $fee->fee_type == 'Book Fees' ? 'selected' : '' }}>
                                Book Fees
                            </option>
                            <option value="Dress Fees"
                                {{ $fee->fee_type == 'Dress Fees' ? 'selected' : '' }}>
                                Dress Fees
                            </option>
                        </select>
                        @error('fee_type')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Row 2 -->
                <div class="d-flex gap-3 mb-3 flex-wrap">
                    <div class="flex-fill">
                        <label class="form-label">Amount</label>
                        <input type="number"
                               name="amount"
                               class="form-control"
                               value="{{ old('amount', $fee->amount) }}"
                               placeholder="Enter Amount"
                               required>
                        @error('amount')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="flex-fill">
                        <label class="form-label">Fee Date</label>
                        <input type="date"
                               name="fee_date"
                               class="form-control"
                               value="{{ old('fee_date', $fee->fee_date) }}"
                               required>
                        @error('fee_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Remarks -->
                <div class="mb-3">
                    <label class="form-label">Remarks</label>
                    <textarea name="remarks"
                              class="form-control"
                              rows="4"
                              placeholder="Enter Remarks">{{ old('remarks', $fee->remarks) }}</textarea>

                    @error('remarks')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                </div>

                <!-- Buttons -->
                <div class="text-end">
                    <button class="btn btn-primary px-4">
                        <i class="fas fa-save me-1"></i>
                        Update Fees
                    </button>
                    <a href="{{ route('fees.list') }}"
                       class="btn btn-danger px-4">
                        Back
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection