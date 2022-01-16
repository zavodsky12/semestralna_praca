<?php
require "Auth.php";

class AuthController
{
    private $con;
    private $conn;

    public function __construct()
    {
        $this->conn = mysqli_connect("localhost","root","","databaza2");
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
        if (isset($_POST['zmazProdukt'])) {
            $this->zmazProdukt($_POST['zmazProdukt']);
        }
        if (isset($_POST['vlozDoK'])) {
            $this->vlozDoKosika($_POST['vlozDoK']);
        }
        if (isset($_POST['uprMnozstvo'])) {
            $this->upravaMnozstvo($_POST['uprMnozstvo']);
        }
        if (isset($_POST['zmazKosik'])) {
            $this->zmazKosik($_POST['zmazKosik']);
        }
        if (isset($_POST['doprava'])) {
            $this->zauvidujPlatbu($_POST['doprava']);
        }
    }

    public function login($name)
    {
        $dlzka = strlen($name);
        $passwd = $_POST['password'];
//        $passwd = escapeshellcmd($passwd);
        $dlzka2 = strlen($passwd);
        $name = escapeshellcmd($name);
        if ($dlzka > 2 && $dlzka < 255 && $dlzka2 > 2 && $dlzka2 < 255) {
            $stmt = $this->con->prepare("SELECT email FROM pouzivatelia WHERE email = ?");
            $stmt->execute([$name]);
            $posts = $stmt->fetchAll(PDO::FETCH_COLUMN | PDO::FETCH_PROPS_LATE);
            if (empty($posts)) {
                //$this->con->prepare("INSERT INTO prihlasenia(meno, heslo) VALUES (?,?)")
                //    ->execute([$name,$passwd]);
                //Auth::login($name);
                Auth::badLoggin($name);
            } else {
                $stmt = $this->con->prepare("SELECT heslo FROM pouzivatelia WHERE email = ?");
                $stmt->execute([$name]);
//                $stmt->execute();

                $posts = $stmt->fetchAll(PDO::FETCH_COLUMN | PDO::FETCH_PROPS_LATE);
                if (password_verify($passwd, $posts[0])) {
                    $stmt = $this->con->prepare("SELECT meno FROM pouzivatelia WHERE email = ?");
                    $stmt->execute([$name]);
//                    $stmt->execute();
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
        $name = escapeshellcmd($name);
        $user = escapeshellcmd($user);
        $dlzka2 = strlen($passwd);
        $hash = password_hash($passwd, PASSWORD_DEFAULT);
        if ($dlzka > 2 && $dlzka < 255 && $dlzka2 > 2 && $dlzka2 < 255) {
            $stmt = $this->con->prepare("SELECT meno FROM pouzivatelia WHERE meno = ?");
            $stmt->execute([$name]);
            $posts = $stmt->fetchAll(PDO::FETCH_COLUMN | PDO::FETCH_PROPS_LATE);
            if (empty($posts)) {
                if ($_POST['password'] == $_POST['psw-repeat']) {
                    $this->con->prepare("INSERT INTO pouzivatelia(email, meno, heslo) VALUES (?,?,?)")
                        ->execute([$name, $user, $hash]);
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
    public function zmazProdukt($kategoria)
    {
        $sql = "DELETE FROM objednavky WHERE id_produktu = '$kategoria'";
        $this->con->query($sql);
        $sql = "DELETE FROM produkty WHERE id_produktu = '$kategoria'";
        $this->con->query($sql);
    }
    public function vlozDoKosika($pocet)
    {
        $i = $_SESSION['name'];
        $e = $_POST['end'];
        $stmt = $this->con->prepare("SELECT id_pouzivatela FROM pouzivatelia WHERE email = ?");
        $stmt->execute([$i]);
        $posts = $stmt->fetchAll(PDO::FETCH_COLUMN | PDO::FETCH_PROPS_LATE);
        $this->con->prepare("INSERT INTO objednavky(id_pouzivatela, id_produktu, pocet_kusov) VALUES (?,?,?)")
            ->execute([$posts[0], $e, $pocet]);
    }
    public function zmazKosik($kategoria)
    {
        $sql = "DELETE FROM objednavky WHERE id_nakupu = '$kategoria'";
        $this->con->query($sql);
    }
    public function zauvidujPlatbu($doprava)
    {
        $sql = "SELECT MAX(objednavka_cislo) as total FROM hotove_objednavky";
        $stmt = $this->conn->query($sql);
        $string = $stmt->fetch_assoc();
        $max = (int)$string['total'];
        $meno = $_SESSION['name'];
        $sql = "SELECT id_pouzivatela FROM pouzivatelia WHERE email = '$meno'";
        $stmt = $this->conn->query($sql);
        $string = $stmt->fetch_assoc();
        $user = $string['id_pouzivatela'];
        $sql = "SELECT * FROM objednavky WHERE id_pouzivatela = '$user'";
        $stmt = $this->conn->query($sql);
        while($row = mysqli_fetch_assoc($stmt)){

            $this->con->prepare("INSERT INTO hotove_objednavky(id_nakupu, id_pouzivatela, id_produktu, objednavka_cislo, pocet_kusov, dorucenie, platba) VALUES (?,?,?,?,?,?,?)")
                ->execute([$row['id_nakupu'], $row['id_pouzivatela'], $row['id_produktu'], $max + 1, $row['pocet_kusov'], $doprava, $_POST['platba']]);
            $pocet = $row['pocet_kusov'];
            $produkt = $row['id_produktu'];
            $sql = "UPDATE produkty SET pocet_kusov = pocet_kusov - '$pocet' WHERE id_produktu = '$produkt'";
            $this->con->query($sql);
        }
        $sql = "DELETE FROM objednavky WHERE id_pouzivatela = '$user'";
        $this->conn->query($sql);
        $_SESSION['objednane'] = 'ano';
    }

    private function upravaMnozstvo($uprMnozstvo)
    {
        $i = $_POST['uprMnPoct'];
        $stmt = $this->con->prepare("UPDATE objednavky SET pocet_kusov = '$uprMnozstvo' WHERE id_nakupu = ?");
        $stmt->execute([$i]);
    }
}