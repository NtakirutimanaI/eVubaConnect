<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Chatbot with Sidebar and Scheduler</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #0A1128;
    }

    .section-container {
      display: flex;
      justify-content: center;
      align-items: flex-start;
      padding: 40px 20px;
      gap: 20px;
      flex-wrap: wrap;
      background: #0A1128;
    }

    .sidebar-buttons {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    .sidebar-button {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 10px;
      padding: 12px 16px;
      border: 1px solid #ddd;
      border-radius: 8px;
      background-color: #322EFF;
      font-size: 14px;
      color: white;
      box-shadow: 0 2px 4px rgba(0,0,0,0.05);
      width: 160px;
      cursor: pointer;
      transition: background 0.3s;
    }

    .sidebar-button:hover {
      background-color: #f8f8f8;
      color: #333;
    }

    .sidebar-button img {
      height: 20px;
    }

    .sidebar-button span {
      flex-grow: 1;
      text-align: left;
    }

    .carousel-wrapper {
      width: 600px;
      max-width: 100%;
    }

    .carousel-container {
      position: relative;
      width: 100%;
      height: 280px;
      border-radius: 6px;
      overflow: hidden;
    }

    .slide {
      position: absolute;
      width: 100%;
      height: 100%;
      display: none;
      align-items: center;
      justify-content: center;
      color: #fff;
      font-size: 28px;
      font-weight: bold;
      text-align: center;
      padding: 30px;
    }

    .slide.active {
      display: flex;
      animation: fade 0.8s ease-in-out;
    }

    @keyframes fade {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    .dots {
      text-align: center;
      margin-top: 10px;
    }

    .dot {
      height: 10px;
      width: 10px;
      margin: 0 4px;
      background-color: #bbb;
      border-radius: 50%;
      display: inline-block;
      transition: background-color 0.3s ease;
    }

    .dot.active {
      background-color: #322EFF;
    }

    .modal {
      display: none;
      position: fixed;
      z-index: 999;
      top: 90px;
      right: 20px;
      width: 100%;
      max-width: 420px;
      overflow: auto;
      background-color: rgba(0,0,0,0.5);
    }

    .modal-content {
      position: relative;
      background-color: #fff;
      margin: 0 auto;
      padding: 0;
      border: 1px solid #888;
      border-radius: 8px;
      width: 100%;
      max-width: 400px;
      overflow: hidden;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
    }

    .close {
      position: absolute;
      top: 8px;
      right: 12px;
      font-size: 20px;
      font-weight: bold;
      cursor: pointer;
      z-index: 1001;
      color:blue;
    }

    .chat-header {
      background-color: #0A1128;
      color: white;
      padding: 10px;
      font-weight: bold;
      font-size: 14px;
    }

    .chat-body {
      padding: 10px;
      overflow-y: auto;
      background: #f6f7fb;
      max-height: 250px;
    }

    .message {
      max-width: 75%;
      margin-bottom: 10px;
      padding: 10px;
      border-radius: 10px;
      font-size: 13px;
      line-height: 1.4;
    }

    .user {
      background-color: #0A1128;
      color: white;
      margin-left: auto;
      border-bottom-right-radius: 0;
    }

    .bot {
      background-color: #e6e6e6;
      color: #333;
      border-bottom-left-radius: 0;
    }

    .chat-input {
      display: flex;
      border-top: 1px solid #ddd;
      padding: 10px;
      background-color: white;
    }

    .chat-input input {
      flex: 1;
      border: 1px solid #ccc;
      border-radius: 20px;
      padding: 8px 12px;
      font-size: 13px;
      outline: none;
    }

    .chat-input button {
      background: none;
      border: none;
      color: #0A1128;
      font-size: 18px;
      cursor: pointer;
      margin-left: 8px;
    }

    /* Scheduler Styles */
    .scheduler {
      background-color: white;
      border-radius: 12px;
      padding: 20px;
      box-shadow: 0 2px 12px rgba(0, 0, 0, 0.1);
      width: 100%;
    }

    .scheduler-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 16px;
    }

    .scheduler-header h3 {
      font-size: 16px;
      font-weight: 600;
      margin: 0;
    }

    .scheduler-header a {
      font-size: 13px;
      color: #6c63ff;
      text-decoration: none;
    }

    .date-row {
      display: flex;
      gap: 8px;
      margin-bottom: 20px;
      flex-wrap: wrap;
    }

    .date {
      flex: 1 1 60px;
      background-color: #f1f1f1;
      border-radius: 10px;
      text-align: center;
      padding: 8px 0;
      font-size: 13px;
      cursor: pointer;
    }

    .date.active {
      background-color: #6c63ff;
      color: white;
      font-weight: bold;
    }

    .times {
      display: flex;
      flex-direction: column;
      gap: 10px;
      max-height: 200px;
      overflow-y: auto;
    }

    .time-slot {
      background-color: #f1f1f1;
      border-radius: 20px;
      padding: 8px 14px;
      font-size: 14px;
      text-align: center;
      cursor: pointer;
      transition: background-color 0.2s;
    }

    .time-slot:hover {
      background-color: #e0e0e0;
    }

    .appointment-button {
      display: flex;
      justify-content: center;
      margin-top: 20px;
    }

    .appointment-button button {
      background-color: #6c63ff;
      color: white;
      border: none;
      border-radius: 20px;
      padding: 10px 20px;
      font-size: 14px;
      font-weight: 500;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 6px;
      text-decoration: none;
    }

    .appointment-button button:hover {
      background-color: #574fe3;
    }

    @media (max-width: 768px) {
      .sidebar-button {
        width: 100%;
        max-width: 240px;
      }

      .modal {
        right: 0;
        left: 0;
        margin: auto;
        width: 95%;
      }
    }
  </style>
</head>
<body>

<div class="section-container">
  <div class="sidebar-buttons">
    <a href="#" onclick="openModal('serviceModal')">
      <div class="sidebar-button">
        <img src="https://img.icons8.com/ios-filled/20/000000/maintenance.png" alt="Service Icon">
        <span>Book Services</span>
        <img src="https://img.icons8.com/ios/20/000000/chevron-right.png" alt="Arrow">
      </div>
    </a>
    <a href="#" onclick="openModal('chatModal')">
      <div class="sidebar-button">
        <img src="https://img.icons8.com/ios/20/000000/chat--v1.png" alt="Chat Icon">
        <span>Chatbot</span>
        <img src="https://img.icons8.com/ios/20/000000/chevron-right.png" alt="Arrow">
      </div>
    </a>
  </div>
  <div class="carousel-wrapper">
    <div class="carousel-container">
      <div class="slide active">Service<br>Request<br>Made Easy<br>Fast</div>
      <div class="slide">Connect<br>With Experts<br>Anywhere<br>Quickly</div>
      <div class="slide">Reliable<br>Smart<br>Support<br>24/7</div>
      <div class="slide">Grow<br>Faster<br>With<br>eVubaConnect</div>
    </div>
    <div class="dots">
      <span class="dot active" onclick="showSlide(0)"></span>
      <span class="dot" onclick="showSlide(1)"></span>
      <span class="dot" onclick="showSlide(2)"></span>
      <span class="dot" onclick="showSlide(3)"></span>
    </div>
  </div>
</div>

<!-- Scheduler Modal -->
<div id="serviceModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal('serviceModal')">&times;</span>
    <div class="scheduler">
      <div class="scheduler-header">
        <h3>Available Times</h3>
        <a href="#">See All</a>
      </div>
      <div class="date-row">
        <div class="date active" onclick="selectDate(0)">14<br><small>Sun</small></div>
        <div class="date" onclick="selectDate(1)">15<br><small>Mon</small></div>
        <div class="date" onclick="selectDate(2)">16<br><small>Tue</small></div>
        <div class="date" onclick="selectDate(3)">17<br><small>Wed</small></div>
      </div>
      <div class="times" id="timeSlots"></div>
      <div class="appointment-button">
        <button onclick="window.location.href='{{ route('web.appointment') }}'">＋ Make new appointment</button>
      </div>
    </div>
  </div>
</div>

<!-- Chat Modal -->
<div id="chatModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal('chatModal')">&times;</span>
    <div class="chat-header">Chatbot Assistant</div>
    <div class="chat-body" id="chat-body">
      <div class="message bot">Hi there! How can I assist you today?</div>
    </div>
    <div class="chat-input">
      <input type="text" id="userInput" placeholder="Type your message..." />
      <button onclick="sendMessage()">➤</button>
    </div>
  </div>
</div>

<script>
  let currentSlide = 0;
  const slides = document.querySelectorAll('.slide');
  const dots = document.querySelectorAll('.dot');

  function showSlide(index) {
    slides.forEach((slide, i) => {
      slide.classList.remove('active');
      dots[i].classList.remove('active');
    });
    slides[index].classList.add('active');
    dots[index].classList.add('active');
    currentSlide = index;
  }

  setInterval(() => showSlide((currentSlide + 1) % slides.length), 4000);

  function openModal(id) {
    document.getElementById(id).style.display = 'block';
  }

  function closeModal(id) {
    document.getElementById(id).style.display = 'none';
  }

  function sendMessage() {
    const input = document.getElementById('userInput');
    const message = input.value.trim();
    if (!message) return;

    const chatBody = document.getElementById('chat-body');
    const userMsg = document.createElement('div');
    userMsg.className = 'message user';
    userMsg.textContent = message;
    chatBody.appendChild(userMsg);
    input.value = '';
    chatBody.scrollTop = chatBody.scrollHeight;

    setTimeout(() => {
      const botMsg = document.createElement('div');
      botMsg.className = 'message bot';
      botMsg.textContent = 'Thanks for your message!';
      chatBody.appendChild(botMsg);
      chatBody.scrollTop = chatBody.scrollHeight;
    }, 700);
  }

  const timeData = {
    0: ["9:00 AM", "10:00 AM", "11:00 AM", "12:00 PM", "1:00 PM"],
    1: ["2:00 PM", "3:00 PM", "4:00 PM", "5:00 PM"],
    2: ["9:00 AM", "10:00 AM", "11:00 AM", "12:00 PM", "1:00 PM"],
    3: ["2:00 PM", "3:00 PM", "4:00 PM", "5:00 PM"]
  };

  const timeSlots = document.getElementById('timeSlots');
  let currentDate = 0;

  function renderSlots(index) {
    timeSlots.innerHTML = "";
    timeData[index].forEach(time => {
      const div = document.createElement('div');
      div.className = 'time-slot';
      div.textContent = time;
      timeSlots.appendChild(div);
    });
  }

  function selectDate(index) {
    document.querySelectorAll('.date').forEach((el, i) => {
      el.classList.toggle('active', i === index);
    });
    currentDate = index;
    renderSlots(index);
  }

  renderSlots(currentDate);
</script>

</body>
</html>
