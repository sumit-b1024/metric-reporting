@extends('layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Add Security Guard License</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('security-guard-licenses.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="employee_id" class="form-label">Employee</label>
                                    <select class="form-select select-search" id="employee_id" name="employee_id" aria-label="Select Employee">
                                        <option selected>Select Employee</option>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
                                                {{ $employee->first_name . " " . $employee->last_name . " - " . $employee->email }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('employee_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="security_id" class="form-label">Security ID</label>
                                    <input type="text" name="security_id" class="form-control" value="{{ old('security_id') }}">
                                    @error('security_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="security_status" class="form-label">Security Status</label>
                                    <input type="text" name="security_status" class="form-control" value="{{ old('security_status') }}">
                                    @error('security_status')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>  
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="license_type" class="form-label">License Type</label>
                                    <input type="text" name="license_type" class="form-control" value="{{ old('license_type') }}">
                                    @error('license_type')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>                      

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="renew_date" class="form-label">Renew Date</label>
                                    <input type="date" name="renew_date" class="form-control" value="{{ old('renew_date') }}">
                                    @error('renew_date')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="expire_date" class="form-label">Expire Date</label>
                                    <input type="date" name="expire_date" class="form-control" value="{{ old('expire_date') }}">
                                    @error('expire_date')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="link" class="form-label">Link</label>
                            <input type="url" name="link" class="form-control" value="{{ old('link') }}">
                            @error('link')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">License Image</label>
                            <input type="file" name="image" class="form-control">
                            @error('image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success">Add Security Guard License</button>
                        <a href="{{ route('security-guard-licenses.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
