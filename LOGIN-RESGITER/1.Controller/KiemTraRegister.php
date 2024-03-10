<?php
require_once("../1.Controller/KetNoiDataBase.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once("../1.Controller/PHPMailer/src/Exception.php");
require_once("../1.Controller/PHPMailer/src/PHPMailer.php");
require_once("../1.Controller/PHPMailer/src/SMTP.php");

function sendVerificationEmail($email, $verification_token)
{
    $mail = new PHPMailer(true);
    $mail->CharSet = 'UTF-8';
    $responseMessage = "";
    try {
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "trinhducquang91@gmail.com";
        $mail->Password = 'yqxdbvfnlxuvrynz';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom($mail->Username, "Quang");
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = "Xác Nhận Đăng Ký";

        $verificationLink = "http://localhost/LOGIN-RESGITER/1.Controller/DangkiThanhCong.php?token=$verification_token";
        $mail->Body = "Cảm ơn bạn đã đăng ký. Vui lòng click vào link sau để xác nhận tài khoản của bạn: <a href='$verificationLink'>Xác Nhận</a>";
        $mail->send();
        $responseMessage = "Email xác nhận đã được gửi.";
    } catch (Exception $e) {
        $responseMessage = "Không thể gửi email. Vui lòng thử lại sau.";
    }
    return $responseMessage;
};

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Email']) && isset($_POST['Username']) && isset($_POST['Password']) && isset($_POST['ConfirmPassword'])) {
    $email = $_POST['Email'];
    $username = $_POST['Username'];
    $password = $_POST['Password'];
    $confirmPassword = $_POST['ConfirmPassword'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $responseMessage = "Hãy nhập Email hợp lệ";
        return;
    }

    if ($password !== $confirmPassword) {
        $responseMessage = "Mật khẩu không khớp xin vui lòng nhập lại";
        return;
    }

    $stmt = $conn->prepare("SELECT * FROM taikhoan WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $responseMessage = "Tài khoản đã tồn tại";
        return;
    }

    $token = bin2hex(random_bytes(50));
    $sql = "INSERT INTO taikhoan (username, password, email, verification_token, is_verified) VALUES (?, ?, ?, ?, FALSE)";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        echo "Error preparing statement: " . $conn->error;
        return;
    }
    $stmt->bind_param("ssss", $username, $password, $email, $token);
    if ($stmt->execute()) {
        $responseMessage = sendVerificationEmail($email, $token);
        return;
    } else {
        $responseMessage = "Đã xảy ra lỗi khi tạo tài khoản";
    }
}
?>
