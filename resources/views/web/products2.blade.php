
  <style>
    * {
      box-sizing: border-box;
      padding: 0;
    }

    body {
      font-family: Arial, sans-serif;
    }

    .support-section {
      background: linear-gradient(to right, #0A1128, #0A1128);
      color: white;
      padding: 40px 20px;
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      justify-content: center;
      margin-top: 10px;
    }

    .support-content {
      flex: 1;
      min-width: 300px;
      max-width: 500px;
      padding: 20px;
    }

    .support-label {
      color: #00ff88;
      font-size: 14px;
      margin-bottom: 10px;
      font-weight: bold;
    }

    .support-title {
      font-size: 32px;
      font-weight: bold;
      margin-bottom: 10px;
    }

    .support-description {
      font-size: 28px;
      margin-bottom: 30px;
    }

    .support-action {
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .call-icon {
      background: white;
      border-radius: 50%;
      padding: 10px;
      width: 60px;
      height: 60px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .call-icon img {
      width: 40px;
      height: 40px;
    }

    .call-button {
      background: #00e676;
      color: white;
      border: none;
      padding: 12px 20px;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .call-button:hover {
      background: #00c060;
    }

    .support-image {
      flex: 1;
      min-width: 300px;
      max-width: 500px;
      text-align: center;
      padding: 20px;
    }

    .support-image img {
      max-width: 100%;
      height: auto;
      border-radius: 8px;
    }

    @media (max-width: 768px) {
      .support-section {
        flex-direction: column;
        text-align: center;
      }

      .support-action {
        justify-content: center;
      }
    }
  </style>

  <section class="support-section">
    <div class="support-content">
      <div class="support-label">Support</div>
      <div class="support-title">We are here for you</div>
      <div class="support-description">Any issue reach on us</div>
      <div class="support-action">
        <div class="call-icon">
          <img src="https://www.gstatic.com/images/branding/product/1x/meet_2020q4_48dp.png" alt="Call Icon">
        </div>
        <button class="call-button" onclick="makeCall()">Call Us!</button>
      </div>
    </div>
    <div class="support-image">
      <img src="{{asset('images/support.jpeg')}}" alt="Support Person">
    </div>
  </section>

  <script>
    function makeCall() {
      alert('Calling support...');
      // You could redirect to a tel: link or video call integration
      // window.location.href = "tel:+1234567890";
    }
  </script>

