<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Movie Reviews</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="admin-style.css">
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
