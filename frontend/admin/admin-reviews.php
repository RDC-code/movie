<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin - Movie Reviews</title>
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
      font-weight: bold;
    }
    .review-card {
      background-color: #1e1e1e;
      border-radius: 8px;
      padding: 15px;
      margin-bottom: 15px;
    }
    .stars {
      color: #f1c40f;
      font-size: 1.2rem;
    }
    .btn-delete {
      color: #ff4d4d;
    }
    .btn-rate {
      margin-left: 10px;
    }
  </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark px-3">
  <a class="navbar-brand" href="#">Admin Dashboard - Reviews</a>
  <div class="collapse navbar-collapse justify-content-end" id="navbarAdmin">
    <ul class="navbar-nav align-items-center">
      <li class="nav-item">
        <a class="nav-link" href="admin-dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/MovieSite/frontend/index.php" id="logoutBtn"><i class="fas fa-sign-out-alt"></i> Logout</a>
      </li>
    </ul>
  </div>
</nav>

<div class="container mt-4">
  <h3>Movie Reviews</h3>
  <div id="reviewsList"></div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // Helper: Render stars (full stars only)
  function renderStars(rating) {
    let stars = "";
    for (let i = 1; i <= 5; i++) {
      stars += `<i class="fas fa-star${i <= rating ? '' : '-half-alt'}"></i>`;
    }
    return stars;
  }

  // Prompt user to enter rating (1-5)
  function promptRating(movieId) {
    let rating = prompt("Rate this movie (1 to 5 stars):");
    if (rating === null) return; // cancelled

    rating = parseInt(rating);
    if (isNaN(rating) || rating < 1 || rating > 5) {
      alert("Please enter a valid number between 1 and 5.");
      return;
    }

    submitRating(movieId, rating);
  }

  // Submit rating to backend and refresh reviews
  function submitRating(movieId, rating) {
    fetch(`http://127.0.0.1:8000/api/movies/${movieId}/rate`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        // Add auth headers if your API requires authentication
        // "Authorization": "Bearer your_token_here"
      },
      body: JSON.stringify({ rating })
    })
    .then(res => {
      if (!res.ok) throw new Error("Failed to submit rating.");
      return res.json();
    })
    .then(data => {
      alert(`Rating submitted! New average rating: ${data.average_rating} (${data.ratings_count} ratings)`);
      fetchReviews(); // refresh list to reflect changes
    })
    .catch(err => {
      alert("Error submitting rating: " + err.message);
    });
  }

  // Fetch reviews and render
  function fetchReviews() {
    fetch("http://127.0.0.1:8000/api/reviews")
      .then(res => res.json())
      .then(data => {
        const reviewsList = document.getElementById("reviewsList");
        reviewsList.innerHTML = "";
        if (data.length === 0) {
          reviewsList.innerHTML = "<p>No reviews yet.</p>";
          return;
        }

        data.forEach(review => {
          reviewsList.innerHTML += `
            <div class="review-card">
              <h5>${review.movie_title}</h5>
              <p><span class="stars">${renderStars(review.rating)}</span></p>
              <p>${review.review || '<em>No review text</em>'}</p>
              <p><small>By: ${review.user_name} | On: ${new Date(review.created_at).toLocaleDateString()}</small></p>
              <button class="btn btn-sm btn-outline-danger btn-delete" data-id="${review.id}"><i class="fas fa-trash"></i> Delete</button>
              <button class="btn btn-sm btn-outline-warning btn-rate" data-movie-id="${review.movie_id}"><i class="fas fa-star"></i> Rate it</button>
            </div>
          `;
        });

        // Attach delete handlers
        document.querySelectorAll(".btn-delete").forEach(btn => {
          btn.addEventListener("click", e => {
            const reviewId = btn.getAttribute("data-id");
            if (confirm("Are you sure you want to delete this review?")) {
              fetch(`http://127.0.0.1:8000/api/reviews/${reviewId}`, {
                method: "DELETE",
                headers: {
                  // Add auth headers if needed
                }
              })
              .then(res => {
                if (!res.ok) throw new Error("Failed to delete review.");
                fetchReviews();
              })
              .catch(err => alert("Error deleting review."));
            }
          });
        });

        // Attach rate it handlers
        document.querySelectorAll(".btn-rate").forEach(btn => {
          btn.addEventListener("click", e => {
            const movieId = btn.getAttribute("data-movie-id");
            promptRating(movieId);
          });
        });
      })
      .catch(err => console.error("Error fetching reviews:", err));
  }

  document.addEventListener("DOMContentLoaded", fetchReviews);
</script>
</body>
</html>
