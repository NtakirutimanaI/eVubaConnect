@include('admin.header')
@include('admin.sidebar')

<style>
* {
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    background-color: #f8f9fa;
    color: #333;
}

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin: 30px 0 15px 222px;
    width: 84%;
}

.header h1 {
    font-weight: 700;
    font-size: 24px;
    color: #333;
    margin: 0;
}

.header-controls {
    display: flex;
    align-items: center;
    gap: 10px;
}

.toggle-btn,
.add-schedule-btn {
    padding: 6px 12px;
    font-size: 14px;
    font-weight: 600;
    border-radius: 4px;
    cursor: pointer;
    user-select: none;
    text-decoration: none;
    border: none;
    color: white;
}

.toggle-btn {
    background-color: #007bff;
}

.toggle-btn.active {
    background-color: #0056b3;
}

.add-schedule-btn {
    background-color: #28a745;
}

.calendar {
    display: grid;
    grid-template-columns: 80px repeat(7, 1fr);
    background: white;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    overflow-x: auto;
    width: 84%;
    margin-left: 222px;
    margin-top: 40px;
}

.calendar-header {
    display: contents;
}

.calendar-header div {
    padding: 10px 5px;
    border-bottom: 2px solid #ddd;
    font-weight: 700;
    text-align: center;
    background: #fafafa;
    color: #555;
    font-size: 14px;
}

.time-column {
    border-right: 1px solid #ddd;
    background: #f9f9f9;
    text-align: right;
    padding: 15px 10px 15px 5px;
    font-weight: 600;
    font-size: 14px;
    color: #666;
}

.day-cell {
    border-right: 1px solid #ddd;
    border-bottom: 1px solid #ddd;
    min-height: 70px;
    padding: 5px;
    position: relative;
}

.calendar > div:nth-child(8n) {
    border-right: none;
}

.event {
    background: #e1e8ff;
    border-radius: 6px;
    padding: 6px 10px;
    margin-bottom: 6px;
    font-size: 13px;
    line-height: 1.3;
    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
    cursor: default;
    position: relative;
    color: #0c4a8c;
    font-weight: 600;
}

.event.completed {
    border-left: 4px solid #4caf50;
    background: #e6f4ea;
    color: #2f6627;
}

.priority {
    position: absolute;
    top: 6px;
    right: 10px;
    font-size: 11px;
    font-weight: 700;
    padding: 2px 6px;
    border-radius: 12px;
    color: white;
    user-select: none;
}

.priority.low {
    background-color: #4caf50;
}

.priority.high {
    background-color: #d32f2f;
}

.event .customer {
    font-weight: 600;
    margin-bottom: 3px;
}

.modal {
    display: none;
    position: fixed;
    z-index: 1001;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.4);
}

.modal-content {
    background-color: #fff;
    margin: 80px auto;
    padding: 30px;
    border: 1px solid #ccc;
    width: 500px;
    border-radius: 10px;
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
}

.modal-content h2 {
    text-align: center;
    margin-bottom: 20px;
}

.modal-content label {
    font-weight: bold;
    display: block;
    margin: 10px 0 5px;
}

.modal-content input,
.modal-content select {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border-radius: 5px;
    border: 1px solid #ccc;
}

.modal-content button {
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}

.modal-content button:hover {
    background-color: #0056b3;
}

.close-modal {
    float: right;
    font-size: 20px;
    font-weight: bold;
    cursor: pointer;
    color: #999;
}

.close-modal:hover {
    color: #000;
}
</style>

<div class="header">
    <h1>Scheduling Calendar</h1>
    <div class="header-controls">
        <button class="add-schedule-btn" id="openModal">+ Add Schedule</button>
        <button class="toggle-btn" id="toggle-customers">Toggle Customers Assigned</button>
        <form action="{{ route('scheduling.auto') }}" method="POST" style="display:inline-block;">
            @csrf
            <button class="toggle-btn" style="background:#ffc107;">Auto Schedule</button>
        </form>
    </div>
