<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>User Dashboard - Movie Management System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    body {
      background-color: #121212;
      color: #fff;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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

    .section-title {
      font-size: 28px;
      font-weight: bold;
      color: #e50914;
      margin-bottom: 20px;
    }

    .movie-card {
      background-color: #1e1e1e;
      border: none;
      border-radius: 10px;
      transition: transform 0.3s ease;
      position: relative;
    }

    .movie-card:hover {
      transform: scale(1.03);
    }

    .movie-thumbnail {
      border-radius: 10px 10px 0 0;
      width: 100%;
      height: 300px;
      object-fit: cover;
    }

    .play-btn {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      font-size: 50px;
      color: white;
      opacity: 0.8;
      pointer-events: none;
    }

    .card-body {
      padding: 15px;
    }

    .main-content {
      padding: 30px 15px;
    }

    .nav-item .fas {
      margin-right: 6px;
    }

    .notification-badge {
      font-size: 0.6rem;
      padding: 4px 6px;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark px-3">
  <a class="navbar-brand" href="#">Movie Management System</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMovie">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-end" id="navbarMovie">
    <form class="d-flex me-3" role="search">
      <input class="form-control me-2" type="search" placeholder="Search movies..." aria-label="Search">
      <button class="btn btn-outline-warning" type="submit"><i class="fas fa-search"></i></button>
    </form>
    <ul class="navbar-nav align-items-center">
      <li class="nav-item">
        <a class="nav-link" href="user-dashboard.php"><i class="fas fa-film action"></i> Browse</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="myprofile.php"><i class="fas fa-user"></i> My Profile</a>
      </li>
      <li class="nav-item position-relative me-2">
        <a class="nav-link" href="#" id="notificationBell">
          <i class="fas fa-bell"></i>
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger notification-badge" id="notificationCount">
            0
          </span>
        </a>
      </li>
      <li class="nav-item">
        <!-- Updated logout button with href -->
        <a class="nav-link" href="/MovieSite/frontend/index.php" id="logoutBtn"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </li>
    </ul>
  </div>
</nav>

<!-- Main Content -->
<div class="container-fluid main-content">
  <h4 class="section-title">Now Streaming</h4>
  <div class="row g-4" id="movieList"></div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  function fetchMovies() {
    fetch("http://127.0.0.1:8000/api/movies")
      .then(res => res.json())
      .then(data => {
        const movieList = document.getElementById("movieList");
        movieList.innerHTML = "";
        data.forEach(movie => {
          movieList.innerHTML += `
            <div class="col-sm-6 col-md-4 col-lg-3">
              <div class="card movie-card">
                <img src="http://127.0.0.1:8000/storage/${movie.thumbnail}" class="movie-thumbnail" alt="${movie.title}">
                <div class="play-btn"><i class="fas fa-play-circle"></i></div>
                <div class="card-body">
                  <h5 class="card-title text-warning">${movie.title}</h5>
                  <p class="card-text text-light">${movie.description}</p>
                </div>
              </div>
            </div>
          `;
        });
      })
      .catch(err => console.error("Error fetching movies:", err));
  }

  function fetchNotificationCount() {
    fetch("http://127.0.0.1:8000/api/notifications/count")
      .then(res => res.json())
      .then(data => {
        const count = data.count || 0;
        const badge = document.getElementById("notificationCount");
        badge.textContent = count;
        badge.style.display = count > 0 ? "inline-block" : "none";
      })
      .catch(err => console.error("Error fetching notification count:", err));
  }

  document.addEventListener("DOMContentLoaded", () => {
    fetchMovies();
    fetchNotificationCount();
  });
</script>
</body>
</html>
