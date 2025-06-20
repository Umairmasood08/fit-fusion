<?php
// index.php - Full version with hero animation, fire, ashes, and scroll-animated feature cards
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FitFusion - Sculpt Your Body</title>
  <style>
    :root {
      --primary: #b6ff4c;
      --bg: #0f0f0f;
      --text: #ffffff;
      --accent: #1f1f1f;
    }
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
      font-family: 'Segoe UI', sans-serif;
      background: var(--bg) url('images/gym-bg.jpg') no-repeat center center fixed;
      background-size: cover;
      color: var(--text);
      overflow-x: hidden;
    }
    .navbar {
      display: flex; justify-content: space-between; padding: 1rem 2rem;
      background: var(--accent); align-items: center; position: sticky; top: 0; z-index: 1000;
    }
    .logo { font-size: 1.5rem; font-weight: bold; color: var(--primary); }
    nav a { color: var(--text); margin: 0 1rem; text-decoration: none; }
    .hero {
      height: 100vh; display: flex; flex-direction: column;
      align-items: center; justify-content: center; text-align: center;
      position: relative; z-index: 1; overflow: hidden;
    }
    .hero h1 { font-size: 3rem; margin-bottom: 1rem; }
    .hero h1 span { color: var(--primary); }
    .hero p { font-size: 1.2rem; color: #ccc; max-width: 500px; }
    .btn {
      margin-top: 1.5rem; background: var(--primary); color: #000; padding: 0.75rem 1.5rem;
      border: none; border-radius: 10px; font-weight: bold; cursor: pointer; text-decoration: none;
    }
     .ashes {
      position: absolute; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none; z-index: 0; overflow: hidden;
    }
    .ash {
      position: absolute; bottom: -20px; width: 4px; height: 4px; background: #ccc; border-radius: 50%; opacity: 0.4;
      animation: rise 6s infinite ease-in;
    }
    @keyframes rise {
      0% { transform: translateY(0) scale(1); opacity: 0.4; }
      50% { opacity: 0.6; }
      100% { transform: translateY(-100vh) scale(0.5); opacity: 0; }
    }
    .hero-fire {
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 100%;
      height: 180px;
      background: radial-gradient(circle at center, #ff6600 0%, #ff3300 40%, transparent 70%);
      opacity: 0.2;
      animation: firePulse 2.5s infinite alternate ease-in-out;
      z-index: 0;
    }
    @keyframes firePulse {
      0% { transform: translateX(-50%) scale(1); opacity: 0.15; filter: blur(3px); }
      50% { transform: translateX(-50%) scale(1.2); opacity: 0.3; filter: blur(5px); }
      100% { transform: translateX(-50%) scale(1); opacity: 0.2; filter: blur(4px); }
    }
    .hero-image {
      position: absolute; bottom: 0; right: -300px; max-height: 80%; z-index: 2;
      animation: slideIn 2.5s ease-out forwards;
    }
    @keyframes slideIn { to { right: 70%; } }

    /* Feature cards section */
    .cards-section {
      background: rgba(0,0,0,0.85);
      padding: 4rem 2rem;
      text-align: center;
    }
    .cards-section h2 {
      color: var(--primary); font-size: 2rem; margin-bottom: 2rem;
    }
    .cards {
      display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 2rem;
      max-width: 1100px; margin: 0 auto;
    }
    .card {
      background: var(--accent); padding: 0; border-radius: 15px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.4); overflow: hidden;
      transform: translateY(50px); opacity: 0;
      transition: all 0.6s ease-in-out; position: relative;
    }
    .card img {
      width: 100%; height: 180px; object-fit: cover; display: block;
    }
    .card-content {
      padding: 1rem; display: flex; flex-direction: column; gap: 0.75rem; text-align: left;
    }
    .card h3 { color: var(--primary); margin: 0; }
    .card p { color: #ccc; margin: 0; }
    .card a {
      margin-top: 0.5rem; align-self: flex-start; background: var(--primary);
      color: #000; padding: 0.5rem 1rem; border-radius: 8px; text-decoration: none; font-weight: bold;
    }
    .card.active { opacity: 1; transform: translateY(0); }
  </style>
</head>
<body>
<header class="navbar">
  <div class="logo">FITfusion</div>
  <nav>
    <a href="#">Home</a>
    <a href="login.html">login</a>
    <a href="session-booking.html">programs</a>
    <a href="team.html">Team</a>

    <a href="#testimonials">Testimonials</a>
    <a class="btn" href="register.html">Get Started</a>
  </nav>
</header>

<div class="hero">
  <h1><span>Sculpt</span> Your Body, <span>Elevate</span> Your Spirit</h1>
  <p>Train with intensity. Transform with purpose.</p>
  <a href="register.html" class="btn">Join Now</a>
  <img src="" class="" alt="">
  <div class="hero-fire"></div>
</div>

<div class="ashes">
  <?php for ($i = 0; $i < 60; $i++): ?>
    <div class="ash" style="left: <?= rand(0, 100) ?>vw; animation-delay: <?= rand(0, 6000) / 1000 ?>s;"></div>
  <?php endfor; ?>
</div>

<section class="cards-section" id="features">
  <h2>What Makes FitFusion Unique</h2>
  <div class="cards">
    <div class="card">
      <img src="pexels-kyle-karbowski-109303118-10821942.jpg" alt="Coach">
      <div class="card-content">
        <h3>Expert Coaches</h3>
        <p>Train with certified professionals for rapid transformation.</p>
        <a href="login.html">Meet Trainers</a>
      </div>
    </div>
    <div class="card">
      <img src="pexels-ivan-samkov-4164761.jpg" alt="Nutrition">
      <div class="card-content">
        <h3>Tailored Nutrition</h3>
        <p>Get diet plans that match your fitness goals.</p>
        <a href="member-dashboard.php">View Diet Plan</a>
      </div>
    </div>
    <div class="card">
      <img src="pexels-olly-864990 copy.jpg" alt="Workout">
      <div class="card-content">
        <h3>Dynamic Workouts</h3>
        <p>Never boring — explore HIIT, strength, cardio and more.</p>
        <a href="session-booking.html">Explore Sessions</a>
      </div>
    </div>
    <div class="card">
      <img src="pexels-victorfreitas-949126.jpg" alt="Pricing">
      <div class="card-content">
        <h3>Transparent Pricing</h3>
        <p>No hidden fees. Just results.</p>
        <a href="fees.html">View Fees</a>
      </div>
    </div>
  </div>
</section>

<script>
  const cards = document.querySelectorAll('.card');
  window.addEventListener('scroll', () => {
    cards.forEach(card => {
      const top = card.getBoundingClientRect().top;
      if (top < window.innerHeight - 100) {
        card.classList.add('active');
      }
    });
  });
</script>
</body>
</html>
