@extends('layouts.app')

@section('content')
<div class="container-xxl mt-4 flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Edit Security Guard License</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('security-guard-licenses.update', $securityGuardLicense->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="employee_id" class="form-label">Employee</label>
                                    <select class="form-select select-search" id="employee_id" name="employee_id" aria-label="Select Employee">
                                        <option selected>Select Employee</option>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}" {{ old('employee_id', $securityGuardLicense->employee_id) == $employee->id ? 'selected' : '' }}>
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
                                    <input type="text" name="security_id" class="form-control" value="{{ old('security_id', $securityGuardLicense->security_id) }}">
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
                                    <input type="text" name="security_status" class="form-control" value="{{ old('security_status', $securityGuardLicense->security_status) }}">
                                    @error('security_status')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>  
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="license_type" class="form-label">License Type</label>
                                    <input type="text" name="license_type" class="form-control" value="{{ old('license_type', $securityGuardLicense->license_type) }}">
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
                                    <input type="date" name="renew_date" class="form-control" value="{{ old('renew_date', $securityGuardLicense->renew_date) }}">
                                    @error('renew_date')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="expire_date" class="form-label">Expire Date</label>
                                    <input type="date" name="expire_date" class="form-control" value="{{ old('expire_date', $securityGuardLicense->expire_date) }}">
                                    @error('expire_date')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="link" class="form-label">Link</label>
                            <input type="url" name="link" class="form-control" value="{{ old('link', $securityGuardLicense->link) }}">
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
                            <small class="text-muted">Leave blank to keep the current image.</small>
                        </div>

                        <button type="submit" class="btn btn-success">Update License</button>
                        <a href="{{ route('security-guard-licenses.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
