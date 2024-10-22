@extends('layouts.app')

@section('content')
<div class="container-xxl mt-4 flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Edit Employee</h5>
                </div>
                <div class="card-body">
                    <!-- Display Validation Errors at the Top -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('employees.update', $employee->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="employee_number" class="form-label">Employee Number</label>
                            <input type="text" name="employee_number" class="form-control" value="{{ old('employee_number', $employee->employee_number) }}" required>
                            @error('employee_number')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $employee->first_name) }}" required>
                            @error('first_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $employee->last_name) }}" required>
                            @error('last_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $employee->email) }}" required>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone', $employee->phone) }}" required>
                            @error('phone')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="employee_status" class="form-label">Employee Status</label>
                            <select name="employee_status" class="form-control select-search" required>
                                <option value="">Select Status</option>
                                <option value="1" {{ old('employee_status', $employee->employee_status) == '1' ? 'selected' : '' }}>Full Time</option>
                                <option value="2" {{ old('employee_status', $employee->employee_status) == '2' ? 'selected' : '' }}>Part Time</option>
                            </select>
                            @error('employee_status')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="date_of_birth" class="form-label">Date of Birth</label>
                            <input type="date" name="date_of_birth" class="form-control" value="{{ old('date_of_birth', $employee->date_of_birth) }}" required>
                            @error('date_of_birth')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="hire_date" class="form-label">Hire Date</label>
                            <input type="date" name="hire_date" class="form-control" value="{{ old('hire_date', $employee->hire_date) }}" required>
                            @error('hire_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="seniority_date" class="form-label">Seniority Date</label>
                            <input type="date" name="seniority_date" class="form-control" value="{{ old('seniority_date', $employee->seniority_date) }}" required>
                            @error('seniority_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- New Uniform Pant Size Field -->
                        <div class="mb-4">
                            <label class="form-label" for="uniform_pant_size">Uniform Pant Size</label>
                            <input type="text" id="uniform_pant_size" name="uniform_pant_size" class="form-control" placeholder="Enter Uniform Pant Size" value="{{ old('uniform_pant_size', $employee->uniform_pant_size) }}" />
                            @error('uniform_pant_size')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- New Uniform Shirt Size Field -->
                        <div class="mb-4">
                            <label class="form-label" for="uniform_shirt_size">Uniform Shirt Size</label>
                            <input type="text" id="uniform_shirt_size"  value="{{ old('uniform_shirt_size', $employee->uniform_shirt_size) }}" name="uniform_shirt_size" class="form-control" placeholder="Enter Uniform Shirt Size" />
                            @error('uniform_shirt_size')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="comments" class="form-label">Comments</label>
                            <textarea name="comments" class="form-control">{{ old('comments', $employee->comments) }}</textarea>
                            @error('comments')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                 


                        <button type="submit" class="btn btn-success">Update Employee</button>
                        <a href="{{ route('employees.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
