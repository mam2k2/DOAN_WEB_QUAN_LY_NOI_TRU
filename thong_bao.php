<?php
// Kết nối CSDL
$host = "localhost";
$dbname = "sql";     // ← Đổi tên CSDL của bạn
$username = "root";       // ← Đổi username CSDL nếu cần
$password = "";           // ← Đổi mật khẩu CSDL nếu có

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Kết nối thất bại: " . $conn->connect_error);
}

// Truy vấn dữ liệu từ bảng thong_bao
$sql = "SELECT tieu_de, noi_dung, ngay FROM thong_bao ORDER BY ngay DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Thông báo</title>
  <style>
    * {
      box-sizing: border-box;
      font-family: Arial, sans-serif;
    }
    body {
      background-color: #f0f2f5;
      margin: 0;
      padding: 20px;
    }
    .container {
      max-width: 900px;
      margin: auto;
      background-color: #fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    h2 {
      text-align: center;
      color: #333;
      margin-bottom: 24px;
    }
    .notification {
      border-left: 5px solid #007bff;
      background-color: #f9f9f9;
      padding: 16px 20px;
      margin-bottom: 20px;
      border-radius: 8px;
    }
    .notification h4 {
      margin: 0 0 8px;
      color: #007bff;
    }
    .notification .date {
      font-size: 13px;
      color: #777;
      margin-bottom: 10px;
    }
    .notification p {
      margin: 0;
      color: #444;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Thông báo mới nhất</h2>

    <?php
    if ($result && $result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo "
        <div class='notification'>
          <h4>" . htmlspecialchars($row['tieu_de']) . "</h4>
          <div class='date'>Ngày đăng: " . date("d/m/Y", strtotime($row['ngay'])) . "</div>
          <p>" . nl2br(htmlspecialchars($row['noi_dung'])) . "</p>
        </div>
        ";
      }
    } else {
      echo "<p>Không có thông báo nào.</p>";
    }

    // Đóng kết nối
    $conn->close();
    ?>
  </div>
</body>
</html>
