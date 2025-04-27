<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- CSRF Token -->
  <title>Admin Dashboard - Movie Management System</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- FontAwesome Icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

  <style>
    body {
      background-color: #121212;
      color: #ffffff;
      margin: 0;
      padding: 0;
    }
    .navbar {
      background-color: #1f1f1f;
    }
    .navbar-brand {
      font-weight: bold;
      color: #ffffff;
    }
    .navbar-nav .nav-link {
      color: #ffffff;
    }
    .sidebar {
      background-color: #1f1f1f;
      min-height: 100vh;
      position: fixed;
      top: 0;
      left: 0;
      width: 250px;
      padding-top: 20px;
      z-index: 1000;
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
      background-color: #121212;
      min-height: 100vh;
      color: #ffffff;
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
    <div class="collapse navbar-collapse justify-content-end">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="javascript:void(0);" id="logoutBtn"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Dashboard Content -->
<div class="container-fluid mt-4">
  <div class="row">
    <!-- Sidebar -->
    <div class="col-md-3 p-0 sidebar">
      <div class="d-flex flex-column p-3">
        <h4 class="text-center text-white mb-4">Admin Menu</h4>
        <div class="list-group">
          <a href="admin-dashboard.php" class="list-group-item list-group-item-action"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a>
          <a href="admin-movies.php" class="list-group-item list-group-item-action"><i class="fas fa-film me-2"></i> Manage Movies</a>
          <a href="admin-users.php" class="list-group-item list-group-item-action active"><i class="fas fa-users me-2"></i> Manage Users</a>
          <a href="admin-reviews.php" class="list-group-item list-group-item-action"><i class="fas fa-comments me-2"></i> Movie Reviews</a>
        </div>
      </div>
    </div>

    <!-- Main Content -->
    <div class="col-md-9 main-content">
      <h2>Manage Users</h2>
      <p>Please note that the role if 0 is admin, 1 is manager, 2 is user</p>
      <button class="btn btn-primary mb-3" onclick="openAddModal()">Add User</button>
      <table class="table table-bordered table-dark table-striped" id="userTable">
        <thead>
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="userModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form id="userForm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">User Form</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="userId" id="userId">
          <div class="mb-3">
            <label>Name</label>
            <input type="text" class="form-control" name="name" id="name" required>
          </div>
          <div class="mb-3">
            <label>Email</label>
            <input type="email" class="form-control" name="email" id="email" required>
          </div>
          <div class="mb-3">
            <label>Password</label>
            <input type="password" class="form-control" name="password" id="password" required>
          </div>
          <div class="mb-3">
            <label>Role</label>
            <input type="text" class="form-control" name="role" id="role" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" id="formSubmitBtn">Add User</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
  const tableBody = document.querySelector("#userTable tbody");
  const form = document.getElementById("userForm");
  const submitBtn = document.getElementById("formSubmitBtn");

  fetchUsers();

  form.addEventListener("submit", function (e) {
    e.preventDefault();
    const id = document.getElementById("userId").value;
    if (id) {
      updateUser(id);
    } else {
      addUser();
    }
  });

  function fetchUsers() {
    fetch("http://127.0.0.1:8000/api/users")
    .then(res => res.json())
    .then(data => {
      tableBody.innerHTML = "";
      data.forEach((user, i) => {
        tableBody.innerHTML += `
          <tr>
            <td>${user.name}</td>
            <td>${user.email}</td>
            <td>${user.role}</td>
            <td>
              <button class="btn btn-warning me-1" onclick="editUser(${user.id}, '${user.name}', '${user.email}', '${user.role}')">Edit</button>
              <button class="btn btn-danger" onclick="deleteUser(${user.id})">Delete</button>
            </td>
          </tr>`;
      });
    });
  }

  function addUser() {
    const name = document.getElementById("name").value;
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;
    const role = document.getElementById("role").value;

    fetch("http://127.0.0.1:8000/api/users", {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify({ name, email, password, role })
    })
    .then(() => {
      alert("User Added Successfully");
      form.reset();
      fetchUsers();
    });
  }

  window.editUser = function(id, name, email, role) {
    document.getElementById("userId").value = id;
    document.getElementById("name").value = name;
    document.getElementById("email").value = email;
    document.getElementById("role").value = role;
    document.getElementById("formSubmitBtn").textContent = "Update User";
    const modal = new bootstrap.Modal(document.getElementById("userModal"));
    modal.show();
  };

  function updateUser(id) {
    const name = document.getElementById("name").value;
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;
    const role = document.getElementById("role").value;

    fetch(`http://127.0.0.1:8000/api/users/${id}`, {
      method: "PUT",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify({ name, email, password, role })
    })
    .then(() => {
      alert("User Updated Successfully");
      form.reset();
      fetchUsers();
    });
  }

  window.deleteUser = function(id) {
    if (confirm("Are you sure you want to delete this user?")) {
      fetch(`http://127.0.0.1:8000/api/users/${id}`, {
        method: "DELETE"
      })
      .then(() => fetchUsers());
    }
  };

  window.openAddModal = function() {
    document.getElementById("formSubmitBtn").textContent = "Add User";
    form.reset();
    const modal = new bootstrap.Modal(document.getElementById("userModal"));
    modal.show();
  };

  document.getElementById("logoutBtn").addEventListener("click", function() {
    window.location.href = "index.php";
  });
});
</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
