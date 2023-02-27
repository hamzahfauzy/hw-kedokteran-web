<?php

class ApiUser {

    static $user;

    static function setUser($user)
    {
        self::$user = $user;
    }

    static function getUser()
    {
        return self::$user;
    }

}