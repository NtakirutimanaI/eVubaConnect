@include('admin.header')
@include('admin.sidebar')

<title>Schedule Appointments</title>

<style>
body {
    background: #f4f6f8;
    font-family: Arial, sans-serif;
    margin-top: 105px;
    margin-bottom: 25px;
    font-size: 12px;
}

.inventory-container {
    width: 81.5%;
    margin-left: 17%;
    margin-top: 10px;
    position: relative;
    font-size: 12px;
}

.alert-success {
    background-color: #d4edda;
    border-left: 3px solid #28a745;
    color: #155724;
    padding: 6px 12px;
    margin-bottom: 15px;
    border-radius: 5px;
    font-weight: 600;
    animation: fadeOut 6s forwards;
    font-size: 12px;
}

@keyframes fadeOut {
    0% { opacity: 1; }
    80% { opacity: 1; }
    100% { opacity: 0; display: none; }
}

/* FIXED: renamed from btn-btn-schedule to btn-schedule */
.btn-schedule, .btn-success {
    background: #007bff;
    color: white;
    padding: 6px 12px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    width: 100px;
    margin-top: 2px;
}

table {
    width: 100%;
    background: white;
    border-collapse: collapse;
    border-radius: 6px;
    overflow: hidden;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    margin-top: 10px;
    font-size: 12px;
}

th, td {
    padding: 6px 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background: #007bff;
    color: white;
    font-size: 12px;
}

tr:nth-child(even) {
    background: #f9f9f9;
}

h2, h3 {
    color: #2c3e50;
    margin-bottom: 20px;
}

.modal {
    display: none;
    position: fixed;
    z-index: 1050;
    padding-top: 100px;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0,0,0,0.5);
    font-size: 12px;
}

.modal-content {
    background-color: #fff;
    margin: auto;
    padding: 20px;
    border-radius: 6px;
    width: 400px;
    box-shadow: 0 5px 15px rgba(0,0,0,.5);
    position: relative;
}

.modal-header {
    font-weight: 600;
    font-size: 16px;
    margin-bottom: 10px;
}

.close-btn {
    color: #aaa;
    float: right;
    font-size: 20px;
    font-weight: bold;
    cursor: pointer;
    position: absolute;
    right: 15px;
    top: 10px;
}

.close-btn:hover {
    color: black;
}

.form-label {
    margin-top: 5px;
}

.btn-block {
    width: 100%;
    margin-top: 15px;
}

.top-row {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 20px;
    gap: 20px;
    flex-wrap: wrap;
}

.btn-add-container {
    white-space: nowrap;
    flex-shrink: 0;
    order: 1;
    align-self: flex-start;
}

.schedule {
    background: #d4edda;
    padding: 15px;
    border-radius: 8px;
    margin-left: auto;
    flex: 1;
    min-width: 350px;
    order: 2;
}

#scheduleForm .row {
    margin-bottom: 10px;
}

/* Pagination */
.pagination-container {
    margin: 10px 0 5px 0;
    margin-top: 0px;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 10px;
    font-size: 12px;
}

.pagination {
    display: flex;
    gap: 5px;
}

.pagination .page-link {
    padding: 4px 10px;
    font-size: 12px;
    border: 1px solid #007bff;
    background: white;
    color: #007bff;
    border-radius: 4px;
    text-decoration: none;
}

.pagination .active .page-link {
    background: #007bff;
    color: white;
    border-color: #007bff;
}

/* Responsive pagination */
@media (max-width: 1024px) {
    .pagination-container {
        font-size: 11px;
    }

    .pagination .page-link {
        padding: 3px 8px;
        font-size: 11px;
    }
}

@media (max-width: 768px) {
    .pagination-container {
        flex-direction: column;
        align-items: flex-start;
        gap: 5px;
        margin-top: 20px;
    }
}

@media (max-width: 480px) {
    .pagination-container {
        font-size: 11px;
    }
}

/* Modal form inputs and textarea styling - very small */
.modal-content form input[type="text"],
.modal-content form input[type="email"],
.modal-content form input[type="number"],
.modal-content form input[type="date"],
.modal-content form input[type="time"],
.modal-content form select,
.modal-content form textarea {
    width: 100%;
    padding: 4px 6px;
    margin-top: 3px;
    margin-bottom: 6px;
    border: 1px solid #ccc;
    border-radius: 3px;
    font-size: 10px;
    font-family: inherit;
    box-sizing: border-box;
    transition: border-color 0.3s ease;
    resize: vertical; /* for textarea */
}

.modal-content form input[type="text"]:focus,
.modal-content form input[type="email"]:focus,
.modal-content form input[type="number"]:focus,
.modal-content form input[type="date"]:focus,
.modal-content form input[type="time"]:focus,
.modal-content form select:focus,
.modal-content form textarea:focus {
    outline: none;
    border-color: #007bff;
    box-shadow: 0 0 4px rgba(0,123,255,0.5);
}

