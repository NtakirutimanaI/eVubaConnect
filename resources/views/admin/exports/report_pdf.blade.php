<h3>eVubaConnect System Report</h3>
<h4>Employees</h4>
<ul>
    @foreach($employees as $emp)
        <li>{{ $emp->name }} – {{ $emp->email }}</li>
    @endforeach
</ul>
<h4>Products</h4>
<ul>
    @foreach($products as $prod)
        <li>{{ $prod->name }} – Qty: {{ $prod->quantity }}</li>
    @endforeach
</ul>
