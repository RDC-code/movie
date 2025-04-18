<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>User Dashboard - Movie Management System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #121212;
      color: #fff;
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

    .form-control {
      background-color: #2a2a2a;
      color: #fff;
      border: 1px solid #444;
    }

    .form-control::placeholder {
      color: #aaa;
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
    }

    .section-title {
      font-size: 28px;
      font-weight: bold;
      color: #e50914;
      border-bottom: 2px solid #555;
      padding-bottom: 10px;
      margin-bottom: 20px;
    }

    .card {
      background-color: #222;
      color: #fff;
      border: none;
      transition: transform 0.3s ease;
    }

    .card:hover {
      transform: scale(1.03);
    }

    .movie-thumbnail {
      width: 100%;
      height: auto;
      border-radius: 5px;
    }

    .badge.bg-secondary {
      background-color: #888;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark px-3">
  <a class="navbar-brand" href="#">🎬 RDC's Movie Site</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMovie" aria-controls="navbarMovie" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-end" id="navbarMovie">
    <form class="d-flex me-3" role="search">
      <input class="form-control me-2" type="search" placeholder="Search movies..." aria-label="Search">
      <button class="btn btn-outline-warning" type="submit"><i class="fas fa-search"></i></button>
    </form>
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="#" id="myProfileNav"><i class="fas fa-user"></i> My Profile</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" id="logoutBtn"><i class="fas fa-sign-out-alt"></i> Logout</a>
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
        <a href="#" class="list-group-item list-group-item-action active" id="browseMoviesLink">🎥 Browse Movies</a>
      </div>
    </div>

    <!-- Main Content -->
    <div class="col-md-9 main-content">
      <!-- Browse Movies Section -->
      <div id="browseMoviesSection">
        <h4 class="section-title">Now Streaming</h4>
        <div class="row g-4">
          <div class="col-md-4">
            <div class="card">
              <img src="https://via.placeholder.com/300x400?text=The+Matrix" class="movie-thumbnail" alt="Matrix">
              <div class="card-body">
                <h5 class="card-title">The Matrix</h5>
                <p class="card-text">Director: Wachowski</p>
                <p class="card-text">Year: 1999</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card">
              <img src="https://via.placeholder.com/300x400?text=Inception" class="movie-thumbnail" alt="Inception">
              <div class="card-body">
                <h5 class="card-title">Inception</h5>
                <p class="card-text">Director: Christopher Nolan</p>
                <p class="card-text">Year: 2010</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- My Profile Section -->
      <div id="myProfileSection" style="display: none;">
        <h4 class="section-title">My Profile</h4>
        <div class="card">
          <div class="card-body">
            <p><strong>Name:</strong> John Doe</p>
            <p><strong>Email:</strong> john@example.com</p>
            <p><strong>Role:</strong> <span class="badge bg-secondary">User</span></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  const browseMoviesSection = document.getElementById("browseMoviesSection");
  const myProfileSection = document.getElementById("myProfileSection");

  const sidebarLinks = document.querySelectorAll(".list-group-item");

  function setActiveLink(activeLink) {
    sidebarLinks.forEach(link => link.classList.remove("active"));
    if (activeLink) {
      activeLink.classList.add("active");
    }
  }

  document.getElementById("browseMoviesLink").addEventListener("click", function (e) {
    e.preventDefault();
    setActiveLink(this);
    browseMoviesSection.style.display = "block";
    myProfileSection.style.display = "none";
  });

  document.getElementById("myProfileNav").addEventListener("click", function (e) {
    e.preventDefault();
    setActiveLink(null);
    browseMoviesSection.style.display = "none";
    myProfileSection.style.display = "block";
  });

  document.getElementById("logoutBtn").addEventListener("click", function () {
    window.location.href = "index.php"; // Redirect on logout
  });
</script>

</body>
</html>
