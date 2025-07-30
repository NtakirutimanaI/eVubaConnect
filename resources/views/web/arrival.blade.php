<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>New Arrival</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: Arial, sans-serif;
      padding: 20px;
      background-color: #fff;
    }

    .label {
      display: flex;
      align-items: center;
      color: #322EFF;
      font-size: 12px;
      font-weight: bold;
      margin-bottom: 6px;
    }

    .label::before {
      content: '';
      width: 6px;
      height: 18px;
      background-color: #322EFF;
      border-radius: 3px;
      margin-right: 6px;
    }

    .section-title {
      font-size: 20px;
    font-weight: bold;
    margin-bottom: 20px;
    }

    .grid {
      display: grid;
      grid-template-columns: 2fr 3fr;
      gap: 16px;
    }

    .left-card {
      position: relative;
      background-size: cover;
      background-position: center;
      border-radius: 10px;
      color: white;
      padding: 20px;
      display: flex;
      flex-direction: column;
      justify-content: flex-end;
      min-height: 350px; /* Reduced from 500px */
    }

    .left-card h3 {
      font-size: 20px;
      margin: 0 0 6px 0;
    }

    .left-card p {
      font-size: 14px;
      margin: 0 0 10px 0;
    }

    .left-card a {
      font-size: 14px;
      text-decoration: underline;
      color: white;
    }

    .right-grid {
      display: grid;
      grid-template-columns: 1fr;
      grid-template-rows: auto auto;
      gap: 16px;
    }

    .top-right-card {
      position: relative;
      border-radius: 10px;
      overflow: hidden;
      height: 180px; /* Reduced from 240px */
    }

    .top-right-card img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
    }

    .top-right-card .card-title {
      position: absolute;
      top: 20px;
      left: 20px;
      color: white;
      font-size: 18px;
      font-weight: bold;
    }

    .bottom-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 16px;
    }

    .bottom-card {
      border-radius: 10px;
      overflow: hidden;
      height: 150px; /* Reduced from 200px */
    }

    .bottom-card img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
    }

    @media (max-width: 768px) {
      .grid {
        grid-template-columns: 1fr;
      }

      .right-grid {
        grid-template-columns: 1fr;
      }

      .bottom-grid {
        grid-template-columns: 1fr;
      }

      .left-card {
        min-height: 250px;
      }

      .top-right-card {
        height: 160px;
      }

      .bottom-card {
        height: 140px;
      }
    }
  </style>
</head>
<body>

  <div class="label">Featured</div>
  <div class="section-title">New Arrival</div>

  <div class="grid">
    <!-- Left Big Card -->
    <div class="left-card" style="background-image: url('images/connect1.png');">
      <h3>Connect to the world</h3>
      <p>Full service, Configuration,<br>Maintenance ...</p>
      <a href="#">Reach us</a>
    </div>

    <!-- Right 2x2 Grid -->
    <div class="right-grid">
      <!-- Top Horizontal Card -->
      <div class="top-right-card">
        <img src="{{asset('images/connect1.png')}}" alt="Modern Switch" />
        <div class="card-title">Modern Switch</div>
      </div>

      <!-- Bottom 2 Cards -->
      <div class="bottom-grid">
        <div class="bottom-card">
          <img src="{{asset('images/connect1.png')}}" alt="Router" />
        </div>
        <div class="bottom-card">
          <img src="{{asset('images/connect1.png')}}" alt="Server" />
        </div>
      </div>
    </div>
  </div>

</body>
</html>
