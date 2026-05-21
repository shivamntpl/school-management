@extends('layout.admin-layout.admin')

@section('title', 'Student Registration')

@section('page-title')
<i class="fas fa-user-graduate me-2"></i> Student Registration
@endsection

@section('content')
<div class="container-fluid">
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('student.store') }}" enctype="multipart/form-data">
                @csrf

                <!-- Row 1 -->
                <div class="d-flex gap-3 mb-3 flex-wrap">
                    <div class="flex-fill">
                        <label class="form-label">Student Name</label>
                        <input type="text" class="form-control" name="student_name" value="{{ old('student_name') }}">
                        @error('student_name')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="flex-fill">
                        <label class="form-label">Father Name</label>
                        <input type="text" class="form-control" name="father_name" value="{{ old('father_name') }}">
                        @error('father_name')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="flex-fill">
                        <label class="form-label">Mother Name</label>
                        <input type="text" class="form-control" name="mother_name" value="{{ old('mother_name') }}">
                        @error('mother_name')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>

                <!-- Local Guardian & Photo -->
                <div class="d-flex gap-3 mb-3 flex-wrap">
                    <div class="flex-fill">
                        <label class="form-label">Local Guardian Name</label>
                        <input type="text" class="form-control" name="local_guardian_name"
                            value="{{ old('local_guardian_name') }}">
                        @error('local_guardian_name')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="flex-fill">
                        <label class="form-label">Photo</label>
                        <input type="file" class="form-control" name="photo">
                    </div>
                </div>

                <!-- Address -->
                <div class="d-flex gap-3 mb-3 flex-wrap">
                    <div class="flex-fill">
                        <label class="form-label">Village</label>
                        <input type="text" class="form-control" name="village" value="{{ old('village') }}">
                        @error('village')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="flex-fill">
                        <label class="form-label">Post</label>
                        <input type="text" class="form-control" name="post" value="{{ old('post') }}">
                        @error('post')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="flex-fill">
                        <label class="form-label">Police Station</label>
                        <input type="text" class="form-control" name="ps" value="{{ old('ps') }}">
                        @error('ps')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="d-flex gap-3 mb-3 flex-wrap">
                    <div class="flex-fill">
                        <label class="form-label">District</label>
                        <input type="text" class="form-control" name="district" value="{{ old('district') }}">
                        @error('district')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="flex-fill">
                        <label class="form-label">PIN</label>
                        <input type="text" class="form-control" name="pin" value="{{ old('pin') }}">
                        @error('pin')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>

                <!-- Personal Info -->
                <div class="d-flex gap-3 mb-3 flex-wrap">
                    <div class="flex-fill">
                        <label class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" name="dob" id="dob" value="{{ old('dob') }}">
                        @error('dob')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="flex-fill">
                        <label class="form-label">Current Age</label>
                        <input type="text" class="form-control" name="age" id="age" value="{{ old('age') }}" readonly>
                        @error('age')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="flex-fill d-flex align-items-center">
                        <input class="form-check-input me-2" type="checkbox" name="bpl" value="1"
                            {{ old('bpl') ? 'checked' : '' }} id="bpl">
                        <label class="form-check-label" for="bpl">BPL</label>
                    </div>
                    <div class="flex-fill">
                        <label class="form-label">Religion</label>
                        <select class="form-select" name="religion">
                            <option value="">Select</option>
                            <option value="hindu" {{ old('religion')=='hindu' ? 'selected' : '' }}>Hindu</option>
                            <option value="muslim" {{ old('religion')=='muslim' ? 'selected' : '' }}>Muslim</option>
                            <option value="christian" {{ old('religion')=='christian' ? 'selected' : '' }}>Christian
                            </option>
                        </select>
                        @error('religion')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                </div>

                <!-- Mother Tongue, Caste, Sex -->
                <div class="d-flex gap-3 mb-3 flex-wrap">
                    <div class="flex-fill">
                        <label class="form-label">Mother Tongue</label>
                        <select class="form-select" name="mother_tongue">
                            <option value="">Select</option>
                            <option value="hindi" {{ old('mother_tongue')=='hindi' ? 'selected' : '' }}>Hindi</option>
                            <option value="english" {{ old('mother_tongue')=='english' ? 'selected' : '' }}>English
                            </option>
                        </select>
                        @error('mother_tongue')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                    <div class="flex-fill">
                        <label class="form-label">Caste</label>
                        <select class="form-select" name="caste">
                            <option value="">Select</option>
                            <option value="general" {{ old('caste')=='general' ? 'selected' : '' }}>General</option>
                            <option value="obc" {{ old('caste')=='obc' ? 'selected' : '' }}>OBC</option>
                            <option value="sc" {{ old('caste')=='sc' ? 'selected' : '' }}>SC</option>
                            <option value="st" {{ old('caste')=='st' ? 'selected' : '' }}>ST</option>
                        </select>
                        @error('caste')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                    <div class="flex-fill">
                        <label class="form-label">Sex</label>
                        <select class="form-select" name="sex">
                            <option value="">Select</option>
                            <option value="male" {{ old('sex')=='male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('sex')=='female' ? 'selected' : '' }}>Female</option>
                        </select>
                        @error('sex')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                </div>

                <!-- Academic Info -->
                <div class="d-flex gap-3 mb-3 flex-wrap">
                    <div class="flex-fill">
                        <label class="form-label">Select Class</label>
                        <select name="class_id" id="class_id" class="form-control" required>
                            <option value="">Select Class</option>
                            @foreach($classes as $class)
                            <option value="{{ $class->id  }}" data-fees="{{ $class->fees }}">
                                {{ $class->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('class')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                    <div class="flex-fill">
                        <label class="form-label">Disease</label>
                        <select class="form-select" name="disease">
                            <option value="">Select</option>
                            <option value="0" {{ old('disease')=='0' ? 'selected' : '' }}>No</option>
                            <option value="1" {{ old('disease')=='1' ? 'selected' : '' }}>Yes</option>
                        </select>
                        @error('disease')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                    <div class="flex-fill">
                        <label class="form-label">Vehicle</label>
                        <select class="form-select" name="vehicle" id="vehicle_id">

                            <option value="">Select Vehicle</option>

                            @foreach($vehicles as $vehicle)

                            <option value="{{ $vehicle->id }}" data-number="{{ $vehicle->vehicle_number }}"
                                {{ old('vehicle') == $vehicle->id ? 'selected' : '' }}>
                                {{ $vehicle->vehicle_type }}
                            </option>

                            @endforeach

                        </select>
                        @error('vehicle')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                </div>

                <!-- Identification -->
                <div class="d-flex gap-3 mb-3 flex-wrap">
                    <div class="flex-fill">
                        <label class="form-label">Aadhaar Number</label>
                        <input type="text" class="form-control" name="aadhaar_number"
                            value="{{ old('aadhaar_number') }}">
                        @error('aadhaar_number')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>

                    <div class="flex-fill">
                        <label class="form-label">
                            Aadhaar File
                        </label>
                        <input type="file" class="form-control" name="aadhaar_file">
                    </div>

                    <div class="flex-fill">
                        <label class="form-label">
                            Birth Certificate
                        </label>
                        <input type="file" class="form-control" name="birth_certificate">
                    </div>

                    <div class="flex-fill">
                        <label class="form-label">Vehicle Number</label>
                        <input type="text" class="form-control" name="vehicle_number" id="vehicle_number"
                            value="{{ old('vehicle_number') }}" readonly>
                        @error('vehicle_number')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                    <div class="flex-fill">
                        <label class="form-label">Details</label>
                        <textarea class="form-control" name="details">{{ old('details') }}</textarea>
                    </div>
                </div>

                <!-- Registration & Fees -->
                <div class="d-flex gap-3 mb-3 flex-wrap">
                    <div class="flex-fill">
                        <label class="form-label">Reg No</label>
                        <input type="text" class="form-control" name="reg_no" value="{{ old('reg_no') }}">
                        @error('reg_no')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                    <div class="flex-fill">
                        <label class="form-label">Sr No</label>
                        <input type="text" class="form-control" name="sr_no" value="{{ old('sr_no') }}">
                        @error('sr_no')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                </div>

                <!-- Admission & Payment -->
                <div class="d-flex gap-3 mb-3 flex-wrap">
                    <div class="flex-fill">
                        <label class="form-label">Admission Type</label>
                        <select class="form-select" name="admission_type">
                            <option value="">Select</option>
                            <option value="New" {{ old('admission_type')=='New' ? 'selected' : '' }}>New</option>
                            <option value="Transfer" {{ old('admission_type')=='Transfer' ? 'selected' : '' }}>Transfer
                            </option>
                        </select>
                        @error('admission_type')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                    <div class="flex-fill">
                        <label class="form-label">Amount</label>
                        <input type="text" class="form-control" name="amount" value="{{ old('amount') }}">
                        @error('amount')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                    <div class="flex-fill">
                        <label class="form-label">Date Of Admission</label>
                        <input type="date" class="form-control" name="date_of_admission"
                            value="{{ old('date_of_admission') }}">
                        @error('date_of_admission')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>

                    <div class="flex-fill d-flex align-items-center">
                        <input class="form-check-input me-2" type="checkbox" name="age_wise" value="1"
                            {{ old('age_wise') ? 'checked' : '' }}>
                        <label class="form-check-label">Age Wise</label>
                    </div>
                </div>

                <div class="d-flex gap-3 mb-3 flex-wrap">
                    <div class="flex-fill">
                        <label class="form-label">Monthly Fees</label>
                        <input type="text" name="monthly" id="monthly_fees" class="form-control" readonly>
                        @error('monthly')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                    <div class="flex-fill">
                        <label class="form-label">Total For Year</label>
                        <input type="text" class="form-control" name="total_for_year" id="total_for_year" readonly>
                        @error('total_for_year')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="flex-fill">
                        <label class="form-label">Discount (Per Month)</label>
                        <input type="number" class="form-control" name="discount" id="discount"
                            value="{{ old('discount',0) }}">
                        @error('discount')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="flex-fill">
                        <label class="form-label">After Discount (Monthly)</label>
                        <input type="text" class="form-control" name="after_discount" id="after_discount" readonly>
                        @error('after_discount')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="text-end">
                    <button class="btn btn-primary px-4">Submit</button>
                    <a href="{{ route('student.list') }}" class="btn btn-danger px-4">Back</a>

                </div>
            </form>

        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>
document.getElementById('dob').addEventListener('change', function() {
    let dob = new Date(this.value);
    if (!this.value) return;
    let dobYear = dob.getFullYear();
    let currentYear = new Date().getFullYear();
    let age = currentYear - dobYear;
    document.getElementById('age').value = age >= 0 ? age : 0;
});
</script>

<script>
function calculateFees() {
    let monthlyFees = parseFloat($('#monthly_fees').val()) || 0;
    let discount = parseFloat($('#discount').val()) || 0;
    // Monthly after discount
    let afterDiscount = monthlyFees - discount;

    if (afterDiscount < 0) {
        afterDiscount = 0;
    }

    // Yearly total
    let yearlyTotal = afterDiscount * 12;
    $('#after_discount').val(afterDiscount);
    $('#total_for_year').val(yearlyTotal);
}

// Class change
$('#class_id').on('change', function() {
    let fees = $(this).find(':selected').data('fees') || 0;
    $('#monthly_fees').val(fees);
    calculateFees();
});

// Discount change
$('#discount').on('keyup change', function() {
    calculateFees();

});
</script>


<script>
$('#vehicle_id').on('change', function () {
    let vehicleNumber = $(this).find(':selected').data('number') || '';
    $('#vehicle_number').val(vehicleNumber);

});

$(document).ready(function () {
    let selectedNumber = $('#vehicle_id').find(':selected').data('number') || '';
    $('#vehicle_number').val(selectedNumber);

});
</script>
@endpush