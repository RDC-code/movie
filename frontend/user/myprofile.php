<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>User Dashboard - Movie Management System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

    .form-control {
      background-color: #2a2a2a;
      color: #fff;
      border: 1px solid #444;
    }

    .form-control::placeholder {
      color: #aaa;
    }

    .section-title {
      font-size: 28px;
      font-weight: bold;
      color: #e50914;
      margin-bottom: 20px;
    }

    .movie-card {
      background-color: #1e1e1e;
      border: none;
      border-radius: 10px;
      transition: transform 0.3s ease;
      position: relative;
    }

    .movie-card:hover {
      transform: scale(1.03);
    }

    .movie-thumbnail {
      border-radius: 10px 10px 0 0;
      width: 100%;
      height: 300px;
      object-fit: cover;
    }

    .play-btn {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      font-size: 50px;
      color: white;
      opacity: 0.8;
      pointer-events: none;
    }

    .card-body {
      padding: 15px;
    }

    .main-content {
      padding: 30px 15px;
    }

    .nav-item .fas {
      margin-right: 6px;
    }

    .notification-badge {
      font-size: 0.6rem;
      padding: 4px 6px;
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
  <form class="d-flex me-3" role="search" onsubmit="event.preventDefault(); searchMovies();">
      <input class="form-control me-2" type="search" placeholder="Search movies..." aria-label="Search">
      <button class="btn btn-outline-warning" type="submit"><i class="fas fa-search"></i></button>
    </form>
    <ul class="navbar-nav align-items-center">
      <li class="nav-item">
        <a class="nav-link" href="user-dashboard.php"><i class="fas fa-film action"></i> Browse</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="myprofile.php"><i class="fas fa-user"></i> My Profile</a>
      </li>
      <li class="nav-item position-relative me-2">
        <a class="nav-link" href="#" id="notificationBell">
          <i class="fas fa-bell"></i>
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger notification-badge" id="notificationCount">
            0
          </span>
        </a>
      </li>
      <li class="nav-item">
        <!-- Updated logout button with href -->
        <a class="nav-link" href="/MovieSite/frontend/index.php" id="logoutBtn"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </li>
    </ul>
  </div>
</nav>

<body>
  <div class="profile-container">
    <div class="profile-header">My Profile</div>
    <ul class="profile-info" id="profileInfo">
      <li><strong>Username:</strong> <span id="profileUsername">Loading...</span></li>
      <li><strong>Email:</strong> <span id="profileEmail">Loading...</span></li>
      <li><strong>Password:</strong> <span>******</span> 
        <button class="btn btn-sm btn-outline-light ms-2" data-bs-toggle="modal" data-bs-target="#passwordModal">Edit</button>
      </li>
    </ul>
    <canvas id="qrcode"></canvas>
  </div>

  <!-- Password Modal -->
  <div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form id="editPasswordForm" class="modal-content bg-dark text-white">
        <div class="modal-header">
          <h5 class="modal-title" id="passwordModalLabel">Change Password</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="currentPassword" class="form-label">Current Password</label>
            <input type="password" class="form-control" id="currentPassword" required />
          </div>
          <div class="mb-3">
            <label for="newPassword" class="form-label">New Password</label>
            <input type="password" class="form-control" id="newPassword" required />
          </div>
          <div class="mb-3">
            <label for="confirmPassword" class="form-label">Confirm New Password</label>
            <input type="password" class="form-control" id="confirmPassword" required />
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Update Password</button>
        </div>
      </form>
    </div>
  </div>

 <script>
  document.addEventListener("DOMContentLoaded", function () {
    // No token needed anymore
    const headers = {
      "Content-Type": "application/json"
    };

    // Fetch user profile (no bearer token)
    fetch("http://127.0.0.1:8000/api/profile", { headers })
      .then(res => res.json())
      .then(data => {
        document.getElementById("profileUsername").textContent = data.username;
        document.getElementById("profileEmail").textContent = data.email;

        const qrData = `Username: ${data.username}\nEmail: ${data.email}`;
        QRCode.toCanvas(document.getElementById("qrcode"), qrData, function (error) {
          if (error) console.error(error);
        });
      })
      .catch(err => {
        console.error("Error loading profile:", err);
        alert("Failed to load profile.");
      });

    // Handle password update (no bearer token)
    document.getElementById("editPasswordForm").addEventListener("submit", function (e) {
      e.preventDefault();
      const currentPassword = document.getElementById("currentPassword").value;
      const newPassword = document.getElementById("newPassword").value;
      const confirmPassword = document.getElementById("confirmPassword").value;

      fetch("http://127.0.0.1:8000/api/update-password", {
        method: "POST",
        headers,
        body: JSON.stringify({
          current_password: currentPassword,
          new_password: newPassword,
          new_password_confirmation: confirmPassword
        })
      })
      .then(res => {
        if (!res.ok) throw res;
        return res.json();
      })
      .then(data => {
        alert(data.message || "Password updated successfully.");
        document.getElementById("editPasswordForm").reset();
        const modal = bootstrap.Modal.getInstance(document.getElementById("passwordModal"));
        modal.hide();
      })
      .catch(async err => {
        let msg = "Failed to update password.";
        if (err.json) {
          const errorData = await err.json();
          msg = errorData.message || JSON.stringify(errorData.errors);
        }
        alert(msg);
      });
    });
  });
</script>

</body>
</html>
