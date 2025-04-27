<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register - Movie Management System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), 
      url('https://images.unsplash.com/photo-1607082349560-18f3b0948b2b') no-repeat center center fixed;
      background-size: cover;
    }
    .form-container {
      background-color: rgba(0, 0, 0, 0.8);
      padding: 2rem;
      border-radius: 15px;
      color: white;
      max-width: 400px;
      margin: auto;
      margin-top: 8%;
      box-shadow: 0 0 15px rgba(255, 0, 0, 0.5);
    }
    .form-container h2 {
      text-align: center;
      margin-bottom: 1.5rem;
      color: #ff4444;
    }
    .form-control::placeholder {
      color: rgba(255,255,255,0.6);
    }
  </style>
</head>

<body class="bg-white relative">

  <!-- Navbar -->
  <header class="bg-black bg-opacity-90 fixed w-full z-30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">
        <div class="flex items-center space-x-6">
          <a class="flex items-center" href="#">
            <img alt="Plex logo" class="h-8 w-auto" src="https://storage.googleapis.com/a1aa/image/f324a0b9-c12a-4ed1-1f71-e69782c5065b.jpg" />
          </a>
        </div>
        <nav class="hidden md:flex items-center space-x-6 text-white font-semibold text-sm">
          <a class="hover:text-yellow-400" href="#">Free Movies & TV</a>
          <a class="hover:text-yellow-400" href="#">Live TV</a>
          <a class="hover:text-yellow-400" href="#">Features</a>
          <a class="hover:text-yellow-400" href="#">Download</a>
          <a class="hover:text-white" href="login.html">Login</a>
          <a class="bg-yellow-500 hover:bg-yellow-600 text-black font-bold rounded px-4 py-2" href="register.html">Register</a>
        </nav>
      </div>
    </div>
  </header>

  <!-- Background -->
  <main class="pt-20 relative">
    <div class="form-container">
      <h2><i class="fas fa-user-plus"></i> RDC'S Movie Site - Register</h2>
      <form id="registerForm">
        <div class="mb-3">
          <label for="regUsername" class="form-label">Username</label>
          <input type="text" class="form-control bg-dark text-white" id="regUsername" placeholder="Enter username" required>
        </div>
        <div class="mb-3">
          <label for="regEmail" class="form-label">Email</label>
          <input type="email" class="form-control bg-dark text-white" id="regEmail" placeholder="user@example.com" required>
        </div>
        <div class="mb-3">
          <label for="regPassword" class="form-label">Password</label>
          <input type="password" class="form-control bg-dark text-white" id="regPassword" placeholder="Create password" required>
        </div>
        <button type="submit" class="btn btn-danger w-100"><i class="fas fa-user-check"></i> Register</button>
        <div class="text-center mt-3">
          <small>Already have an account? <a href="login.php" class="text-warning">Login instead</a></small>
        </div>
      </form>
    </div>
  </main>

  <script>
    document.getElementById('registerForm').addEventListener('submit', async (e) => {
      e.preventDefault();
      const username = document.getElementById('regUsername').value;
      const email = document.getElementById('regEmail').value;
      const password = document.getElementById('regPassword').value;

      try {
        const response = await fetch('http://127.0.0.1:8000/api/register', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ name: username, email: email, password: password, role: 2 })
        });
        const data = await response.json();
        if (response.ok) {
          Swal.fire({
            icon: 'success',
            title: 'Registration Successful!',
            text: 'You can now log in.',
            confirmButtonColor: '#d33'
          }).then(() => {
            window.location.href = 'login.html';
          });
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Registration Failed',
            text: data.message || 'Please try again.',
            confirmButtonColor: '#d33'
          });
        }
      } catch (error) {
        console.error(error);
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Something went wrong.',
          confirmButtonColor: '#d33'
        });
      }
    });
  </script>

</body>
</html>
