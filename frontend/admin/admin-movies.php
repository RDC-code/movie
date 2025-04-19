<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Manage Movies</title>
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

<!-- Page Content -->
<div class="container-fluid mt-4">
  <div class="row">
    <!-- Sidebar -->
    <div class="col-md-3 sidebar">
      <div class="list-group">
        <a href="admin-dashboard.php" class="list-group-item list-group-item-action">Dashboard</a>
        <a href="admin-movies.php" class="list-group-item list-group-item-action active">Manage Movies</a>
        <a href="admin-users.php" class="list-group-item list-group-item-action">Manage Users</a>
        <a href="admin-reviews.php" class="list-group-item list-group-item-action">Movie Reviews</a>
      </div>
    </div>

    <!-- Main Content -->
    <div class="col-md-9 main-content">
        <div id="movieSection" class="dashboard-section" style="display: block;">
        <h4 class="section-title">Manage Movies</h4>
        <div class="btn-group mb-3">
          <a href="#" class="btn btn-success">Add Movie</a>
        </div>
        <table class="table table-hover table-bordered">
          <thead class="table-dark">
            <tr>
              <th>Thumbnail</th>
              <th>Title</th>
              <th>Director</th>
              <th>Release Year</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><img src="https://via.placeholder.com/60x90?text=Matrix" class="movie-thumbnail" alt="Matrix"></td>
              <td>The Matrix</td>
              <td>Wachowski</td>
              <td>1999</td>
              <td>
                <button class="btn btn-warning btn-sm">Edit</button>
                <button class="btn btn-danger btn-sm">Delete</button>
              </td>
            </tr>
            <tr>
              <td><img src="https://via.placeholder.com/60x90?text=Inception" class="movie-thumbnail" alt="Inception"></td>
              <td>Inception</td>
              <td>Christopher Nolan</td>
              <td>2010</td>
              <td>
                <button class="btn btn-warning btn-sm">Edit</button>
                <button class="btn btn-danger btn-sm">Delete</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
