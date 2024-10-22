@extends('layouts.app')

@section('content')
<div class="container-xxl mt-4 flex-grow-1 container-p-y">
    <div class="row g-4 mb-4">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>
    
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Add Employee</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('employees.store') }}" method="POST">
                        @csrf
                        <!-- First Name -->
                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}">
                            @error('first_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Last Name -->
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}">
                            @error('last_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Employee Number -->
                        <div class="mb-3">
                            <label for="employee_number" class="form-label">Employee Number</label>
                            <input type="text" name="employee_number" class="form-control" value="{{ old('employee_number') }}">
                            @error('employee_number')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                            @error('phone')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Employee Status -->
                        <div class="mb-3">
                            <label for="employee_status" class="form-label">Employee Status</label>
                            <select class="form-select" id="employee_status" name="employee_status">
                                <option value="">Select Status</option>
                                <option value="1" {{ old('employee_status') == '1' ? 'selected' : '' }}>Part-Time</option>
                                <option value="2" {{ old('employee_status') == '2' ? 'selected' : '' }}>Full-Time</option>
                            </select>
                            @error('employee_status')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Date of Birth -->
                        <div class="mb-3">
                            <label for="date_of_birth" class="form-label">Date of Birth</label>
                            <input type="date" name="date_of_birth" class="form-control" value="{{ old('date_of_birth') }}">
                            @error('date_of_birth')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Hire Date -->
                        <div class="mb-3">
                            <label for="hire_date" class="form-label">Hire Date</label>
                            <input type="date" name="hire_date" class="form-control" value="{{ old('hire_date') }}">
                            @error('hire_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Seniority Date -->
                        <div class="mb-3">
                            <label for="seniority_date" class="form-label">Seniority Date</label>
                            <input type="date" name="seniority_date" class="form-control" value="{{ old('seniority_date') }}">
                            @error('seniority_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Uniform Pant Size -->
                        <div class="mb-3">
                            <label for="uniform_pant_size" class="form-label">Uniform Pant Size</label>
                            <input type="text" name="uniform_pant_size" class="form-control" value="{{ old('uniform_pant_size') }}">
                            @error('uniform_pant_size')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Uniform Shirt Size -->
                        <div class="mb-3">
                            <label for="uniform_shirt_size" class="form-label">Uniform Shirt Size</label>
                            <input type="text" name="uniform_shirt_size" class="form-control" value="{{ old('uniform_shirt_size') }}">
                            @error('uniform_shirt_size')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Comments -->
                        <div class="mb-3">
                            <label for="comments" class="form-label">Comments</label>
                            <textarea name="comments" class="form-control">{{ old('comments') }}</textarea>
                        </div>

                        <!-- Submit and Cancel buttons -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Add Employee</button>
                            <a href="{{ route('employees.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
