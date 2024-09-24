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
    </div>

    <!-- Add Employee Button -->
    

    <!-- Datatable Card -->
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Employees List
                <a href="{{ route('employees.create') }}" class="btn btn-success float-right">+ Add Employee</a>
                <button type="button" class="btn btn-success float-right mr-1" data-bs-toggle="modal" data-bs-target="#bulkImportModal">
                    Bulk Import
                </button>
            </h5>
        </div>
        
        <div class="card-body">
            {!! $dataTable->table(['class' => 'table table-responsive']) !!}
        </div>
    </div>
    <div class="modal fade" id="bulkImportModal" tabindex="-1" aria-labelledby="bulkImportModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bulkImportModalLabel">Bulk Import Employees</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('employees.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="file" class="form-label">Choose CSV File</label>
                            <input type="file" name="file" class="form-control" required accept=".csv">
                            @error('file')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted mt-5">
                                <strong>Instructions for File Upload:</strong>
                                <ul>
                                    <li>The file must be in <strong>CSV</strong> format.</li>
                                    <li>Maximum file size allowed: <strong>2MB</strong>.</li>
                                    <li>The CSV file should include the following columns: <code>employee_number, first_name, last_name, email, phone, employee_status, date_of_birth, hire_date, comments</code>.</li>
                                    <li><strong>employee_status</strong> should be either "Full Time" or "Part Time".</li>
                                    <li>Make sure the <strong>date_of_birth</strong> and <strong>hire_date</strong> columns are in <strong>YYYY-MM-DD</strong> format.</li>
                                    <li>The <strong>email</strong> column should contain valid email addresses.</li>
                                    <li>The <strong>employee_number</strong> must be unique for each employee.</li>
                                </ul>
                            </small>
                            <div class="mt-3">
                                <a href="{{ asset('sample_employees.csv') }}" class="btn btn-link">Download Sample CSV</a>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Import</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
{!! $dataTable->scripts() !!}
@endpush
