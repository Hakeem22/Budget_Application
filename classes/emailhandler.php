<?php

class emailhandler {

    public function sendContactInfo() {
        $fullName = $_POST['fullName'];
        $emailAddress = $_POST['emailAddress'];
        $contactNumber = $_POST['cnumber'];
        $subject = $_POST['subject'];
        $ctext = $_POST['ctext'];
        mail("contact@hakeemsuleman.co.uk", $subject,"$fullName has their main contact number as: $contactNumber. \n\n They would like support in the following:$ctext", "From: $emailAddress");
    }

    public function sendMail($to, $from, $subject, $message) {
        $headers = "From: " . strip_tags($from) . "\r\n";
        $headers .= "Reply-To: ". strip_tags($from) . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        mail($to,$subject,$message,$headers);
    }

}

?>