<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Đọc dữ liệu từ form mới
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $password = $_POST['password'];

    echo "<div style='font-family: sans-serif; max-width: 400px; margin: 50px auto; padding: 20px; border-radius: 8px; background: #e3f2fd;'>";
    echo "<h2 style='color: #0056b3;'>Dữ liệu User đã vào Server! 🚀</h2>";
    
    echo "<p><strong>Username:</strong> " . htmlspecialchars($username) . "</p>";
    echo "<p><strong>Họ và tên:</strong> " . htmlspecialchars($fullname) . "</p>";
    
    // Lưu ý bảo mật: Thực tế KHÔNG BAO GIỜ in password ra màn hình.
    // Ở đây chúng ta in ra độ dài để chứng minh đã nhận được dữ liệu.
    echo "<p><strong>Password:</strong> Đã nhận (Độ dài: " . strlen($password) . " ký tự)</p>";
    
    echo "</div>";
    
} else {
    echo "Lỗi: Hãy gửi bằng method POST.";
}
?>