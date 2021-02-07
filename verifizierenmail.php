<?php
    session_start();

    if (isset($_SESSION['loggedin'])) {
        $email =$_SESSION["username"];
    }
    else
    {
        header("Location: login.php");
        die();
    }

    require_once 'vendor/autoload.php';

    $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
    ->setUsername('festlplaner@gmail.com')
    ->setPassword('unqovrmbgtxmczvx')
    ;

    $mailer = new Swift_Mailer($transport);

    $message = (new Swift_Message('Verifikation'))
    ->setFrom(['festlplaner@gmail.com' => 'Festlplaner Anfrage'])
    ->setTo(['festlplaner@gmail.com' => ''])
    ->setBody('Der User ' + $email + ' beantragt die Verifikation des Accounts')
    ;

    $result = $mailer->send($message);

    if($result){
        header("Location: anbieterprofil.php");
        echo "Mail wurde versendet";
        die();
    }
    echo "Mail wurde NICHT versendet";
?>
