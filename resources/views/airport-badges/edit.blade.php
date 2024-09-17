@extends('layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Edit Airport SIDA Badge</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('airport-badge.update', $airportBadge->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="employee_id" class="form-label">Employee</label>
                                    <select class="form-select select-search" id="employee_id" name="employee_id" aria-label="Select Employee">
                                        <option selected>Select Employee</option>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}" {{ old('employee_id', $airportBadge->employee_id) == $employee->id ? 'selected' : '' }}>
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
                                    <label for="privilege" class="form-label">Privilege</label>
                                    <input type="text" name="privilege" class="form-control" value="{{ old('privilege', $airportBadge->privilege) }}" required>
                                    @error('privilege')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>  
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="security_front_id" class="form-label">Security Front ID</label>
                                    <input type="text" name="security_front_id" class="form-control" value="{{ old('security_front_id', $airportBadge->security_front_id) }}" required>
                                    @error('security_front_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="security_back_id" class="form-label">Security Back ID</label>
                                    <input type="text" name="security_back_id" class="form-control" value="{{ old('security_back_id', $airportBadge->security_back_id) }}" required>
                                    @error('security_back_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>                      
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="expire_date" class="form-label">Expire Date</label>
                                    <input type="date" name="expire_date" class="form-control" value="{{ old('expire_date', $airportBadge->expire_date) }}" required>
                                    @error('expire_date')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="renew_date" class="form-label">Renew Date</label>
                                    <input type="date" name="renew_date" class="form-control" value="{{ old('renew_date', $airportBadge->renew_date) }}">
                                    @error('renew_date')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="image_front" class="form-label">Image Front</label>
                                    <input type="file" name="image_front" class="form-control">
                                    @error('image_front')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Leave blank to keep the current image.</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="image_back" class="form-label">Image Back</label>
                                    <input type="file" name="image_back" class="form-control">
                                    @error('image_back')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Leave blank to keep the current image.</small>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">Update Airport SIDA Badge</button>
                        <a href="{{ route('airport-badge.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
