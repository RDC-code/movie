<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>My Profile - Movie Management System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/qrcode@1.5.0/build/qrcode.min.js"></script>
  
  <style>
    body {
      background-color: #121212;
      color: #fff;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .navbar {
      background-color: #1c1c1c;
    }

    .navbar-brand {
      color: #ffcc00 !important;
      font-weight: bold;
    }

    .navbar-nav .nav-link {
      color: #ccc !important;
    }

    .navbar-nav .nav-link:hover {
      color: #fff !important;
    }

    .profile-container {
      padding: 50px 0;
    }

    .profile-card {
      background-color: #1e1e1e;
      border-radius: 12px;
      padding: 20px;
      box-shadow: 0 4px 10px rgba(255, 255, 255, 0.1);
    }

    .profile-header {
      font-size: 24px;
      font-weight: bold;
      color: #ffcc00;
      text-align: center;
      margin-bottom: 20px;
    }

    .profile-info {
      list-style: none;
      padding: 0;
      font-size: 18px;
    }

    .profile-info li {
      padding: 10px;
      border-bottom: 1px solid #333;
    }

    .profile-info li:last-child {
      border-bottom: none;
    }

    .profile-info strong {
      color: #f8f9fa;
    }

    .edit-profile-btn {
      display: block;
      width: 100%;
      text-align: center;
      margin-top: 15px;
      background-color: #ffcc00;
      color: #121212;
      font-size: 16px;
      font-weight: bold;
      padding: 10px;
      border-radius: 8px;
      text-decoration: none;
      transition: 0.3s ease;
    }

    .edit-profile-btn:hover {
      background-color: #e50914;
      color: #fff;
    }

    .qr-section {
      text-align: center;
      margin-top: 30px;
    }

    .qr-section canvas {
      margin-top: 10px;
    }

    .modal-content {
      background-color: #1e1e1e;
      color: #fff;
      border-radius: 10px;
    }

    .modal-header {
      border-bottom: 1px solid #444;
    }

    .form-control {
      background-color: #2a2a2a;
      color: #fff;
      border: 1px solid #444;
    }

    .btn-save {
      background-color: #ffcc00;
      border: none;
      font-weight: bold;
      transition: 0.3s;
    }

    .btn-save:hover {
      background-color: #e50914;
      color: #fff;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark px-3">
  <a class="navbar-brand" href="#">Movie Management System</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMovie">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-end" id="navbarMovie">
    <ul class="navbar-nav align-items-center">
      <li class="nav-item"><a class="nav-link" href="user-dashboard.php"><i class="fas fa-film"></i> Browse</a></li>
      <li class="nav-item"><a class="nav-link" href="myprofile.php"><i class="fas fa-user"></i> My Profile</a></li>
      <li class="nav-item position-relative me-2">
        <a class="nav-link" href="#" id="notificationBell">
          <i class="fas fa-bell"></i>
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger notification-badge" id="notificationCount">
            0
          </span>
        </a>
      </li>
      <li class="nav-item"><a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
    </ul>
  </div>
</nav>

<!-- Profile Section -->
<div class="container profile-container">
  <div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
      <div class="profile-card">
        <div class="profile-header">My Profile</div>
        <ul class="profile-info">
          <li><strong>Username:</strong> <span>Ronilo Calape</span></li>
          <li><strong>Email:</strong> <span>Calape55@gmail.com</span></li>
          <li><strong>Password:</strong> <span>******</span>
          </li>
        </ul>
        <a href="#" class="edit-profile-btn" data-bs-toggle="modal" data-bs-target="#passwordModal">Edit Profile</a>
      </div>
    </div>
  </div>

  <!-- QR Code Section -->
  <div class="qr-section">
    <h4>Scan the QR Code to View Full Details</h4>
    <canvas id="qrcode"></canvas>
  </div>
</div>

<!-- Password Modal -->
<div class="modal fade" id="passwordModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Password</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="editPasswordForm">
          <div class="mb-3">
            <label for="currentPassword" class="form-label">Current Password</label>
            <input type="password" class="form-control" id="currentPassword" placeholder="Enter current password">
          </div>
          <div class="mb-3">
            <label for="newPassword" class="form-label">New Password</label>
            <input type="password" class="form-control" id="newPassword" placeholder="Enter new password">
          </div>
          <div class="mb-3">
            <label for="confirmPassword" class="form-label">Confirm New Password</label>
            <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm new password">
          </div>
          <button type="submit" class="btn btn-save w-100">Save Changes</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    var fullDetailsURL = window.location.href;  
    QRCode.toCanvas(document.getElementById("qrcode"), fullDetailsURL, function (error) {
      if (error) console.error(error);
    });
  });
</script>

</body>
</html>
