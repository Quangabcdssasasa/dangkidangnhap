<?php 
require_once("../1.Controller/KetNoiDataBase.php");

if (isset($_GET["token"])) {
    $token = $_GET["token"];
    $sql = "UPDATE taikhoan SET is_verified = 1 WHERE verification_token = ? AND is_verified = 0";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        echo "Lỗi khi chuẩn bị câu lệnh: " . $conn->error;
        return;
    }
    
    $stmt->bind_param("s", $token);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Tài khoản của bạn đã được xác nhận thành công.";
    } else {
        echo "Token không hợp lệ hoặc tài khoản đã được xác nhận.";
    }
}

?>