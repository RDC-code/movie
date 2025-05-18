<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin - Movie Reviews</title>

  <!-- Bootstrap + FontAwesome -->
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
      padding: 1rem;
      z-index: 1050;
      position: sticky;
      top: 0;
    }
    .navbar-brand {
      font-weight: bold;
      color: #ffffff;
    }
    .navbar-nav .nav-link {
      color: #ffffff;
      margin-left: 15px;
    }
    .navbar-nav .nav-link:hover {
      color: #0d6efd;
    }
    .sidebar {
      background-color: #1f1f1f;
      min-height: 100vh;
      position: fixed;
      top: 56px;
      left: 0;
      width: 250px;
      padding-top: 20px;
    }
    .sidebar .list-group-item {
      background-color: transparent;
      color: #ccc;
      border: none;
    }
    .sidebar .list-group-item.active,
    .sidebar .list-group-item:hover {
      background-color: #333333;
      color: #ffffff;
    }
    .main-content {
      margin-left: 250px;
      padding: 20px;
    }
    h2 {
      font-weight: bold;
    }
    .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
    }
    .btn-primary:hover {
      background-color: #0056b3;
      border-color: #004085;
    }
    .modal-content {
      background-color: #1f1f1f;
      color: #ffffff;
    }
    .modal-header {
      border-bottom: 1px solid #444;
    }
    .table-dark {
      background-color: #2d2d2d;
    }
    .table-dark td,
    .table-dark th {
      border: 1px solid #444;
    }
    .card {
      border: none;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }
    .content {
      padding: 20px;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Movie Management System</a>
    <div class="collapse navbar-collapse justify-content-end">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="/MovieSite/frontend/index.php" id="logoutBtn"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Sidebar + Main Content -->
<div class="container-fluid">
  <div class="row">
    <!-- Sidebar -->
    <div class="col-md-3 sidebar">
      <div class="d-flex flex-column p-3">
        <h4 class="text-center text-white mb-4">Admin Menu</h4>
        <div class="list-group">
          <a href="admin-dashboard.php" class="list-group-item list-group-item-action">
            <i class="fas fa-tachometer-alt me-2"></i> Dashboard
          </a>
          <a href="admin-users.php" class="list-group-item list-group-item-action">
            <i class="fas fa-users me-2"></i> Manage Users</a>
          <a href="admin-movies.php" class="list-group-item list-group-item-action">
            <i class="fas fa-film me-2"></i> Manage Movies
          </a>
          <a href="admin-reviews.php" class="list-group-item list-group-item-action active">
            <i class="fas fa-comments me-2"></i> Movie Reviews
          </a>
          <a href="admin-reports.php" class="list-group-item list-group-item-action">
            <i class="fas fa-chart-bar me-2"></i> Reports
          </a>
        </div>
      </div>
    </div>

    <!-- Main Content -->
    <div class="col-md-9 main-content">
      <h2 class="mb-4">Movie Reviews</h2>

      <div id="reviewList"></div>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Script to Fetch and Delete Reviews -->
<script>
  document.addEventListener("DOMContentLoaded", () => {
    fetch('/api/reviews')
      .then(res => res.json())
      .then(data => {
        const container = document.getElementById("reviewList");
        container.innerHTML = '';
        data.forEach(review => {
          const stars = '<i class="fas fa-star"></i>'.repeat(Math.floor(review.rating)) +
                        (review.rating % 1 ? '<i class="fas fa-star-half-alt"></i>' : '');
          const card = `
            <div class="card mb-3">
              <div class="card-body">
                <h5 class="card-title">${review.movie_title}</h5>
                <div class="text-warning mb-2">${stars}</div>
                <small class="text-muted">— ${review.username}</small>
                <div class="d-flex justify-content-end mt-2">
                  <button class="btn btn-danger btn-sm delete-review" data-id="${review.id}">
                    <i class="fas fa-trash-alt"></i> Delete
                  </button>
                </div>
              </div>
            </div>`;
          container.insertAdjacentHTML('beforeend', card);
        });

        document.querySelectorAll('.delete-review').forEach(btn => {
          btn.addEventListener('click', function () {
            const id = this.dataset.id;
            if (confirm("Are you sure you want to delete this review?")) {
              fetch(`/api/reviews/${id}`, {
                method: 'DELETE',
                headers: {
                  'Content-Type': 'application/json',
                  'Authorization': `Bearer ${localStorage.getItem('token')}`
                }
              })
              .then(res => res.json())
              .then(() => location.reload())
              .catch(err => alert("Failed to delete review."));
            }
          });
        });
      });
  });
</script>

</body>
</html>
