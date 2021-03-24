<?php
$to = "ghayfy@hotmail.com"; // Your Brand Mail ID
$from = "ghayfy@hotmail.com"; // Replace it with your From Mail ID

$headers = "From: " . $from . "rn";

$subject = "Nouvel abonnement";
$body = "Nouvel abonnement utilisateur: " . $_POST['email'];
if( filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) )
{
if (mail($to, $subject, $body, $headers, "-f " . $from))
{
echo 'Votre e-mail (' . $_POST['email'] . ') a été ajouté à notre liste de diffusion!';
}
else
{
echo 'Il y a eu un problème avec votre e-mail (' . $_POST['email'] . ')';
}
}
?>
 

 