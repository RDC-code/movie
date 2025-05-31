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
      background-color:rgb(0, 195, 255);
      color: #fff;
    }

    .change-password-btn {
      display: block;
      width: 100%;
      text-align: center;
      margin-top: 15px;
      background-color: #e50914;
      color: #fff;
      font-size: 16px;
      font-weight: bold;
      padding: 10px;
      border-radius: 8px;
      text-decoration: none;
      transition: 0.3s ease;
    }

    .change-password-btn:hover {
       background-color:rgb(0, 195, 255);
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
      <li class="nav-item"><a class="nav-link" href="../index.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
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
          <li><strong>Username:</strong> <span id="name"></span></li>
          <li><strong>Email:</strong> <span id="email"></span></li>
        </ul>

        <a href="#" class="edit-profile-btn" data-bs-toggle="modal" data-bs-target="#editProfileModal">Edit Profile</a>
        <a href="#" class="change-password-btn" data-bs-toggle="modal" data-bs-target="#changePasswordModal">Change Password</a>
      </div>
    </div>
  </div>
</div>

<!-- QR Code Section -->
<div class="qr-section">
  <h4>Scan the QR Code to View Full Details</h4>
  <canvas id="qrcode"></canvas>
</div>

<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Profile</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="editProfileForm">
          <div class="mb-3">
            <label for="editName" class="form-label">Name</label>
            <input type="text" class="form-control" id="editName" required>
          </div>
          <div class="mb-3">
            <label for="editEmail" class="form-label">Email</label>
            <input type="email" class="form-control" id="editEmail" required>
          </div>
          <button type="submit" class="btn btn-primary w-100">Save Changes</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Change Password Modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="changePasswordForm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="current_password" class="form-label">Current Password</label>
            <input type="password" class="form-control" id="current_password" name="current_password" required>
          </div>
          <div class="mb-3">
            <label for="new_password" class="form-label">New Password</label>
            <input type="password" class="form-control" id="new_password" name="new_password" required>
          </div>
          <div class="mb-3">
            <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
            <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
          </div>
          <div id="password-error" class="text-danger"></div>
          <div id="password-success" class="text-success"></div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Update Password</button>
        </div>
      </div>
    </form>
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

  // Load profile
  document.addEventListener("DOMContentLoaded", function () {
    fetch("http://127.0.0.1:8000/api/userprofile", {
      method: "GET",
      headers: {
        "Authorization": `Bearer ${localStorage.getItem("auth_token")}`,
        "Accept": "application/json"
      }
    })
    .then(response => {
      if (!response.ok) {
        throw new Error("Failed to fetch user profile.");
      }
      return response.json();
    })
    .then(data => {
      document.getElementById("name").textContent = data.name || "No name";
      document.getElementById("email").textContent = data.email || "No email";
      document.getElementById("editName").value = data.name;
      document.getElementById("editEmail").value = data.email;
      localStorage.setItem("user_id", data.id); 
    })
    .catch(error => {
      console.error("Error:", error);
      document.querySelector(".profile-info").innerHTML = "<li class='text-danger'>Failed to load profile information.</li>";
    });
  });

  // Update profile
  document.getElementById('editProfileForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const name = document.getElementById('editName').value;
    const email = document.getElementById('editEmail').value;
    const token = localStorage.getItem('auth_token');

    fetch("http://127.0.0.1:8000/api/updateprofile", {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'Authorization': `Bearer ${token}`
      },
      body: JSON.stringify({ name, email })
    })
    .then(response => {
      return response.json().then(data => ({
        ok: response.ok,
        body: data
      }));
    })
    .then(result => {
      if (result.ok) {
        alert("Profile updated successfully.");
        location.reload();
      } else {
        alert("Update failed: " + result.body.message);
      }
    })
    .catch(error => {
      console.error("Update error:", error);
      alert("An error occurred while updating profile.");
    });
  });

  // Change password
  document.getElementById('changePasswordForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const currentPassword = document.getElementById('current_password').value;
    const newPassword = document.getElementById('new_password').value;
    const newPasswordConfirm = document.getElementById('new_password_confirmation').value;

    const errorDiv = document.getElementById('password-error');
    const successDiv = document.getElementById('password-success');

    errorDiv.innerText = '';
    successDiv.innerText = '';

    fetch('http://127.0.0.1:8000/api/updatepassword', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'Authorization': 'Bearer ' + localStorage.getItem("auth_token")
      },
      body: JSON.stringify({
        current_password: currentPassword,
        new_password: newPassword,
        new_password_confirmation: newPasswordConfirm
      })
    })
    .then(function(response) {
      return response.json().then(function(data) {
        if (response.ok) {
          successDiv.innerText = data.message;
          document.getElementById('changePasswordForm').reset();
        } else {
          errorDiv.innerText = data.message || 'Something went wrong.';
        }
      });
    })
    .catch(function(error) {
      console.error('Error:', error);
      errorDiv.innerText = 'Something went wrong. Please try again.';
    });
  });
</script>

</body>
</html>
