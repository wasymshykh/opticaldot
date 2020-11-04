<?php

require_once "includes.php";

function ch($data)
{
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$NoFooterContactForm = true;

$error = ["error" => false, "error_type" => "none"];
$messageSent = false;
if (isset($_GET['success'])) {
    $messageSent = true;
}


$pageTitle = 'Contact';
require_once "header.php";

if (isset($_POST['submit'])) {

    $name = ch($_POST['full_name']);
    $email = ch($_POST['email']);
    $services = $_POST['services'];
    $message = nl2br(ch($_POST['message']));
    $to = "opticaldotofficial@gmail.com";

    // Verifying Recaptcha
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = array(
        'secret' => '6LdH3q8UAAAAAMXqkyuxLG5P9GRD9VdDONoks8Oa',
        'response' => $_POST["g-recaptcha-response"]
    );
    $options = array(
        'http' => array(
            'method' => 'POST',
            'content' => http_build_query($data)
        )
    );
    $context  = stream_context_create($options);
    $verify = file_get_contents($url, false, $context);
    $captcha_success = json_decode($verify);

    if ($captcha_success->success == false) {
        $error = ["error" => true, "error_type" => "captcha", "message" => "Solve captcha before submiting."];
    } else
    if (empty($name) || strlen($name) < 3) {
        $error = ["error" => true, "error_type" => "name", "message" => "Kindly enter valid name."];
    } else
    if (empty($email) || strlen($email) < 3 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = ["error" => true, "error_type" => "email", "message" => "Kindly enter valid email address."];
    } else
    if (!is_array($services) || count($services) < 1) {
        $error = ["error" => true, "error_type" => "services", "message" => "Kindly select atleast one category"];
    } else
    if (empty($message) || strlen($message) < 15) {
        $error = ["error" => true, "error_type" => "message", "message" => "Kindly enter valid message. Must be minimum 10 words."];
    }

    if (!$error["error"]) {

        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Server settings
            //$mail->SMTPDebug = 2;                                 // Enable verbose debug output

            $sender_email = 'contact@opticaldot.com';

            $mail->isSMTP();
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'ssl';
            $mail->Host = 'opticaldot.com';
            $mail->Port = '465';
            $mail->isHTML();
            $mail->Username = $sender_email;
            $mail->Password = 'contactOD@1947';

            $mailSubjectGenerated = '';
            $firstWords = array();

            if (isset($services) && is_array($services)) {
                $servicesList = 'Services Requested: ';
                $size = sizeof($services);
                for ($i = 0; $i < $size; $i++) {
                    $servicesList .= $services[$i] . iif($i == ($size - 1), '', ', ');
                    $firstWords[$i] = explode(' ', $services[$i])[0];
                }
                $servicesList .= '<br><br>';
                $firstWords = array_values(array_unique($firstWords));
            }

            if (!empty($firstWords)) {
                if (sizeof($firstWords) > 3) {
                    $mailSubjectGenerated .= $firstWords[0] . ", " . $firstWords[1] . " & Other ";
                } else {
                    $mailSubjectGenerated .= implode(', ', $firstWords) . " ";
                }
            }

            $mailSubjectGenerated .= 'Services from Optical Dot';

            //Content
            $mail->AddReplyTo($email, $name);
            $mail->SetFrom($sender_email, $name);
            $mail->Subject = $mailSubjectGenerated;
            $mail->Body = $servicesList . $message;
            $mail->AddAddress($to);

            $mail->send();
            $messageSent = true;

            Redirect("contact?success");
        } catch (Exception $e) {
            $error = ["error" => true, "error_type" => "mailer", "message" => "Message could not be sent!"];
        }
    }
}

?>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<link rel="stylesheet" type="text/css" href="/css/contact.css">

<section>
    <div id="contactPage">
        <div class="contact-wrap">

            <div class="contact-text">

                <?php
                if (!$messageSent) {
                    ?>

                    <h1>Let's talk</h1>
                    <h2>Business</h2>

                <?php
                } else {
                    ?>

                    <h1>
                        Message Sent!
                    </h1>

                <?php
                }
                ?>

                <div class="phone-number">
                    <span>(+92)</span>302-2736286
                </div>

                <div class="drop-email">
                    <h3>
                        <?php
                        if (!$messageSent) {
                            ?>
                            drop a mail
                        <?php
                        }
                        ?>
                    </h3>
                    <p>opticaldotofficial@gmail.com</p>
                </div>

                <div class="social-buttons">
                    <a href="https://facebook.com/opticaldot" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://twitter.com/opticaldot" target="_blank"><i class="fab fa-twitter"></i></a>
                    <a href="skype:live:opticaldotofficial?chat"><i class="fab fa-skype"></i></a>
                    <a href="https://www.linkedin.com/company/optical-dot-official/" target="_blank"><i class="fab fa-linkedin"></i></a>
                </div>

            </div>

            <form method="POST" action="/contact.php" class="contact-form">
                    
                <div class="row">
                    <form class="col s10 offset-s1">

                        <?php if ($error["error"]) : ?>
                            <div class="row">
                                <div class="col s12">
                                    <div class="card-panel red white-text" style="padding: 14px;font-size: 0.8rem;">
                                        <?= $error["message"]; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="row">
                            <div class="input-field col s12">
                                <input id="full_name" type="text" name="full_name" class="validate <?= ($error["error"] && $error["error_type"] == "name") ? "invalid" : "" ?>" <?= ($error["error"]) ? 'value="' . $_POST["full_name"] . '"' : "" ?>>
                                <label for="full_name">Your Name</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="email" type="email" name="email" class="validate <?= ($error["error"] && $error["error_type"] == "email") ? "invalid" : "" ?>" <?= ($error["error"]) ? 'value="' . $_POST["email"] . '"' : "" ?>>
                                <label for="email">Email</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <textarea id="textarea1" name="message" class="materialize-textarea <?= ($error["error"] && $error["error_type"] == "message") ? "invalid" : "" ?>"><?= ($error["error"]) ? $_POST["message"] : "" ?></textarea>
                                <label for="textarea1">Your Message</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12">
                                <div class="g-recaptcha" data-sitekey="6LdH3q8UAAAAAOstcc4hPcXVkApqs_22QE2jbujE"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12">
                                <input type="submit" name="submit" value="Submit" class="contact-submit">
                            </div>
                        </div>
                    </form>
                </div>

            </form>

        </div>
    </div>
</section>



<?php

require_once "footer.php";

?>