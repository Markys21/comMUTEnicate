

<?php
session_start();
include "../db_conn.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require '../PHPMailer/src/Exception.php';

function registerUser($conn, $unameadd, $emailadd, $passadd)
{
    $unameadd = validate($conn, $unameadd);
    $emailadd = validate($conn, $emailadd);
    $passadd = validate($conn, $passadd);

    $sqltest = mysqli_query($conn, "SELECT * FROM users WHERE user_name = '$unameadd' OR email = '$emailadd' ");
    if (mysqli_num_rows($sqltest) > 0) {
        return array('status' => 'error', 'message' => 'Username or email is already existing');
    } else {
        $sql = "INSERT INTO users (user_name, password, email, status, roleid)
                VALUES ('$unameadd', '$passadd',  '$emailadd', 1, 'guest')";

        if (mysqli_query($conn, $sql)) {
            $mail = new PHPMailer();
            try {
                $mail->isSMTP();
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'tls';
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 587;
                $mail->Username = 'jcytfchurch92@gmail.com'; // Replace with your Gmail email address
                $mail->Password = 'txncdnjbiolxvxvs'; // Replace with your Gmail password
                $mail->setFrom('jcytfchurch92@gmail.com', 'JCYTF'); // Replace with your Gmail email address and desired sender name
                $mail->addAddress($emailadd); // Add recipient email address

                // Table
                $table = '<table style="border-collapse: collapse; width: 1000px; margin: 0 auto; text-align: center;">';
                $table .= '<tr>';
                $table .= '<td style="font-size: 16px; font-weight: 600; text-align: left; padding: 20px 0;"><strong>Hello ' . $unameadd . ',</strong></td>';
                $table .= '</tr>';
                $table .= '<tr>';
                $table .= '<td style="padding: 30px; background-color: #d97706; border-radius: 4px; font-size: 24px; font-weight: bold; color: #fff;">';
                $table .= 'Here are your login details:</td>';
                $table .= '</tr>';
                $table .= '<tr>';
                $table .= '<td style="padding: 30px 0; font-size: 20px;"><strong>Username:</strong> ' . $unameadd . '</td>';
                $table .= '</tr>';
                $table .= '<tr>';
                $table .= '<td style="padding: 0 0 30px; font-size: 20px;"><strong>Password:</strong> ' . $passadd . '</td>';
                $table .= '</tr>';
                $table .= '<tr>';
                $table .= '<td style="font-size: 16px; font-weight: 600; color: #626262; line-height: 22px;">Please keep this information confidential and do not share it with others.</td>';
                $table .= '</tr>';
                $table .= '<tr>';
                $table .= '<td style="border-bottom: 5px solid #ccc;"></td>';
                $table .= '</tr>';
                $table .= '<tr>';
                $table .= '<td style="margin: 0; text-align: left; font-size: 12px; font-weight: 400; color: #858585; line-height: 22px; padding: 10px 0;">&copy; Jesus Christ Yesterday, Today and Forever. All Rights Reserved.</td>';
                $table .= '</tr>';
                $table .= '</table>';

                $mail->isHTML(true);
                $mail->Subject = 'Registration Details';
                $mail->Body = $table;

                $mail->ContentType = 'text/html';
                $mail->CharSet = 'UTF-8';
                $mail->send();
                return array('status' => 'success');
            } catch (Exception $e) {
                return array('status' => 'error', 'message' => 'Failed to send email. Error: ' . $mail->ErrorInfo);
            }
        } else {
            return array('status' => 'error', 'message' => 'Error inserting data into the database');
        }
    }
}

function validate($conn, $data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = mysqli_real_escape_string($conn, $data);
    return $data;
}

if (isset($_POST['unameadd'], $_POST['emailadd'], $_POST['passadd'])) {
    $result = registerUser($conn, $_POST['unameadd'], $_POST['emailadd'], $_POST['passadd']);
    echo json_encode($result);
}
?>