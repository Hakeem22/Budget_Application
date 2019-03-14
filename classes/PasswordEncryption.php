<?php

class passwordEncryption
{

    public function getPassword($password) {
        $salt1 = "qm8h*";
        $salt2 = "pg!@";
        $hash = hash("ripemd128", "$salt1$password$salt2");
        return $hash;
    }

}