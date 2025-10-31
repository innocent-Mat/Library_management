<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Footer Section</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #fff;
    }

    footer {
      background-color: #f9f9f9;
      padding: 40px 20px;
      border-top: 1px solid #ddd;
    }

    .footer-container {
      max-width: 1200px;
      margin: 0 auto;
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    .footer-columns {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 20px;
    }

    .footer-column h4 {
      font-size: 1.1rem;
      margin-bottom: 15px;
      color: #000;
    }

    .footer-column ul {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .footer-column ul li {
      margin-bottom: 10px;
    }

    .footer-column ul li a {
      text-decoration: none;
      color: #555;
      font-size: 0.9rem;
      transition: color 0.3s;
    }

    .footer-column ul li a:hover {
      color: #000;
    }

    .social-links {
      display: flex;
      justify-content: center;
      gap: 15px;
      margin-top: 20px;
    }

    .social-links a {
      text-decoration: none;
      color: #000;
      font-size: 1.2rem;
      display: flex;
      align-items: center;
      justify-content: center;
      width: 36px;
      height: 36px;
      border: 1px solid #000;
      border-radius: 50%;
      transition: background-color 0.3s, color 0.3s;
    }

    .social-links a:hover {
      background-color: #000;
      color: #fff;
    }

    .footer-bottom {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 20px;
      border-top: 1px solid #ddd;
      padding-top: 20px;
    }

    .footer-bottom .selectors {
      display: flex;
      gap: 20px;
    }

    .selectors select {
      padding: 8px;
      border: 1px solid #ddd;
      border-radius: 4px;
      font-size: 0.9rem;
    }

    .payment-icons {
      display: flex;
      gap: 10px;
      justify-content: center;
    }

    .payment-icons img {
      width: 36px;
      height: auto;
    }

    .copyright {
      font-size: 0.9rem;
      color: #555;
      text-align: center;
    }
  </style>
</head>
<body>
  <footer>
    <div class="footer-container">
      <div class="footer-columns">
        <div class="footer-column">
          <h4>About us</h4>
          <ul>
            <li><a href="#">Our Mission</a></li>
            <li><a href="#">Our Impact</a></li>
            <li><a href="#">Our Technology</a></li>
          </ul>
        </div>
        <div class="footer-column">
          <h4>Need Help?</h4>
          <ul>
            <li><a href="#">FAQ</a></li>
            <li><a href="#">Support with my product</a></li>
          </ul>
        </div>
        <div class="footer-column">
          <h4>Contact Us</h4>
          <ul>
            <li><a href="#">Corporate</a></li>
            <li><a href="#">School</a></li>
            <li><a href="#">Distributor</a></li>
          </ul>
        </div>
        <div class="footer-column">
          <h4>Useful Links</h4>
          <ul>
            <li><a href="#">Affiliate program</a></li>
            <li><a href="#">Referral program</a></li>
            <li><a href="#">Terms & Conditions</a></li>
            <li><a href="#">Privacy Policy</a></li>
          </ul>
        </div>
      </div>

      <div class="social-links">
            <a href="#" class="fa fa-facebook"></a>
            <a href="#" class="fa fa-twitter"></a>
            <a href="#" class="fa fa-google"></a>
            <a href="#" class="fa fa-instagram"></a>
            <a href="#" class="fa fa-yahoo"></a>
      </div>

      <div class="footer-bottom">
        <div class="selectors">
          <select name="country" aria-label="Country/region">
            <option value="italy">Italy (EUR €)</option>
            <option value="us">United States (USD $)</option>
            <option value="uk">United Kingdom (GBP £)</option>
          </select>
          <select name="language" aria-label="Language">
            <option value="english">English</option>
            <option value="italian">Italian</option>
            <option value="french">French</option>
          </select>
        </div>

        <div class="payment-icons">
          <img src="images/amex.jpg" alt="AMEX">
          <img src="images/apple.jpg" alt="Apple Pay">
          <img src="images/Google.jpg" alt="Google Pay">
          <img src="images/PayPal.jpg" alt="PayPal">
          <img src="images/Visa.jpg" alt="Visa">
        </div>

        <div class="copyright">
          Copyright © 2024 Hexagro Urban Farming S.r.l. SB All rights reserved.
        </div>
      </div>
    </div>
  </footer>
</body>
</html>