</div>

@if(session('success'))
    <div style="margin-left:222px; width:84%; background:#d4edda; padding:10px; color:#155724; border-left:5px solid #28a745; margin-bottom:10px;">
        {{ session('success') }}
    </div>
@endif

<div class="calendar" id="calendar">
    <div class="calendar-header">
        <div></div>
        <div>Monday</div>
        <div>Tuesday</div>
        <div>Wednesday</div>
        <div>Thursday</div>
        <div>Friday</div>
        <div>Saturday</div>
        <div>Sunday</div>
    </div>
</div>

<div id="scheduleModal" class="modal" role="dialog" aria-modal="true" aria-labelledby="modalTitle" aria-hidden="true">
  <div class="modal-content">
    <span class="close-modal" id="closeModal">&times;</span>
    <h2 id="modalTitle">Add Schedule</h2>
    <form method="POST" action="{{ route('scheduling.store') }}">
      @csrf
      <label for="day">Day</label>
      <select id="day" name="day" required>
        <option value="">Select Day</option>
        <option>Monday</option>
        <option>Tuesday</option>
        <option>Wednesday</option>
        <option>Thursday</option>
        <option>Friday</option>
        <option>Saturday</option>
        <option>Sunday</option>
      </select>

      <label for="time">Time</label>
      <input type="time" id="time" name="time" required />

      <label for="customer">Customer</label>
      <input type="text" id="customer" name="customer" required />

      <label for="status">Status</label>
      <select id="status" name="status" required>
        <option value="">Select Status</option>
        <option>Scheduled</option>
        <option>Completed</option>
      </select>

      <label for="priority">Priority</label>
      <select id="priority" name="priority" required>
        <option value="">Select Priority</option>
        <option>Low</option>
        <option>High</option>
      </select>

      <button type="submit">Save Schedule</button>
    </form>
  </div>
</div>

@include('admin.footer')

<script>
const scheduleData = @json($scheduleData);
const days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
const times = ["08:00", "09:00", "10:00", "11:00", "12:00", "14:00", "16:00", "18:00"];

const calendarEl = document.getElementById("calendar");

function buildCalendar(showCustomers = true) {
    days.forEach((day, dIndex) => {
        times.forEach((time, tIndex) => {
            if (dIndex === 0) {
                const timeCol = document.createElement('div');
                timeCol.classList.add('time-column');
                if (tIndex < times.length) timeCol.textContent = time;
                calendarEl.appendChild(timeCol);
            }

            const cell = document.createElement('div');
            cell.classList.add('day-cell');

            const events = scheduleData[day]?.filter(e => e.time === time) || [];
            events.forEach(event => {
                const eventDiv = document.createElement('div');
                eventDiv.classList.add('event', event.status.toLowerCase());

                if (showCustomers) {
                    const customer = document.createElement('div');
                    customer.classList.add('customer');
                    customer.textContent = event.customer;
                    eventDiv.appendChild(customer);
                }

                const priority = document.createElement('span');
                priority.classList.add('priority', event.priority.toLowerCase());
                priority.textContent = event.priority;
                eventDiv.appendChild(priority);

                cell.appendChild(eventDiv);
            });

            calendarEl.appendChild(cell);
        });
    });
}

buildCalendar();

document.getElementById('toggle-customers').addEventListener('click', function() {
    const customers = document.querySelectorAll('.event .customer');
    customers.forEach(el => el.style.display = el.style.display === 'none' ? 'inline' : 'none');
    this.classList.toggle('active');
});

document.getElementById('openModal').addEventListener('click', function() {
  document.getElementById('scheduleModal').style.display = 'block';
});

document.getElementById('closeModal').addEventListener('click', function() {
  document.getElementById('scheduleModal').style.display = 'none';
});

window.addEventListener('click', function(event) {
  const modal = document.getElementById('scheduleModal');
  if (event.target === modal) modal.style.display = 'none';
});
</script>
