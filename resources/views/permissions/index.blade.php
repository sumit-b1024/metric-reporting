@extends('layouts.app')
@section('content')
<div class="container-xxl mt-4 flex-grow-1 container-p-y">
    <h4 class="py-3 mb-2">Permissions List</h4>
    
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
                        ];
                    @endphp
                    
                    @foreach ($permission_groups as $permission_group)
                    <tr>
                        <td><span class="text-nowrap">{{ $permission_group->name }}</span></td>
                        <td>
                            <span class="text-nowrap">
                                @foreach ($permission_group->permissions as $permission)
                                    <span class="badge bg-label-{{ $colors[substr($permission->name, strpos($permission->name, "-") + 1)] }} m-1">
                                        {{ substr($permission->name, strpos($permission->name, "-") + 1) }}
                                    </span>
                                @endforeach
                            </span>
                        </td>
                        <td><span class="text-nowrap">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $permission_group->created_at)->format('d M Y, g:i A') }}</span></td>
                        <td>
                            <span class="text-nowrap">
                                <button class="btn btn-sm btn-icon me-2 editButton" data-id="{{ $permission_group->id }}">
                                    <i class="fa fa-pen"></i>
                                </button>
                                <button class="btn btn-sm btn-icon delete-record" data-id="{{ $permission_group->id }}" data-route="{{ route('permissions.destroy', $permission_group->id) }}">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
