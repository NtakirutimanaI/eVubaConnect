<style>
  /* Reset some default styles */
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    padding-top: 70px; /* space for fixed header */
  }

  header {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    background-color: #0A1128;
    border-bottom: 1px solid #eee;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    z-index: 1000;
    height: 70px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 20px;
    flex-wrap: wrap;
  }

  .logo {
    font-weight: bold;
    font-size: 20px;
    color: white;
  }


  nav {
    display: flex;
    align-items: center;
    gap: 20px;
    flex-wrap: wrap;
  }

  nav a {
    text-decoration: none;
    color: #111;
    font-size: 14px;
    padding-bottom: 5px;
    transition: 0.2s;
  }

  nav a.active{
    border-bottom: 2px solid #fff; /* changed to white */
    color: white;
  }
  nav a:hover {
    border-bottom: 2px solid #fff; /* changed to white */
    color: orange;
  }

  .search-bar {
    display: flex;
    align-items: center;
    background: #f8f8f8;
    border-radius: 4px;
    padding: 5px 10px;
    margin-top: 5px;
  }

  .search-bar input {
    border: none;
    background: transparent;
    outline: none;
    padding: 5px;
    font-size: 13px;
  }

  .search-bar button {
    background: transparent;
    border: none;
    cursor: pointer;
    font-size: 16px;
  }

  /* Refined Sign In/Up styles */
  .auth-links {
    display: flex;
    gap: 10px;
  }

  .auth-links a {
    padding: 5px 12px;
    border: 1px solid #111;
    border-radius: 4px;
    font-size: 13px;
    text-decoration: none;
    color: white;
    transition: background 0.3s;
  }

  .auth-links a:hover {
    background-color: #111;
    color: orange;
  }

  /* Responsive tweaks */
  @media (max-width: 768px) {
    header {
      flex-direction: column;
      height: auto;
      align-items: flex-start;
      gap: 10px;
    }

    nav {
      flex-wrap: wrap;
      gap: 15px;
    }

    .search-bar {
      width: 100%;
    }
  }
</style>
</head>

<header>
  <div class="logo">eVuba Connect</div>

  <nav>
    <a href="#" class="active">Watch Guide</a>
  </nav>

  <div class="auth-links">
    <a href="{{ route('auth.register') }}">Sign Up</a>
  </div>

  <div class="search-bar">
    <input type="text" placeholder="What are you looking for?">
    <button>🔍</button>
  </div>
</header>
