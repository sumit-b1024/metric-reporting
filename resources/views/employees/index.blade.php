@extends('layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
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
    </div>

    <!-- Add Employee Button -->
    <div class="mb-3">
        <a href="{{ route('employees.create') }}" class="btn btn-success">Add Employee</a>
    </div>

    <!-- Datatable Card -->
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Employees List</h5>
        </div>
        <div class="card-body">
            {!! $dataTable->table(['class' => 'datatables-users table border-top']) !!}
        </div>
    </div>
</div>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
