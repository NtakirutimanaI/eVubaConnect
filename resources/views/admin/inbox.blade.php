<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Gmail-Inspired Inbox</title>

  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f1f3f4;
      margin: 0;
      padding: 0;
      
    }

    header {
      display: flex;
      align-items: center;
      padding: 8px 16px;
      background-color: #fff;
      box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }

    header button {
      background: none;
      border: none;
      cursor: pointer;
      padding: 8px;
    }

    header img.logo {
      height: 24px;
      margin-right: 24px;
    }

    .search-container {
      flex-grow: 1;
      max-width: 720px;
      position: relative;
    }

    .search-container input {
      width: 100%;
      padding: 8px 40px 8px 16px;
      border: 1px solid #dadce0;
      border-radius: 8px;
      font-size: 14px;
      color: #202124;
      outline-offset: 2px;
    }

    .search-container svg.search-icon {
      position: absolute;
      right: 12px;
      top: 50%;
      transform: translateY(-50%);
      pointer-events: none;
    }

    .avatar {
      width: 32px;
      height: 32px;
      border-radius: 50%;
      margin-left: 12px;
      cursor: pointer;
    }

    .container {
      max-width: 900px;
      margin: 40px auto;
      background: white;
      border-radius: 8px;
      box-shadow: 0 0 5px rgba(0,0,0,0.1);
    }

    .tabs {
      display: flex;
      border-bottom: 1px solid #ddd;
    }

    .tab {
      padding: 14px 20px;
      cursor: pointer;
      color: #555;
      position: relative;
    }

    .tab.active {
      color: #1a73e8;
      border-bottom: 3px solid #1a73e8;
      font-weight: bold;
    }

    .badge {
      background-color: #eee;
      padding: 2px 6px;
      border-radius: 10px;
      font-size: 12px;
      margin-left: 6px;
    }

    .green {
      background-color: #34a853;
      color: white;
    }

    .blue {
      background-color: #1a73e8;
      color: white;
    }

    .get-started {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
      padding: 20px;
      border-bottom: 1px solid #ddd;
      gap: 10px;
    }

    .card {
      background: #f9fafb;
      padding: 20px;
      text-align: center;
      border-radius: 10px;
    }

    .icon {
      font-size: 30px;
      margin-bottom: 10px;
    }

    .email-list {
      padding: 10px 20px;
    }

    .email-item {
      display: flex;
      align-items: center;
      padding: 12px 0;
      border-bottom: 1px solid #eee;
      transition: background 0.2s;
    }

    .email-item:hover {
      background: #f1f3f4;
    }

    .checkbox {
      margin-right: 10px;
    }

    .star {
      margin-right: 10px;
      color: #ccc;
      cursor: pointer;
    }

    .sender {
      font-weight: bold;
      min-width: 180px;
    }

    .subject {
      flex-grow: 1;
    }

    .time {
      white-space: nowrap;
      color: #555;
    }
  </style>
