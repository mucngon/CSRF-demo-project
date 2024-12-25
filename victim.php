<?php
session_start();

// Kết nối cơ sở dữ liệu
$conn = new mysqli('localhost', 'root', '1234', 'csrf_demo');
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Kiểm tra đăng nhập


// Xử lý yêu cầu thay đổi mật khẩu
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_password = $_POST['new_password'];
    $username = $_SESSION['username']; // Lấy tên người dùng từ session
    
    // Cập nhật mật khẩu trong cơ sở dữ liệu
    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");
    $stmt->bind_param('ss', $new_password, $username);
    $stmt->execute();
    $stmt->close();

    echo "Mật khẩu đã được thay đổi thành công!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đổi mật khẩu</title>
</head>
<body>
    <h1>Đổi mật khẩu</h1>
    <form method="POST" action="victim.php">
        <label for="new_password">Mật khẩu mới:</label>
        <input type="password" id="new_password" name="new_password" required>
        <button type="submit">Đổi mật khẩu</button>
    </form>
</body>
</html>
