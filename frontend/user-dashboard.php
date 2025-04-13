<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Dashboard - Movie Site</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
  <div class="container mt-5">
    <h2>Welcome, User!</h2>
    <p>This is your personal dashboard where you can browse movies, write reviews, and manage your profile.</p>
    <button class="btn btn-danger" onclick="logout()">Logout</button>
  </div>

  <script>
    function logout() {
      localStorage.removeItem('auth_token');
      window.location.href = 'MovieSite/frontend/index.php';
    }
  </script>
</body>
</html>