</head>
<body>

  <!-- Gmail Style Header -->
  <header>
    <!-- Hamburger menu -->
    <button aria-label="Menu" style="margin-right: 16px;">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#5f6368" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <line x1="3" y1="6" x2="21" y2="6" />
        <line x1="3" y1="12" x2="21" y2="12" />
        <line x1="3" y1="18" x2="21" y2="18" />
      </svg>
    </button>

    <!-- Gmail logo -->
    <img src="https://ssl.gstatic.com/ui/v1/icons/mail/rfr/logo_gmail_lockup_default_1x_r2.png" alt="Gmail" class="logo">

    <!-- Search bar -->
    <div class="search-container">
      <input type="search" placeholder="Search mail" aria-label="Search mail">
      <svg class="search-icon" width="20" height="20" fill="#5f6368" viewBox="0 0 24 24">
        <path d="M15.5 14h-.79l-.28-.27a6.471 6.471 0 001.48-5.34C15.03 6.01 12.52 3.5 9.5 3.5S4 6.01 4 9.5 6.52 15.5 9.5 15.5c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zM9.5 14C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
      </svg>
    </div>

    <!-- Clear search (hidden) -->
    <button aria-label="Clear search" style="margin-left: 8px; display: none;">
      <svg width="20" height="20" fill="#5f6368" viewBox="0 0 24 24">
        <path d="M18 6L6 18M6 6l12 12" stroke="#5f6368" stroke-width="2" stroke-linecap="round"/>
      </svg>
    </button>

    <!-- Settings icon -->
    <button aria-label="Settings" style="margin-left: 16px;">
      <svg width="24" height="24" fill="none" stroke="#5f6368" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
        <circle cx="12" cy="12" r="3" />
        <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 1 1-4 0v-.09a1.65 1.65 0 0 0-1-1.51 1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 1 1 0-4h.09a1.65 1.65 0 0 0 1.51-1 1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33h.09A1.65 1.65 0 0 0 9 5.6V5a2 2 0 1 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82v.09a1.65 1.65 0 0 0 1.51 1H21a2 2 0 1 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z" />
      </svg>
    </button>

    <!-- Help icon -->
    <button aria-label="Help" style="margin-left: 8px;">
      <svg width="24" height="24" fill="none" stroke="#5f6368" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
        <circle cx="12" cy="12" r="10" />
        <path d="M9.09 9a3 3 0 1 1 5.83 1c-.27.69-1.12 1.26-1.82 1.53-.54.21-.61.5-.61 1.14M12 17h.01" />
      </svg>
    </button>

    <!-- Google Apps -->
    <button aria-label="Google apps" style="margin-left: 8px;">
      <svg width="24" height="24" fill="#5f6368" viewBox="0 0 24 24">
        <circle cx="4" cy="4" r="2" />
        <circle cx="12" cy="4" r="2" />
        <circle cx="20" cy="4" r="2" />
        <circle cx="4" cy="12" r="2" />
        <circle cx="12" cy="12" r="2" />
        <circle cx="20" cy="12" r="2" />
        <circle cx="4" cy="20" r="2" />
        <circle cx="12" cy="20" r="2" />
        <circle cx="20" cy="20" r="2" />
      </svg>
    </button>

    <!-- Avatar -->
    <img src="https://i.pravatar.cc/40" alt="User Avatar" class="avatar">
  </header>

  @include('admin.mail_sidebar')

  <div class="container">
    <!-- Tabs -->
    <div class="tabs">
      <div class="tab active">Primary</div>
      <div class="tab">Promotions <span class="badge green">9 new</span></div>
      <div class="tab">Social <span class="badge blue">50 new</span></div>
    </div>

    <!-- Get Started -->
    <div class="get-started">
      <div class="card"><div class="icon">📥</div><p>Customize your inbox</p></div>
      <div class="card"><div class="icon">🖼️</div><p>Change profile image</p></div>
      <div class="card"><div class="icon">👥</div><p>Import contacts and mail</p></div>
      <div class="card"><div class="icon">📱</div><p>Get Gmail for mobile</p></div>
    </div>

    <!-- Email List -->
    <div class="email-list" id="email-list"></div>
  </div>

  <script>
    const emails = [
      {
        sender: 'LinkedIn',
        subject: 'Innocent, your application was sent to Kastech Software Solutions Group',
        preview: 'Your application was...',
        time: '10:21 AM'
      },
      {
        sender: 'Jobright',
        subject: 'Welcome to Jobright!',
        preview: "Welcome to Jobright Eric Cheng, CEO 👋 I'm Eric Cheng...",
        time: '10:10 AM'
      },
      {
        sender: 'LinkedIn Job Alerts',
        subject: '“Data Analyst”: Jobright.ai - Entry Level Data Analyst and more',
        preview: 'Jobright.ai Entry Level Data A...',
        time: '1:18 AM'
      },
      {
        sender: 'LinkedIn Job Alerts',
        subject: '“Software Engineer”: Jobright.ai - Junior Software Engineer – Entry Level (Remote)',
        preview: 'Jobright.ai – Entry Level...',
        time: 'Jul 12'
      },
      {
        sender: 'LinkedIn Job Alerts',
        subject: 'Explore jobs similar to your job alert',
        preview: 'Software Tools Engineer and other roles...',
        time: 'Jul 12'
      },
      {
        sender: 'World of Electrical.',
        subject: 'SCADA & PLC Essentials: Must-Learn Basics for Industrial Automation',
        preview: '🔧 SCADA & PLC Basics...',
        time: 'Jul 12'
      },
      {
        sender: 'LinkedIn Job Alerts',
        subject: '“Software Engineer”: Jobright.ai - Junior Software Engineer – Entry Level (Remote)',
        preview: 'Jobright.ai – Entry Level...',
        time: 'Jul 12'
      }
    ];

    const emailList = document.getElementById('email-list');
    emails.forEach(email => {
      const item = document.createElement('div');
      item.className = 'email-item';
      item.innerHTML = `
        <input type="checkbox" class="checkbox" />
        <span class="star">☆</span>
        <div class="sender">${email.sender}</div>
        <div class="subject"><strong>${email.subject}</strong> - ${email.preview}</div>
        <div class="time">${email.time}</div>
      `;
      emailList.appendChild(item);
    });
  </script>
</body>
</html>
