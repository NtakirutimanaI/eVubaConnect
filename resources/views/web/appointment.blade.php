@include('web.header')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Request a Service</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f9fafb;
    }
    .modal-content {
      background: #fff;
      border-radius: 16px;
      padding: 30px;
      box-shadow: 0 10px 20px rgba(0,0,0,0.05);
      animation: fadeIn 0.3s ease-in-out;
    }
    .user-image {
      width: 70px;
      height: 70px;
      border-radius: 50%;
      object-fit: cover;
      margin-bottom: 15px;
      display: block;
      margin-left: auto;
      margin-right: auto;
    }
    h4 {
      text-align: center;
      font-weight: 600;
      margin-bottom: 25px;
    }
    .section {
      background-color: #fefefe;
      border: 1px solid #e0e0e0;
      border-radius: 10px;
      padding: 15px 20px;
      margin-bottom: 20px;
      transition: all 0.2s ease-in-out;
    }
    .section:hover {
      box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }
    .time-slot {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 12px;
    }
    .badge-time {
      background-color: #e3f2fd;
      color: #0d47a1;
      padding: 5px 12px;
      border-radius: 6px;
      margin: 0 5px;
      font-weight: 500;
      font-size: 0.85rem;
    }
    .avatar-group img {
      width: 34px;
      height: 34px;
      border-radius: 50%;
      margin-right: 6px;
      border: 2px solid #fff;
      box-shadow: 0 0 4px rgba(0,0,0,0.1);
    }
    .day-selector button {
      border: none;
      background: #f1f3f4;
      border-radius: 6px;
      padding: 8px 12px;
      margin: 4px;
      font-weight: 500;
      transition: all 0.2s;
    }
    .day-selector button.active {
      background: #6200ee;
      color: white;
      font-weight: bold;
    }
    .btn-save {
      background-color: #6200ee;
      color: white;
      border: none;
      padding: 10px 25px;
      border-radius: 8px;
      font-weight: 600;
    }
    .btn-save:hover {
      background-color: #4b00d1;
    }
    .form-control:focus, .form-select:focus {
      border-color: #6200ee;
      box-shadow: 0 0 0 0.15rem rgba(98, 0, 238, 0.2);
    }
    @keyframes fadeIn {
      from {opacity: 0; transform: translateY(10px);}
      to {opacity: 1; transform: translateY(0);}
    }
  </style>
</head>
<body>
  <div class="container mt-5 mb-5">
    <div class="modal-content">
      <img src="{{ asset('images/user.png') }}" alt="User Icon" class="user-image">
      <h4>Request Service</h4>

      <input type="text" class="form-control mb-4" placeholder="Appointment heading...">

      <!-- Smart Suggestions -->
      <div class="section">
        <div class="d-flex justify-content-between align-items-center">
          <span class="fw-semibold">Smart suggestions <a href="#" class="ms-1 text-decoration-none">Lab</a></span>
          <div>
            <button class="btn btn-sm btn-outline-primary">Duration</button>
            <button class="btn btn-sm btn-outline-primary">Timezone</button>
          </div>
        </div>

        <div class="mt-3">
          <div class="time-slot">
            <div>
              <strong>Free slot 1</strong><br>
              <small>29 January 2024</small>
            </div>
            <div>
              <span class="badge-time">6:00 PM</span>
              <span class="badge-time">10:00 PM</span>
              <button class="btn-close ms-2"></button>
            </div>
          </div>
          <div class="time-slot">
            <div>
              <strong>Free slot 2</strong><br>
              <small>29 January 2024</small>
            </div>
            <div>
              <span class="badge-time">8:00 PM</span>
              <span class="badge-time">10:00 PM</span>
              <button class="btn-close ms-2"></button>
            </div>
          </div>
        </div>
      </div>

      <!-- Appointment Date & Time -->
      <div class="section">
        <label class="form-label">Appointment date</label>
        <div class="row">
          <div class="col-md-6 mb-2">
            <select class="form-select">
              <option>Choose date</option>
              <option>30 July 2025</option>
              <option>31 July 2025</option>
              <option>01 August 2025</option>
            </select>
          </div>
          <div class="col-md-3 mb-2">
            <select class="form-select">
              <option>From</option>
              <option>9:00 AM</option>
              <option>2:00 PM</option>
              <option>6:00 PM</option>
            </select>
          </div>
          <div class="col-md-3 mb-2">
            <select class="form-select">
              <option>To</option>
              <option>10:00 AM</option>
              <option>3:00 PM</option>
              <option>7:00 PM</option>
            </select>
          </div>
        </div>

        <div class="row mb-2">
          <div class="col-md-6">
            <select class="form-select">
              <option>Rwanda Time (UTC+2)</option>
              <option>UTC</option>
              <option>India (IST)</option>
            </select>
          </div>
          <div class="col-md-6">
            <select class="form-select">
              <option>Auto adjust DST</option>
              <option>Manual</option>
            </select>
          </div>
        </div>

        <input type="text" class="form-control mb-3" placeholder="Enter location...">

        <!-- Avatars -->
        <div class="avatar-group mb-3">
          <img src="https://i.pravatar.cc/100?img=1" alt="">
          <img src="https://i.pravatar.cc/100?img=2" alt="">
          <img src="https://i.pravatar.cc/100?img=3" alt="">
          <img src="https://i.pravatar.cc/100?img=4" alt="">
          <button class="btn btn-sm btn-outline-primary">+ Add more</button>
        </div>

        <!-- Day Selector -->
        <div class="day-selector">
          <span class="me-2 fw-semibold">Select Day:</span>
          <button>M</button>
          <button>T</button>
          <button>W</button>
          <button>T</button>
          <button>F</button>
          <button>S</button>
          <button class="active">S</button>
        </div>
      </div>

      <!-- Actions -->
      <div class="d-flex justify-content-end mt-4">
        <button class="btn btn-outline-secondary me-2">Cancel</button>
        <button class="btn-save">Save</button>
      </div>
    </div>
  </div>

  <script>
    const buttons = document.querySelectorAll('.day-selector button');
    buttons.forEach(btn => {
      btn.addEventListener('click', () => {
        buttons.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
      });
    });
  </script>
</body>
</html>
@include('web.footer')
