@include('admin.mail_header')
@include('admin.sidebar')

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Trash Inbox</title>
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

    .notice {
      background: #f1f3f4;
      color: #202124;
      font-size: 13px;
      padding: 10px 12px;
      border-bottom: 1px solid #ddd;
    }

    .notice a {
      color: #1a73e8;
      text-decoration: none;
      margin-left: 5px;
    }

    .email-list {
      background: white;
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

    .checkbox {
      margin-right: 8px;
      cursor: pointer;
    }

    .trash-icon {
      margin-right: 8px;
      cursor: pointer;
      color: #5f6368;
    }

    .sender {
      font-weight: bold;
      margin-right: 6px;
      white-space: nowrap;
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

    <div class="notice">
      Messages that have been in Trash more than 30 days will be automatically deleted.
      <a href="#">Empty Trash now</a>
    </div>

    <div class="email-list">
      <div class="email-item">
        <input type="checkbox" class="checkbox">
        <span class="trash-icon">🗑️</span>
        <span class="sender">HackerRank Team</span>
        <span class="subject">Day 23: Rooting for You! - Day 23 of 30 Days of Code Hi makeitsolutions, Welcome...</span>
        <span class="date">Jun 23</span>
      </div>

      <div class="email-item">
        <input type="checkbox" class="checkbox">
        <span class="trash-icon">🗑️</span>
        <span class="sender">HackerRank Team</span>
        <span class="subject">Day 22: Stumped on Binary Search Trees? - Day 22 of 30 Days of Code Hi makeitsolutions...</span>
        <span class="date">Jun 22</span>
      </div>

      <div class="email-item">
        <input type="checkbox" class="checkbox">
        <span class="trash-icon">🗑️</span>
        <span class="sender">HackerRank Team</span>
        <span class="subject">Day 21: Become a Generics Master! - Day 21 of 30 Days of Code Hi makeitsolutions...</span>
        <span class="date">Jun 21</span>
      </div>

      <div class="email-item">
        <input type="checkbox" class="checkbox">
        <span class="trash-icon">🗑️</span>
        <span class="sender">Upwork</span>
        <span class="subject">Complete your profile and begin scoring job opportunities - Move your freelance...</span>
        <span class="date">Jun 20</span>
      </div>

      <div class="email-item">
        <input type="checkbox" class="checkbox">
        <span class="trash-icon">🗑️</span>
        <span class="sender">LinkedIn</span>
        <span class="subject">Pelephone just posted new content - עם חברון פלאפון, 2025</span>
        <span class="date">Jun 2</span>
      </div>

      <div class="email-item">
        <input type="checkbox" class="checkbox">
        <span class="trash-icon">🗑️</span>
        <span class="sender">Google</span>
        <span class="subject">Security alert - Phone number added for 2-Step Verification...</span>
        <span class="date">Jun 2</span>
      </div>

      <div class="email-item">
        <input type="checkbox" class="checkbox">
        <span class="trash-icon">🗑️</span>
        <span class="sender">Google</span>
        <span class="subject">2-Step Verification turned on - 2-Step Verification turned on makeitsolutionsrw@gmail.com...</span>
        <span class="date">Jun 2</span>
      </div>

      <div class="email-item">
        <input type="checkbox" class="checkbox">
        <span class="trash-icon">🗑️</span>
        <span class="sender">HackerRank Team</span>
        <span class="subject">Day 2: Become an Operator Overlord - Day 2 of 30 Days of Code...</span>
        <span class="date">Jun 1</span>
      </div>

      <div class="email-item">
        <input type="checkbox" class="checkbox">
        <span class="trash-icon">🗑️</span>
        <span class="sender">HackerRank Team</span>
        <span class="subject">Day 1: Double Down on Data Types - Day 1 of 30 Days of Code...</span>
        <span class="date">Jun 1</span>
      </div>

      <div class="email-item">
        <input type="checkbox" class="checkbox">
        <span class="trash-icon">🗑️</span>
        <span class="sender">HackerRank Team</span>
        <span class="subject">Welcome to 30 Days of Code - Day 0 of 30 Days of Code! Hi makeitsolutions...</span>
        <span class="date">May 31</span>
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
    // Placeholder for any dynamic actions
    console.log('Trash Inbox UI loaded.');
  </script>
</body>
</html>
@include('admin.footer')