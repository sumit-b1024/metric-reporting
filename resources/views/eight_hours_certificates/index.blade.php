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

    <!-- Datatable Card -->
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">8-Hours Certificates List</h5>
            <a href="{{ route('eight-hours-certificates.create') }}" class="btn btn-success float-right">+ Add Certificate</a>
            <button type="button" class="btn btn-success float-right mr-1" data-bs-toggle="modal" data-bs-target="#bulkImportModal">
                Bulk Import Certificates
            </button>
        </div>
        <div class="card-body">
            {!! $dataTable->table(['class' => 'table table-responsive']) !!}
        </div>
    </div>

    <!-- Bulk Import Modal -->
    <div class="modal fade" id="bulkImportModal" tabindex="-1" aria-labelledby="bulkImportModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bulkImportModalLabel">Bulk Import 8-Hours Certificates</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('eight-hours-certificates.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="file" class="form-label">Choose CSV File</label>
                            <input type="file" name="file" class="form-control" required accept=".csv">
                            @error('file')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror

                            <!-- Validation Points -->
                            <small class="form-text text-muted mt-2">
                                <strong>Instructions for File Upload:</strong>
                                <ul>
                                    <li>The file must be in <strong>CSV</strong> format.</li>
                                    <li>Maximum file size allowed: <strong>2MB</strong>.</li>
                                    <li>The CSV file should include the following columns: <code>employee_id, certificate_id, expire_date, license_type, missing_annual_training, image</code>.</li>
                                    <li><strong>employee_id</strong> should correspond to an existing employee's ID in the database.</li>
                                    <li><strong>expire_date</strong> must be in the <strong>MM-DD-YYYY</strong> format.</li>
                                    <li>The <strong>image</strong> column should contain the filenames of images that should exist on the server.</li>
                                </ul>
                            </small>

                            <!-- Link to Download Sample CSV -->
                            <div class="mt-3">
                                <a href="{{ asset('sample_eight_hours_certificate.csv') }}" class="btn btn-link">Download Sample CSV</a>
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
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
