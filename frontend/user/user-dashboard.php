<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>User Dashboard - Movie Portal</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
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
      font-weight: 700;
      font-size: 1.5rem;
    }
    .navbar-nav .nav-link {
      color: #ccc !important;
      font-weight: 500;
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
      font-size: 2rem;
      font-weight: 700;
      color: #e50914;
      margin-bottom: 1.5rem;
      text-align: center;
    }
    .movie-card {
      background-color: #1e1e1e;
      border: none;
      border-radius: 10px;
      position: relative;
      transition: transform 0.3s ease;
      cursor: pointer;
      display: flex;
      flex-direction: column;
      height: 100%;
    }
    .movie-card:hover {
      transform: scale(1.05);
      box-shadow: 0 8px 20px rgba(229, 9, 20, 0.6);
      z-index: 2;
    }


    .thumbnail-wrapper {
  position: relative;
  width: 100%;
  height: 280px;
  overflow: hidden;
  border-radius: 10px 10px 0 0;
}

.movie-thumbnail {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}

.play-btn {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  font-size: 48px;
  color: white;
  opacity: 0.8;
  pointer-events: none;
  z-index: 2;
}

    .card-body {
      padding: 1rem;
      flex-grow: 1;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }
    .card-title {
      color: #ffcc00;
      font-weight: 700;
      font-size: 1.25rem;
      margin-bottom: 0.5rem;
    }
    .card-text {
      color: #ddd;
      font-size: 0.95rem;
      height: 48px;
      overflow: hidden;
      text-overflow: ellipsis;
      margin-bottom: 1rem;
    }
    .rate-btn {
      align-self: flex-start;
    }
    .star-rating i {
      font-size: 1.5rem;
      color: #ddd;
      cursor: pointer;
      transition: color 0.2s;
    }
    .star-rating i.selected,
    .star-rating i:hover,
    .star-rating i:hover ~ i {
      color: #f1c40f;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark px-3">
  <a class="navbar-brand" href="#">Movie Portal</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
    <form class="d-flex me-3" onsubmit="event.preventDefault(); searchMovies();">
      <input class="form-control me-2" type="search" id="searchInput" placeholder="Search movies..." />
      <button class="btn btn-outline-warning" type="submit"><i class="fas fa-search"></i></button>
    </form>
    <ul class="navbar-nav align-items-center">
      <li class="nav-item">
        <a class="nav-link" href="myprofile.php"><i class="fas fa-user"></i> My Profile</a>
      </li>
      <li class="nav-item">
        <a class="nav-link btn btn-outline-danger text-white px-3 ms-3" href="../index.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
      </li>
    </ul>
  </div>
</nav>

<div class="container my-4">
  <h2 class="section-title">Browse Movies</h2>
  <div class="row g-4" id="movieContainer"></div>
</div>

<!-- Rate Modal -->
<div class="modal" id="rateModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-dark text-white">
      <div class="modal-header border-0">
        <h5 class="modal-title">Rate Movie</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p id="modalMovieTitle" class="fs-5 mb-3"></p>
        <div class="star-rating d-flex justify-content-center mb-3" id="starRating">
          <i class="fas fa-star" data-value="1"></i>
          <i class="fas fa-star" data-value="2"></i>
          <i class="fas fa-star" data-value="3"></i>
          <i class="fas fa-star" data-value="4"></i>
          <i class="fas fa-star" data-value="5"></i>
        </div>
      </div>
      <div class="modal-footer border-0">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button id="submitRatingBtn" class="btn btn-warning">Submit Rating</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  const movieContainer = document.getElementById('movieContainer');
  const rateModal = new bootstrap.Modal(document.getElementById('rateModal'));
  let selectedMovieId = null;
  let selectedRating = 0;

  window.onload = function () {
    fetchMovies();
  };

  function fetchMovies() {
    fetch("http://127.0.0.1:8000/api/movies", {
      method: "GET",
      headers: {
        "Content-Type": "application/json"
      }
    })
      .then(response => {
        if (!response.ok) throw new Error("HTTP error! status: " + response.status);
        return response.json();
      })
      .then(data => renderMovies(data))
      .catch(error => {
        console.error("Error fetching movies:", error);
        movieContainer.innerHTML = `<p class="text-center text-danger">Error loading movies.</p>`;
      });
  }

  function searchMovies() {
    const query = document.getElementById('searchInput').value.toLowerCase();
    fetch("http://127.0.0.1:8000/api/movies", {
      method: "GET",
      headers: {
        "Content-Type": "application/json"
      }
    })
      .then(response => {
        if (!response.ok) throw new Error("HTTP error! status: " + response.status);
        return response.json();
      })
      .then(movies => {
        const filtered = movies.filter(movie =>
          movie.title.toLowerCase().includes(query) ||
          (movie.description && movie.description.toLowerCase().includes(query))
        );
        renderMovies(filtered);
      })
      .catch(error => console.error("Search error:", error));
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
        <a href="${movie.link || '#'}" target="_blank" class="text-decoration-none">
        <div class="card movie-card">
  <div class="thumbnail-wrapper">
    <img src="http://localhost:8000/storage/${movie.thumbnail}" class="movie-thumbnail" />
    <div class="play-btn"><i class="fas fa-play-circle"></i></div>
  </div>
  <div class="card-body">
    <h5 class="card-title">${movie.title}</h5>
    <p class="card-text">${movie.description || ''}</p>
    <button type="button" class="btn btn-warning rate-btn">Rate ⭐</button>
  </div>
</div>

        </a>
      `;
      movieContainer.appendChild(card);

      card.querySelector('.rate-btn').addEventListener('click', e => {
        e.preventDefault();
        selectedMovieId = movie.id;
        selectedRating = 0;
        resetStars();
        document.getElementById('modalMovieTitle').textContent = movie.title;
        rateModal.show();
      });
    });
  }

  document.querySelectorAll('#starRating i').forEach(star => {
    star.addEventListener('click', () => {
      selectedRating = parseInt(star.getAttribute('data-value'));
      updateStars(selectedRating);
    });
    star.addEventListener('mouseover', () => {
      updateStars(parseInt(star.getAttribute('data-value')));
    });
    star.addEventListener('mouseout', () => {
      updateStars(selectedRating);
    });
  });

  function updateStars(rating) {
    document.querySelectorAll('#starRating i').forEach(star => {
      const value = parseInt(star.getAttribute('data-value'));
      star.classList.toggle('selected', value <= rating);
    });
  }

  function resetStars() {
    document.querySelectorAll('#starRating i').forEach(star => star.classList.remove('selected'));
  }

  document.getElementById('submitRatingBtn').addEventListener('click', function () {
    if (selectedRating === 0) {
      alert('Please select a rating.');
      return;
    }

    fetch(`http://localhost:8000/api/movies/${selectedMovieId}/rate`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ rating: selectedRating })
    })
      .then(response => {
        if (!response.ok) throw new Error('Failed to submit rating: ' + response.statusText);
        return response.json();
      })
      .then(() => {
        alert('Thank you for rating!');
        rateModal.hide();
      })
      .catch(error => {
        alert('Error: ' + error.message);
      });
  });
</script>
</body>
</html>