<?php
if (isset($_POST['Email'])) {

    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "ghayfy@hotmail.com";
    $email_subject = "Soumissions de nouveaux formulaires";

    function problem($error)
    {
        echo "Nous sommes désolés, mais des erreurs ont été trouvées dans le formulaire que vous avez soumis.";
        echo "Ces erreurs apparaissent ci-dessous.<br><br>";
        echo $error . "<br><br>";
        echo "Veuillez revenir en arrière et corriger ces erreurs.<br><br>";
        die();
    }

    // validation expected data exists
    if (
        !isset($_POST['Name']) ||
        !isset($_POST['Email']) ||
        !isset($_POST['Message'])
    ) {
        problem('Nous sommes désolés, mais il semble y avoir un problème avec le formulaire que vous avez soumis.');
    }

    $name = $_POST['Name']; // required
    $email = $_POST['Email']; // required
    $message = $_POST['Message']; // required

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if (!preg_match($email_exp, $email)) {
        $error_message .= 'l-adresse e-mail que vous avez saisie ne semble pas être valide.<br>';
    }
    
    $string_exp = "/^[A-Za-z .'-]+$/";

    if (!preg_match($string_exp, $name)) {
        $error_message .= 'Le nom que vous avez entré ne semble pas valide.<br>';
    }

    if (strlen($message) < 2) {
        $error_message .= 'Le message que vous avez entré ne semble pas valide.<br>';
    }

    if (strlen($error_message) > 0) {
        problem($error_message);
    }

    $email_message = "Détails du formulaire ci-dessous.\n\n";

    function clean_string($string)
    {
        $bad = array("content-type", "bcc:", "to:", "cc:", "href");
        return str_replace($bad, "", $string);
    }

    $email_message .= "Name: " . clean_string($name) . "\n";
    $email_message .= "Email: " . clean_string($email) . "\n";
    $email_message .= "Message: " . clean_string($message) . "\n";

    // create email headers
    $headers = 'From: ' . $email . "\r\n" .
        'Reply-To: ' . $email . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    @mail($email_to, $email_subject, $email_message, $headers);
?>

    <!-- include your success message below -->

    Merci de nous contacter. Nous vous recontacterons très prochainement.

<?php
}
?>