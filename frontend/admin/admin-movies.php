<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Dashboard - Movie Management System</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- FontAwesome Icons -->
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
    .sidebar {
      background-color: #1f1f1f;
      min-height: 100vh;
      position: fixed;
      top: 0;
      left: 0;
      width: 250px;
      padding-top: 20px;
      z-index: 1000;
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
      background-color: #121212;
      min-height: 100vh;
      color: #ffffff;
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
    <div class="collapse navbar-collapse justify-content-end">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="javascript:void(0);" id="logoutBtn"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Dashboard Content -->
<div class="container-fluid mt-4">
  <div class="row">
    <!-- Sidebar -->
    <div class="col-md-3 p-0 sidebar">
      <div class="d-flex flex-column p-3">
        <h4 class="text-center text-white mb-4">Admin Menu</h4>
        <div class="list-group">
          <a href="admin-dashboard.php" class="list-group-item list-group-item-action "><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a>
          <a href="admin-movies.php" class="list-group-item list-group-item-action active"><i class="fas fa-film me-2"></i> Manage Movies</a>
          <a href="admin-users.php" class="list-group-item list-group-item-action"><i class="fas fa-users me-2"></i> Manage Users</a>
          <a href="admin-reviews.php" class="list-group-item list-group-item-action"><i class="fas fa-comments me-2"></i> Movie Reviews</a>
        </div>
      </div>
    </div>

    <!-- Main Content -->
    <div class="col-md-9 main-content">
      <h2>Manage Movies</h2>
      <button class="btn btn-primary mb-3" onclick="openAddModal()">Add Movie</button>
      <table class="table table-bordered table-dark table-striped" id="movieTable">
        <thead>
          <tr>
            <th>Thumbnail</th>
            <th>Title</th>
            <th>Description</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="movieModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form id="movieForm" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Movie Form</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="movieId" id="movieId">
          <input type="hidden" name="existingThumbnail" id="existingThumbnail">
          <div class="mb-3">
            <label>Title</label>
            <input type="text" class="form-control" name="title" id="title" required>
          </div>
          <div class="mb-3">
            <label>Description</label>
            <textarea class="form-control" name="description" id="description"></textarea>
          </div>
          <div class="mb-3">
            <label>Thumbnail</label>
            <input type="file" class="form-control" name="thumbnail" id="thumbnail">
            <img id="previewImage" src="" class="mt-2" width="100" hidden>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Save</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // Logout button click event
  document.getElementById("logoutBtn").addEventListener("click", function () {
    window.location.href = "/MovieSite/frontend/index.php"; // Correctly redirect to index.php
  });

  const apiBase = 'http://localhost:8000/api/movies';
  const movieTableBody = document.querySelector("#movieTable tbody");
  const movieForm = document.getElementById("movieForm");
  const modal = new bootstrap.Modal(document.getElementById("movieModal"));

  // Fetch movies and display in the table
  function fetchMovies() {
    fetch(apiBase)
      .then(res => res.json())
      .then(movies => {
        movieTableBody.innerHTML = "";
        movies.forEach(movie => {
          movieTableBody.innerHTML += ` 
            <tr>
              <td><img src="http://localhost:8000/storage/${movie.thumbnail}" width="80" /></td>
              <td>${movie.title}</td>
              <td>${movie.description || ''}</td>
              <td>
                <button class="btn btn-sm btn-warning" onclick='editMovie(${JSON.stringify(movie)})'>Edit</button>
                <button class="btn btn-sm btn-danger" onclick='deleteMovie(${movie.id})'>Delete</button>
              </td>
            </tr>`; 
        });
      });
  }

  // Open the modal for adding a new movie
  function openAddModal() {
    movieForm.reset();
    document.getElementById("movieId").value = "";
    document.getElementById("existingThumbnail").value = "";
    document.getElementById("previewImage").hidden = true;
    modal.show();
  }

  // Edit a movie
  function editMovie(movie) {
    document.getElementById("movieId").value = movie.id;
    document.getElementById("title").value = movie.title;
    document.getElementById("description").value = movie.description;
    document.getElementById("existingThumbnail").value = movie.thumbnail;
    const img = document.getElementById("previewImage");
    img.src = `http://localhost:8000/storage/${movie.thumbnail}`;
    img.hidden = false;
    modal.show();
  }

  // Submit the movie form (Add/Edit)
  movieForm.addEventListener("submit", function(e) {
    e.preventDefault();
    const formData = new FormData(movieForm);
    const movieId = formData.get("movieId");
    const method = movieId ? "POST" : "POST";
    const url = movieId ? `${apiBase}/${movieId}` : apiBase;

    fetch(url, {
      method,
      body: formData
    })
    .then(res => res.json())
    .then(() => {
      modal.hide();
      fetchMovies();
    });
  });

  // Delete a movie
  function deleteMovie(id) {
    if (!confirm("Delete this movie?")) return;
    fetch(`${apiBase}/${id}`, {
      method: "DELETE"
    })
    .then(res => res.json())
    .then(() => fetchMovies());
  }

  fetchMovies();
</script>
</body>
</html>
