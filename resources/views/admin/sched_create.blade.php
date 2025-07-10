<style>
    body {
        background-color: #f4f6f8;
        font-family: Arial, sans-serif;
        margin: 0;
        padding-bottom: 100px;
    }

    h2 {
        text-align: center;
        margin-top: 30px;
        color: #333;
        font-size: 24px;
    }

    form {
        background-color: #fff;
        max-width: 600px;
        margin: 30px auto;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }

    label {
        display: block;
        margin-bottom: 6px;
        font-weight: bold;
        color: #444;
    }

    input[type="time"],
    input[type="text"],
    select {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 6px;
        background-color: #f9f9f9;
        transition: all 0.3s ease;
    }

    input:focus,
    select:focus {
        border-color: #007bff;
        background-color: #fff;
        outline: none;
    }

    button {
        width: 100%;
        background-color: #007bff;
        color: white;
        padding: 12px;
        font-size: 16px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #0056b3;
    }
</style>

@include('admin.header')
@include('admin.sidebar')

<h2>Add New Schedule</h2>

<form method="POST" action="{{ route('scheduling.store') }}">
    @csrf

    <label>Day:</label>
    <select name="day" required>
        @foreach(['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'] as $day)
            <option value="{{ $day }}">{{ $day }}</option>
        @endforeach
    </select><br><br>

    <label>Time:</label>
    <input type="time" name="time" required><br><br>

    <label>Customer:</label>
    <input type="text" name="customer" required><br><br>

    <label>Status:</label>
    <select name="status" required>
        <option value="Completed">Completed</option>
        <option value="Scheduled">Scheduled</option>
    </select><br><br>

    <label>Priority:</label>
    <select name="priority" required>
        <option value="Low">Low</option>
        <option value="High">High</option>
    </select><br><br>

    <button type="submit">Save</button>
</form>

@include('admin.footer')
