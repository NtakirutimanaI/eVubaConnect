@include('admin.header')
@include('admin.sidebar')

<title>Workforce Management</title>

{{-- Add All Your CSS From Original --}}
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

    .header-title {
        font-size: 16px;
        margin-top: 10px;
        margin-bottom: 15px;
        color: #2c3e50;
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
        0% {opacity: 1;}
        80% {opacity: 1;}
        100% {opacity: 0; display: none;}
    }

    .button-row {
        display: flex;
        gap: 8px;
        margin-bottom: 15px;
    }

    .stats-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 10px;
    }

    .card {
        background: white;
        border-radius: 6px;
        padding: 5px;
        flex: 1;
        min-width: 150px;
        position: relative;
        margin-top: 0px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        font-size: 12px;
    }

    .card h4 {
        margin: 0;
        font-size: 13px;
        color: #555;
        margin-top: 10px;
    }

    .card p {
        font-size: 16px;
        margin-top: 10px;
        font-weight: bold;
        color: #2c3e50;
    }

    .pagination-container {
        margin: 10px 0 5px 0;
        margin-top: 90px;
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

    .pagination button {
        padding: 3px 8px;
        font-size: 12px;
        border: 1px solid #007bff;
        background: white;
        color: #007bff;
        cursor: pointer;
        border-radius: 4px;
    }

    .pagination button.active {
        background: #007bff;
        color: white;
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

    .action-btn {
        padding: 2px 6px;
        margin: 1px;
        font-size: 11px;
        border-radius: 4px;
        color: white;
        cursor: pointer;
        user-select: none;
        white-space: nowrap;
        border: none;
        background: transparent;
        text-decoration: underline;
    }

    .edit-btn {
        color: #28a745;
        font-weight: 600;
        text-decoration: none;
    }
    .delete-btn {
        color: #dc3545;
        font-weight: 600;
        text-decoration: none;
    }
    .status-btn {
        background: #17a2b8;
        color: white;
        padding: 2px 8px;
        border-radius: 4px;
        font-size: 11px;
        border: none;
        cursor: pointer;
    }
    
 .edit-btn {
    background: #28a745;
    color: white;
    font-weight: 600;
    padding: 2px 6px;
    margin: 1px;
    font-size: 11px;
    cursor: pointer;
    border: none;
    border-radius: 4px;
    user-select: none;
    white-space: nowrap;
}

.delete-btn {
    background: #dc3545;
    color: white;
    font-weight: 600;
    padding: 2px 6px;
    margin: 1px;
    font-size: 11px;
    cursor: pointer;
    border: none;
    border-radius: 4px;
    user-select: none;
    white-space: nowrap;
}

.view-btn {
    background: #007bff;
    color: white;
    font-weight: 600;
    padding: 2px 6px;
    margin: 1px;
    font-size: 11px;
    cursor: pointer;
    border: none;
    border-radius: 4px;
    user-select: none;
    white-space: nowrap;
}


    .add-btn {
        background: #007bff;
        color: white;
        padding: 6px 12px;
        border: none;
        border-radius: 6px;
        margin-top: 0px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
    }

    .modal {
        display: none;
        position: fixed;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    .modal-content {
        background: white;
        padding: 15px 20px;
        border-radius: 10px;
        width: 380px;
        margin-top: 15px;
        position: relative;
        font-size: 12px;
    }

    .modal-header {
        font-size: 14px;
        font-weight: bold;
        margin-bottom: 10px;
        margin-top: 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal input,
    .modal select,
    .modal textarea {
        width: 100%;
        margin-top: 8px;
        margin-bottom: 6px;
        padding: 5px;
        border-radius: 5px;
        border: 1px solid #ccc;
        font-size: 12px;
        box-sizing: border-box;
        height: 26px;
        resize: vertical;
    }

    .modal textarea {
        min-height: 50px;
    }

    .close-modal {
        cursor: pointer;
        color: #888;
        font-size: 18px;
        user-select: none;
        border: none;
        background: none;
    }
</style>

<div class="inventory-container">
    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <div class="header-title">Workforce Management</div>

    {{-- Add Button --}}
    <div class="button-row">
        <button class="add-btn" onclick="openModal('addEmployeeModal')">+ Add New Employee</button>
    </div>

    {{-- Stats Cards --}}
    <div class="stats-grid">
        <div class="card"><h4>Total Employees</h4><p>{{ $totalEmployees ?? $employees->count() }}</p></div>
        <div class="card"><h4>Active Employees</h4><p>{{ $activeEmployees ?? $employees->where('status', 1)->count() }}</p></div>
        <div class="card"><h4>Inactive Employees</h4><p>{{ $inactiveEmployees ?? $employees->where('status', 0)->count() }}</p></div>
    </div>

    {{-- Pagination --}}
    <div class="pagination-container">
        <label for="itemsPerPage">Items per page:</label>
        <select id="itemsPerPage" onchange="setupPagination()">
            <option value="5">5</option>
            <option value="10" selected>10</option>
        </select>
        <div class="pagination" id="pagination"></div>
    </div>

    {{-- Employee Table --}}
    <table id="employeeTable">
        <thead>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Email</th>
                <th>Status</th>
                <th>Joined</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="tableBody">
            @foreach($employees as $emp)
            <tr data-id="{{ $emp->id }}" data-name="{{ $emp->name }}" data-position="{{ $emp->position ?? '' }}" data-email="{{ $emp->email ?? '' }}" data-status="{{ $emp->status }}" data-created="{{ $emp->created_at ? $emp->created_at->format('d/m/Y') : '-' }}">
                <td>{{ $emp->name }}</td>
                <td>{{ $emp->position ?? '-' }}</td>
                <td>{{ $emp->email ?? '-' }}</td>
                <td style="color: {{ $emp->status ? 'green' : 'red' }};">{{ $emp->status ? 'Active' : 'Inactive' }}</td>
                <td>{{ $emp->created_at ? $emp->created_at->format('d/m/Y') : '-' }}</td>
                <td>
                    <button class="view-btn" onclick="openViewModal({{ $emp->id }})" title="View">View</button>
                    <button class="edit-btn action-btn" onclick="openEditModal({{ $emp->id }})" title="Edit">Edit</button>
                    <button class="status-btn" onclick="openStatusModal({{ $emp->id }})" title="Change Status">
                        {{ $emp->status ? 'Deactivate' : 'Activate' }}
                    </button>
                    <form action="{{ route('workforce.destroy', $emp->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this employee?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-btn action-btn" title="Delete">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- Add Employee Modal --}}
<div class="modal" id="addEmployeeModal">
    <div class="modal-content">
        <div class="modal-header">
            Add New Employee
            <button class="close-modal" onclick="closeModal('addEmployeeModal')">✖</button>
        </div>
        <form method="POST" action="{{ route('workforce.store') }}">
            @csrf
            <input type="text" name="name" placeholder="Full Name" required />
            <input type="text" name="position" placeholder="Position (optional)" />
            <input type="email" name="email" placeholder="Email (optional)" />
            <select name="status" required>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
            <button type="submit" class="add-btn">Save Employee</button>
        </form>
    </div>
</div>

{{-- View Employee Modal --}}
<div class="modal" id="viewEmployeeModal">
    <div class="modal-content">
        <div class="modal-header">
            View Employee Details
            <button class="close-modal" onclick="closeModal('viewEmployeeModal')">✖</button>
        </div>
        <div>
            <strong>Name:</strong> <span id="viewName"></span><br />
            <strong>Position:</strong> <span id="viewPosition"></span><br />
            <strong>Email:</strong> <span id="viewEmail"></span><br />
            <strong>Status:</strong> <span id="viewStatus"></span><br />
            <strong>Joined:</strong> <span id="viewJoined"></span>
        </div>
    </div>
</div>

{{-- Edit Employee Modal --}}
<div class="modal" id="editEmployeeModal">
    <div class="modal-content">
        <div class="modal-header">
            Edit Employee
            <button class="close-modal" onclick="closeModal('editEmployeeModal')">✖</button>
        </div>
        <form id="editEmployeeForm" method="POST" action="">
            @csrf
            @method('PUT')
            <input type="text" name="name" id="editName" placeholder="Full Name" required />
            <input type="text" name="position" id="editPosition" placeholder="Position (optional)" />
            <input type="email" name="email" id="editEmail" placeholder="Email (optional)" />
            <select name="status" id="editStatus" required>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
            <button type="submit" class="add-btn">Update Employee</button>
        </form>
    </div>
</div>

{{-- Change Status Modal --}}
<div class="modal" id="statusModal">
    <div class="modal-content">
        <div class="modal-header">
            Change Employee Status
            <button class="close-modal" onclick="closeModal('statusModal')">✖</button>
        </div>
        <form id="statusForm" method="POST" action="">
            @csrf
            @method('PATCH')
            <p id="statusConfirmText"></p>
            <input type="hidden" name="status" id="newStatus" value="" />
            <button type="submit" class="add-btn" id="statusConfirmBtn">Confirm</button>
        </form>
    </div>
</div>

<script>
    function openModal(id) {
        document.getElementById(id).style.display = 'flex';
    }

    function closeModal(id) {
        document.getElementById(id).style.display = 'none';
    }

    // Helper to get row data by employee ID
    function getEmployeeRow(id) {
        return document.querySelector(`tr[data-id='${id}']`);
    }

    // Open View Modal and fill data
    function openViewModal(id) {
        const row = getEmployeeRow(id);
        if (!row) return alert('Employee not found.');

        document.getElementById('viewName').textContent = row.dataset.name;
        document.getElementById('viewPosition').textContent = row.dataset.position || '-';
        document.getElementById('viewEmail').textContent = row.dataset.email || '-';
        document.getElementById('viewStatus').textContent = row.dataset.status == '1' ? 'Active' : 'Inactive';
        document.getElementById('viewStatus').style.color = row.dataset.status == '1' ? 'green' : 'red';
        document.getElementById('viewJoined').textContent = row.dataset.created || '-';

        openModal('viewEmployeeModal');
    }

    // Open Edit Modal and fill form
    function openEditModal(id) {
        const row = getEmployeeRow(id);
        if (!row) return alert('Employee not found.');

        document.getElementById('editName').value = row.dataset.name;
        document.getElementById('editPosition').value = row.dataset.position;
        document.getElementById('editEmail').value = row.dataset.email;
        document.getElementById('editStatus').value = row.dataset.status;

        // Set form action URL dynamically
        const form = document.getElementById('editEmployeeForm');
        form.action = `/admin/workforce/${id}`;

        openModal('editEmployeeModal');
    }

    // Open Change Status Modal
    function openStatusModal(id) {
        const row = getEmployeeRow(id);
        if (!row) return alert('Employee not found.');

        const currentStatus = row.dataset.status;
        const newStatus = currentStatus == '1' ? '0' : '1';
        const statusText = newStatus == '1' ? 'Activate' : 'Deactivate';

        document.getElementById('statusConfirmText').textContent =
            `Are you sure you want to ${statusText.toLowerCase()} employee "${row.dataset.name}"?`;
        document.getElementById('newStatus').value = newStatus;

        // Set form action URL dynamically
        const form = document.getElementById('statusForm');
        form.action = `/admin/workforce/${id}/status`;

        // Update confirm button text
        document.getElementById('statusConfirmBtn').textContent = statusText;

        openModal('statusModal');
    }

    // Pagination
    let current_page = 1;
    let rows_per_page = 10;
    const tbody = document.getElementById('tableBody');
    const rows = tbody.getElementsByTagName('tr');
    const pagination = document.getElementById('pagination');
    const itemsPerPageSelect = document.getElementById('itemsPerPage');

    function displayRows() {
        let start = (current_page - 1) * rows_per_page;
        let end = start + rows_per_page;
        for (let i = 0; i < rows.length; i++) {
            rows[i].style.display = (i >= start && i < end) ? '' : 'none';
        }
    }

    function setupPagination() {
        rows_per_page = parseInt(itemsPerPageSelect.value);
        current_page = 1;
        displayRows();
        pagination.innerHTML = '';
        let page_count = Math.ceil(rows.length / rows_per_page);
        for (let i = 1; i <= page_count; i++) {
            let btn = document.createElement('button');
            btn.innerText = i;
            if (i === current_page) btn.classList.add('active');
            btn.addEventListener('click', function () {
                current_page = i;
                displayRows();
                updatePaginationButtons();
            });
            pagination.appendChild(btn);
        }
    }

    function updatePaginationButtons() {
        const buttons = pagination.querySelectorAll('button');
        buttons.forEach((btn, idx) => {
            btn.classList.toggle('active', idx + 1 === current_page);
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        setupPagination();
    });
</script>

@include('admin.footer')
