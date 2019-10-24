<?php

class PasswordEncryption
{

    public function getPassword($password) {
        $salt1 = "qm8h*";
        $salt2 = "pg!@";
        return hash("ripemd128", "$salt1$password$salt2");;
    }

}