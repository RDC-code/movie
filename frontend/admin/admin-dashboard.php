<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Dashboard - Movie Management System</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- FontAwesome Icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

  <style>
    body {
      background-color: #121212;
      color: #ffffff;
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }
    .navbar {
      background-color: #1f1f1f;
    }
    .navbar-brand {
      font-weight: bold;
      color: #ffffff;
    }
    .sidebar {
      background-color: #1f1f1f;
      min-height: 100vh;
      padding-top: 20px;
      position: fixed;
      top: 0;
      left: 0;
      width: 250px;
      transition: all 0.3s;
    }
    .sidebar h4 {
      text-align: center;
      color: #fff;
      margin-bottom: 30px;
    }
    .list-group-item {
      background-color: transparent;
      color: #ccc;
      border: none;
    }
    .list-group-item.active,
    .list-group-item:hover {
      background-color: #333333;
      color: #ffffff;
    }
    .main-content {
      margin-left: 250px;
      background-color: #121212;
      min-height: 100vh;
      padding: 20px;
      flex: 1;
    }
    .content {
      padding: 20px;
    }
    .card {
      border: none;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0,0,0,0.5);
    }
    h2 {
      font-weight: bold;
    }
    .row .card {
      margin-bottom: 20px;
    }
    @media (max-width: 767px) {
      .sidebar {
        position: static;
        width: 100%;
        min-height: auto;
        padding-top: 10px;
      }
      .main-content {
        margin-left: 0;
        padding: 10px;
      }
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container-fluid">

    <div class="collapse navbar-collapse justify-content-between">
      <ul class="navbar-nav">
        <!-- Additional links can go here -->
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="javascript:void(0);" id="logoutBtn"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Dashboard Layout -->
<div class="container-fluid">
  <div class="row">
    
    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column p-3">
      <h4 class="text-white">Admin Menu</h4>
      <div class="list-group">
        <a href="#" class="list-group-item list-group-item-action active"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a>
        <a href="admin-movies.php" class="list-group-item list-group-item-action"><i class="fas fa-film me-2"></i> Manage Movies</a>
        <a href="admin-users.php" class="list-group-item list-group-item-action"><i class="fas fa-users me-2"></i> Manage Users</a>
        <a href="admin-reviews.php" class="list-group-item list-group-item-action"><i class="fas fa-comments me-2"></i> Movie Reviews</a>
      </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
      <h2>Welcome, Admin</h2>
      

      <!-- Stats Cards -->
      <div class="row mt-4">
        <div class="col-md-4 mb-3">
          <div class="card bg-dark text-white text-center">
            <div class="card-body">
              <h5 class="card-title"><i class="fas fa-film me-2"></i> Total Movies</h5>
              <p class="card-text fs-2">42</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-3">
          <div class="card bg-dark text-white text-center">
            <div class="card-body">
              <h5 class="card-title"><i class="fas fa-user-friends me-2"></i> Registered Users</h5>
              <p class="card-text fs-2">108</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-3">
          <div class="card bg-dark text-white text-center">
            <div class="card-body">
              <h5 class="card-title"><i class="fas fa-hourglass-half me-2"></i> Pending Reviews</h5>
              <p class="card-text fs-2">7</p>
            </div>
          </div>
        </div>
      </div>
    </div> <!-- End Main Content -->

  </div>
</div>

<!-- Bootstrap Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
  document.getElementById("logoutBtn").addEventListener("click", function () {
    window.location.href = "index.php"; // Replace with your real logout logic
  });
</script>

</body>
</html>
