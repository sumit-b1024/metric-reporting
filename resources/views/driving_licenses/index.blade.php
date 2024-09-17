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

    <!-- Datatable Card -->
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Driving Licenses List</h5>
            <a href="{{ route('driving-licenses.create') }}" class="btn btn-success float-right">+ Add Driving License</a>
            <button type="button" class="btn btn-success float-right mr-1" data-bs-toggle="modal" data-bs-target="#bulkImportModal">
                Bulk Import Licenses
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
                    <h5 class="modal-title" id="bulkImportModalLabel">Bulk Import Driving Licenses</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('driving-licenses.import') }}" method="POST" enctype="multipart/form-data">
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
                                    <li>The CSV file should include the following columns: <code>employee_id, driving_id, expire_date, renew_date, image</code>.</li>
                                    <li><strong>employee_id</strong> should correspond to an existing employee's ID in the database.</li>
                                    <li><strong>expire_date</strong> and <strong>renew_date</strong> must be in the <strong>YYYY-MM-DD</strong> format.</li>
                                    <li>The <strong>image</strong> column should contain the filenames of images that should exist on the server.</li>
                                </ul>
                            </small>

                            <!-- Link to Download Sample CSV -->
                            <div class="mt-3">
                                <a href="{{ asset('sample_driving_license.csv') }}" class="btn btn-link">Download Sample CSV</a>
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
