<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Movie Portal - Home</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Font Awesome for play icon -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
    body {
      background-color: #121212;
      color: #fff;
    }
    .navbar-brand {
      font-weight: bold;
    }
    .movie-card {
      transition: transform 0.2s;
      cursor: pointer;
    }
    .movie-card:hover {
      transform: scale(1.05);
    }
    .movie-thumbnail {
      width: 100%;
      height: 300px;
      object-fit: cover;
    }
    .play-btn {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      font-size: 3rem;
      color: rgba(255, 255, 255, 0.7);
      pointer-events: none;
    }
    .card {
      position: relative;
      background-color: #1e1e1e;
      border: none;
      color: white;
    }
  </style>
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-black">
  <div class="container">
    <a class="navbar-brand" href="#">R.Movies</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>
</nav>

<!-- Hero Section -->
<section class="text-center py-5">
  <div class="container">
    <h1 class="display-4 fw-bold">Welcome to R.Movies</h1>
    <p class="lead">Browse movies, watch trailers, and leave your reviews!</p>
    <a href="login-register.php" class="btn btn-primary btn-lg mt-3">Login here to get started</a>
  </div>
</section>

<!-- Search bar -->
<div class="container mb-4">
  <input
    type="text"
    class="form-control"
    id="searchInput"
    placeholder="Search movies..."
    oninput="searchMovies()"
    autocomplete="off"
  />
</div>

<!-- Movie Preview Section -->
<div class="container my-4">
  <h2 class="section-title">Browse Movies</h2>
  <div class="row g-4" id="movieContainer"></div>
</div>



<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
  const movieContainer = document.getElementById('movieContainer');

  // Fetch movies on page load
  window.onload = fetchMovies;

  function fetchMovies() {
    fetch('http://localhost:8000/api/movies')
      .then(res => {
        if (!res.ok) throw new Error('Network response was not ok');
        return res.json();
      })
      .then(data => renderMovies(data))
      .catch(err => {
        console.error(err);
        movieContainer.innerHTML = `<p class="text-center text-danger">Error loading movies.</p>`;
      });
  }

  function renderMovies(movies) {
    movieContainer.innerHTML = '';
    if (!movies.length) {
      movieContainer.innerHTML = `<p class="text-center text-muted">No movies found.</p>`;
      return;
    }
    movies.forEach(movie => {
      const card = document.createElement('div');
      card.className = 'col-sm-6 col-md-4 col-lg-3';
      card.innerHTML = `
        <div class="card movie-card" role="button" tabindex="0">
          <img src="http://localhost:8000/storage/${movie.thumbnail}" alt="${movie.title}" class="movie-thumbnail" />
          <div class="play-btn"><i class="fas fa-play-circle"></i></div>
          <div class="card-body">
            <h5 class="card-title">${movie.title}</h5>
            <p class="card-text">${movie.description || ''}</p>
          </div>
        </div>
      `;
      movieContainer.appendChild(card);

      // Show alert on clicking the movie card
      card.querySelector('.movie-card').addEventListener('click', () => {
        alert('Please login first to watch movies.');
      });
    });
  }

  function searchMovies() {
    const query = document.getElementById('searchInput').value.toLowerCase().trim();
    fetch('http://localhost:8000/api/movies')
      .then(res => res.json())
      .then(movies => {
        const filtered = movies.filter(movie =>
          movie.title.toLowerCase().includes(query) ||
          (movie.description && movie.description.toLowerCase().includes(query))
        );
        renderMovies(filtered);
      })
      .catch(err => {
        console.error(err);
        movieContainer.innerHTML = `<p class="text-center text-danger">Error searching movies.</p>`;
      });
  }
</script>
</body>
</html>
