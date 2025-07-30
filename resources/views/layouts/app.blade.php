<script src="https://unpkg.com/lucide@latest"></script>
<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Logout</button>
</form>
