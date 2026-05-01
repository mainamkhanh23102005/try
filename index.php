<?php
session_start();
if (!isset($_SESSION['user'])) { header("Location: signin.php"); exit(); }
$conn = new mysqli("127.0.0.1", "admin", "Abc123", "socialnetA");
$result = $conn->query("SELECT id, username, fullname, description FROM account");
?>
<!DOCTYPE html>
<html>
<head><title>Home</title><style>body{font-family:Arial; padding:20px;} th,td{padding:10px; border-bottom:1px solid #ccc;}</style></head>
<body>
    <div style="background:#eee; padding:15px; margin-bottom:20px; border-radius:5px;">
        <h2>Xin chào, <?php echo htmlspecialchars($_SESSION['fullname']); ?>! 👋</h2>
        <a href="settings.php">⚙️ Cài đặt (Settings)</a> | 
        <a href="signout.php" style="color:red;">Đăng xuất</a>
    </div>

    <h3>👥 Danh sách thành viên (Making friends)</h3>
    <table width="100%" style="text-align:left; border-collapse:collapse;">
        <tr style="background:#4a90e2; color:white;">
            <th>ID</th><th>Username</th><th>Họ và Tên</th><th>Tiểu sử</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo htmlspecialchars($row['username']); ?></td>
            <td><?php echo htmlspecialchars($row['fullname']); ?></td>
            <td><i><?php echo htmlspecialchars($row['description'] ?? 'Chưa cập nhật'); ?></i></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
