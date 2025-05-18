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
    .movie-thumbnail {
      width: 100%;
      height: 280px;
      border-radius: 10px 10px 0 0;
      object-fit: cover;
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
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
    <form class="d-flex me-3" role="search" onsubmit="event.preventDefault(); searchMovies();">
      <input class="form-control me-2" type="search" id="searchInput" placeholder="Search movies..." aria-label="Search" />
      <button class="btn btn-outline-warning" type="submit"><i class="fas fa-search"></i></button>
    </form>
    <ul class="navbar-nav align-items-center">
      <li class="nav-item">
        <a class="nav-link" href="my-profile.html"><i class="fas fa-user"></i> My Profile</a>
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

<!-- Rate Modal (no fade class for instant popup) -->
<div class="modal" id="rateModal" tabindex="-1" aria-labelledby="rateModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-dark text-white">
      <div class="modal-header border-0">
        <h5 class="modal-title" id="rateModalLabel">Rate Movie</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
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
        <button id="submitRatingBtn" type="button" class="btn btn-warning">Submit Rating</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  const movieContainer = document.getElementById('movieContainer');
  let selectedMovieId = null;
  let selectedRating = 0;
  const rateModal = new bootstrap.Modal(document.getElementById('rateModal'));

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
            <img src="http://localhost:8000/storage/${movie.thumbnail}" alt="${movie.title}" class="movie-thumbnail" />
            <div class="play-btn"><i class="fas fa-play-circle"></i></div>
            <div class="card-body">
              <h5 class="card-title">${movie.title}</h5>
              <p class="card-text">${movie.description || ''}</p>
              <button type="button" class="btn btn-warning rate-btn">Rate ⭐</button>
            </div>
          </div>
        </a>
      `;
      movieContainer.appendChild(card);

      // Add click listener for Rate button
      card.querySelector('.rate-btn').addEventListener('click', e => {
        e.preventDefault();  // prevent anchor click
        selectedMovieId = movie.id;
        selectedRating = 0;
        resetStars();
        document.getElementById('modalMovieTitle').textContent = movie.title;
        rateModal.show();
      });
    });
  }

  function resetStars() {
    const stars = document.querySelectorAll('#starRating i');
    stars.forEach(star => star.classList.remove('selected'));
  }

  // Star rating selection
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
    const stars = document.querySelectorAll('#starRating i');
    stars.forEach(star => {
      if (parseInt(star.getAttribute('data-value')) <= rating) {
        star.classList.add('selected');
      } else {
        star.classList.remove('selected');
      }
    });
  }

  // Submit rating
  document.getElementById('submitRatingBtn').addEventListener('click', () => {
    if (selectedRating === 0) {
      alert('Please select a rating before submitting.');
      return;
    }
    // Example POST request to submit rating (replace URL and data structure as needed)
    fetch(`http://localhost:8000/api/movies/${selectedMovieId}/rate`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        // 'Authorization': `Bearer ${token}`, // if needed
      },
      body: JSON.stringify({ rating: selectedRating })
    })
    .then(res => {
      if (!res.ok) throw new Error('Failed to submit rating');
      return res.json();
    })
    .then(data => {
      alert('Thank you for your rating!');
      rateModal.hide();
    })
    .catch(err => {
      alert('Error submitting rating: ' + err.message);
    });
  });

  // Search functionality
  function searchMovies() {
    const query = document.getElementById('searchInput').value.trim().toLowerCase();
    if (!query) {
      loadMovies();
      return;
    }
    const filtered = window.allMovies.filter(m => m.title.toLowerCase().includes(query));
    renderMovies(filtered);
  }

  // Load movies from API
  function loadMovies() {
    fetch('http://localhost:8000/api/movies')
      .then(res => res.json())
      .then(data => {
        window.allMovies = data;
        renderMovies(data);
      })
      .catch(err => {
        movieContainer.innerHTML = `<p class="text-center text-danger">Error loading movies.</p>`;
        console.error(err);
      });
  }

  // Initial load
  loadMovies();
</script>

</body>
</html>
