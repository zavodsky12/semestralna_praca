<?php

class Auth
{
    public static function login($name, $user) {
        $_SESSION['name'] = $name;
        $_SESSION['username'] = $user;
    }
    public static function logout() {
        unset($_SESSION['name']);
        unset($_SESSION['username']);
    }
    public static function isLogged() {
        return isset($_SESSION['name']);
    }
    public static function badLoggin($name) {
        $_SESSION['bad'] = $name;
    }
    public static function badLoggin2($name) {
        $_SESSION['bad2'] = $name;
    }
    public static function badLoggin3($name) {
        $_SESSION['bad3'] = $name;
    }
    public static function isBadLoggin() {
        return isset($_SESSION['bad']);
    }
    public static function isBadLoggin2() {
        return isset($_SESSION['bad2']);
    }
    public static function isBadLoggin3() {
        return isset($_SESSION['bad3']);
    }
}