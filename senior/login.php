<?php
session_start();
include 'connect.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// If already logged in, redirect to dashboard
if (isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get username and password from form
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Prepare the SQL statement
    $query = "SELECT * FROM admin WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();

    // Check if user exists and verify password (WITHOUT HASHING)
    if ($admin && $password === $admin['password']) { 
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['username'] = $admin['username']; // Store username in session

        header("Location: index.php"); // Redirect to Dashboard
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}

$sql = "SELECT * FROM announcement ORDER BY pic DESC";
$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: #f8f9fa;
    }

    .login-container {
      display: flex;
      height: 100vh;
    }

    .left-panel {
      flex: 1;
      background: url('images/WELCOME TO OSCA.png') no-repeat center center;
      background-size: cover;
    }

    .right-panel {
      flex: 1;
      background: 	#f6f6f6;
      display: flex;
      justify-content: center;
      align-items: center;
      box-shadow: -5px 0 20px rgba(0,0,0,0.1);
    }

    .form-box {
      width: 100%;
      max-width: 400px;
      padding: 20px;
      background: #ffffff;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .form-control {
      border-radius: 8px;
    }

    .btn-primary {
      background-color: #7e5bef;
      border: none;
      border-radius: 8px;
    }

    .btn-primary:hover {
      background-color: #6c47d3;
    }

    .text-muted a {
      color: #7e5bef;
      text-decoration: none;
    }

    .icon-circle {
    background-color: #7e5bef;
    color: white;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
    margin: 0 auto 10px auto;
    transition: transform 0.3s, box-shadow 0.3s;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  }

  .icon-circle:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
    background-color: #684ce6;
  }

  .fw-bold {
    font-weight: 700 !important;
  }

  .icon-label {
    font-size: 14px;
    color: #000;
  }

  .announcement-section {
  background-color: #fff;
  text-align: center;
  padding: 50px 20px;
}

.announcement-section h4 {
  font-weight: 700;
  margin-bottom: 15px;
}

.announcement-section p {
  color: #333;
  max-width: 800px;
  margin: 0 auto 30px auto;
  line-height: 1.6;
}

.announcement-slideshow {
  position: relative;
  width: 800px;
  height: 500px;
  margin: 0 auto;
  overflow: hidden;
 
}

.slide {
  position: absolute;
  width: 100%;
  height: 100%;
  opacity: 0;
  transition: opacity 1s ease-in-out;
}

.slide.active {
  opacity: 1;
  z-index: 1;
}

.slide img {
  width: 100%;
  height: 100%;
  object-fit: cover;
 
}

.announcement-caption {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  padding: 12px 20px;
  background: linear-gradient(to top, rgba(0, 0, 0, 0.7), transparent);
  color: #fff;
  font-weight: 600;
  font-size: 14px;
  text-align: left;
  
}


.announcement-image-wrapper {
  position: relative;
  display: inline-block;
  width: 900px;       /* Match the image width */
  height: 600px;      /* Match the image height */
  overflow: hidden;
  max-width: 100%;    /* Keeps it responsive on smaller screens */
}


.announcement-image-wrapper img {
  width: 900px;       /* Set a fixed width */
  height: 600px;      /* Set a fixed height */
  object-fit: cover;  /* Ensures the image fills the box nicely */

}


.announcement-caption {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  padding: 12px 20px;
  background: linear-gradient(to top, rgba(126, 91, 239, 0.9), transparent);
  color: #fff;
  font-weight: 600;
  font-size: 14px;
  text-align: left;

}

.why-contact-wrapper {
  width: 100%;
  text-align: center;
  font-family: 'Montserrat', sans-serif;
}

/* Why This Matters Styles */
.why-matters {
  background-color: #fff;
  padding: 50px 20px;
}

.why-matters h4 {
  font-weight: 700;
  margin-bottom: 30px;
}

.why-card {
  background-color: #735ff2;
  color: white;
  border-radius: 8px;
  padding: 15px 20px;
  margin-bottom: 15px;
  max-width: 700px;
  margin-left: auto;
  margin-right: auto;
  display: flex;
  justify-content: space-between;
  align-items: center;
  text-align: left;
  transition: transform 0.2s;
}

.why-card:hover {
  transform: scale(1.02);
}

.why-card i {
  font-size: 18px;
}


.contact-section {
  background-color: #735ff2;
  color: white;
  padding: 40px 20px;
}

.contact-section h5 {
  font-weight: 700;
  margin-bottom: 10px;
}

.contact-section p {
  max-width: 600px;
  margin: 0 auto 30px auto;
}

.contact-details {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 12px;
  font-size: 15px;
}

.contact-details i {
  margin-right: 8px;
}

.navbar {
  border-bottom: 1px solid #eee;
  transition: all 0.3s ease-in-out;
}

.nav-link {
  color: #333;
  margin-right: 15px;
  transition: color 0.3s;
}

.nav-link:hover, .nav-link.active {
  color: #7e5bef;
}

.navbar-brand i {
  margin-right: 6px;
}

html {
  scroll-behavior: smooth;
}

.container {
  max-width: 90%; /* or 100% or any width you prefer */
}

.contact-cards {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 30px;
}

