<?php

$fullName = $_POST['fullName'];
$emailAddress = $_POST['emailAddress'];
$contactNumber = $_POST['cnumber'];
$subject = $_POST['subject'];
$ctext = $_POST['ctext'];

echo "$fullName $emailAddress $contactNumber $subject $ctext";

mail("contact@hakeemsuleman.co.uk", $subject,"$fullName has their main contact number as: $contactNumber. \n\n They would like support in the following:$ctext", "From: $emailAddress");

?>