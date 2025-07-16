@include('admin.mail_header')
@include('admin.sidebar')
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Google Meet Style Page</title>
<style>
  body {
    margin: 0;
    font-family: "Roboto", Arial, sans-serif;
    background: #fff;
  }

  .container {
    margin-left: 222px;
    width: 81.5%;
    min-height: 100vh;
    box-sizing: border-box;
    position: relative;
  }

  .top-bar {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    padding: 10px 20px;
    gap: 15px;
    font-size: 14px;
    color: #5f6368;
  }

  .top-bar img.avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    cursor: pointer;
  }

  .top-bar .icon {
    cursor: pointer;
    font-size: 18px;
  }

  .main {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 40px 20px;
  }

  .left {
    max-width: 50%;
  }

  .left img.logo {
    height: 40px;
    margin-bottom: 20px;
  }

  .left h1 {
    font-size: 36px;
    margin: 0 0 10px;
    color: #202124;
  }

  .left p {
    font-size: 16px;
    color: #5f6368;
    margin-bottom: 30px;
  }

  .buttons {
    display: flex;
    gap: 10px;
    align-items: center;
  }

  .buttons button {
    background-color: #1a73e8;
    color: #fff;
    border: none;
    padding: 10px 16px;
    font-size: 14px;
    border-radius: 4px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 6px;
  }

  .buttons input {
    padding: 10px 12px;
    font-size: 14px;
    border: 1px solid #dadce0;
    border-radius: 4px;
    outline: none;
  }

  .right {
    text-align: center;
    max-width: 45%;
  }

  .right .popup {
    background: #fff;
    border: 1px solid #dadce0;
    border-radius: 8px;
    padding: 15px;
    box-shadow: 0 1px 3px rgba(60,64,67,.3);
    margin-bottom: 20px;
  }

  .popup p {
    margin: 8px 0;
    font-size: 14px;
    color: #202124;
  }

  .popup .actions {
    text-align: right;
    margin-top: 10px;
  }

  .popup .actions button {
    background: none;
    border: none;
    color: #1a73e8;
    cursor: pointer;
    font-size: 14px;
    margin-left: 10px;
  }

  .illustration {
    width: 100%;
    max-width: 250px;
    margin: 0 auto 10px;
  }

  .carousel-text {
    font-size: 16px;
    color: #202124;
    margin-top: 10px;
  }

  .carousel-dots {
    margin-top: 10px;
  }

  .carousel-dots span {
    display: inline-block;
    width: 6px;
    height: 6px;
    margin: 0 2px;
    border-radius: 50%;
    background: #c4c4c4;
  }

  .carousel-dots span.active {
    background: #1a73e8;
  }

  .learn-more {
    font-size: 12px;
    color: #1a73e8;
    text-decoration: none;
    display: block;
    margin: 30px 20px 0;
  }

</style>
</head>
<body>
<div class="container">
  <div class="top-bar">
    <span id="clock">8:06 AM</span> · Tue, Jul 15
    <span class="icon">❔</span>
    <span class="icon">⚙️</span>
    <span class="icon">⋮</span>
    <img src="https://i.pravatar.cc/40" alt="Avatar" class="avatar">
  </div>
  <div class="main">
    <div class="left">
      <img src="{{asset('images/googlemeet.png')}}" alt="Google Meet" class="logo">
      <h1>Video calls and meetings for everyone</h1>
      <p>Connect, collaborate, and celebrate from anywhere with Google Meet</p>
      <div class="buttons">
        <button>📹 New meeting</button>
        <input type="text" placeholder="Enter a code or link" />
      </div>
    </div>
    <div class="right">
      <div class="popup">
        <p><strong>Try the Google Meet web app</strong></p>
        <p>The Meet web app makes it easier to join your meetings and start your own video calls on your computer</p>
        <div class="actions">
          <button>Close</button>
          <button>Install</button>
        </div>
      </div>
      <img src="{{asset('images/user.png')}}" alt="Illustration" class="illustration">
      <div class="carousel-text">Get a link you can share</div>
      <div class="carousel-dots">
        <span></span><span class="active"></span><span></span>
      </div>
    </div>
  </div>
  <a href="#" class="learn-more">Learn more about Google Meet</a>
</div>
<script>
  // Dynamic clock
  function updateClock() {
    const now = new Date();
    let hours = now.getHours();
    const minutes = now.getMinutes().toString().padStart(2,'0');
    const ampm = hours >=12 ? 'PM':'AM';
    hours = hours % 12 || 12;
    document.getElementById('clock').textContent = `${hours}:${minutes} ${ampm}`;
  }
  updateClock();
  setInterval(updateClock, 60000);
</script>
</body>
</html>
