@extends('layouts.app')

@section('content')
<h1>Manage Services</h1>
<button class="btn btn-success mb-3" id="createServiceBtn">Create New Service</button>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody id="serviceTableBody">
        <!-- Service rows will be populated here by AJAX -->
    </tbody>
</table>

<!-- Modal for creating and editing services -->
<div class="modal fade" id="serviceModal" tabindex="-1" aria-labelledby="serviceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="serviceModalLabel">Create/Edit Service</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="serviceForm">
                    <input type="hidden" id="serviceId">
                    <div class="mb-3">
                        <label for="serviceName" class="form-label">Service Name</label>
                        <input type="text" class="form-control" id="serviceName" required>
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
        // Fetch services and populate the table
        function fetchServices() {
            $.ajax({
                url: '{{ url("/api/services") }}',
                method: 'GET',
                success: function(data) {
                    let serviceTableBody = $('#serviceTableBody');
                    serviceTableBody.empty();
                    data.forEach(function(service) {
                        serviceTableBody.append(`
                                <tr>
                                    <td>${service.id}</td>
                                    <td>${service.name}</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm editServiceBtn" data-id="${service.id}" data-name="${service.name}">Edit</button>
                                        <button class="btn btn-danger btn-sm deleteServiceBtn" data-id="${service.id}">Delete</button>
                                    </td>
                                </tr>
                            `);
                    });
                }
            });
        }

        fetchServices();

        // Show the modal for creating a new service
        $('#createServiceBtn').click(function() {
            $('#serviceId').val('');
            $('#serviceName').val('');
            $('#serviceModal').modal('show');
        });

        // Save or update service
        $('#serviceForm').submit(function(e) {
            e.preventDefault();
            let serviceId = $('#serviceId').val();
            console.log('data', serviceId)
            let serviceName = $('#serviceName').val();
            let url = serviceId ? `{{ url('/api/services/') }}/${serviceId}` : `{{ url('/api/services') }}`;
            let method = serviceId ? 'PUT' : 'POST';

            $.ajax({
                url: url,
                method: method,
                data: {
                    name: serviceName,
                    _token: '{{ csrf_token() }}'
                },
                success: function() {
                    $('#serviceModal').modal('hide');
                    fetchServices();
                }
            });
        });

        // Edit service
        $(document).on('click', '.editServiceBtn', function() {
            let serviceId = $(this).data('id');
            let serviceName = $(this).data('name');
            $('#serviceId').val(serviceId);
            $('#serviceName').val(serviceName);
            $('#serviceModal').modal('show');
        });

        // Delete service
        $(document).on('click', '.deleteServiceBtn', function() {
            let serviceId = $(this).data('id');

            $.ajax({
                url: `{{ url('/api/services/') }}/${serviceId}`,
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function() {
                    fetchServices();
                }
            });
        });
    });
</script>
@endsection