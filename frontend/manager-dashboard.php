<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Manager Dashboard - Movie Management System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Arial', sans-serif;
      background-color: #121212;
      color: #fff;
    }

    .navbar {
      background-color: #333;
    }

    .navbar-brand {
      color: rgb(229, 255, 0) !important;
      font-weight: bold;
    }

    .navbar-nav .nav-link {
      color: #ccc !important;
    }

    .navbar-nav .nav-link:hover {
      color: #fff !important;
    }

    .sidebar {
      background-color: #1c1c1c;
      height: 100vh;
      padding-top: 20px;
      position: fixed;
      width: 250px;
    }

    .sidebar .list-group-item {
      background-color: #333;
      color: #ccc;
      border: none;
    }

    .sidebar .list-group-item.active {
      background-color: #e50914;
      color: #fff;
    }

    .sidebar .list-group-item:hover {
      background-color: #444;
      color: #fff;
    }

    .main-content {
      margin-left: 260px;
      padding: 20px;
      background-color: #212121;
    }

    .section-title {
      font-size: 24px;
      font-weight: bold;
      color: #e50914;
      border-bottom: 2px solid #555;
      padding-bottom: 10px;
    }

    .table {
      background-color: #333;
      color: #fff;
    }

    .table th, .table td {
      text-align: center;
    }

    .btn {
      font-size: 14px;
    }

    .btn-warning, .btn-danger, .btn-success {
      font-weight: bold;
    }

    .card-body {
      background-color: #333;
      color: #fff;
    }
  </style>
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
        <a href="#" class="list-group-item list-group-item-action active" id="dashboardLink">Dashboard</a>
        <a href="#" class="list-group-item list-group-item-action" id="movieLink">Manage Movies</a>
        <a href="#" class="list-group-item list-group-item-action" id="reviewLink">Movie Reviews</a>
      </div>
    </div>

    <!-- Main Content -->
    <div class="col-md-9 main-content">
      <h2>Welcome, Admin</h2>
      <p>Manage your movies and reviews</p>

      <!-- Manage Movies Section -->
      <div id="movieSection" class="dashboard-section" style="display: block;">
        <h4 class="section-title">Manage Movies</h4>
        <div class="btn-group mb-3">
          <a href="#" class="btn btn-primary">View Movies</a>
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

      <!-- Movie Reviews Section -->
      <div id="reviewSection" class="dashboard-section" style="display: none;">
        <h4 class="section-title">Movie Reviews</h4>
        <div class="card mb-3">
          <div class="card-body">
            <h5 class="card-title">The Matrix</h5>
            <p class="card-text">"An absolute sci-fi masterpiece. Mind-bending action and philosophy!"</p>
            <small class="text">— user123</small>
            <div class="d-flex justify-content-between mt-2">
              <button class="btn btn-danger btn-sm">Delete</button>
            </div>
          </div>
        </div>
        <div class="card mb-3">
          <div class="card-body">
            <h5 class="card-title">Inception</h5>
            <p class="card-text">"A thrilling dive into dreams within dreams. Nolan nailed it!"</p>
            <small class="text">— movieFan88</small>
            <div class="d-flex justify-content-between mt-2">
              <button class="btn btn-danger btn-sm">Delete</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  const movieSection = document.getElementById("movieSection");
  const reviewSection = document.getElementById("reviewSection");

  const sidebarLinks = document.querySelectorAll(".list-group-item");

  function setActiveLink(activeLink) {
    sidebarLinks.forEach(link => link.classList.remove("active"));
    activeLink.classList.add("active");
  }

  document.getElementById("dashboardLink").addEventListener("click", function (e) {
    e.preventDefault();
    setActiveLink(this);
    movieSection.style.display = "none";
    reviewSection.style.display = "none";
  });

  document.getElementById("movieLink").addEventListener("click", function (e) {
    e.preventDefault();
    setActiveLink(this);
    movieSection.style.display = "block";
    reviewSection.style.display = "none";
  });

  document.getElementById("reviewLink").addEventListener("click", function (e) {
    e.preventDefault();
    setActiveLink(this);
    movieSection.style.display = "none";
    reviewSection.style.display = "block";
  });

  document.getElementById("logoutBtn").addEventListener("click", function () {
    window.location.href = "index.php";
  });
</script>

</body>
</html>
