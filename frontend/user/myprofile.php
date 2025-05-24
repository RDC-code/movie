<!DOCTYPE html>
<html>
<head>
  <title>User Profile</title>
</head>
<body>
  <h1>User Profile</h1>
  <div id="profile">
    <p>Username: <span id="username"></span></p>
    <p>Email: <span id="email"></span></p>
    <p>Role: <span id="role"></span></p>
  </div>

  <script>
    const token = localStorage.getItem("token"); // Assume token is stored after login

    async function fetchLoggedInUserProfile() {
      try {
        const response = await fetch("http://localhost:8000/api/user/profile", {
          headers: {
            "Authorization": `Bearer ${token}`,
            "Accept": "application/json"
          }
        });

        if (!response.ok) throw new Error("Failed to fetch profile");

        const data = await response.json();
        document.getElementById("username").textContent = data.username;
        document.getElementById("email").textContent = data.email;
        document.getElementById("role").textContent = data.role;

      } catch (error) {
        console.error("Error loading profile:", error);
      }
    }

    fetchLoggedInUserProfile();
  </script>
</body>
</html>
