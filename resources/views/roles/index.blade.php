@extends('layouts.app')
@section('content')
<div class="container-xxl mt-4 flex-grow-1 container-p-y">
    <h4 class="py-3 mb-2">Roles List</h4>
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
    <p>A role provided access to predefined menus and features so that depending on <br> assigned role an administrator can have access to what user needs.</p>
    <!-- Role cards -->
    <div class="row g-4">
        @foreach ($roles as $role)
        <div class="col-xl-4 col-lg-6 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                       
                        
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-end">
                        <div class="role-heading">
                            <h4 class="mb-1">{{$role->name}}</h4>
                            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal" class="role-edit-modal editButton" data-id={{$role->id}}><small>Edit Role</small></a>
                        </div>
                        <a href="javascript:void(0);" class="text-muted delete-record" data-id={{$role->id}} data-bs-toggle="modal" data-route={{route('roles.destroy', $role->id)}} data-bs-target="#toggleModal" data-content="Are you sure you want to delete this Role?"><i class="fa-solid fa-trash"></i></a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <div class="col-xl-4 col-lg-6 col-md-6">
            <div class="card h-100">
                <div class="row h-100">
                    <div class="col-sm-5">
                        <div class="d-flex align-items-end h-100 justify-content-center mt-sm-0 mt-3">
                           
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="card-body text-sm-end text-center ps-sm-0">
                            <button data-bs-target="#addRoleModal" data-bs-toggle="modal" class="btn btn-primary mb-3 text-nowrap add-new-role">Add New Role</button>
                            <p class="mb-0">Add role, if it does not exist</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <!-- Role Table -->
            <div class="card">
                <div class="card-datatable table-responsive">
                    <table class="datatables-users table border-top">
                        <thead>
                            <tr>
                                <th>Role</th>
                                <th>No of Users</th>
                                <th>Created_At</th>
                               
                            </tr>
                        </thead>
                        @foreach ($roles as $role)
                        <tr>
                            <td><span class="text-nowrap">{{$role->name}}</span></td>
                            <td>{{ $role->users->count() }} Users</td> <!-- Dynamically fetch user count -->

                            <td><span class="text-nowrap">{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $role->created_at)->format('d M Y, g:i A')}}</span></td>
                            
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <!--/ Role Table -->
        </div>
    </div>
    <!--/ Role cards -->
    <!-- Add Role Modal -->
    <!-- Add Role Modal -->
    <div class="modal fade" id="addRoleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-simple modal-dialog-centered modal-add-new-role">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                        <h3 class="role-title">Add New Role</h3>
                        <p>Set role permissions</p>
                    </div>
                    <!-- Add role form -->
                    <div id="message"></div>
                    <form id="addRoleForm" class="row g-3" action="{{route('roles.store')}}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="" id="edit-id">
                        <div class="col-12 mb-4">
                            <label class="form-label" for="name">Role Name</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Enter a role name" tabindex="-1" />
                            <div id="nameError" class="text-danger"></div>
                        </div>
                        <div class="col-12">
                            <h4>Role Permissions</h4>
                            <!-- Permission table -->
                            <div class="table-responsive">
                                <table class="table table-flush-spacing">
                                    <tbody>
                                        <tr>
                                            <td class="text-nowrap fw-medium">Super Admin Access <i class="bx bx-info-circle bx-xs" data-bs-toggle="tooltip" data-bs-placement="top" title="Allows a full access to the system"></i></td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="selectAll" />
                                                    <label class="form-check-label" for="selectAll">
                                                    Select All
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                        @foreach ($permission_groups as $permission_group)    
                                        <tr>
                                            <td class="text-nowrap fw-medium">{{$permission_group->name}}</td>
                                            <td>
                                                <div class="d-flex">
                                                    @foreach ($permission_group->permissions as $permission)
                                                    <div class="form-check me-3 me-lg-5">
                                                        <input class="form-check-input" type="checkbox" id="{{$permission->name}}" value="{{$permission->name}}" name="permission[]"/>
                                                        <label class="form-check-label" for="{{$permission->name}}">
                                                            {{ucwords(substr($permission->name, strpos($permission->name, "-") + 1))}}
                                                        </label>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- Permission table -->
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                        </div>
                    </form>
                    <!--/ Add role form -->
                </div>
            </div>
        </div>
    </div>
    <!--/ Add Role Modal -->
    <!-- / Add Role Modal -->
</div>
@endsection
@section('js')
<script src="{{asset('assets/js/app-access-roles.js')}}"></script>
<script>
    const selectAllCheckbox = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('[type="checkbox"]');
    
    selectAllCheckbox.addEventListener('change', () => {
        checkboxes.forEach(checkbox => checkbox.checked = selectAllCheckbox.checked);
    });
    
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            selectAllCheckbox.checked = [...checkboxes].every(cb => cb.checked);
        });
    });
    $(document).on('click', '.editButton', function() {
        openEditModalWithFetch($(this).attr('data-id'));
    });
    $(document).ready(function() {
        $('#addRoleForm').submit(function(event) {
            if($('#edit-id').val() !== '') {
                var route = '/roles/' + $('#edit-id').val();
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
    function openEditModalWithFetch(roleId) {
        $.ajax({
            url: '/roles/' + roleId,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.status == 'success') {
                    var roleData = JSON.parse(response.data.role);
                    var rolePermission = JSON.parse(response.data.rolePermissions);
                    $('#edit-id').val(roleId);
                    $('#name').val(roleData.name);
                    $('input[name="permission[]"]').prop('checked', false); // Uncheck all checkboxes first
                    $.each(rolePermission, function(index, value) {
                        $('#' + value.name).prop('checked', true);
                    });
                    $('#addRoleForm').attr('class', 'editRoleForm');
                    $('#addRoleModal').modal('show');
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