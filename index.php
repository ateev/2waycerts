<?php

$email = $_POST['email'];    
echo $email;

$code = randomStr();

if ( ! empty ($email) )
{
  sendMail ( $code,$email ); 
}

$pkey = openssl_pkey_get_details($res);
echo $pkey;

function sendMail ( $code, $email)
{       
        require_once "Mail/Mail.php";

        $from = "\"Gehri Route\" <gehriroute@gmail.com>";
        $to = "<$email>";
        $subject = "PIN for site";
        $body = "Dear user. Here is your PIN $code";
        $host = "ssl://smtp.gmail.com";
        $port = "465";
        $username = "gehriroute@gmail.com";  //<> give errors
        $password = 'vitchennai$$$9909';
        $headers = array ( 'From' => $from, 'To' => $to, 'Subject' => $subject );
        $smtp = Mail::factory ( 'smtp', array ( 'host' => $host,        'port' => $port, 'auth' => true, 'username' => $username,       'password' => $password ) );
        $mail = $smtp->send ( $to, $headers, $body );
        if ( PEAR::isError ( $mail ) )
        {
                echo("<p>" . $mail->getMessage() . "</p>");
        }
        else
        {
                //echo("<p>Dear $name, Go to your inbox and confirm email!</p>");
        }
}

function randomStr()
{
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 10; $i++)
        {
                $n = mt_rand(0, $alphaLength);
                $pass[] = $alphabet[$n];
        }
        return implode ( $pass ); //turn the array into a string
}


?>