/* Buttons inside modals - very small */
.modal-content form button.btn {
    background-color: #007bff;
    border: none;
    color: white;
    padding: 6px 0;
    font-size: 11px;
    font-weight: 600;
    border-radius: 4px;
    cursor: pointer;
    width: 100%;
    transition: background-color 0.3s ease;
}

.modal-content form button.btn:hover {
    background-color: #0056b3;
}

/* Label styling inside modal forms - smaller */
.modal-content form .form-label {
    font-weight: 600;
    font-size: 10px;
    color: #333;
    margin-top: 4px;
}

/* Responsive adjustments */
@media (max-width: 1200px) {
    .inventory-container {
        width: 90%;
        margin-left: 5%;
        font-size: 11px;
    }
    .btn-schedule, .btn-success {
        width: 90px;
        font-size: 11px;
        padding: 5px 10px;
    }
    .modal-content {
        width: 350px;
    }
}

@media (max-width: 768px) {
    body {
        margin-top: 80px;
        font-size: 11px;
    }
    .inventory-container {
        width: 95%;
        margin-left: 2.5%;
        font-size: 11px;
    }
    .btn-schedule, .btn-success {
        width: 80px;
        font-size: 10px;
        padding: 4px 8px;
    }
    .modal-content {
        width: 90%;
        max-width: 320px;
        padding: 15px;
    }
    table {
        font-size: 11px;
    }
    th, td {
        padding: 5px 6px;
    }
}

@media (max-width: 480px) {
    body {
        margin-top: 70px;
        font-size: 10px;
    }
    .inventory-container {
        width: 98%;
        margin-left: 1%;
        font-size: 10px;
    }
    .btn-schedule, .btn-success {
        width: 70px;
        font-size: 9px;
        padding: 3px 6px;
    }
    .modal-content {
        width: 95%;
        max-width: 280px;
        padding: 10px;
    }
    table {
        font-size: 10px;
    }
    th, td {
        padding: 4px 5px;
    }
}

