@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-2">Permissions List</h4>
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
    <p class="mb-4">Each category (Basic, Professional, and Business) includes the four predefined roles shown below.</p>
    <!-- Permission Table -->
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="datatables-permissions table border-top">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th class="sorting_disabled">Operation</th>
                        <th class="sorting_disabled">Created Date</th>
                        <th class="sorting_disabled">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $colors = [
                            'list'      => 'info',
                            'create'    => 'primary',
                            'edit'      => 'success',
                            'delete'    => 'danger'
                        ]
                    @endphp
                    @foreach ($permission_groups as $permission_group)
                    <tr>
                        <td><span class="text-nowrap">{{$permission_group->name}}</span></td>
                        <td>
                            <span class="text-nowrap">
                                @foreach ($permission_group->permissions as $permission)
                                    <span class="badge  bg-label-{{$colors[substr($permission->name, strpos($permission->name, "-") + 1)]}} m-1">{{substr($permission->name, strpos($permission->name, "-") + 1)}}</span>
                                @endforeach
                            </span>
                        </td>
                        <td><span class="text-nowrap">{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $permission_group->created_at)->format('d M Y, g:i A')}}</span></td>
                        <td>
                            <span class="text-nowrap">
                                <button class="btn btn-sm btn-icon me-2 editButton" data-bs-target="#editPermissionModal" data-bs-toggle="modal" data-bs-dismiss="modal" data-id={{$permission_group->id}}><i class="bx bx-edit"></i></button>
                                <button class="btn btn-sm btn-icon delete-record" data-id={{$permission_group->id}} data-bs-toggle="modal" data-route={{route('permissions.destroy', $permission_group->id)}} data-bs-target="#toggleModal" data-content="Are you sure you want to delete this permission?"><i class="bx bx-trash"></i></button>
                            </span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!--/ Permission Table -->
    <!-- Modal -->
    <!-- Add Permission Modal -->
    <div class="modal fade" id="addPermissionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-simple">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                        <h3>Add New Permission</h3>
                        <p>Permissions you may use and assign to your users.</p>
                    </div>
                    <div id="message"></div>
                    <form id="addPermissionForm" class="row" action={{route('permissions.store')}}>
                        @csrf
                        <div class="col-12 mb-3">
                            <label class="form-label" for="modalPermissionName">Permission Name</label>
                            <input type="text" id="modalPermissionName" name="name" class="form-control" placeholder="Permission Name" autofocus />
                            <div id="nameError" class="text-danger"></div>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label" for="prefix">Prefix</label>
                            <input type="text" id="prefix" name="prefix" class="form-control" placeholder="Prefix"/>
                            <div id="prefixError" class="text-danger"></div>
                        </div>
                        <div class="col-12 mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="list" name="operation[]" value="list"/>
                                <label class="form-check-label" for="list">
                                List
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="create" name="operation[]" value="create"/>
                                <label class="form-check-label" for="create">
                                Create
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="edit" name="operation[]" value="edit"/>
                                <label class="form-check-label" for="edit">
                                Edit
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="delete" name="operation[]" value="delete" />
                                <label class="form-check-label" for="delete">
                                Delete
                                </label>
                            </div>
                            <div id="operationError" class="text-danger"></div>
                        </div>
                        <div class="col-12 text-center demo-vertical-spacing">
                            <button type="submit" class="btn btn-primary me-sm-3 me-1">Create Permission</button>
                            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Discard</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/ Add Permission Modal -->
    <!-- Edit Permission Modal -->
    <div class="modal fade" id="editPermissionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-simple">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                        <h3>Edit Permission</h3>
                        <p>Edit permission as per your requirements.</p>
                    </div>
                    <div class="alert alert-warning" role="alert">
                        <h6 class="alert-heading mb-2">Warning</h6>
                        <p class="mb-0">By editing the permission name, you might break the system permissions functionality. Please ensure you're absolutely certain before proceeding.</p>
                    </div>
                    <div id="edit-message"></div>
                    <form id="editPermissionForm" class="row">
                        @csrf
                        <input type="hidden" name="id" value="" id="edit-id">
                        <div class="col-12 mb-3">
                            <label class="form-label" for="editPermissionName">Permission Name</label>
                            <input type="text" id="editPermissionName" name="name" class="form-control" placeholder="Permission Name" autofocus />
                            <div id="editNameError" class="text-danger"></div>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label" for="editPrefix">Prefix</label>
                            <input type="text" id="editPrefix" name="prefix" class="form-control" placeholder="Prefix"/>
                            <div id="editPrefixError" class="text-danger"></div>
                        </div>
                        <div class="col-12 mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="edit-list" name="operation[]" value="list"/>
                                <label class="form-check-label" for="edit-list">
                                List
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="edit-create" name="operation[]" value="create"/>
                                <label class="form-check-label" for="edit-create">
                                Create
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="edit-edit" name="operation[]" value="edit"/>
                                <label class="form-check-label" for="edit-edit">
                                Edit
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="edit-delete" name="operation[]" value="delete" />
                                <label class="form-check-label" for="edit-delete">
                                Delete
                                </label>
                            </div>
                            <div id="editOperationError" class="text-danger"></div>
                        </div>
                        <div class="col-sm-3 mb-3">
                            <label class="form-label invisible d-none d-sm-inline-block">Button</label>
                            <button type="submit" class="btn btn-primary mt-1 mt-sm-0">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/ Edit Permission Modal -->
    <!-- /Modal -->
