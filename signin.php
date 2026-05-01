<?php
session_start();
$msg = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = new mysqli("127.0.0.1", "admin", "Abc123", "socialnetA");
    $stmt = $conn->prepare("SELECT fullname, password FROM account WHERE username = ?");
    $stmt->bind_param("s", $_POST['username']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if (password_verify($_POST['password'], $row['password'])) {
            $_SESSION['user'] = $_POST['username'];
            $_SESSION['fullname'] = $row['fullname'];
            header("Location: index.php");
            exit();
        } else { $msg = "<p style='color:red'>Sai mật khẩu!</p>"; }
    } else { $msg = "<p style='color:red'>Không tìm thấy User!</p>"; }
}
?>
<!DOCTYPE html>
<html>
<head><title>Sign In</title><style>body{font-family:Arial; padding:50px;}</style></head>
<body>
    <h2>Đăng nhập (Sign In)</h2>
    <?php echo $msg; ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button type="submit">Đăng nhập</button>
        <a href="newuser.php">Chưa có tài khoản? Đăng ký</a>
    </form>
</body>
</html>
