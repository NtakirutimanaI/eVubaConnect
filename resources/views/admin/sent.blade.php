@include('admin.mail_header')
@include('admin.sidebar')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Email Inbox</title>
  <link rel="stylesheet" href="styles.css" />
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      background: #f6f8fc;
    }

    .toolbar {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 10px 20px;
      background: #fff;
      border-bottom: 1px solid #ddd;
      font-size: 14px;
      width: 81.5%;
      margin-left: 222px;
    }

    .toolbar select {
      padding: 5px;
    }

    .advanced-search {
      color: #1a73e8;
      text-decoration: none;
    }

    .email-table {
      margin: 0 20px;
      font-size: 14px;
      width: 81.5%;
      margin-left: 222px;
    }

    .email-header,
    .email-row {
      display: grid;
      grid-template-columns: 30px 200px 1fr 70px;
      padding: 10px;
      align-items: center;
      border-bottom: 1px solid #e0e0e0;
      background: #fff;
    }

    .email-header {
      font-weight: bold;
      color: #555;
      background: #f1f3f4;
    }

    .email-row.unread {
      font-weight: bold;
      background-color: #eaf1fb;
    }

    .email-row:hover {
      background: #f5f5f5;
    }

    .badge {
      background: #e8f0fe;
      color: #1967d2;
      padding: 2px 6px;
      font-size: 11px;
      border-radius: 4px;
      margin-right: 5px;
    }

    .attachment {
      margin-left: 10px;
    }
  </style>
</head>
<body>
  <div class="toolbar">
    <select>
      <option>Any time</option>
    </select>
    <select>
      <option>Has attachment</option>
    </select>
    <select>
      <option>To</option>
    </select>
    <select>
      <option>Is unread</option>
    </select>
    <a href="#" class="advanced-search">Advanced search</a>
  </div>

  <div class="email-table">
    <div class="email-header">
      <span><input type="checkbox" /></span>
      <span class="email-to">To:</span>
      <span class="email-subject">Subject</span>
      <span class="email-date">Date</span>
    </div>

    <div class="email-row unread">
      <span><input type="checkbox" /></span>
      <span class="email-to">nshimiyiman.</span>
      <span class="email-subject"><span class="badge">Inbox</span> RE: Request - Thank You Dear...</span>
      <span class="email-date">Jul 11</span>
    </div>

    <div class="email-row">
      <span><input type="checkbox" /></span>
      <span class="email-to">innocentnta.</span>
      <span class="email-subject">RE: Improvement - Thank You Dear...</span>
      <span class="email-date">Jul 11</span>
    </div>

    <div class="email-row">
      <span><input type="checkbox" /></span>
      <span class="email-to">fionaanne.u.</span>
      <span class="email-subject">Request for Payment API Access – Integration with TECH GUARD System</span>
      <span class="email-date">Jun 12</span>
    </div>

    <div class="email-row">
      <span><input type="checkbox" /></span>
      <span class="email-to">Nkurunziza 2</span>
      <span class="email-subject"><span class="badge">Inbox</span> Reapplication for Graphic Design Internship <span class="attachment">📎</span></span>
      <span class="email-date">Jun 8</span>
    </div>

    <div class="email-row unread">
      <span><input type="checkbox" /></span>
      <span class="email-to">papy</span>
      <span class="email-subject"><strong>Reset Password Notification</strong> – Laravel Logo Hello!...</span>
      <span class="email-date">Jun 4</span>
    </div>
  </div>

  <script src="script.js"></script>
</body>
</html>

<script>
  document.querySelectorAll('.email-row').forEach(row => {
    row.addEventListener('click', () => {
      alert('Opening email: ' + row.querySelector('.email-subject').innerText);
    });
  });
</script>

@include('admin.footer')