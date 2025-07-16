@include('admin.mail_header')
@include('admin.sidebar')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Inbox UI</title>
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

    .top-bar {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      gap: 8px;
      padding: 10px;
      background: white;
      border-bottom: 1px solid #ddd;
    }

    .top-bar button, .top-bar a {
      font-size: 14px;
      padding: 6px 12px;
      background-color: #f1f3f4;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      color: #202124;
      text-decoration: none;
    }

    .email-list {
      background: white;
      margin: 10px 0;
      border: 1px solid #ddd;
    }

    .email-item {
      display: flex;
      align-items: center;
      padding: 8px 12px;
      border-top: 1px solid #eee;
      font-size: 14px;
    }

    .email-item:first-child {
      border-top: none;
    }

    .email-item:hover {
      background: #f1f3f4;
    }

    .star, .checkbox {
      margin-right: 8px;
      cursor: pointer;
    }

    .sender {
      font-weight: bold;
      margin-right: 6px;
      white-space: nowrap;
    }

    .label {
      background-color: #e8f0fe;
      color: #1967d2;
      font-size: 11px;
      padding: 2px 6px;
      border-radius: 4px;
      margin-right: 6px;
    }

    .subject {
      flex-grow: 1;
      color: #333;
      overflow: hidden;
      white-space: nowrap;
      text-overflow: ellipsis;
    }

    .date {
      font-size: 12px;
      color: gray;
      min-width: 60px;
      text-align: right;
      margin-left: 6px;
    }

    footer {
      font-size: 12px;
      color: #777;
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
      padding: 10px;
      background: #f1f1f1;
      border-top: 1px solid #ccc;
    }

    footer a {
      color: #777;
      text-decoration: none;
      margin: 0 4px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="top-bar">
      <button>From</button>
      <button>Any time</button>
      <button>Has attachment</button>
      <button>To</button>
      <button>Is unread</button>
      <a href="#">Advanced search</a>
    </div>

    <div class="email-list">
      <div class="email-item">
        <input type="checkbox" class="checkbox">
        <span class="star">⭐</span>
        <span class="sender">LinkedIn</span>
        <span class="label">Inbox</span>
        <span class="subject">Innocent, add BIGIRIMANA Celestin - Sales And Marketing Specialist - Engineer, Author...</span>
        <span class="date">Jun 18</span>
      </div>

      <div class="email-item">
        <input type="checkbox" class="checkbox">
        <span class="star">⭐</span>
        <span class="sender">HackerRank Team</span>
        <span class="subject">Day 18: Get in Line with Queues & Stacks - Day 18 of 30 Days of Code Hi makeitsolutions, Welcome...</span>
        <span class="date">Jun 18</span>
      </div>

      <div class="email-item">
        <input type="checkbox" class="checkbox">
        <span class="star">⭐</span>
        <span class="sender">HackerRank Team</span>
        <span class="subject">Day 17: Handle Exceptions Like a Boss - Day 17 of 30 Days of Code Hi makeitsolutions...</span>
        <span class="date">Jun 17</span>
      </div>

      <div class="email-item">
        <input type="checkbox" class="checkbox">
        <span class="star">⭐</span>
        <span class="sender">Upwork</span>
        <span class="label">Inbox</span>
        <span class="subject">Finalize your profile and get ready to win work - Move your freelance career forward...</span>
        <span class="date">Jun 16</span>
      </div>

      <div class="email-item">
        <input type="checkbox" class="checkbox">
        <span class="star">⭐</span>
        <span class="sender">HackerRank Team</span>
        <span class="subject">Day 16: Be Exception-al - Day 16 of 30 Days of Code Hi makeitsolutions, Welcome to Day 16...</span>
        <span class="date">Jun 16</span>
      </div>

      <div class="email-item">
        <input type="checkbox" class="checkbox">
        <span class="star">⭐</span>
        <span class="sender">HackerRank Team</span>
        <span class="subject">Day 15: Come together for Linked Lists - Day 15 of 30 Days of Code Hi makeitsolutions...</span>
        <span class="date">Jun 15</span>
      </div>

      <div class="email-item">
        <input type="checkbox" class="checkbox">
        <span class="star">⭐</span>
        <span class="sender">HackerRank Team</span>
        <span class="subject">Day 14: Broaden your Scope - Day 14 of 30 Days of Code Hi makeitsolutions...</span>
        <span class="date">Jun 14</span>
      </div>

      <div class="email-item">
        <input type="checkbox" class="checkbox">
        <span class="star">⭐</span>
        <span class="sender">LinkedIn</span>
        <span class="label">Inbox</span>
        <span class="subject">Marriott Hotels International Luxury Hotel Management - Paradox is hiring a AsstMgr-Se...</span>
        <span class="date">Jun 13</span>
      </div>

      <div class="email-item">
        <input type="checkbox" class="checkbox">
        <span class="star">⭐</span>
        <span class="sender">Upwork</span>
        <span class="label">Inbox</span>
        <span class="subject">Welcome to Upwork - You've opened the door to a world of new work opportunities...</span>
        <span class="date">Jun 13</span>
      </div>

      <div class="email-item">
        <input type="checkbox" class="checkbox">
        <span class="star">⭐</span>
        <span class="sender">HackerRank Team</span>
        <span class="subject">Day 13: Let’s Get Abstract - Day 13 of 30 Days of Code Hi makeitsolutions...</span>
        <span class="date">Jun 13</span>
      </div>
    </div>

    <footer>
      <div>0% of 15 GB used</div>
      <div>
        <a href="#">Terms</a> · <a href="#">Privacy</a> · <a href="#">Program Policies</a>
      </div>
      <div>Last account activity: 7 hours ago</div>
    </footer>
  </div>

  <script>
    // Example placeholder for future interactivity
    console.log('Inbox UI loaded.');
  </script>
</body>
</html>

@include('admin.footer')