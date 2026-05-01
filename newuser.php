<?php
$msg = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['username'];
    $fname = $_POST['fullname'];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $desc = $_POST['description'];

    $conn = new mysqli("127.0.0.1", "admin", "Abc123", "socialnetA");
    $stmt = $conn->prepare("INSERT INTO account (username, fullname, password, description) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $user, $fname, $pass, $desc);
    
    if ($stmt->execute()) {
        $msg = "<p style='color:green'>Đăng ký thành công! <a href='signin.php'>Đăng nhập ngay</a></p>";
    } else {
        $msg = "<p style='color:red'>Lỗi: Username đã tồn tại!</p>";
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Sign Up</title><style>body{font-family:Arial; padding:50px;}</style></head>
<body>
    <h2>Đăng ký tài khoản (Sign Up)</h2>
    <?php echo $msg; ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required><br><br>
        <input type="text" name="fullname" placeholder="Họ và Tên" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <textarea name="description" placeholder="Giới thiệu bản thân"></textarea><br><br>
        <button type="submit">Đăng ký</button>
        <a href="signin.php">Đã có tài khoản? Đăng nhập</a>
    </form>
</body>
</html>
