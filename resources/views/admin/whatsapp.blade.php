@include('admin.mail_header')
@include('admin.sidebar')

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>WhatsApp Web Clone</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f6f1eb;
      margin: 0;
      padding: 20px;
      color: #333;
    }

    h1 {
      text-align: center;
      margin-bottom: 5px;
    }

    .subtitle {
      text-align: center;
      color: #666;
      font-size: 14px;
      margin-bottom: 40px;
    }

    .container {
      max-width: 1000px;
      margin: auto;
    }

    .login-box {
      display: flex;
      justify-content: space-between;
      background: white;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    .steps {
      flex: 1;
      padding-right: 40px;
    }

    .steps h2 {
      font-size: 24px;
      margin-bottom: 20px;
    }

    .steps ol {
      padding-left: 20px;
      line-height: 1.7;
    }

    .steps .logo img {
      height: 30px;
      vertical-align: middle;
      width:33px;
    }

    .steps a {
      display: block;
      margin-top: 20px;
      color: green;
      text-decoration: none;
    }

    .stay-logged {
      margin-top: 20px;
    }

    .qr-area {
      flex: 1;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .qr-code {
      position: relative;
      width: 250px;
      height: 250px;
      border: 1px solid #ddd;
      padding: 10px;
      background: #fff;
      border-radius: 8px;
    }

    .qr-code img {
      width: 100%;
      height: 100%;
    }

    .overlay-icon {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      font-size: 36px;
      background: white;
      border-radius: 50%;
      padding: 5px;
    }

    .mock-phone {
      width: 250px;
      height: 150px;
      margin-top: 20px;
      background: #f0f0f0;
      border-radius: 12px;
      position: relative;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>WhatsApp Web</h1>
    <p class="subtitle">🔒 Your personal messages are end-to-end encrypted on all of your devices.</p>
    
    <div class="login-box">
      <div class="steps">
        <h2>Steps to log in</h2>
        <ol>
          <li>Open WhatsApp <span class="logo"><img src="{{ asset('images/whatsapp.png') }}" alt="WhatsApp"></span> on your phone</li>
          <li>On Android tap <strong>Menu</strong><br>On iPhone tap <strong>Settings</strong></li>
          <li>Tap <strong>Linked devices</strong>, then <strong>Link device</strong></li>
          <li>Scan the QR code to confirm</li>
        </ol>
        <a href="#">Log in with phone number instead</a>
        <div class="stay-logged">
          <input type="checkbox" id="stay-logged" checked>
          <label for="stay-logged">Stay logged in</label>
        </div>
      </div>
      
      <div class="qr-area">
        <div class="qr-code">
          <img src="https://upload.wikimedia.org/wikipedia/commons/8/89/QR_Code_Example.svg" alt="QR Code">
          <div class="overlay-icon">🟢</div>
        </div>
        <div class="mock-phone"></div>
      </div>
    </div>
  </div>

  <script>
    document.getElementById("stay-logged").addEventListener("change", (e) => {
      console.log("Stay logged in:", e.target.checked);
    });
  </script>
</body>
</html>
