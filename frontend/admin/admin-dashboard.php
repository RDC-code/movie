<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin Dashboard - Movie Management System</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- FontAwesome Icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />

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

    /* Sidebar styles */
    .sidebar {
      background-color: #1f1f1f;
      min-height: 100vh;
      position: fixed;
      top: 56px; /* height of navbar */
      left: 0;
      width: 250px;
      padding-top: 20px;
      transition: transform 0.3s ease-in-out;
      z-index: 1040;
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

    /* Main content with sidebar space */
    .main-content {
      margin-left: 250px;
      padding: 20px;
      transition: margin-left 0.3s ease-in-out;
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

    /* Responsive adjustments */
    @media (max-width: 991.98px) { /* md breakpoint and below */
      .sidebar {
        position: fixed;
        top: 56px;
        left: 0;
        width: 250px;
        height: calc(100vh - 56px);
        transform: translateX(-100%);
        box-shadow: 2px 0 5px rgba(0,0,0,0.5);
      }
      .sidebar.show {
        transform: translateX(0);
      }
      .main-content {
        margin-left: 0;
        padding: 20px;
      }
      /* Overlay behind sidebar */
      #sidebarOverlay {
        display: none;
        position: fixed;
        top: 56px;
        left: 0;
        width: 100vw;
        height: calc(100vh - 56px);
        background: rgba(0, 0, 0, 0.5);
        z-index: 1039;
      }
      #sidebarOverlay.show {
        display: block;
      }
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container-fluid">
    <!-- Sidebar toggle button for small screens -->
    <button class="btn btn-outline-light d-lg-none me-3" id="sidebarToggle">
      <i class="fas fa-bars"></i>
    </button>
    <a class="navbar-brand" href="#">Movie Management System</a>
    <div class="collapse navbar-collapse justify-content-end">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="/MovieSite/frontend/index.php" id="logoutBtn">
            <i class="fas fa-sign-out-alt"></i> Logout
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Sidebar Overlay for mobile -->
<div id="sidebarOverlay"></div>

<!-- Sidebar + Main Content -->
<div class="container-fluid">
  <div class="row">
    <!-- Sidebar -->
    <nav class="col-md-3 sidebar" id="sidebar">
      <div class="d-flex flex-column p-3">
        <h4 class="text-center text-white mb-4">Admin Menu</h4>
        <div class="list-group">
          <a href="admin-dashboard.php" class="list-group-item list-group-item-action active">
            <i class="fas fa-tachometer-alt me-2"></i> Dashboard
          </a>
          <a href="admin-users.php" class="list-group-item list-group-item-action">
            <i class="fas fa-users me-2"></i> Manage Users
          </a>
          <a href="admin-movies.php" class="list-group-item list-group-item-action">
            <i class="fas fa-film me-2"></i> Manage Movies
          </a>
          <a href="admin-reviews.php" class="list-group-item list-group-item-action">
            <i class="fas fa-comments me-2"></i> Movie Reviews
          </a>
          <a href="admin-reports.php" class="list-group-item list-group-item-action">
            <i class="fas fa-chart-bar me-2"></i> Reports
          </a>
        </div>
      </div>
    </nav>

    <!-- Main Content -->
    <main class="col-md-9 main-content">
      <h2>Welcome, Admin</h2>

      <!-- Stats Cards -->
      <div class="row mt-4">
        <div class="col-md-6 mb-3">
          <div class="card bg-dark text-white text-center">
            <div class="card-body">
              <h5 class="card-title"><i class="fas fa-film me-2"></i> Total Movies</h5>
              <p class="card-text fs-2" id="totalMovies">Loading...</p>
            </div>
          </div>
        </div>
        <div class="col-md-6 mb-3">
          <div class="card bg-dark text-white text-center">
            <div class="card-body">
              <h5 class="card-title"><i class="fas fa-users me-2"></i> Total Users</h5>
              <p class="card-text fs-2" id="totalUsers">Loading...</p>
            </div>
          </div>
        </div>
      </div>
    </main> <!-- End Main Content -->
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
  // Sidebar toggle for mobile
  const sidebar = document.getElementById('sidebar');
  const sidebarToggle = document.getElementById('sidebarToggle');
  const sidebarOverlay = document.getElementById('sidebarOverlay');

  sidebarToggle.addEventListener('click', () => {
    sidebar.classList.toggle('show');
    sidebarOverlay.classList.toggle('show');
  });

  sidebarOverlay.addEventListener('click', () => {
    sidebar.classList.remove('show');
    sidebarOverlay.classList.remove('show');
  });

  // Fetch stats data
  fetch("http://127.0.0.1:8000/api/public-dashboard")
    .then(response => {
      if (!response.ok) {
        throw new Error("Network response was not ok");
      }
      return response.json();
    })
    .then(data => {
      document.getElementById("totalMovies").textContent = data.total_movies ?? 0;
      document.getElementById("totalUsers").textContent = data.total_users ?? 0;
    })
    .catch(error => {
      console.error("Fetch error:", error);
      document.getElementById("totalMovies").textContent = "Error";
      document.getElementById("totalUsers").textContent = "Error";
    });
</script>

</body>
</html>
