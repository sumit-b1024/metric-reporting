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
                    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="mobile" class="form-label">Mobile</label>
                                    <input type="number" name="mobile" class="form-control" value="{{ old('mobile', $user->phone) }}">
                                    @error('mobile')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>  
                            </div>
                        </div>                      

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">email</label>
                                    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" value="{{ old('password', $user->password) }}">
                                    @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-success">Update License</button>
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