.contact-card {
  background: white;
  color: #333;
  padding: 30px;
  border-radius: 10px;
  text-align: center;
  flex: 1 1 300px;
  max-width: 300px;
  box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.contact-card i {
  font-size: 30px;
  color:  #735ff2;
  margin-bottom: 15px;
}

.contact-card h4 {
  font-size: 18px;
  font-weight: bold;
  margin-bottom: 10px;
}

.contact-card p {
  font-size: 14px;
  color: #666;
  margin-bottom: 8px;
}

.contact-card span {
  color:  #735ff2;
  font-weight: bold;
}

  </style>
</head>
<body>

<!-- Modern Navbar with Logo and Section Links -->
<nav class="navbar navbar-expand-lg shadow-sm bg-white sticky-top py-3">
  <div class="container">
    <!-- Logo Image -->
    <a class="navbar-brand fw-bold d-flex align-items-center" href="#">
      <img src="images/logo.png" width="50" height="50" class="me-2">
      <span style="color: #7e5bef; font-size: 15px;">OSCA System</span>
    </a>


    <!-- Toggle Button for Mobile -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar Links -->
    <div class="collapse navbar-collapse" id="navbarContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 fw-semibold">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#login">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#whatwedo">What We Do</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#announcement">Announcement</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#contact">Contact</a>
        </li>
      </ul>
      <a href="#login" class="btn btn-primary ms-3 px-4" style="background-color: #7e5bef; border: none; border-radius: 20px;">Login</a>

    </div>
  </div>
</nav>




<!-- LOGIN SECTION -->
<section id="login" class="login-container">
  <div class="left-panel"></div>

  <div class="right-panel">
    <div class="container d-flex justify-content-center align-items-center">
      <div class="form-box">
        <h4 class="mb-3">Login</h4>
        <p class="text-muted mb-4">Welcome back! Please login to your account.</p>
        <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
        <form method="POST">
          <div class="mb-3">
            <label class="form-label">User Name</label>
            <input type="text" name="username" class="form-control" placeholder="username" required />
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" placeholder="********" required />
          </div>
          <div class="mb-3 d-flex justify-content-between align-items-center">
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="rememberMe">
              <label class="form-check-label" for="rememberMe">Remember Me</label>
            </div>
          </div>
          <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
      </div>
    </div>
  </div>
</section>

<!-- WHAT WE DO SECTION -->
<section id="whatwedo" class="py-5 bg-white text-center">
  <div class="container">
    <h4 class="fw-bold mb-3">What We Do</h4>
    <p class="text-muted mb-5">We are conducting a comprehensive survey focused on</p>
    <div class="row justify-content-center">
      <div class="col-6 col-md-3 mb-4">
        <div class="icon-circle">
          <i class="fas fa-hand-holding-dollar"></i>
        </div>
        <h6 class="icon-label fw-bold">Financial Struggles</h6>
      </div>
      <div class="col-6 col-md-3 mb-4">
        <div class="icon-circle">
          <i class="fas fa-notes-medical"></i>
        </div>
        <h6 class="icon-label fw-bold">Assessing Medical Needs</h6>
      </div>
      <div class="col-6 col-md-3 mb-4">
        <div class="icon-circle">
          <i class="fas fa-heartbeat"></i>
        </div>
        <h6 class="icon-label fw-bold">Real-life Situation</h6>
      </div>
    </div>
  </div>
</section>

<!-- ANNOUNCEMENT SECTION -->
<section id="announcement" class="announcement-section">
  <div class="container">
    <h4>Announcement</h4>
    <p>
      Our team will visit all 42 barangays to hear from our seniors. We invite all senior citizens and families to participate—
      your voice can help shape better support and services. Let’s build a brighter future together!
    </p>

    <div class="announcement-slideshow">
      <?php if ($result->num_rows > 0): ?>
        <?php $first = true; ?>
        <?php while($row = $result->fetch_assoc()): ?>
          <div class="slide <?php echo $first ? 'active' : ''; ?>">
            <img src="<?php echo htmlspecialchars($row['pic']); ?>" alt="Announcement Image">
            <div class="announcement-caption">
              <?php echo htmlspecialchars($row['captions']); ?>
            </div>
          </div>
          <?php $first = false; ?>
        <?php endwhile; ?>
      <?php else: ?>
        <p>No announcements available.</p>
      <?php endif; ?>
    </div>
  </div>

  <!-- WHY + CONTACT -->
  <div class="why-contact-wrapper">
    <div class="why-matters">
      <h4>Why This Matters</h4>
      <div class="why-card">Provide accurate data for local government and organizations to offer better services. <i class="fas fa-chevron-right"></i></div>
      <div class="why-card">Create programs that directly respond to the needs of the elderly. <i class="fas fa-chevron-right"></i></div>
      <div class="why-card">Ensure that no senior is left behind whether they live in the town proper or the farthest... <i class="fas fa-chevron-right"></i></div>
    </div>

    <!-- CONTACT SECTION -->
    <div id="contact" class="contact-section">
      <h5>Contact Us</h5>
      <p>For questions, support, or to participate in the survey:</p>
      <div class="contact-details">
      <div class="contact-cards">
      <div class="contact-card">
        <i class="fas fa-map-marker-alt"></i>
        <h4>VISIT US</h4>
        <p>Visit our office at any time, we would love to hear from you.</p>
        <span>Nasugbu, Batangas</span>
      </div>

      <div class="contact-card">
        <i class="fas fa-phone"></i>
        <h4>CALL US</h4>
        <p>Call or text us from 8AM to 5PM for any concerns or support.</p>
        <span>09087235753</span>
      </div>

      <div class="contact-card">
        <i class="fas fa-envelope"></i>
        <h4>CONTACT US</h4>
        <p>Email us and we’ll get back to you as soon as possible.</p>
        <span>Osca@gmail.com</span>
      </div>
    </div>
      </div>
    </div>
  </div>
</section>

<!-- SLIDESHOW SCRIPT -->
<script>
  let slideIndex = 0;
  const slides = document.querySelectorAll(".slide");

  function showSlides() {
    slides.forEach((slide) => slide.classList.remove("active"));
    slideIndex++;
    if (slideIndex > slides.length) slideIndex = 1;
    slides[slideIndex - 1].classList.add("active");
    setTimeout(showSlides, 5000);
  }

  window.onload = showSlides;
</script>
