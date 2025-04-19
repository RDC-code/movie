<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Manage Users</title>
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
        <a href="admin-users.php" class="list-group-item list-group-item-action active">Manage Users</a>
        <a href="admin-reviews.php" class="list-group-item list-group-item-action">Movie Reviews</a>
      </div>
    </div>

    <!-- Main Content -->
    <div class="col-md-9 main-content">
      <h4 class="section-title">Manage Users</h4>
      <div class="btn-group mb-3">
        <a href="#" class="btn btn-success">Add User</a>
      </div>
      <table class="table table-hover table-bordered">
        <thead class="table-dark">
          <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>admin</td>
            <td>admin@example.com</td>
            <td><span class="badge bg-danger">Admin</span></td>
            <td><span class="badge bg-success">Active</span></td>
            <td>
              <button class="btn btn-warning btn-sm">Edit</button>
              <button class="btn btn-danger btn-sm">Delete</button>
              <button class="btn btn-secondary btn-sm">Deactivate</button>
            </td>
          </tr>
          <tr>
            <td>manager</td>
            <td>manager@example.com</td>
            <td><span class="badge bg-warning text-dark">Manager</span></td>
            <td><span class="badge bg-danger">Inactive</span></td>
            <td>
              <button class="btn btn-warning btn-sm">Edit</button>
              <button class="btn btn-danger btn-sm">Delete</button>
              <button class="btn btn-success btn-sm">Activate</button>
            </td>
          </tr>
          <tr>
            <td>user</td>
            <td>user@example.com</td>
            <td><span class="badge bg-secondary">User</span></td>
            <td><span class="badge bg-success">Active</span></td>
            <td>
              <button class="btn btn-warning btn-sm">Edit</button>
              <button class="btn btn-danger btn-sm">Delete</button>
              <button class="btn btn-secondary btn-sm">Deactivate</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
