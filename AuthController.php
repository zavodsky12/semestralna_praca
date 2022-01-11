<?php
require "Auth.php";

class AuthController
{
    private $con;

    public function __construct()
    {
        try {
            $this->con = new PDO("mysql:host=localhost;dbname=databaza2", "root", "");
            $this->con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("DB error: " . $e->getMessage());
        }
        if (isset($_POST['login'])) {
            $this->login($_POST['login']);
        }
        if (isset($_POST['logout'])) {
            $this->logout();
        }
        if (isset($_POST['registration'])) {
            $this->registration($_POST['registration']);
        }
    }

    public function login($name)
    {
        $dlzka = strlen($name);
        $passwd = $_POST['password'];
        $dlzka2 = strlen($passwd);
        if ($dlzka > 2 && $dlzka < 255 && $dlzka2 > 2 && $dlzka2 < 255) {
            $stmt = $this->con->prepare("SELECT meno FROM prihlasenia WHERE meno = '$name'");
            $stmt->execute();
            $posts = $stmt->fetchAll(PDO::FETCH_COLUMN | PDO::FETCH_PROPS_LATE);
            if (empty($posts)) {
                //$this->con->prepare("INSERT INTO prihlasenia(meno, heslo) VALUES (?,?)")
                //    ->execute([$name,$passwd]);
                //Auth::login($name);
                Auth::badLoggin($name);
            } else {
                $stmt = $this->con->prepare("SELECT heslo FROM prihlasenia WHERE meno = '$name'");
                $stmt->execute();

                $posts = $stmt->fetchAll(PDO::FETCH_COLUMN | PDO::FETCH_PROPS_LATE);
                if ($passwd == $posts[0]) {
                    Auth::login($name);
                } else {
                    Auth::badLoggin($name);
                }
            }
        } else {
            Auth::badLoggin($name);
        }
    }

    public function logout()
    {
        Auth::logout();
        unset($_POST['logout']);
    }
    public function registration($name)
    {
        $dlzka = strlen($name);
        $passwd = $_POST['password'];
        $dlzka2 = strlen($passwd);
        if ($dlzka > 2 && $dlzka < 255 && $dlzka2 > 2 && $dlzka2 < 255) {
            $stmt = $this->con->prepare("SELECT meno FROM prihlasenia WHERE meno = '$name'");
            $stmt->execute();
            $posts = $stmt->fetchAll(PDO::FETCH_COLUMN | PDO::FETCH_PROPS_LATE);
            if (empty($posts)) {
                if ($_POST['password'] == $_POST['psw-repeat']) {
                    $this->con->prepare("INSERT INTO prihlasenia(meno, heslo) VALUES (?,?)")
                        ->execute([$name, $passwd]);
                    Auth::login($name);
                    //Auth::badLoggin($name);
                } else {
                    Auth::badLoggin3($name);
                }
            } else {
                Auth::badLoggin2($name);
            }
        } else {
            Auth::badLoggin($name);
        }
    }
}