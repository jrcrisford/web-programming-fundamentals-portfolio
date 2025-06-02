<nav>
  <ul>
    <li><a href="../static_site/index.html">Home</a></li>
    <li><a href="../static_site/registration.html">Register</a></li>
    <li><a href="../static_site/testimonials.html">Testimonials</a></li>
    <li><a href="participants.php">Participants</a></li>
    <?php if (session_status() !== PHP_SESSION_ACTIVE) session_start(); ?>
    <li>
      <?php if (isset($_SESSION['user'])): ?>
        <a href="logout.php">Logout (<?php echo htmlspecialchars($_SESSION["user"]); ?>)</a>
      <?php else: ?>
        <a href="login.php">Login</a>
      <?php endif; ?>
    </li>
  </ul>
</nav>