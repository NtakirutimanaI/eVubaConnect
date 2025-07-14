@include('admin.header') 
@include('admin.sidebar')

<title>Inventory Management</title>

<style>
    body {
        background: #f4f6f8;
        font-family: Arial, sans-serif;
        margin-top: 105px;
        margin-bottom: 25px;
        font-size: 12px; /* overall smaller font */
    }

    .inventory-container {
        width: 81.5%;
        margin-left: 17.5%;
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

    /* Success message */
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

    /* Pagination container */
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
        font-size: 10px;
        border-radius: 4px;
        color: white;
        cursor: pointer;
        user-select: none;
        white-space: nowrap;
    }

    .view-btn { background: #007bff; }
    .edit-btn { background: #28a745; }
    .delete-btn { background: #dc3545; }
    .restock-btn { background: #17a2b8; }

    .add-btn {
        background: #007bff;
        color: white;
        padding: 6px 12px;
        border: none;
        border-radius: 6px;
        margin-top: 0px;
        cursor: pointer;
        display:flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
    }

    .add-supplier-btn {
        background: #6f42c1;
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
        position: absolute;
        top: 10px;
        right: 10px;
        cursor: pointer;
        color: #888;
        font-size: 14px;
        user-select: none;
    }

    /* Smaller select for pagination options */
    #itemsPerPage {
        padding: 3px 6px;
        font-size: 12px;
        border-radius: 4px;
        border: 1px solid #ccc;
    }

    /* ======= Responsive Styles ======= */
    @media (max-width: 1024px) {
        .inventory-container {
            width: 90%;
            margin-left: 5%;
            font-size: 11px;
        }
        .button-row {
            flex-wrap: wrap;
            gap: 6px;
        }
        .add-btn {
            font-size: 11px;
            padding: 5px 10px;
        }
        .stats-grid {
            gap: 6px;
        }
        .card h4 {
            font-size: 12px;
        }
        .card p {
            font-size: 14px;
        }
        table {
            font-size: 11px;
        }
        th, td {
            padding: 5px 6px;
        }
        .pagination-container {
            font-size: 11px;
        }
        .pagination button {
            padding: 2px 6px;
            font-size: 11px;
        }
    }

    @media (max-width: 768px) {
        body {
            margin-top: 70px;
        }
        .inventory-container {
            width: 95%;
            margin-left: 2.5%;
            font-size: 11px;
        }
        .button-row {
            flex-direction: column;
            gap: 8px;
        }
        .add-btn {
            width: 100%;
            font-size: 12px;
        }
        .stats-grid {
            flex-direction: column;
            gap: 10px;
        }
        table {
            display: block;
            overflow-x: auto;
            white-space: nowrap;
        }
        th, td {
            padding: 8px 10px;
            white-space: nowrap;
        }
        .pagination-container {
            flex-direction: column;
            align-items: flex-start;
            gap: 5px;
            margin-top: 20px;
        }
    }

    @media (max-width: 480px) {
        body {
            margin-top: 60px;
            font-size: 11px;
        }
        .inventory-container {
            margin-left: 1%;
            width: 98%;
        }
        .header-title {
            font-size: 14px;
        }
        .button-row {
            flex-direction: column;
        }
        .add-btn {
            padding: 8px 10px;
            font-size: 12px;
        }
        .stats-grid {
            gap: 8px;
        }
        .card {
            min-width: 100%;
        }
        table {
            font-size: 11px;
        }
        .pagination-container {
            font-size: 11px;
        }
    }
</style>

<div class="inventory-container">

    {{-- Success message for supplier or product addition --}}
    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="header-title">Inventory Management</div>

    <div class="button-row">
        <button class="add-btn add-supplier-btn" onclick="openModal('addSupplierModal')">+ Add Supplier</button>
        <button class="add-btn" onclick="openModal('addModal')">+ Add New Item</button>
        <button class="add-btn add-client-btn" onclick="openModal('addclientModal')">+ Add Client</button>
        <button class="add-btn" onclick="window.location.href='{{ route('transactions.index') }}'">🧾 View Transactions</button>
    </div>

    <div class="stats-grid">
        <div class="card"><h4>Total Items</h4><p>{{ $totalItems }}</p></div>
        <div class="card"><h4>Low Stock</h4><p>{{ $lowStock }}</p></div>
        <div class="card"><h4>Out of Stock</h4><p>{{ $outOfStock }}</p></div>
        <div class="card"><h4>Recently Added</h4><p>{{ $recentItems }}</p></div>
    </div>

    <!-- Pagination Controls -->
    <div class="pagination-container">
        <label for="itemsPerPage">Items per page:</label>
        <select id="itemsPerPage" onchange="setupPagination()">
            <option value="5">5</option>
            <option value="10" selected>10</option>
        </select>
        <div class="pagination" id="pagination"></div>
    </div>

    <!-- Inventory Table -->
    <table id="inventoryTable">
        <thead>
            <tr>
                <th>Item Name</th>
                <th>Category</th>
                <th>Qty</th>
                <th>Unit</th>
                <th>Status</th>
                <th>Last Updated</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="tableBody">
            @foreach ($items as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->category }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->unit }}</td>
                <td style="color: {{ $item->quantity <= $item->min_threshold ? 'red' : 'green' }};">
                    {{ $item->quantity > 0 ? 'In Stock' : 'Out of Stock' }}
                </td>
                <td>{{ $item->updated_at->format('d/m/Y') }}</td>
                <td>
                    <span class="action-btn view-btn" onclick='openViewModal(@json($item), @json($item->supplier))'>View</span>
                    <span class="action-btn edit-btn" onclick='openEditModal(@json($item))'>Edit</span>
                    <span class="action-btn restock-btn" onclick='openRestockModal(@json($item))'>Restock</span>
                    <form action="{{ route('inventory.destroy', $item->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="action-btn delete-btn" onclick="return confirm('Delete this item?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- View Modal -->
<div class="modal" id="viewModal">
    <div class="modal-content">
        <div class="modal-header">
            View Item Details
            <span class="close-modal" onclick="closeModal('viewModal')">✖</span>
        </div>
        <div id="viewContent" style="font-size: 12px; line-height: 1.4;">
            <!-- Details will be populated by JS -->
        </div>
    </div>
</div>

<!-- Add Supplier Modal -->
<div class="modal" id="addSupplierModal">
    <div class="modal-content">
        <div class="modal-header">
            Add New Supplier
            <span class="close-modal" onclick="closeModal('addSupplierModal')">✖</span>
        </div>
        <form method="POST" action="{{ route('supplier.store') }}">
            @csrf
            <input type="text" name="name" placeholder="Supplier Name" required />
            <input type="text" name="contact" placeholder="Contact Info (optional)" />
            <textarea name="address" placeholder="Address (optional)"></textarea>
            <button type="submit" class="add-btn">Save Supplier</button>
        </form>
    </div>
</div>

<!-- Add Modal -->
<div class="modal" id="addModal">
    <div class="modal-content">
        <div class="modal-header">
            Add New Inventory Item
            <span class="close-modal" onclick="closeModal('addModal')">✖</span>
        </div>
        <form method="POST" action="{{ route('inventory.store') }}">
            @csrf
            <input type="text" name="name" placeholder="Item Name" required />
            <input type="text" name="category" placeholder="Category (optional)" />
            <input type="number" name="quantity" placeholder="Quantity" min="0" step="any" required />
            <input type="text" name="unit" placeholder="Unit (kg, pcs...)" required />
            <input type="number" name="min_threshold" placeholder="Low Stock Threshold" min="0" required />
            <input type="number" name="price" placeholder="Price" min="0" step="any" required />
            <select name="supplier_id" required>
                <option value="">Select Supplier</option>
                @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                @endforeach
            </select>
            <textarea name="description" placeholder="Description (optional)"></textarea>
            <button type="submit" class="add-btn">Save Item</button>
        </form>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal" id="editModal">
    <div class="modal-content">
        <div class="modal-header">
            Edit Item
            <span class="close-modal" onclick="closeModal('editModal')">✖</span>
        </div>
        <form method="POST" id="editForm">
            @csrf
            @method('PUT')
            <input type="text" name="name" id="editName" placeholder="Item Name" required />
            <input type="text" name="category" id="editCategory" placeholder="Category (optional)" />
            <input type="number" step="any" name="quantity" id="editQuantity" placeholder="Quantity" min="0" required />
            <input type="text" name="unit" id="editUnit" placeholder="Unit (kg, pcs...)" required />
            <input type="number" name="min_threshold" id="editMinThreshold" placeholder="Low Stock Threshold" min="0" required />
            <input type="number" step="any" name="price" id="editPrice" placeholder="Price" min="0" required />
            <select name="supplier_id" id="editSupplier" required>
                <option value="">Select Supplier</option>
                @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                @endforeach
            </select>
            <textarea name="description" id="editDescription" placeholder="Description (optional)"></textarea>
            <button type="submit" class="add-btn">Save Item</button>
        </form>
    </div>
</div>

<!-- Restock Modal -->
<div class="modal" id="restockModal">
    <div class="modal-content">
        <div class="modal-header">
            Restock Item
            <span class="close-modal" onclick="closeModal('restockModal')">✖</span>
        </div>
        <form method="POST" id="restockForm">
            @csrf
            @method('PATCH')
            <input type="number" name="restock_quantity" placeholder="Enter quantity to add" min="1" step="any" required />
            <button type="submit" class="add-btn">Restock</button>
        </form>
    </div>
</div>


<!-- Add Client Modal -->
<div class="modal" id="addclientModal">
    <div class="modal-content">
        <div class="modal-header">
            Add New Client
            <span class="close-modal" onclick="closeModal('addclientModal')">✖</span>
        </div>
        <form method="POST" action="{{ route('client-product.store') }}">
           @csrf
           <!-- CLIENT FIELDS -->
           <input type="text" name="full_name" placeholder="Full Name" required />
           <input type="email" name="email" placeholder="Email (optional)" />
           <input type="text" name="phone" placeholder="Phone (optional)" />
           <input type="text" name="company" placeholder="Company (optional)" />
           <input type="text" name="address" placeholder="Address (optional)" />

           <!-- PRODUCT FIELDS -->
           <input type="text" name="product_name" placeholder="Product Name" required />
           <input type="text" name="category" placeholder="Category/Type" />
           <input type="number" name="quantity" placeholder="Quantity" step="any" required />
           <input type="text" name="price" placeholder="Unit Price" step="any" required />

           <button type="submit" class="add-btn">Save Client</button>
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

    function openRestockModal(item) {
        openModal('restockModal');
        document.getElementById('restockForm').action = `/inventory/${item.id}/restock`;
    }

    function openEditModal(item) {
        openModal('editModal');
        const form = document.getElementById('editForm');
        form.action = `/inventory/${item.id}`;

        document.getElementById('editName').value = item.name || '';
        document.getElementById('editCategory').value = item.category || '';
        document.getElementById('editQuantity').value = item.quantity || 0;
        document.getElementById('editUnit').value = item.unit || '';
        document.getElementById('editMinThreshold').value = item.min_threshold || 0;
        document.getElementById('editPrice').value = item.price || 0;
        document.getElementById('editDescription').value = item.description || '';
        document.getElementById('editSupplier').value = item.supplier_id || '';
    }

    function openViewModal(item, supplier) {
        openModal('viewModal');
        const viewContent = document.getElementById('viewContent');

        // Handle null supplier gracefully
        const supplierName = supplier?.name || '-';
        const supplierContact = supplier?.contact || '-';
        const supplierAddress = supplier?.address || '-';

        viewContent.innerHTML = `
            <strong>Product Details:</strong><br>
            <strong>Name:</strong> ${item.name}<br>
            <strong>Category:</strong> ${item.category || '-'}<br>
            <strong>Quantity:</strong> ${item.quantity}<br>
            <strong>Unit:</strong> ${item.unit}<br>
            <strong>Low Stock Threshold:</strong> ${item.min_threshold}<br>
            <strong>Price:</strong> ${item.price}<br>
            <strong>Status:</strong> <span style="color: ${item.quantity <= item.min_threshold ? 'red' : 'green'};">${item.quantity > 0 ? 'In Stock' : 'Out of Stock'}</span><br>
            <strong>Last Updated:</strong> ${new Date(item.updated_at).toLocaleDateString()}<br>
            <strong>Description:</strong> ${item.description || '-'}<br><br>

            <strong>Supplier Details:</strong><br>
            <strong>Name:</strong> ${supplierName}<br>
            <strong>Contact:</strong> ${supplierContact}<br>
            <strong>Address:</strong> ${supplierAddress}<br>
        `;
    }

    // Pagination script
    let current_page = 1;
    let rows_per_page = 10;
    const table = document.getElementById('inventoryTable');
    const tbody = document.getElementById('tableBody');
    const rows = tbody.getElementsByTagName('tr');
    const pagination = document.getElementById('pagination');
    const itemsPerPageSelect = document.getElementById('itemsPerPage');

    function displayRows() {
        let start = (current_page - 1) * rows_per_page;
        let end = start + rows_per_page;
        for(let i = 0; i < rows.length; i++) {
            rows[i].style.display = (i >= start && i < end) ? '' : 'none';
        }
    }

    function setupPagination() {
        rows_per_page = parseInt(itemsPerPageSelect.value);
        current_page = 1;
        displayRows();

        // Clear existing buttons
        pagination.innerHTML = '';

        let page_count = Math.ceil(rows.length / rows_per_page);

        for(let i = 1; i <= page_count; i++) {
            let btn = document.createElement('button');
            btn.innerText = i;
            if(i === current_page) btn.classList.add('active');
            btn.addEventListener('click', function() {
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
            btn.classList.toggle('active', idx+1 === current_page);
        });
    }

    // Initialize pagination on page load
    document.addEventListener('DOMContentLoaded', () => {
        setupPagination();
    });
</script>

@include('admin.footer')








