@include('admin.mail_header')
@include('admin.sidebar')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Inbox - Gmail Style</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f6f8fc;
      margin: 0;
      padding: 0;
    }

    .container {
      width: 81.5%;
      margin-left: 222px;
      margin-top: 10px;
    }

    .header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 10px 20px;
      background: #fff;
      border-bottom: 1px solid #ddd;
    }

    .tab-bar {
      display: flex;
      background: #fff;
      border-bottom: 1px solid #ddd;
      padding: 0 20px;
    }

    .tab {
      padding: 14px 20px;
      cursor: pointer;
      font-size: 14px;
      color: #5f6368;
      display: flex;
      align-items: center;
    }

    .tab.active {
      border-bottom: 3px solid #1a73e8;
      color: #1a73e8;
      font-weight: bold;
    }

    .tab span.badge {
      background: #1a73e8;
      color: #fff;
      font-size: 11px;
      padding: 2px 6px;
      border-radius: 10px;
      margin-left: 5px;
    }

    .inbox {
      margin-top: 10px;
    }

    .email-row {
      display: grid;
      grid-template-columns: 30px 1fr 160px;
      align-items: center;
      padding: 10px 15px;
      background: #fff;
      border-bottom: 1px solid #e0e0e0;
      font-size: 14px;
    }

    .email-row:hover {
      background: #f1f3f4;
    }

    .email-from {
      font-weight: bold;
    }

    .email-subject {
      color: #202124;
      overflow: hidden;
      white-space: nowrap;
      text-overflow: ellipsis;
    }

    .email-date {
      text-align: right;
      color: #5f6368;
      font-size: 13px;
    }

    .attachment {
      margin-left: 5px;
    }

    .label {
      background: #e8f0fe;
      color: #1967d2;
      padding: 2px 6px;
      border-radius: 4px;
      font-size: 11px;
      margin-right: 5px;
    }

    .icon {
      margin-left: 5px;
      font-size: 16px;
      color: #5f6368;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <span><input type="checkbox" /></span>
      <span style="color: #5f6368;">1–45 of 45</span>
    </div>

    <div class="tab-bar">
      <div class="tab active">Primary</div>
      <div class="tab">Promotions <span class="badge">8 new</span></div>
      <div class="tab">Social <span class="badge">8 new</span></div>
      <div class="tab">Updates</div>
    </div>

    <div class="inbox">
      <div class="email-row">
        <input type="checkbox" />
        <div>
          <div class="email-from">donotreply</div>
          <div class="email-subject">Action needed: Your profile is no longer appearing in client searches – Log in to switch your profile ba...</div>
        </div>
        <div class="email-date">Jul 13</div>
      </div>

      <div class="email-row">
        <input type="checkbox" />
        <div>
          <div class="email-from"><strong>LinkedIn</strong></div>
          <div class="email-subject"><strong>Pelephone posted</strong> - Innocent, here are your top trending posts</div>
        </div>
        <div class="email-date">Jul 11</div>
      </div>

      <div class="email-row">
        <input type="checkbox" />
        <div>
          <div class="email-from">me, Nshimiyimana <span class="icon">2</span></div>
          <div class="email-subject">RE: Request - Thank you and see you soon! On Fri, 11 Jul 2025, 17:21 Please Check Your Email!...</div>
        </div>
        <div class="email-date">Jul 11</div>
      </div>

      <div class="email-row">
        <input type="checkbox" />
        <div>
          <div class="email-from">Birusha Ndegeya</div>
          <div class="email-subject">Application for Software Development Skills Training – Dear Make IT Solutions Team, I hope this mess...</div>
        </div>
        <div class="email-date">Jun 3</div>
      </div>

      <div class="email-row">
        <input type="checkbox" />
        <div>
          <div class="email-from">Nkurunziza, me <span class="icon">2</span></div>
          <div class="email-subject">Reapplication for Graphic Design Internship – NKURUNZIZA Vital 
            <span class="label">PDF</span>
            <span class="label">PDF</span>
          </div>
        </div>
        <div class="email-date">Jun 3</div>
      </div>

      <div class="email-row">
        <input type="checkbox" />
        <div>
          <div class="email-from">me, Nkundabagen. <span class="icon">2</span></div>
          <div class="email-subject">Greetings – hello Innocent Ntakirutimana. Gusa usibye ubu butumwa ntakindi nabonye On Sun, Jun 1...</div>
        </div>
        <div class="email-date">Jun 2</div>
      </div>

      <div class="email-row">
        <input type="checkbox" />
        <div>
          <div class="email-from">me, Mail <span class="icon">2</span></div>
          <div class="email-subject">Verify Email Address – Address not found. Your message wasn't delivered to user@gmail.co...</div>
        </div>
        <div class="email-date">Jun 2</div>
      </div>

      <div class="email-row">
        <input type="checkbox" />
        <div>
          <div class="email-from">me</div>
          <div class="email-subject">Reset Password Notification – Hello! You are receiving this email because we received a password res...</div>
        </div>
        <div class="email-date">Jun 2</div>
      </div>

      <div class="email-row">
        <input type="checkbox" />
        <div>
          <div class="email-from">me</div>
          <div class="email-subject">Reset Password Notification – Hello! You are receiving this email because we received a password res...</div>
        </div>
        <div class="email-date">Jun 2</div>
      </div>
    </div>
  </div>

  <script>
    document.querySelectorAll('.tab').forEach(tab => {
      tab.addEventListener('click', () => {
        document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
        tab.classList.add('active');
        alert('Filtering: ' + tab.textContent.trim());
      });
    });

    document.querySelectorAll('.email-row').forEach(row => {
      row.addEventListener('click', () => {
        const subject = row.querySelector('.email-subject').textContent.trim();
        alert('Opening: ' + subject);
      });
    });
  </script>
</body>
</html>

@include('admin.footer')