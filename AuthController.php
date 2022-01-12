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
        if (isset($_POST['nazov'])) {
            $this->pridanieproduktu($_POST['nazov']);
        }
        if (isset($_POST['uprObr'])) {
            $this->upravaObr($_POST['uprObr']);
        }
        if (isset($_POST['uprNazov'])) {
            $this->upravaNazov($_POST['uprNazov']);
        }
        if (isset($_POST['uprCena'])) {
            $this->upravaCena($_POST['uprCena']);
        }
        if (isset($_POST['uprPocet'])) {
            $this->upravaPocet($_POST['uprPocet']);
        }
        if (isset($_POST['uprPopis'])) {
            $this->upravaPopis($_POST['uprPopis']);
        }
        if (isset($_POST['uprTyp'])) {
            $this->upravaTyp($_POST['uprTyp']);
        }
        if (isset($_POST['uprKategoria'])) {
            $this->upravaKategoria($_POST['uprKategoria']);
        }
    }

    public function login($name)
    {
        $dlzka = strlen($name);
        $passwd = $_POST['password'];
        $dlzka2 = strlen($passwd);
        if ($dlzka > 2 && $dlzka < 255 && $dlzka2 > 2 && $dlzka2 < 255) {
            $stmt = $this->con->prepare("SELECT email FROM pouzivatelia WHERE email = '$name'");
            $stmt->execute();
            $posts = $stmt->fetchAll(PDO::FETCH_COLUMN | PDO::FETCH_PROPS_LATE);
            if (empty($posts)) {
                //$this->con->prepare("INSERT INTO prihlasenia(meno, heslo) VALUES (?,?)")
                //    ->execute([$name,$passwd]);
                //Auth::login($name);
                Auth::badLoggin($name);
            } else {
                $stmt = $this->con->prepare("SELECT heslo FROM pouzivatelia WHERE email = '$name'");
                $stmt->execute();

                $posts = $stmt->fetchAll(PDO::FETCH_COLUMN | PDO::FETCH_PROPS_LATE);
                if ($passwd == $posts[0]) {
                    $stmt = $this->con->prepare("SELECT meno FROM pouzivatelia WHERE email = '$name'");
                    $stmt->execute();
                    $posts = $stmt->fetchAll(PDO::FETCH_COLUMN | PDO::FETCH_PROPS_LATE);
                    Auth::login($name, $posts[0]);
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
        $user = $_POST['username'];
        $dlzka2 = strlen($passwd);
        if ($dlzka > 2 && $dlzka < 255 && $dlzka2 > 2 && $dlzka2 < 255) {
            $stmt = $this->con->prepare("SELECT meno FROM pouzivatelia WHERE meno = '$name'");
            $stmt->execute();
            $posts = $stmt->fetchAll(PDO::FETCH_COLUMN | PDO::FETCH_PROPS_LATE);
            if (empty($posts)) {
                if ($_POST['password'] == $_POST['psw-repeat']) {
                    $this->con->prepare("INSERT INTO pouzivatelia(email, meno, heslo) VALUES (?,?,?)")
                        ->execute([$name, $user, $passwd]);
                    Auth::login($name, $user);
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
    public function pridanieproduktu($meno)
    {
        $name = date('Y-m-d-H-i-s_').$_FILES['file']['name'];
        $path = "files/$name";
        move_uploaded_file($_FILES['file']['tmp_name'], $path);
        $this->con->prepare("INSERT INTO produkty(obrazok, nazov, cena, pocet_kusov, popis, typ, kategoria) VALUES (?,?,?,?,?,?,?)")
            ->execute([$name, $meno, $_POST['cena'], $_POST['pocet_kusov'], $_POST['popis'], $_POST['typ'], $_POST['kategoria']]);
    }
    public function upravaObr($nazov)
    {
        $name = date('Y-m-d-H-i-s_').$_FILES['uprObr'];
        $path = "files/$name";
        move_uploaded_file($_FILES['uprObr'], $path);
        $i = $_SESSION['idcko'];
        $sql = "UPDATE produkty SET obrazok = '$nazov' WHERE id_produktu = '$i'";
        $this->con->query($sql);
    }
    public function upravaNazov($nazov)
    {
        $i = $_SESSION['idcko'];
        $sql = "UPDATE produkty SET nazov = '$nazov' WHERE id_produktu = '$i'";
        $this->con->query($sql);
    }
    public function upravaCena($cena)
    {
        $i = $_SESSION['idcko'];
        $sql = "UPDATE produkty SET cena = '$cena' WHERE id_produktu = '$i'";
        $this->con->query($sql);
    }
    public function upravaPocet($pocet)
    {
        $i = $_SESSION['idcko'];
        $sql = "UPDATE produkty SET pocet_kusov = '$pocet' WHERE id_produktu = '$i'";
        $this->con->query($sql);
    }
    public function upravaPopis($popis)
    {
        $i = $_SESSION['idcko'];
        $sql = "UPDATE produkty SET popis = '$popis' WHERE id_produktu = '$i'";
        $this->con->query($sql);
    }
    public function upravaTyp($typ)
    {
        $i = $_SESSION['idcko'];
        $sql = "UPDATE produkty SET typ = '$typ' WHERE id_produktu = '$i'";
        $this->con->query($sql);
    }
    public function upravaKategoria($kategoria)
    {
        $i = $_SESSION['idcko'];
        $sql = "UPDATE produkty SET kategoria = '$kategoria' WHERE id_produktu = '$i'";
        $this->con->query($sql);
    }
}