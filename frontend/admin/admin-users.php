<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Users - Movie Management System</title>

  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    body {
      background-color: #121212;
      color: #ffffff;
      margin: 0;
      padding: 0;
    }
    .navbar {
      background-color: #1f1f1f;
      padding: 1rem;
      z-index: 1050;
      position: sticky;
      top: 0;
    }
    .navbar-brand {
      font-weight: bold;
      color: #ffffff;
    }
    .navbar-nav .nav-link {
      color: #ffffff;
      margin-left: 15px;
    }
    .navbar-nav .nav-link:hover {
      color: #0d6efd;
    }
    .sidebar {
      background-color: #1f1f1f;
      min-height: 100vh;
      padding-top: 20px;
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
      padding: 20px;
    }
    .table-dark {
      background-color: #2d2d2d;
    }
    .table-dark td,
    .table-dark th {
      border: 1px solid #444;
    }
    .modal-content {
      background-color: #1f1f1f;
      color: #ffffff;
    }

    @media (min-width: 992px) {
      .sidebar {
        position: fixed;
        width: 250px;
        top: 56px;
        left: 0;
      }
      .main-content {
        margin-left: 250px;
      }
    }

    @media (max-width: 991.98px) {
      .sidebar {
        display: none;
      }
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container-fluid">
    <button class="btn btn-outline-light d-lg-none me-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar">
      <i class="fas fa-bars"></i>
    </button>
    <a class="navbar-brand" href="#">Movie Management System</a>
    <div class="collapse navbar-collapse justify-content-end">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="/MovieSite/frontend/index.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Mobile Sidebar (Offcanvas) -->
<div class="offcanvas offcanvas-start bg-dark text-white" tabindex="-1" id="mobileSidebar">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title">Admin Menu</h5>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
  </div>
  <div class="offcanvas-body">
    <div class="list-group">
      <a href="admin-dashboard.php" class="list-group-item list-group-item-action bg-dark text-white"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a>
      <a href="admin-users.php" class="list-group-item list-group-item-action bg-dark text-white active"><i class="fas fa-users me-2"></i> Manage Users</a>
      <a href="admin-movies.php" class="list-group-item list-group-item-action bg-dark text-white"><i class="fas fa-film me-2"></i> Manage Movies</a>
      <a href="admin-reviews.php" class="list-group-item list-group-item-action bg-dark text-white"><i class="fas fa-comments me-2"></i> Movie Reviews</a>
      <a href="admin-reports.php" class="list-group-item list-group-item-action bg-dark text-white"><i class="fas fa-chart-bar me-2"></i> Reports</a>
    </div>
  </div>
</div>

<!-- Layout -->
<div class="container-fluid">
  <div class="row">
    <!-- Sidebar (Desktop) -->
    <div class="col-lg-3 d-none d-lg-block sidebar">
      <div class="d-flex flex-column p-3">
        <h4 class="text-center text-white mb-4">Admin Menu</h4>
        <div class="list-group">
          <a href="admin-dashboard.php" class="list-group-item list-group-item-action"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a>
          <a href="admin-users.php" class="list-group-item list-group-item-action active"><i class="fas fa-users me-2"></i> Manage Users</a>
          <a href="admin-movies.php" class="list-group-item list-group-item-action"><i class="fas fa-film me-2"></i> Manage Movies</a>
          <a href="admin-reviews.php" class="list-group-item list-group-item-action"><i class="fas fa-comments me-2"></i> Movie Reviews</a>
          <a href="admin-reports.php" class="list-group-item list-group-item-action"><i class="fas fa-chart-bar me-2"></i> Reports</a>
        </div>
      </div>
    </div>

    <!-- Main Content -->
    <div class="col-lg-9 main-content">
      <h1>Manage Users</h1>
      <button class="btn btn-primary mb-3" onclick="openAddUserModal()"><i class="fas fa-plus"></i> Add User</button>

      <table class="table table-bordered table-dark table-striped table-hover">
        <thead>
          <tr>
            <th>ID</th><th>Name</th><th>Email</th><th>Role</th><th>Status</th><th>Actions</th>
          </tr>
        </thead>
        <tbody id="userTableBody"></tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="userModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content bg-secondary text-white">
      <div class="modal-header">
        <h5 class="modal-title" id="userModalTitle">Add User</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="userId">
        <div class="mb-3"><label>Name</label><input type="text" id="name" class="form-control"></div>
        <div class="mb-3"><label>Email</label><input type="email" id="email" class="form-control"></div>
        <div class="mb-3"><label>Password</label><input type="password" id="password"  class="form-control"></div>
        <div class="mb-3">
          <label>Role</label>
          <select id="role" class="form-control">
            <option value="0">Admin</option>
            <option value="1">Manager</option>
            <option value="2" selected>User</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="saveUser()">Save</button>
      </div>
    </div>
  </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  var userModal = new bootstrap.Modal(document.getElementById('userModal'));

  function fetchUsers() {
    fetch('http://localhost:8000/api/users')
      .then(res => res.json())
      .then(data => {
        const tbody = document.getElementById('userTableBody');
        tbody.innerHTML = '';
        data.forEach(user => {
          const statusClass = user.suspended ? 'btn-success' : 'btn-secondary';
          const statusText = user.suspended ? 'Activate' : 'Suspend';
          tbody.innerHTML += `
            <tr>
              <td>${user.id}</td>
              <td>${user.name}</td>
              <td>${user.email}</td>
              <td>${roleLabel(user.role)}</td>
              <td>${user.suspended ? 'Suspended' : 'Active'}</td>
              <td>
                <button class="btn btn-warning btn-sm" onclick='openEditUserModal(${JSON.stringify(user)})'><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger btn-sm" onclick="deleteUser(${user.id})"><i class="fas fa-trash"></i></button>
                <button class="btn ${statusClass} btn-sm" onclick="toggleStatus(${user.id})"><i class="fas fa-user-lock"></i> ${statusText}</button>
              </td>
            </tr>
          `;
        });
      });
  }

  function roleLabel(role) {
    return role == 0 ? 'Admin' : role == 1 ? 'Manager' : 'User';
  }

  function openAddUserModal() {
    document.getElementById('userId').value = '';
    document.getElementById('name').value = '';
    document.getElementById('email').value = '';
    document.getElementById('password').value = '';
    document.getElementById('role').value = '2';
    document.getElementById('userModalTitle').innerText = 'Add User';
    userModal.show();
  }

  function openEditUserModal(user) {
    document.getElementById('userId').value = user.id;
    document.getElementById('name').value = user.name;
    document.getElementById('email').value = user.email;
    document.getElementById('role').value = user.role;
    document.getElementById('password').value = '';
    document.getElementById('userModalTitle').innerText = 'Edit User';
    userModal.show();
  }

  function createUser(data) {
    fetch('http://localhost:8000/api/users', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(data)
    })
    .then(res => res.json())
    .then(() => {
      userModal.hide();
      fetchUsers();
      Swal.fire('Success', 'User created successfully.', 'success');
    });
  }

  function updateUser(id, data) {
    fetch(`http://localhost:8000/api/users/${id}`, {
      method: 'PUT',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(data)
    })
    .then(res => res.json())
    .then(() => {
      userModal.hide();
      fetchUsers();
      Swal.fire('Success', 'User updated successfully.', 'success');
    });
  }

  function saveUser() {
    const id = document.getElementById('userId').value;
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const role = document.getElementById('role').value;

    const data = { name, email, role };
    if (password) {
      data.password = password;
    }

    if (!id) {
      createUser(data);
    } else {
      updateUser(id, data);
    }
  }

  function deleteUser(id) {
    Swal.fire({
      title: 'Delete this user?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, delete'
    }).then(result => {
      if (result.isConfirmed) {
        fetch(`http://localhost:8000/api/users/${id}`, { method: 'DELETE' })
          .then(res => res.json())
          .then(() => {
            fetchUsers();
            Swal.fire('Deleted!', 'User has been deleted.', 'success');
          });
      }
    });
  }

  function toggleStatus(id) {
    fetch(`http://localhost:8000/api/users/${id}/toggle-status`, { method: 'PUT' })
      .then(res => res.json())
      .then(() => {
        fetchUsers();
        Swal.fire('Success', 'User status updated successfully.', 'success');
      });
  }

  // Load users on page load
  document.addEventListener('DOMContentLoaded', fetchUsers);
</script>
</body>
</html>