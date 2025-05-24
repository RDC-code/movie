<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Movies - Movie Management System</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
      top: 56px; /* height of navbar */
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
          <a href="admin-dashboard.php" class="list-group-item list-group-item-action"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a>
          <a href="admin-users.php" class="list-group-item list-group-item-action"><i class="fas fa-users me-2"></i> Manage Users</a>
          <a href="admin-movies.php" class="list-group-item list-group-item-action active"><i class="fas fa-film me-2"></i> Manage Movies</a>
          <a href="admin-reviews.php" class="list-group-item list-group-item-action"><i class="fas fa-comments me-2"></i> Movie Reviews</a>
          <a href="admin-reports.php" class="list-group-item list-group-item-action"><i class="fas fa-chart-bar me-2"></i> Reports</a>
        </div>
      </div>
    </div>

    <!-- Main Content -->
    <div class="col-md-9 main-content">
      <h1>Manage Movies</h1>
      <div class="mb-3 d-flex justify-content-between">
        <button class="btn btn-primary" onclick="openAddModal()">Add Movie</button>
        <button class="btn btn-secondary" onclick="printMovies()"><i class="fas fa-print me-1"></i> Print Movies</button>
      </div>
      <table class="table table-bordered table-dark table-striped" id="movieTable">
        <thead>
          <tr>
            <th>Thumbnail</th>
            <th>Title</th>
            <th>Description</th>
            <th>Link</th>
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
            <label>Link (YouTube/IMDb/etc.)</label>
            <input type="url" class="form-control" name="link" id="link" placeholder="https://example.com" required>
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

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  const movieTableBody = document.querySelector("#movieTable tbody");
  const movieForm = document.getElementById("movieForm");
  const modal = new bootstrap.Modal(document.getElementById("movieModal"));

  // Fetch all movies (GET)
  function fetchMovies() {
    fetch("http://localhost:8000/api/movies")
      .then(res => res.json())
      .then(movies => {
        movieTableBody.innerHTML = "";
        movies.forEach(movie => {
          movieTableBody.innerHTML += `
            <tr>
              <td><img src="http://localhost:8000/storage/${movie.thumbnail}" width="80" /></td>
              <td>${movie.title}</td>
              <td>${movie.description || ''}</td>
              <td><a href="${movie.link}" target="_blank">Visit</a></td>
              <td>
                <button class="btn btn-sm btn-warning" onclick='editMovie(${JSON.stringify(movie)})'>Edit</button>
                <button class="btn btn-sm btn-danger" onclick='deleteMovie(${movie.id})'>Delete</button>
              </td>
            </tr>`;
        });
      });
  }

  // Open modal for adding new movie
  function openAddModal() {
    movieForm.reset();
    document.getElementById("movieId").value = "";
    document.getElementById("existingThumbnail").value = "";
    document.getElementById("previewImage").hidden = true;
    modal.show();
  }

  // Fill modal with movie data for editing
  function editMovie(movie) {
    document.getElementById("movieId").value = movie.id;
    document.getElementById("title").value = movie.title;
    document.getElementById("description").value = movie.description;
    document.getElementById("link").value = movie.link;
    document.getElementById("existingThumbnail").value = movie.thumbnail;
    const img = document.getElementById("previewImage");
    img.src = `http://localhost:8000/storage/${movie.thumbnail}`;
    img.hidden = false;
    modal.show();
  }

  // Add a new movie (POST)
  function addMovie(formData) {
    fetch("http://localhost:8000/api/movies", {
      method: "POST",
      body: formData
    })
    .then(res => res.json())
    .then(() => {
      modal.hide();
      fetchMovies();
      Swal.fire({
        icon: 'success',
        title: 'Movie Added!',
        text: 'The movie has been saved successfully.',
        timer: 2000,
        showConfirmButton: false
      });
    });
  }

  // Update existing movie (POST to /movies/:id)
  function updateMovie(movieId, formData) {
    fetch(`http://localhost:8000/api/movies/${movieId}`, {
      method: "POST",
      body: formData
    })
    .then(res => res.json())
    .then(() => {
      modal.hide();
      fetchMovies();
      Swal.fire({
        icon: 'success',
        title: 'Movie Updated!',
        text: 'The movie has been saved successfully.',
        timer: 2000,
        showConfirmButton: false
      });
    });
  }

  // Delete movie by ID (DELETE)
  function deleteMovie(id) {
    Swal.fire({
      title: 'Are you sure?',
      text: 'This movie will be permanently deleted.',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, delete it!',
    }).then(result => {
      if (result.isConfirmed) {
        fetch(`http://localhost:8000/api/movies/${id}`, { method: 'DELETE' })
          .then(() => {
            fetchMovies();
            Swal.fire('Deleted!', 'The movie has been deleted.', 'success');
          });
      }
    });
  }

  // Print movies list
  function printMovies() {
    fetch("http://localhost:8000/api/movies")
      .then(res => res.json())
      .then(movieData => {
        let printWindow = window.open('', '', 'height=800,width=1000');
        let html = `
          <html>
            <head>
              <title>Print Movies</title>
              <style>
                body { font-family: Arial, sans-serif; padding: 20px; }
                h2 { text-align: center; }
                table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                th, td { border: 1px solid #000; padding: 8px; text-align: left; }
                img { width: 80px; }
              </style>
            </head>
            <body>
              <h2>Movie List</h2>
              <table>
                <thead>
                  <tr>
                    <th>Title</th>
                    <th>Description</th>
                  </tr>
                </thead>
                <tbody>
                  ${movieData.map(movie => `
                    <tr>
                      <td>${movie.title}</td>
                      <td>${movie.description || ''}</td>
                    </tr>`).join('')}
                </tbody>
              </table>
            </body>
          </html>`;
        printWindow.document.write(html);
        printWindow.document.close();
        printWindow.focus();
        printWindow.print();
        printWindow.close();
      })
      .catch(err => {
        alert("Failed to fetch movies for printing.");
        console.error(err);
      });
  }

  // Preview thumbnail image on file select
  document.getElementById("thumbnail").addEventListener("change", function() {
    const preview = document.getElementById("previewImage");
    const file = this.files[0];
    if(file) {
      const reader = new FileReader();
      reader.onload = e => {
        preview.src = e.target.result;
        preview.hidden = false;
      };
      reader.readAsDataURL(file);
    } else {
      preview.src = "";
      preview.hidden = true;
    }
  });

  // Handle form submit (calls add or update based on presence of movieId)
  movieForm.addEventListener("submit", function(e) {
    e.preventDefault();
    const formData = new FormData(movieForm);
    const movieId = formData.get("movieId");
    if (movieId) {
      updateMovie(movieId, formData);
    } else {
      addMovie(formData);
    }
  });

  // Initial load
  fetchMovies();
</script>

</body>
</html>
