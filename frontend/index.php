<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Movie Management System - Login/Register</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1607082349560-18f3b0948b2b') no-repeat center center fixed;
      background-size: cover;
      font-family: 'Segoe UI', sans-serif;
    }
    .form-container {
      background-color: rgba(0, 0, 0, 0.8);
      padding: 2rem;
      border-radius: 15px;
      color: white;
      max-width: 400px;
      margin: auto;
      margin-top: 5%;
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
    .form-switch label {
      color: #ccc;
    }
    .btn-danger {
      width: 100%;
    }
  </style>
</head>
<body>

  <div class="form-container" id="loginForm">
    <h2><i class="fas fa-film"></i> RDC'S Movie Site</h2>
    <form>
      <div class="mb-3">
        <label for="loginEmail" class="form-label">Email</label>
        <input type="email" class="form-control bg-dark text-white" id="loginEmail" placeholder="Enter your email here">
      </div>
      <div class="mb-3">
        <label for="loginPassword" class="form-label">Password</label>
        <input type="password" class="form-control bg-dark text-white" id="loginPassword" placeholder="Enter your password here">
      </div>
      <button type="submit" class="btn btn-danger"><i class="fas fa-sign-in-alt"></i> Login</button>
      <div class="form-switch mt-3 text-center">
        <input class="form-check-input" type="checkbox" id="toggleRegister">
        <label class="form-check-label" for="toggleRegister">New here? Register instead</label>
      </div>
    </form>
  </div>

  <div class="form-container d-none" id="registerForm">
    <h2><i class="fas fa-user-plus"></i> Register</h2>
    <form>
      <div class="mb-3">
        <label for="regUsername" class="form-label">Username</label>
        <input type="text" class="form-control bg-dark text-white" id="regUsername" placeholder="Enter username">
      </div>
      <div class="mb-3">
        <label for="regEmail" class="form-label">Email</label>
        <input type="email" class="form-control bg-dark text-white" id="regEmail" placeholder="user@example.com">
      </div>
      <div class="mb-3">
        <label for="regPassword" class="form-label">Password</label>
        <input type="password" class="form-control bg-dark text-white" id="regPassword" placeholder="Create password">
      </div>
      <button type="submit" class="btn btn-danger"><i class="fas fa-user-check"></i> Register</button>
      <div class="form-switch mt-3 text-center">
        <input class="form-check-input" type="checkbox" id="toggleLogin">
        <label class="form-check-label" for="toggleLogin">Already have an account? Login instead</label>
      </div>
    </form>
  </div>

  <script>
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');
    document.getElementById('toggleRegister').addEventListener('change', () => {
      loginForm.classList.add('d-none');
      registerForm.classList.remove('d-none');
    });
    document.getElementById('toggleLogin').addEventListener('change', () => {
      registerForm.classList.add('d-none');
      loginForm.classList.remove('d-none');
    });
  </script>

  <script>
    document.querySelector('#registerForm form').addEventListener('submit', async (e) => {
      e.preventDefault();

      const username = document.getElementById('regUsername').value;
      const email = document.getElementById('regEmail').value;
      const password = document.getElementById('regPassword').value;

      try {
        const response = await fetch('http://127.0.0.1:8000/api/register', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            name: username,
            email: email,
            password: password,
            role: 2
          })
        });

        const data = await response.json();
        if (response.ok) {
          alert('Registration successful!');
          document.getElementById('toggleLogin').checked = true;
          registerForm.classList.add('d-none');
          loginForm.classList.remove('d-none');
        } else {
          alert(data.message || 'Registration failed.');
        }
      } catch (error) {
        alert('Something went wrong during registration.');
        console.error(error);
      }
    });

    document.querySelector('#loginForm form').addEventListener('submit', async (e) => {
      e.preventDefault();

      const email = document.getElementById('loginEmail').value;
      const password = document.getElementById('loginPassword').value;

      try {
        const response = await fetch('http://127.0.0.1:8000/api/login', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({ email, password })
        });

        const data = await response.json();
        if (response.ok) {
          alert('Login successful!');
          localStorage.setItem('auth_token', data.token);

          if (data.user.role === 0) {
            window.location.href = 'admin-dashboard.php';
          } else if (data.user.role === 1) {
            window.location.href = 'manager-dashboard.php';
          } else if (data.user.role === 2) {
            window.location.href = 'user-dashboard.php';
          }
        } else {
          alert(data.message || 'Login failed.');
        }
      } catch (error) {
        alert('Something went wrong during login.');
        console.error(error);
      }
    });
  </script>

</body>
</html>
