@extends('layouts.app')

@section('content')
<h1>Manage Users</h1>
<button class="btn btn-success mb-3" id="createUserBtn">Create New User</button>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Selected Service</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody id="userTableBody">
        <!-- User rows will be populated here by AJAX -->
    </tbody>
</table>

<!-- Modal for creating and editing users -->
<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Create/Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="userForm">
                    <input type="hidden" id="userId">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="serviceId" class="form-label">Select Service</label>
                        <select class="form-control" id="serviceId">
                            <!-- Service options will be populated by AJAX -->
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Fetch users and populate the table
        function fetchUsers() {
            $.ajax({
                url: '{{ url("/api/users") }}',
                method: 'GET',
                success: function(data) {
                    console.log('data', data)
                    let userTableBody = $('#userTableBody');
                    userTableBody.empty();
                    data.forEach(function(user) {
                        userTableBody.append(`
                                <tr>
                                    <td>${user.id}</td>
                                    <td>${user.username}</td>
                                    <td>${user.service_id || 'Not Selected'}</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm editUserBtn" data-id="${user.id}" data-username="${user.username}" data-service-id="${user.service_id}">Edit</button>
                                        <button class="btn btn-danger btn-sm deleteUserBtn" data-id="${user.id}">Delete</button>
                                    </td>
                                </tr>
                            `);
                    });
                }
            });
        }

        fetchUsers();

        // Fetch services and populate the select box
        function fetchServicesForSelect() {
            $.ajax({
                url: '{{ url("/api/services") }}',
                method: 'GET',
                success: function(data) {
                    let serviceSelect = $('#serviceId');
                    console.log('s', serviceSelect)
                    serviceSelect.empty();
                    data.forEach(function(service) {
                        serviceSelect.append(`<option value="${service.id}">${service.name}</option>`);
                    });
                }
            });
        }

        // Show the modal for creating a new user
        $('#createUserBtn').click(function() {
            $('#userId').val('');
            $('#username').val('');
            fetchServicesForSelect();
            $('#userModal').modal('show');
        });

        // Save or update user
        $('#userForm').submit(function(e) {
            e.preventDefault();
            let userId = $('#userId').val();
            let username = $('#username').val();
            let serviceId = $('#serviceId').val();
            let url = userId ? `{{ url('/api/users/') }}/${userId}` : `{{ url('/api/users') }}`;
            let method = userId ? 'PUT' : 'POST';

            $.ajax({
                url: url,
                method: method,
                data: {
                    username: username,
                    service_id: serviceId,
                    _token: '{{ csrf_token() }}'
                },
                success: function() {
                    $('#userModal').modal('hide');
                    fetchUsers();
                }
            });
        });

        // Edit user
        $(document).on('click', '.editUserBtn', function() {
            let userId = $(this).data('id');
            let username = $(this).data('username');
            let serviceId = $(this).data('service-id');
            $('#userId').val(userId);
            $('#username').val(username);
            fetchServicesForSelect();
            $('#serviceId').val(serviceId);
            $('#userModal').modal('show');
        });

        // Delete user
        $(document).on('click', '.deleteUserBtn', function() {
            let userId = $(this).data('id');
            // console.log('userid', userId)
            $.ajax({                
                url: `{{ url('/api/users/') }}/${userId}`,
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function() {
                    fetchUsers();
                }
            });
        });
    });
</script>
@endsection