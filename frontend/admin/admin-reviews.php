<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Movie Reviews</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #121212;
      color: #ffffff;
      margin: 0;
      padding: 0;
    }
    .navbar {
      background-color: #1f1f1f;
    }
    .navbar-brand {
      font-weight: bold;
      color: #ffffff;
    }
    .navbar-nav .nav-link {
      color: #ffffff;
    }
    .navbar-nav .nav-link:hover {
      color: #d1d1d1;
    }
    .sidebar {
      background-color: #1f1f1f;
      padding-top: 20px;
      min-height: 100vh;
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
      background-color: #121212;
      min-height: 100vh;
      padding: 20px;
    }
    .section-title {
      color: #ffffff;
      font-size: 1.5rem;
      font-weight: bold;
    }
    .card {
      background-color: #1e1e1e;
      border: none;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }
    .card-title {
      color: #fff;
      font-size: 1.2rem;
    }
    .card-text {
      color: #ccc;
    }
    .btn-danger {
      background-color: #e74c3c;
      border: none;
    }
    .btn-danger:hover {
      background-color: #c0392b;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">RDC's Movie Site</a>
    <ul class="navbar-nav ms-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
      </li>
    </ul>
  </div>
</nav>

<!-- Dashboard Content -->
<div class="container-fluid mt-4">
  <div class="row">
    <!-- Sidebar -->
    <div class="col-md-3 sidebar">
      <div class="list-group">
        <a href="admin-dashboard.php" class="list-group-item list-group-item-action">Dashboard</a>
        <a href="admin-movies.php" class="list-group-item list-group-item-action">Manage Movies</a>
        <a href="admin-users.php" class="list-group-item list-group-item-action">Manage Users</a>
        <a href="admin-reviews.php" class="list-group-item list-group-item-action active">Movie Reviews</a>
      </div>
    </div>

    <!-- Main Content -->
    <div class="col-md-9 main-content">
      <h4 class="section-title">Movie Reviews</h4>

      <!-- Review Card 1 -->
      <div class="card mb-3">
        <div class="card-body">
          <h5 class="card-title">The Matrix</h5>
          <p class="card-text">"An absolute sci-fi masterpiece. Mind-bending action and philosophy!"</p>
          <small class="text-muted">— user123</small>
          <div class="d-flex justify-content-end mt-2">
            <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Delete</button>
          </div>
        </div>
      </div>

      <!-- Review Card 2 -->
      <div class="card mb-3">
        <div class="card-body">
          <h5 class="card-title">Inception</h5>
          <p class="card-text">"A thrilling dive into dreams within dreams. Nolan nailed it!"</p>
          <small class="text-muted">— movieFan88</small>
          <div class="d-flex justify-content-end mt-2">
            <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Delete</button>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
