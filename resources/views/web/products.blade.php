<style>
  * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
  }

  body {
    font-family: Arial, sans-serif;
    overflow-x: hidden;
    background: #0A1128; /* 🔹 Applied to whole page */
    color: white;         /* 🔹 Optional: to make all text readable */
  }

  h1 {
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 20px;
  }

  .countdown {
    display: flex;
    gap: 10px;
    font-size: 18px;
    font-weight: bold;
    flex-wrap: wrap;
    justify-content: flex-start;
  }

  .countdown div {
    text-align: center;
    padding: 10px;
    background: #0A1128; /* already updated */
    border-radius: 6px;
    min-width: 70px;
    color:white;
  }

  .countdown span {
    display: block;
    font-size: 12px;
    color: #ccc; /* Slightly lighter for contrast */
    margin-top: 4px;
  }

  .securedata-section {
    max-width: 70vw;
    margin: 0 auto;
    text-align: center;
    padding: 40px 0;
  }

  .securedata-promo-label {
    display: inline-flex;
    align-items: center;
    font-size: 14px;
    font-weight: bold;
    color: #322EFF;
    margin-bottom: 5px;
  }

  .securedata-promo-label::before {
    content: "";
    display: inline-block;
    width: 6px;
    height: 16px;
    background-color: #322EFF;
    border-radius: 3px;
    margin-right: 6px;
  }

  .securedata-carousel-container {
    max-width: 70vw;
    margin: 0 auto;
    position: relative;
    overflow: hidden;
  }

  .securedata-carousel-wrapper {
    display: flex;
    transition: transform 0.6s ease;
    align-items: center;
  }

  .securedata-carousel-item {
    flex: 0 0 33.33%;
    padding: 10px;
    transition: transform 0.6s ease;
  }

  .securedata-carousel-item img {
    width: 100%;
    height: 250px;
    object-fit: cover;
    border-radius: 6px;
    transition: transform 0.6s ease;
  }

  .securedata-carousel-item.securedata-center img {
    transform: scale(1.1);
    z-index: 2;
  }

  .securedata-carousel-controls {
    display: flex;
    gap: 10px;
    justify-content: center;
    align-items: center;
    margin-left: 60px;
  }

  .securedata-carousel-controls button {
    font-size: 22px;
    padding: 8px 14px;
    background: #f4f4f4;
    border: 1px solid #ccc;
    border-radius: 50%;
    cursor: pointer;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
  }

  .securedata-cta-button {
    margin-top: 30px;
    text-align: center;
  }

  .securedata-cta-button button {
    background-color: #322EFF;
    color: white;
    padding: 12px 24px;
    border: none;
    border-radius: 5px;
    font-size: 14px;
    cursor: pointer;
  }

  .securedata-header-block {
    display: flex;
    align-items: flex-start;
    justify-content: flex-start;
    gap: 30px;
    margin: 20px 15.5%;
    flex-wrap: wrap;
  }

  .title-block {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    min-width: 200px;
  }

  @media (max-width: 768px) {
    .securedata-carousel-item {
      flex: 0 0 100%;
    }

    .securedata-carousel-item.securedata-center img {
      transform: scale(1.05);
    }

    .securedata-carousel-controls {
      flex-direction: row;
      margin: 10px auto;
    }

    .securedata-section,
    .securedata-carousel-container {
      max-width: 100vw;
    }

    .securedata-carousel-item img {
      height: 200px;
    }

    .securedata-header-block {
      flex-direction: column;
      align-items: flex-start;
      margin-left: 5vw;
      margin-right: 5vw;
    }
  }
</style>

<div class="securedata-header-block">
  <div class="title-block">
    <span class="securedata-promo-label">Promotion</span>
    <h1>Secure your data</h1>
  </div>

  <div class="countdown" id="countdown">
    <div><div id="days">Days</div><span>03</span></div>
    <div><div id="hours">Hours</div><span>23</span></div>
    <div><div id="minutes">Minutes</div><span>19</span></div>
    <div><div id="seconds">Seconds</div><span>56</span></div>
  </div>

  <div class="securedata-carousel-controls">
    <button onclick="securedataSlideLeft()">&#8592;</button>
    <button onclick="securedataSlideRight()">&#8594;</button>
  </div>
</div>

<div class="securedata-carousel-container">
  <div class="securedata-carousel-wrapper" id="securedata-carousel">
    <div class="securedata-carousel-item">
      <img src="{{asset('images/img1.png')}}" alt="Server 1">
    </div>
    <div class="securedata-carousel-item securedata-center">
      <img src="{{asset('images/img2.png')}}" alt="Server 2">
    </div>
    <div class="securedata-carousel-item">
      <img src="{{asset('images/img3.png')}}" alt="Server 3">
    </div>
  </div>
</div>

<div class="securedata-cta-button">
  <button>View All Products</button>
</div>

<script>
  const securedataCarousel = document.getElementById("securedata-carousel");
  let securedataItems = securedataCarousel.querySelectorAll(".securedata-carousel-item");

  function securedataUpdateClasses() {
    securedataItems.forEach(item => item.classList.remove("securedata-center"));
    const middleIndex = Math.floor(securedataItems.length / 2);
    securedataItems[middleIndex].classList.add("securedata-center");
  }

  function securedataSlideLeft() {
    securedataCarousel.appendChild(securedataItems[0]);
    securedataItems = securedataCarousel.querySelectorAll(".securedata-carousel-item");
    securedataUpdateClasses();
  }

  function securedataSlideRight() {
    securedataCarousel.insertBefore(securedataItems[securedataItems.length - 1], securedataItems[0]);
    securedataItems = securedataCarousel.querySelectorAll(".securedata-carousel-item");
    securedataUpdateClasses();
  }

  securedataUpdateClasses();
</script>
