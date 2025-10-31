<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    $to = $data['email'];
    $message = $data['message'];
    $subject = "Support Response";

    $headers = "From: ditnrb531724@spu.ac.ke\r\n" .
               "Reply-To: ditnrb531724@spu.ac.ke\r\n" .
               "Content-Type: text/html; charset=UTF-8\r\n";

    if (mail($to, $subject, $message, $headers)) {
        echo "Email sent successfully!";
    } else {
        echo "Error sending email!";
    }
}
?>
