<footer class="footer">
  <div class="footer-column">
    <h3>eVubaConnect</h3>
    <p>Subscribe</p>
    <p>Get 10% off your first order</p>
    <form>
      <input type="email" placeholder="Enter your email" />
      <button>&gt;</button>
    </form>
  </div>

  <div class="footer-column">
    <h3>Support</h3>
    <p>Rwanda, Kigali,<br>Nyamirambo</p>
    <p>eVubaConnect@gmail.com</p>
    <p>+250 786 325 291</p>
  </div>

  <div class="footer-column">
    <h3>Account</h3>
    <a href="#">My Account</a>
    <a href="#">Login / Register</a>
    <a href="#">Cart</a>
    <a href="#">Wishlist</a>
    <a href="#">Shop</a>
  </div>

  <div class="footer-column">
    <h3>Quick Link</h3>
    <a href="#">Privacy Policy</a>
    <a href="#">Terms Of Use</a>
    <a href="#">FAQ</a>
    <a href="#">Contact</a>
  </div>

  <div class="footer-column download-app">
    <h3>Download App</h3>
    <p>Save $3 with App New User Only</p>    
    <div class="footer-icons">
      <a href="#"><i class="fab fa-facebook-f"></i></a>
      <a href="#"><i class="fab fa-twitter"></i></a>
      <a href="#"><i class="fab fa-instagram"></i></a>
      <a href="#"><i class="fab fa-linkedin-in"></i></a>
    </div>
  </div>
</footer>

<div class="footer-bottom">
  © Copyright Rimel 2022. All rights reserved
</div>

<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

<style>
  .footer {
    background:#0A1128;
    color: #fff;
    padding: 40px 20px;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    font-family: Arial, sans-serif;
    margin-top:30px;
  }

  .footer-column {
    flex: 1 1 180px;
    margin: 10px;
  }

  .footer h3 {
    font-size: 16px;
    margin-bottom: 10px;
  }

  .footer p,
  .footer a {
    font-size: 14px;
    color: #ccc;
    text-decoration: none;
    display: block;
    margin-bottom: 8px;
  }

  .footer input[type="email"] {
    padding: 8px;
    width: 70%;
    border: none;
    border-radius: 2px;
  }

  .footer button {
    padding: 8px 12px;
    background: transparent;
    border: 1px solid #fff;
    color: #fff;
    cursor: pointer;
  }

  .download-app img {
    width: 110px;
    margin-bottom: 8px;
    display: block;
  }

  .footer-icons {
    display: flex;
    gap: 10px;
    margin-top: 10px;
  }

  .footer-icons a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background-color: #222;
    border-radius: 50%;
    width: 32px;
    height: 32px;
    color: #fff;
    font-size: 14px;
    transition: background 0.3s;
  }

  .footer-icons a:hover {
    background-color: #322EFF;
  }

  .footer-bottom {
    text-align: center;
    font-size: 12px;
    color: #888;
    padding: 10px 0;
    background-color: #0b0b0b;
  }

  @media (max-width: 768px) {
    .footer {
      flex-direction: column;
      align-items: flex-start;
    }

    .download-app img {
      width: 90px;
    }

    .footer-icons {
      margin-bottom: 20px;
    }
  }
</style>
