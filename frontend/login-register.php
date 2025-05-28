<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>R.Movie - Login/Register</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
  />
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    rel="stylesheet"
  />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    body,
    html {
      height: 100%;
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(
          rgba(0, 0, 0, 0.85),
          rgba(0, 0, 0, 0.85)
        ),
        url('https://images.unsplash.com/photo-1607082349560-18f3b0948b2b?auto=format&fit=crop&w=1920&q=80')
          no-repeat center center fixed;
      background-size: cover;
      color: white;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    /* Back to homepage button */
    .back-home-btn {
      position: fixed;
      top: 20px;
      left: 20px;
      z-index: 1000;
      background-color: #ff4444;
      border: none;
      color: white;
      padding: 0.5rem 1rem;
      border-radius: 8px;
      font-weight: 600;
      font-size: 1rem;
      cursor: pointer;
      box-shadow: 0 0 10px #ff4444aa;
      transition: background-color 0.3s ease;
      display: flex;
      align-items: center;
      gap: 0.5rem;
      text-decoration: none;
    }

    .back-home-btn:hover {
      background-color: #cc3737;
      text-decoration: none;
      color: white;
    }

    /* Center form wrapper horizontally and vertically with some padding */
    .form-wrapper {
      flex: 1 0 auto;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 2rem 1rem;
      width: 100%;
      position: relative;
    }

    /* Form container styling */
    .form-container {
      background-color: rgba(20, 20, 20, 0.85);
      padding: 2.5rem 2rem;
      border-radius: 15px;
      max-width: 420px;
      width: 100%;
      box-shadow: 0 0 20px #ff4444aa;
      transition: opacity 0.3s ease-in-out;
      color: white;
    }

    /* Smooth fade effect for showing/hiding forms */
    .form-container.d-none {
      opacity: 0;
      height: 0;
      overflow: hidden;
      pointer-events: none;
      position: absolute;
      top: 0;
      left: 50%;
      transform: translateX(-50%);
    }

    .form-container:not(.d-none) {
      opacity: 1;
      height: auto;
      position: relative;
      transform: none;
    }

    .form-container h2 {
      text-align: center;
      margin-bottom: 1.5rem;
      color: #ff4444;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.1em;
    }

    .form-control {
      background-color: #222 !important;
      border: none !important;
      color: white !important;
    }

    .form-control::placeholder {
      color: rgba(255, 255, 255, 0.6);
    }

    .form-switch label {
      color: #ccc;
      font-weight: 500;
      cursor: pointer;
    }

    .btn-danger {
      background-color: #ff4444;
      border: none;
      width: 100%;
      font-weight: 600;
      padding: 0.6rem 0;
      font-size: 1.1rem;
      transition: background-color 0.3s ease;
    }

    .btn-danger:hover {
      background-color: #cc3737;
    }

    @media (max-width: 480px) {
      .form-wrapper {
        padding: 1.5rem 1rem;
      }
      .form-container {
        padding: 2rem 1.5rem;
      }
    }
  </style>
</head>
<body>

  <a href="index.php" class="back-home-btn" aria-label="Back to homepage">
    <i class="fas fa-arrow-left"></i> Back to Homepage
  </a>

  <div class="form-wrapper">
    <!-- Login Form -->
    <div class="form-container" id="loginForm">
      <h2>R.Movies | Login</h2>
      <form>
        <div class="mb-3">
          <label for="loginEmail" class="form-label">Email</label>
          <input
            type="email"
            class="form-control"
            id="loginEmail"
            placeholder="Enter your email here"
          />
        </div>
        <div class="mb-3">
          <label for="loginPassword" class="form-label">Password</label>
          <input
            type="password"
            class="form-control"
            id="loginPassword"
            placeholder="Enter your password here"
          />
        </div>
        <button type="submit" class="btn btn-danger">
          <i class="fas fa-sign-in-alt"></i> Login
        </button>
        <div id="message" class="mt-2 text-center"></div>
        <div class="form-switch mt-3 text-center">
          <input class="form-check-input" type="checkbox" id="toggleRegister" />
          <label class="form-check-label" for="toggleRegister"
            >New here? Register instead</label
          >
        </div>
      </form>
    </div>

    <!-- Register Form -->
    <div class="form-container d-none" id="registerForm">
      <h2>R.Movies | Register</h2>
      <form>
        <div class="mb-3">
          <label for="regUsername" class="form-label">Username</label>
          <input
            type="text"
            class="form-control"
            id="regUsername"
            placeholder="Enter username"
          />
        </div>
        <div class="mb-3">
          <label for="regEmail" class="form-label">Email</label>
          <input
            type="email"
            class="form-control"
            id="regEmail"
            placeholder="user@example.com"
          />
        </div>
        <div class="mb-3">
          <label for="regPassword" class="form-label">Password</label>
          <input
            type="password"
            class="form-control"
            id="regPassword"
            placeholder="Create password"
          />
        </div>
        <button type="submit" class="btn btn-danger">
          <i class="fas fa-user-check"></i> Register
        </button>
         <div class="form-switch mt-3 text-center">
          <input class="form-check-input" type="checkbox" id="toggleLogin" />
          <label class="form-check-label" for="toggleLogin"
            >Already have an account? Login instead</label
          >
        </div>
      </form>
    </div>
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
            role: 2,
          }),
        });

        const data = await response.json();
        if (response.ok) {
          Swal.fire({
            icon: 'success',
            title: 'Registration Successful!',
            text: 'You can now log in.',
            confirmButtonColor: '#d33',
          });
          document.getElementById('toggleLogin').checked = true;
          registerForm.classList.add('d-none');
          loginForm.classList.remove('d-none');
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Registration Failed',
            text: data.message || 'Please try again.',
            confirmButtonColor: '#d33',
          });
        }
      } catch (error) {
        console.error(error);
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Something went wrong during registration.',
          confirmButtonColor: '#d33',
        });
      }
    });

  document.getElementById('loginForm').addEventListener('submit', function (e) {
   e.preventDefault();

    const email = document.getElementById('loginEmail').value;
    const password = document.getElementById('loginPassword').value;
    const message = document.getElementById('message');

    fetch('http://127.0.0.1:8000/api/login', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      },
      body: JSON.stringify({ email: email, password: password })
    })
    .then(response => response.json().then(data => ({ status: response.status, ok: response.ok, body: data })))
    .then(result => {
      const data = result.body;

      if (result.ok) {
        localStorage.setItem('auth_token', data.token);
        localStorage.setItem('user_role', data.role);

        const role = Number(data.role);
        message.innerHTML = `<span class="text-success">${data.message}</span>`;

        setTimeout(() => {
          if (role === 0) {
            window.location.href = 'admin/admin-dashboard.php';
          } else if (role === 1) {
            window.location.href = 'manager/manager-dashboard.php';
          } else if (role === 2) {
            window.location.href = 'user/user-dashboard.php';
          } else {
            message.innerHTML = `<span class="text-danger">Unknown role: ${role}</span>`;
          }
        }, 1000);
      } else {
        message.innerHTML = `<span class="text-danger">${data.message}</span>`;
      }
    })
    .catch(error => {
      message.innerHTML = `<span class="text-danger">Error: ${error.message}</span>`;
    });
  });

  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
