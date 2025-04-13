<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manager Dashboard </title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
  <div class="container mt-5">
    <h2> Manager Dashboard</h2>
    <p>Manage movie listings, review submissions, and user content moderation.</p>
    <button class="btn btn-danger" onclick="logout()">Logout</button>
  </div>

  <script>
    function logout() {
      localStorage.removeItem('auth_token');
      window.location.href = '/';
    }
  </script>
</body>
</html>
