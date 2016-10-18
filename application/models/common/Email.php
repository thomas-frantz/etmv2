<?php declare(strict_types=1);
defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH.'libraries/PHPMailer/PHPMailerAutoload.php');

class Email extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('common/Msg');
    }

    public function send($to, $from, $from_name, $subject, $body)
    {

        global $error;
        $mail = new PHPMailer(); // create a new object
        $mail->IsSMTP(); // enable SMTP
        $mail->SMTPDebug  = SMTPDEBUG; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth   = true; // authentication enabled
        $mail->SMTPSecure = SMTPSECURE; // secure transfer enabled REQUIRED for GMail
        $mail->Host       = SMTPHOST;
        $mail->Port       = SMTPPORT;
        $mail->Username   = GUSER;
        $mail->Password   = GPWD;
        $mail->SetFrom($from, $from_name);
        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->AddAddress($to);
        $mail->IsHTML(true);
        //$mail->SMTPDebug = 2;
        if (!$mail->Send()) {
            return false;
        }
        else {
            return true;
        }
    }

}
