@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<div class="container-xxl flex-grow-1 container-p-y">
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
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Session</span>
                            <div class="d-flex align-items-end mt-2">
                                <h4 class="mb-0 me-2">21,459</h4>
                                <small class="text-success">(+29%)</small>
                            </div>
                            <p class="mb-0">Total Users</p>
                        </div>
                        <div class="avatar">
                            <span class="avatar-initial rounded bg-label-primary">
                            <i class="bx bx-user bx-sm"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Paid Users</span>
                            <div class="d-flex align-items-end mt-2">
                                <h4 class="mb-0 me-2">4,567</h4>
                                <small class="text-success">(+18%)</small>
                            </div>
                            <p class="mb-0">Last week analytics </p>
                        </div>
                        <div class="avatar">
                            <span class="avatar-initial rounded bg-label-danger">
                            <i class="bx bx-user-check bx-sm"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Active Users</span>
                            <div class="d-flex align-items-end mt-2">
                                <h4 class="mb-0 me-2">19,860</h4>
                                <small class="text-danger">(-14%)</small>
                            </div>
                            <p class="mb-0">Last week analytics</p>
                        </div>
                        <div class="avatar">
                            <span class="avatar-initial rounded bg-label-success">
                            <i class="bx bx-group bx-sm"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Pending Users</span>
                            <div class="d-flex align-items-end mt-2">
                                <h4 class="mb-0 me-2">237</h4>
                                <small class="text-success">(+42%)</small>
                            </div>
                            <p class="mb-0">Last week analytics</p>
                        </div>
                        <div class="avatar">
                            <span class="avatar-initial rounded bg-label-warning">
                            <i class="bx bx-user-voice bx-sm"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Users List Table -->
    <div class="card">
        <div class="card-header border-bottom">
            <h5 class="card-title">Search Filter</h5>
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
                        <th>User</th>
                        <th>Role</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>
                            <div class="d-flex justify-content-start align-items-center user-name">
                                <div class="avatar-wrapper">
                                    <div class="avatar avatar-sm me-3"><img src="../../assets/img/avatars/2.png" alt="Avatar" class="rounded-circle"></div>
                                </div>
                                <div class="d-flex flex-column"><a href="app-user-view-account.html" class="text-body text-truncate"><span class="fw-medium">{{$user->name}}</span></a><small class="text-muted">{{$user->email}}</small></div>
                            </div>
                        </td>
                        <td><span class="text-truncate d-flex align-items-center"><span class="badge badge-center rounded-pill bg-label-primary w-px-30 h-px-30 me-2"><i class="bx bx-pie-chart-alt bx-xs"></i></span>Maintainer</span></td>
                        <td>{{$user->mobile}}</td>
                        <td><span class="badge bg-label-success">Active</span></td>
                        <td>
                            <div class="d-inline-block text-nowrap">
                                <button class="btn btn-sm btn-icon editButton" data-bs-target="#offcanvasAddUser" data-bs-toggle="offcanvas" data-id={{$user->id}}><i class="bx bx-edit"></i></button><button class="btn btn-sm btn-icon delete-record" data-id={{$user->id}} data-bs-toggle="modal" data-route={{route('users.destroy', $user->id)}} data-bs-target="#toggleModal" data-content="Are you sure you want to delete this User?"><i class="bx bx-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- Offcanvas to add new user -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser" aria-labelledby="offcanvasAddUserLabel">
            <div class="offcanvas-header">
                <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add User</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body mx-0 flex-grow-0">
                <div id="message"></div>
                <form class="add-new-user pt-0" id="addNewUserForm" action="{{route('users.store')}}" onsubmit="return false">
                    @csrf
                    <input type="hidden" name="id" value="" id="edit-id">
                    <div class="mb-3">
                        <label class="form-label" for="name">Full Name</label>
                        <input type="text" class="form-control" id="name" placeholder="User Full Name" name="name" aria-label="User Full Name" />
                        <div id="nameError" class="text-danger"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="email">Email</label>
                        <input type="text" id="email" class="form-control" placeholder="User Email ID" aria-label="User Email ID" name="email" />
                        <div id="emailError" class="text-danger"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="mobile">Contact</label>
                        <input type="text" id="mobile" class="form-control phone-mask" placeholder="User Contact Number" aria-label="User Contact Number" name="mobile" />
                        <div id="mobileError" class="text-danger"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="password">Password</label>
                        <input type="password" id="password" class="form-control" placeholder="Add Password" aria-label="jdoe1" name="password" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="user-role">User Role</label>
                        <select id="user-role" class="form-select" name='role'>
                            @foreach ($roles as $role)
                            <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
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
<script src="{{asset('assets/js/app-user-list.js')}}"></script>
<script>
    $(document).on('click', '.editButton', function() {
        openEditModalWithFetch($(this).attr('data-id'));
    });
    $(document).ready(function() {
        $('#addNewUserForm').submit(function(event) {
            if($('#edit-id').val() !== '') {
                var route = '/users/' + $('#edit-id').val();
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
                        if (response.errors.email) {
                            $('#emailError').html(response.errors.email[0]);
                        }
                        if (response.errors.mobile) {
                            $('#mobileError').html(response.errors.mobile[0]);
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
    function openEditModalWithFetch(userId) {
        $.ajax({
            url: '/users/' + userId,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.status == 'success') {
                    var userData = JSON.parse(response.data.user);
                    $('#edit-id').val(userId);
                    $('#name').val(userData.name);
                    $('#email').val(userData.email);
                    $('#mobile').val(userData.mobile);
                    $('#password').val(userData.password);
                    $('#addNewUserForm').attr('class', 'editUserForm');
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