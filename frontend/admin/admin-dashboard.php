<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Dashboard - Movie Management System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="admin-style.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">RDC's Movie Site</a>
    <div class="collapse navbar-collapse justify-content-end">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="#" id="logoutBtn"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Dashboard Content -->
<div class="container-fluid mt-4">
  <div class="row">
    <!-- Sidebar -->
    <div class="col-md-3 mb-3 sidebar">
      <div class="list-group">
        <a href="#" class="list-group-item list-group-item-action active">Dashboard</a>
        <a href="admin-movies.php" class="list-group-item list-group-item-action">Manage Movies</a>
        <a href="admin-users.php" class="list-group-item list-group-item-action">Manage Users</a>
        <a href="admin_reviews.html" class="list-group-item list-group-item-action">Movie Reviews</a>
      </div>
    </div>

    <!-- Main Content -->
    <div class="col-md-9 main-content">
      <h2>Welcome, Admin</h2>
      <p>This is your dashboard. Use the sidebar to navigate through different sections like Movies, Users, and Reviews.</p>

      <div class="row mt-4">
        <div class="col-md-4 mb-3">
          <div class="card bg-dark text-white">
            <div class="card-body">
              <h5 class="card-title">Total Movies</h5>
              <p class="card-text fs-4">42</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-3">
          <div class="card bg-dark text-white">
            <div class="card-body">
              <h5 class="card-title">Registered Users</h5>
              <p class="card-text fs-4">108</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-3">
          <div class="card bg-dark text-white">
            <div class="card-body">
              <h5 class="card-title">Pending Reviews</h5>
              <p class="card-text fs-4">7</p>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<script>
  document.getElementById("logoutBtn").addEventListener("click", function () {
    window.location.href = "index.php"; // Replace with logout logic
  });
</script>

</body>
</html>
