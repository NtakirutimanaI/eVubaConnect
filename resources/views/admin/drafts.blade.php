@include('admin.mail_header')
@include('admin.sidebar')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Email Drafts</title>
  <link rel="stylesheet" href="styles.css" />
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      background-color: #f9f9f9;
    }

    .container {
      margin-left: 222px;
      width: 81.5%;
    }

    .header {
      display: flex;
      gap: 10px;
      padding: 10px;
      background-color: white;
      border-bottom: 1px solid #ccc;
      align-items: center;
    }

    .header button, .header a {
      font-size: 14px;
      padding: 6px 10px;
      background-color: #f1f3f4;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .email-table {
      margin: 10px;
      background-color: white;
      border: 1px solid #ddd;
    }

    .email-row {
      display: flex;
      align-items: center;
      padding: 10px;
      border-top: 1px solid #eee;
    }

    .email-row.header-row {
      font-weight: bold;
      background-color: #f5f5f5;
    }

    .email-row input[type="checkbox"] {
      margin-right: 10px;
    }

    .label {
      color: black;
      font-weight: bold;
      margin-right: 10px;
      min-width: 50px;
    }

    .subject {
      flex-grow: 1;
      font-size: 14px;
      color: #333;
    }

    .date {
      color: gray;
      font-size: 12px;
      min-width: 60px;
      text-align: right;
    }

    footer {
      padding: 15px;
      font-size: 12px;
      color: #777;
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      background: #f1f1f1;
      margin-top: 20px;
      border-top: 1px solid #ccc;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <button>Any time</button>
      <button>Has attachment</button>
      <button>To</button>
      <a href="#">Advanced search</a>
    </div>

    <div class="email-table">
      <div class="email-row header-row">
        <input type="checkbox" />
        <span class="label">Draft</span>
        <span class="subject">(no subject)</span>
        <span class="date">Jun 24</span>
      </div>

      <div class="email-row">
        <input type="checkbox" />
        <span class="label">Draft</span>
        <span class="subject">Job Application letter - Innocent Ntakirutimana Kigali, Rwanda Email: innocentntakir@gmail.com Tel: ...</span>
        <span class="date">Jun 12</span>
      </div>

      <div class="email-row">
        <input type="checkbox" />
        <span class="label">Draft</span>
        <span class="subject">Zifite size nini cyane</span>
        <span class="date">Jun 1</span>
      </div>

      <div class="email-row">
        <input type="checkbox" />
        <span class="label">Draft</span>
        <span class="subject">Apps</span>
        <span class="date">Jun 1</span>
      </div>
    </div>

    <footer>
      <div class="usage">0% of 15 GB used</div>
      <div class="policies">
        <a href="#">Terms</a> · <a href="#">Privacy</a> · <a href="#">Program Policies</a>
      </div>
      <div class="activity">Last account activity: 7 hours ago</div>
    </footer>
  </div>

  <script src="script.js"></script>
  <script>
    // Placeholder for future dynamic functionality
    console.log("Inbox UI loaded.");
  </script>
</body>
</html>
