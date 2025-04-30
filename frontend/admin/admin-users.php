<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin - Manage Users</title>

  <!-- Bootstrap + FontAwesome -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    body {
      background-color: #121212;
      color: #ffffff;
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }
    .navbar {
      background-color: #1f1f1f;
    }
    .sidebar {
      background-color: #1f1f1f;
      min-height: 100vh;
      padding-top: 20px;
      position: fixed;
      top: 0;
      left: 0;
      width: 250px;
    }
    .list-group-item {
      background-color: transparent;
      color: #ccc;
      border: none;
    }
    .list-group-item.active,
    .list-group-item:hover {
      background-color: #333333;
      color: #ffffff;
    }
    .main-content {
      margin-left: 250px;
      padding: 20px;
    }
    .modal-content {
      background-color: #2c2c2c;
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
          <a class="nav-link" href="/MovieSite/frontend/index.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Sidebar -->
<div class="sidebar d-flex flex-column">
  <h4 class="text-center text-white">Admin Menu</h4>
  <div class="list-group">
    <a href="admin-dashboard.php" class="list-group-item list-group-item-action">
      <i class="fas fa-tachometer-alt me-2"></i> Dashboard
    </a>
    <a href="admin-movies.php" class="list-group-item list-group-item-action">
      <i class="fas fa-film me-2"></i> Manage Movies
    </a>
    <a href="admin-users.php" class="list-group-item list-group-item-action active">
      <i class="fas fa-users me-2"></i> Manage Users
    </a>
    <a href="admin-reviews.php" class="list-group-item list-group-item-action">
      <i class="fas fa-comments me-2"></i> Movie Reviews
    </a>
  </div>
</div>

<!-- Main Content -->
<div class="main-content">
  <h2 class="mb-4">Manage Users</h2>
  <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#userModal" onclick="openAddUserModal()">
    <i class="fas fa-plus me-1"></i> Add User
  </button>

  <table class="table table-dark table-hover">
    <thead>
      <tr>
        <th>ID</th><th>Name</th><th>Email</th><th>Role</th><th>Actions</th>
      </tr>
    </thead>
    <tbody id="userTableBody"></tbody>
  </table>
</div>

<!-- User Modal -->
<div class="modal fade" id="userModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content text-white">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitle">Add User</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="userForm">
          <input type="hidden" id="userId">
          <div class="mb-3">
            <label>Name</label>
            <input type="text" class="form-control" id="name" required>
          </div>
          <div class="mb-3">
            <label>Email</label>
            <input type="email" class="form-control" id="email" required>
          </div>
          <div class="mb-3" id="passwordGroup">
            <label>Password <span id="passwordHint" class="text-warning">(leave blank to keep current password)</span></label>
            <input type="password" class="form-control" id="password" required>
          </div>
          <div class="mb-3">
            <label>Role</label>
            <select class="form-control" id="role">
              <option value="0">Admin</option>
              <option value="1">Manager</option>
              <option value="2">User</option>
            </select>
          </div>
          <button type="submit" class="btn btn-success w-100">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Scripts -->
<script>
const apiUrl = 'http://localhost:8000/api/users';

function fetchUsers() {
  fetch(apiUrl)
    .then(res => res.json())
    .then(data => {
      const tbody = document.getElementById('userTableBody');
      tbody.innerHTML = '';
      data.forEach(user => {
        tbody.innerHTML += `
          <tr>
            <td>${user.id}</td>
            <td>${user.name}</td>
            <td>${user.email}</td>
            <td>${roleLabel(user.role)}</td>
            <td>
              <button class="btn btn-warning btn-sm" onclick='openEditUserModal(${JSON.stringify(user)})'>
                <i class="fas fa-edit"></i>
              </button>
              <button class="btn btn-danger btn-sm" onclick="deleteUser(${user.id})">
                <i class="fas fa-trash-alt"></i>
              </button>
            </td>
          </tr>` ;
      });
    });
}

function roleLabel(role) {
  return ['Admin', 'Manager', 'User'][role] || 'Unknown';
}

function openAddUserModal() {
  document.getElementById('modalTitle').textContent = 'Add User';
  document.getElementById('userForm').reset();
  document.getElementById('userId').value = '';
  document.getElementById('passwordGroup').style.display = 'block';
  document.getElementById('password').required = true; // Make password required in Add User modal
  document.getElementById('passwordHint').textContent = "(3 maximum password required)"; // Change the hint to "required"
}

function openEditUserModal(user) {
  document.getElementById('modalTitle').textContent = 'Edit User';
  document.getElementById('userId').value = user.id;
  document.getElementById('name').value = user.name;
  document.getElementById('email').value = user.email;
  document.getElementById('role').value = user.role;
  document.getElementById('password').value = '';
  document.getElementById('passwordGroup').style.display = 'block';
  document.getElementById('password').required = false; // Make password optional in Edit User modal
  document.getElementById('passwordHint').textContent = "(leave blank to keep current password)"; // Restore the original hint
  new bootstrap.Modal(document.getElementById('userModal')).show();
}

document.getElementById('userForm').addEventListener('submit', function(e) {
  e.preventDefault();
  const id = document.getElementById('userId').value;
  const method = id ? 'PUT' : 'POST';
  const url = id ? `${apiUrl}/${id}` : apiUrl;

  const payload = {
    name: document.getElementById('name').value,
    email: document.getElementById('email').value,
    role: parseInt(document.getElementById('role').value)
  };
  const password = document.getElementById('password').value.trim();
  if (password) payload.password = password;

  fetch(url, {
    method: method,
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(payload)
  })
  .then(res => res.json())
  .then(() => {
    bootstrap.Modal.getInstance(document.getElementById('userModal')).hide();
    fetchUsers();
    Swal.fire({
      icon: 'success',
      title: id ? 'User Updated' : 'User Added',
      showConfirmButton: false,
      timer: 1500
    });
  });
});

function deleteUser(id) {
  Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#3085d6',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {
      fetch(`${apiUrl}/${id}`, { method: 'DELETE' })
        .then(() => {
          fetchUsers();
          Swal.fire({
            icon: 'success',
            title: 'Deleted!',
            text: 'User has been deleted.',
            timer: 1500,
            showConfirmButton: false
          });
        });
    }
  });
}

fetchUsers();
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
