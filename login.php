<?php
session_start();
include("config/db.php");
include("includes/header.php");
?>

<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card p-3">
            <h3 class="text-center">Login</h3>

            <form method="POST">
                <input class="form-control mb-2" type="email" name="email" placeholder="Email" required>
                <input class="form-control mb-2" type="password" name="password" placeholder="Password" required>

                <button class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    </div>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if ($password == $user['password']) {
            $_SESSION['user'] = $user;
            header("Location: dashboard.php");
        } else {
            echo "<div class='alert alert-danger mt-3'>Wrong password</div>";
        }
    } else {
        echo "<div class='alert alert-danger mt-3'>User not found</div>";
    }
}

include("includes/footer.php");
?>