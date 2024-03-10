<?php

session_start();
require_once('../1.Controller/KetNoiDataBase.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username']) && isset($_POST['password'])) {
    $usernameOrEmail = $_POST['username'];
    $password = $_POST['password'];
    $responseMessage = "";

    $sql = "SELECT * FROM taikhoan WHERE username = ? OR email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $usernameOrEmail, $usernameOrEmail);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        if ($password == $user['password']) {
            $_SESSION['user_id'] = $user['id'];

            if ($user['is_verified'] == 0) {

                $responseMessage = "Tài khoản của bạn chưa được xác nhận. Vui lòng kiểm tra email.";
            } else {
                
                header("Location: ../1.Controller/Dangnhapthanhcong.php");
                exit();
            }
        } else {
            $responseMessage = "Tài khoản hoặc mật khẩu không đúng!";
        }
    } else {
        $responseMessage = "Không tìm thấy tài khoản!";
    }
}
?>