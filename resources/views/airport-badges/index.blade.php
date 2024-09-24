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
            <h5 class="card-title">Airport SIDA Badges List</h5>
            <a href="{{ route('airport-badge.create') }}" class="btn btn-success float-right">+ Add Airport SIDA Badge</a>
            <button type="button" class="btn btn-success float-right mr-1" data-bs-toggle="modal" data-bs-target="#bulkImportModal">
                Bulk Airport SIDA Badges
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
                    <h5 class="modal-title" id="bulkImportModalLabel">Bulk Import Airport Badges</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('airport_badge.import') }}" method="POST" enctype="multipart/form-data">
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
                                    <li>The CSV file should include the following columns: <code>employee_id, security_front_id, security_back_id, privilege, expire_date, renew_date, front_image, back_image</code>.</li>
                                    <li><strong>employee_id</strong> should correspond to an existing employee's ID in the database.</li>
                                    <li><strong>expire_date</strong> and <strong>renew_date</strong> must be in the <strong>YYYY-MM-DD</strong> format.</li>
                                    <li>The <strong>front_image</strong> and <strong>back_image</strong> columns should contain the filenames of images that should exist on the server.</li>
                                </ul>
                            </small>

                            <!-- Link to Download Sample CSV -->
                            <div class="mt-3">
                                <a href="{{ asset('sample_airport_badge.csv') }}" class="btn btn-link">Download Sample CSV</a>
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
