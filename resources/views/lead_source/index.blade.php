@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<div class="container-xxl mt-4 flex-grow-1 container-p-y">
    <div class="row g-4 mb-4">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
        @endif
    </div>
    <div class="card">
        <div class="card-header border-bottom">
            <h5 class="card-title">Lead Source</h5>
            <div class="d-flex justify-content-between align-items-center row py-3 gap-3 gap-md-0">
                <div class="col-md-4 user_role"></div>
                <div class="col-md-4 user_plan"></div>
                <div class="col-md-4 user_status"></div>
            </div>
        </div>
        <div class="card-datatable table-responsive">
            <table class="datatables-users table border-top">
                <thead>
                    <tr>
                        <th>Lead Source</th>
                        <th>Created By</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lead_sources as $lead_source)
                    <tr>
                        <td>{{$lead_source->name}}</td>
                        <td>{{$lead_source->created_by}}</td>
                        <td><span class="badge bg-label-success">Active</span></td>
                        <td>
                            <div class="d-inline-block text-nowrap">
                                <button class="btn btn-sm btn-icon editButton" data-bs-target="#offcanvasAddLeadSource" data-bs-toggle="offcanvas" data-id={{$lead_source->id}}><i class="bx bx-edit"></i></button><button class="btn btn-sm btn-icon delete-record" data-id={{$lead_source->id}} data-bs-toggle="modal" data-route={{route('lead-source.destroy', $lead_source->id)}} data-bs-target="#toggleModal" data-content="Are you sure you want to delete this Lead Source?"><i class="bx bx-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddLeadSource" aria-labelledby="offcanvasAddLeadSourceLabel">
            <div class="offcanvas-header">
                <h5 id="offcanvasAddLeadSourceLabel" class="offcanvas-title">Add Lead Source</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body mx-0 flex-grow-0">
                <div id="message"></div>
                <form class="add-new-user pt-0" id="addNewLeadSourceForm" action="{{route('lead-source.store')}}" onsubmit="return false">
                    @csrf
                    <input type="hidden" name="id" value="" id="edit-id">
                    <div class="mb-3">
                        <label class="form-label" for="name">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Name" name="name" aria-label="Name" />
                        <div id="nameError" class="text-danger"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="status">Status</label>
                        <select id="status" class="form-select" name='status'>
                            <option value='active'>Active</option>
                            <option value='inactive'>Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button>
                    <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{asset('assets/js/app-lead-source-list.js')}}"></script>
<script>
    $(document).on('click', '.editButton', function() {
        openEditModalWithFetch($(this).attr('data-id'));
    });
    $(document).ready(function() {
        $('#addNewLeadSourceForm').submit(function(event) {
            if($('#edit-id').val() !== '') {
                var route = '/lead-source/' + $('#edit-id').val();
                var method = 'PUT';
            } else {
                var route = $(this).attr('action');
                var method = 'POST';
            }
            event.preventDefault(); // Prevent default form submission

            $.ajax({
                url: route,
                type: method,
                data: $(this).serialize(),
                success: function(response) {
                    // Clear previous error messages
                    $('#nameError').html('');

                    // Check if validation errors exist
                    if (response.errors) {
                        if (response.errors.name) {
                            $('#nameError').html(response.errors.name[0]);
                        }
                    } else {
                        if (response.success){
                            $('#message').html('<div class="alert alert-success" role="alert">' + response.success + '</div>');
                        } else {
                            $('#message').html('<div class="alert alert-danger" role="alert">' + response.error + '</div>');
                        }
                        setTimeout(function() {location.reload();}, 2000);
                    }
                },
                error: function(xhr) {
                    // Handle AJAX errors if any
                    response = JSON.parse(xhr.responseText);
                    if (response.errors.name) {
                        $('#nameError').html(response.errors.name[0]);
                    } else {
                        if (response.success){
                            $('#message').html('<div class="alert alert-success" role="alert">' + response.success + '</div>');
                        } else {
                            $('#message').html('<div class="alert alert-danger" role="alert">' + response.error + '</div>');
                        }
                    }
                }
            });
        });
    });
    function openEditModalWithFetch(id) {
        $.ajax({
            url: '/lead-source/' + id,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.status == 'success') {
                    var data = JSON.parse(response.data.lead_source);
                    $('#edit-id').val(id);
                    $('#name').val(data.name);
                    $('#addNewLeadSourceForm').attr('class', 'editLeadSourceForm');
                } else {
                    console.error('Failed to fetch permission data');
                }
            },
            error: function(xhr) {
                // Handle AJAX error
                console.error('Error fetching permission data:', xhr.responseText);
            }
        });
    }
</script>
@endsection