.action-btn {
        padding: 2px 6px;
        margin: 1px;
        font-size: 10px;
        border-radius: 4px;
        color: white;
        cursor: pointer;
        user-select: none;
        white-space: nowrap;
    }

    .view-btn { background: #007bff; }
    .notify-client-btn { background: #28a745; }
    .delete-btn { background: #dc3545; }
    .notify-employee-btn { background: #17a2b8; }
</style>

<div class="inventory-container">
    <h2>Schedule Appointments</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="top-row">
        <div class="schedule">
            <form id="scheduleForm" method="POST" action="{{ route('scheduling.store') }}">
                @csrf
                {{-- Form Inputs --}}
                <div class="row mb-3">
                    <div class="col-md-3" style="display:inline-block; width: 22%; margin-right: 2%;">
                        <label for="client_id" class="form-label">Client</label>
                        <select name="client_id" class="form-select" required>
                            <option value="">Select Client</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->full_name ?? $client->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3" style="display:inline-block; width: 22%; margin-right: 2%;">
                        <label for="employee_id" class="form-label">Employee</label>
                        <select name="employee_id" class="form-select" required>
                            <option value="">Select Employee</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3" style="display:inline-block; width: 22%; margin-right: 2%;">
                        <label for="service_id" class="form-label">Service</label>
                        <select name="service_id" id="service_id" class="form-select" required>
                            <option value="">Select Service</option>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}" data-duration="{{ $service->duration }}">
                                    {{ $service->name }} ({{ $service->duration }} min)
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3" style="display:inline-block; width: 22%;">
                        <label for="scheduled_date" class="form-label">Date</label>
                        <input type="date" name="scheduled_date" class="form-control" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3" style="display:inline-block; width: 22%; margin-right: 2%;">
                        <label for="start_time" class="form-label">Start Time</label>
                        <input type="time" name="start_time" id="start_time" class="form-control" required>
                    </div>
                    <div class="col-md-3" style="display:inline-block; width: 22%; margin-right: 2%;">
                        <label for="end_time" class="form-label">End Time</label>
                        <input type="time" name="end_time" id="end_time" class="form-control" readonly required>
                    </div>
                    <div class="col-md-3" style="display:inline-block; width: 22%; margin-right: 2%;">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="scheduled" selected>Scheduled</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                    <div class="col-md-3" style="display:inline-block; width: 22%; vertical-align: bottom;">
                        <label class="form-label">&nbsp;</label>
                        <button type="submit" class="btn-schedule">Schedule</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="btn-add-container">
            <button class="btn btn-success" id="openAddClient">+ Add Client</button>
            <button class="btn btn-success" id="openAddEmployee">+ Add Employee</button>
            <button class="btn btn-success" id="openAddService">+ Add Service</button>
        </div>
    </div>

    <hr>

     <!-- Pagination Controls -->
    <div class="pagination-container">
        <label for="itemsPerPage">Items per page:</label>
        <select id="itemsPerPage" onchange="setupPagination()">
            <option value="5">5</option>
            <option value="10" selected>10</option>
        </select>
        <div class="pagination" id="pagination"></div>
    </div>

    <h3>🗓️ Existing Appointments</h3>
    <table>
        <thead>
            <tr>
                <th>Client</th>
                <th>Employee</th>
                <th>Service</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($appointments as $appointment)
                <tr>
                    <td>{{ $appointment->client->full_name ?? $appointment->client->name }}</td>
                    <td>{{ $appointment->employee->name }}</td>
                    <td>{{ $appointment->service->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($appointment->scheduled_date)->format('Y-m-d') }}</td>
                    <td>{{ $appointment->start_time }} - {{ $appointment->end_time }}</td>
                    <td>{{ ucfirst($appointment->status) }}</td>
                    <td>
                        <span class="action-btn view-btn" onclick='openViewModal(@json($appointment), null)'>View</span>
                        <span class="action-btn notify-client-btn" onclick='openNotifyClientModal(@json($appointment))'>Notify Client</span>
                        <span class="action-btn notify-employee-btn" onclick='openNotifyEmployeeModal(@json($appointment))'>Notify Employee</span>
                        <form action="{{ route('appointment.destroy', $appointment->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                        <button type="submit" class="action-btn delete-btn" onclick="return confirm('Delete this item?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center">No appointments found.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="pagination-container">
        {{ $appointments->links('pagination::bootstrap-4') }}
    </div>
</div>

{{-- MODALS --}}

{{-- Add Client Modal --}}
<div id="addClientModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" data-modal="addClientModal">&times;</span>
        <div class="modal-header">+ Add Client</div>
        <form method="POST" action="{{ route('clients.store') }}">
            @csrf
            <label class="form-label">Full Name</label>
            <input type="text" name="full_name" class="form-control" required>
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control">
            <label class="form-label">Company</label>
            <input type="text" name="company" class="form-control">
            <label class="form-label">Address</label>
            <input type="text" name="address" class="form-control">
            <button type="submit" class="btn btn-primary btn-block">Add Client</button>
        </form>
    </div>
</div>

{{-- Add Employee Modal --}}
<div id="addEmployeeModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" data-modal="addEmployeeModal">&times;</span>
        <div class="modal-header">+ Add Employee</div>
        <form method="POST" action="{{ route('employees.store') }}">
            @csrf
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" required>
            <label class="form-label">Position</label>
            <input type="text" name="position" class="form-control">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
            <label class="form-label">Expertise</label>
            <input type="text" name="expertise" class="form-control">
            <button type="submit" class="btn btn-primary btn-block">Add Employee</button>
        </form>
    </div>
</div>

{{-- Add Service Modal --}}
<div id="addServiceModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" data-modal="addServiceModal">&times;</span>
        <div class="modal-header">+ Add Service</div>
        <form method="POST" action="{{ route('services.store') }}">
            @csrf
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" required>
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control"></textarea>
            <label class="form-label">Duration (minutes)</label>
            <input type="number" name="duration" class="form-control" required min="1">
            <label class="form-label">Price</label>
            <input type="number" step="0.01" name="price" class="form-control" required min="0">
            <button type="submit" class="btn btn-primary btn-block">Add Service</button>
        </form>
    </div>
</div>

@include('admin.footer')

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Calculate end time based on start time and service duration
    function calculateEndTime() {
        const startTime = document.getElementById('start_time').value;
        const selectedOption = document.getElementById('service_id').selectedOptions[0];
        const duration = parseInt(selectedOption?.getAttribute('data-duration')) || 0;

        if (startTime && duration) {
            const [hours, minutes] = startTime.split(':').map(Number);
            const startDate = new Date(0, 0, 0, hours, minutes);
            startDate.setMinutes(startDate.getMinutes() + duration);

            document.getElementById('end_time').value =
                String(startDate.getHours()).padStart(2, '0') + ':' +
                String(startDate.getMinutes()).padStart(2, '0');
        } else {
            document.getElementById('end_time').value = '';
        }
    }

    document.getElementById('start_time').addEventListener('change', calculateEndTime);
    document.getElementById('service_id').addEventListener('change', calculateEndTime);

    // Open modals
    document.getElementById('openAddClient').onclick = () => {
        document.getElementById('addClientModal').style.display = 'block';
    };
    document.getElementById('openAddEmployee').onclick = () => {
        document.getElementById('addEmployeeModal').style.display = 'block';
    };
    document.getElementById('openAddService').onclick = () => {
        document.getElementById('addServiceModal').style.display = 'block';
    };

    // Close modals when clicking close buttons
    document.querySelectorAll('.close-btn').forEach(btn => {
        btn.onclick = () => {
            const modalId = btn.getAttribute('data-modal');
            document.getElementById(modalId).style.display = 'none';
        };
    });

    // Close modal when clicking outside modal content
    window.onclick = function(event) {
        if (event.target.classList.contains('modal')) {
            event.target.style.display = 'none';
        }
    };
});
</script>
