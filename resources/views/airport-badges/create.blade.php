@extends('layouts.app')

@section('content')
<div class="container-xxl mt-4 flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Add Airport SIDA Badge</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('airport-badge.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="employee_id" class="form-label">Employee</label>
                                    <select class="form-select select-search" id="employee_id" name="employee_id" aria-label="Select User">
                                        <option selected>Select Employee</option>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : '' }}>{{ $employee->first_name . " " . $employee->last_name . " - " . $employee->email }}</option>
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
                                    <input type="text" name="privilege" class="form-control" value="{{ old('privilege') }}">
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
                                    <input type="text" name="security_front_id" class="form-control" value="{{ old('security_front_id') }}">
                                    @error('security_front_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="security_back_id" class="form-label">Security Back ID</label>
                                    <input type="text" name="security_back_id" class="form-control" value="{{ old('security_back_id') }}">
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
                                    <input type="date" name="expire_date" class="form-control" value="{{ old('expire_date') }}">
                                    @error('expire_date')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="renew_date" class="form-label">Renew Date</label>
                                    <input type="date" name="renew_date" class="form-control" value="{{ old('renew_date') }}">
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
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="image_back" class="form-label">Image Back</label>
                                    <input type="file" name="image_back" class="form-control">
                                    @error('image_back')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">Add Airport SIDA Badge</button>
                        <a href="{{ route('airport-badge.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
