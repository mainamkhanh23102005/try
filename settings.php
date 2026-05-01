<?php
session_start();
if (!isset($_SESSION['user'])) { header("Location: signin.php"); exit(); }
$conn = new mysqli("127.0.0.1", "admin", "Abc123", "socialnetA");
$msg = "";

// Cập nhật dữ liệu nếu người dùng bấm nút Lưu
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $conn->prepare("UPDATE account SET fullname = ?, description = ? WHERE username = ?");
    $stmt->bind_param("sss", $_POST['fullname'], $_POST['description'], $_SESSION['user']);
    if ($stmt->execute()) {
        $_SESSION['fullname'] = $_POST['fullname']; // Cập nhật tên hiển thị
        $msg = "<p style='color:green'>Cập nhật hồ sơ thành công!</p>";
    }
}

// Lấy dữ liệu cũ để hiển thị ra form
$stmt = $conn->prepare("SELECT fullname, description FROM account WHERE username = ?");
$stmt->bind_param("s", $_SESSION['user']);
$stmt->execute();
$current_data = $stmt->get_result()->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head><title>Settings</title><style>body{font-family:Arial; padding:50px;}</style></head>
<body>
    <a href="index.php">← Quay lại trang chủ</a>
    <h2>Cài đặt tài khoản (Settings)</h2>
    <?php echo $msg; ?>
    <form method="POST">
        <label>Username (Không thể đổi):</label><br>
        <input type="text" value="<?php echo $_SESSION['user']; ?>" disabled><br><br>
        
        <label>Họ và Tên mới:</label><br>
        <input type="text" name="fullname" value="<?php echo htmlspecialchars($current_data['fullname']); ?>" required><br><br>
        
        <label>Tiểu sử (Description) mới:</label><br>
        <textarea name="description" rows="4"><?php echo htmlspecialchars($current_data['description'] ?? ''); ?></textarea><br><br>
        
        <button type="submit">Lưu thay đổi</button>
    </form>
</body>
</html>