</div>
@endsection
@section('js')
<script src="{{asset('assets/js/app-access-permission.js')}}"></script>
<script>
    $(document).on('click', '.editButton', function() {
        openEditModalWithFetch($(this).attr('data-id'));
    });
    $(document).ready(function() {
        $('#addPermissionForm').submit(function(event) {
            event.preventDefault(); // Prevent default form submission

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    // Clear previous error messages
                    $('#nameError').html('');
                    $('#prefixError').html('');
                    $('#operationError').html('');

                    // Check if validation errors exist
                    if (response.errors) {
                        if (response.errors.name) {
                            $('#nameError').html(response.errors.name[0]);
                        }
                        if (response.errors.prefix) {
                            $('#prefixError').html(response.errors.prefix[0]);
                        }
                        if (response.errors.operation) {
                            $('#operationError').html(response.errors.operation[0]);
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
                    }
                    if (response.errors.prefix) {
                        $('#prefixError').html(response.errors.prefix[0]);
                    }
                    if (response.errors.operation) {
                        $('#operationError').html(response.errors.operation[0]);
                    }
                    if (response.success){
                        $('#message').html('<div class="alert alert-success" role="alert">' + response.success + '</div>');
                    } else {
                        $('#message').html('<div class="alert alert-danger" role="alert">' + response.error + '</div>');
                    }
                }
            });
        });
        $('#editPermissionForm').submit(function(event) {
            event.preventDefault(); // Prevent default form submission

            $.ajax({
                url: '/permissions/' + $('#edit-id').val(),
                type: 'PUT',
                data: $(this).serialize(),
                success: function(response) {
                    // Clear previous error messages
                    $('#nameError').html('');
                    $('#prefixError').html('');
                    $('#operationError').html('');

                    // Check if validation errors exist
                    if (response.errors) {
                        if (response.errors.name) {
                            $('#editNameError').html(response.errors.name[0]);
                        }
                        if (response.errors.prefix) {
                            $('#editPrefixError').html(response.errors.prefix[0]);
                        }
                        if (response.errors.operation) {
                            $('#editOperationError').html(response.errors.operation[0]);
                        }
                    } else {
                        if (response.success){
                            $('#edit-message').html('<div class="alert alert-success" role="alert">' + response.success + '</div>');
                        } else {
                            $('#edit-message').html('<div class="alert alert-danger" role="alert">' + response.error + '</div>');
                        }
                        setTimeout(function() {location.reload();}, 2000);
                    }
                },
                error: function(xhr) {
                    // Handle AJAX errors if any
                    response = JSON.parse(xhr.responseText);
                    if (response.errors.name) {
                        $('#editNameError').html(response.errors.name[0]);
                    }
                    if (response.errors.prefix) {
                        $('#editPrefixError').html(response.errors.prefix[0]);
                    }
                    if (response.errors.operation) {
                        $('#editOperationError').html(response.errors.operation[0]);
                    }
                    if (response.success){
                        $('#edit-message').html('<div class="alert alert-success" role="alert">' + response.success + '</div>');
                    } else {
                        $('#edit-message').html('<div class="alert alert-danger" role="alert">' + response.error + '</div>');
                    }
                }
            });
        });
    });
    function openEditModalWithFetch(permissionId) {
        $.ajax({
            url: '/permissions/' + permissionId,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.status == 'success') {
                    var permissionData = JSON.parse(response.data);
                    $('#edit-id').val(permissionId);
                    $('#editPermissionName').val(permissionData.name);
                    $('#editPrefix').val(permissionData.permissions[0].name.split('-')[0]);
                    $('input[name="operation[]"]').prop('checked', false); // Uncheck all checkboxes first
                    $.each(permissionData.permissions, function(index, value) {
                        var str = value.name;
                        var parts = str.split('-');
                        $('#edit-' + parts[1]).prop('checked', true);
                    });
                    $('#editPermissionModal').modal('show');
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