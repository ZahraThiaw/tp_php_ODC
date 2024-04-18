<?php

function isEmailValid($email) {
    $email_pattern = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
    return preg_match($email_pattern, $email);
}

?>