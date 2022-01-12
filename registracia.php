<?php
session_start();
require "AuthController.php";
$authctr = new AuthController();
$conn = mysqli_connect("localhost","root","","databaza2");
?>


<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="vlastne.css">
    <link rel="stylesheet" href="nove.css">
    <title>Obchod so športovými potrebami</title>
    <script src="javaskripty.js"></script>
</head>

<body>
<div class="header zadnyObrazok">
    <h1>Bikeski.sk</h1>
    <h2>Predaj outdorových športových potrieb</h2>
</div>

<div class="row">
    <div class="col-1 col-s-0">

    </div>
    <div class="col-2 col-s-12 menu">
        <ul>
            <li class="hlavne"><a href="index.php">Hlavná stránka</a></li>
            <li class="hlavne" onclick=dropdownSide("prve")>Letný šport<i class="fa fa-caret-down"></i></li>
            <li class="opacne prve"><a href="Letne/Bicykle.php" class="red">Bicykle</a></li>
            <li class="opacne prve"><a href="Letne/Kolobezky.html" class="red">Kolobežky</a></li>
            <li class="opacne prve"><a href="Letne/Korcule.html" class="red">Korčule</a></li>
            <li class="opacne prve"><a href="Letne/Nahradne.html" class="red">Doplnky</a></li>
            <li class="opacne prve"><a href="Letne/Doplnky.html" class="red">Príslušenstvo</a></li>
            <li class="hlavne" onclick=dropdownSide("druhe")>Zimný šport<i class="fa fa-caret-down"></i></li>
            <li class="opacne druhe">Lyže</li>
            <li class="opacne druhe">Snowboardy</li>
            <li class="opacne druhe">Korčule</li>
            <li class="opacne druhe">Bežky</li>
            <li class="opacne druhe">Doplnky</li>
            <li class="opacne druhe">Príslušenstvo</li>
            <li class="hlavne" onclick=dropdownSide("tretie")>Doplnky<i class="fa fa-caret-down"></i></li>
            <li class="opacne tretie">Cyklodoplnky</li>
            <li class="opacne tretie">Cyklovýbava</li>
            <li class="opacne tretie">Lyžiarky</li>
            <li class="opacne tretie">Viazania</li>
            <li class="opacne tretie">Palice</li>
            <li class="opacne tretie">Letné doplnky</li>
            <li class="opacne tretie">Zimné doplnky</li>
        </ul>
        <?php if (isset($_SESSION['name'])) { ?>
            <?php if ($_SESSION['name'] == 'admin@admin') { ?>
                <br>
                <ul>
                    <li class="hlavne"><a href="pridaj.php">Pridaj produkt</a></li>
                </ul>
            <?php } ?>
        <?php } ?>
    </div>

    <div class="col-6 col-s-8">
        <div class="main">
            <h1>Registrácia</h1>
            <form method="post">
                <div class="container">
                    <p class="cierna">Prosím, vyplňte toto pole pre registráciu</p>
                    <hr>

                    <label for="email"><b class="cierna">Email</b></label>
                    <input class="registr" type="email" placeholder="Email" name="registration" id="email" required>

                    <label for="username"><b class="cierna">Meno</b></label>
                    <input class="registr" type="text" placeholder="Email" name="username" id="username" required>

                    <label for="psw"><b class="cierna">Heslo</b></label>
                    <input class="registr" type="password" placeholder="Heslo" name="password" id="psw" required>

                    <label for="psw-repeat"><b class="cierna">Zopakujte heslo</b></label>
                    <input class="registr" type="password" placeholder="Zopakujte heslo" name="psw-repeat" id="psw-repeat" required>
                    <hr>
                    <p class="cierna">Vytvorením účtu súhlasíte s našími podmienkami používania <a class="modre" href="https://www.youtube.com/watch?v=dQw4w9WgXcQ&ab_channel=RickAstley">Terms & Privacy</a>.</p>

                    <?php if(Auth::isLogged()) { ?>
                        <br>
                        <p class="red">Už ste prihlásený</p>
                    <?php } else {?>
                        <button type="submit">Registrovať</button>
                    <?php }?>
                </div>
                <?php if(Auth::isBadLoggin()) { ?>
                    <p class="cervena">Nepodarilo sa prihlásiť</p>
                    <?php unset($_SESSION['bad']); ?>
                <?php }?>
                <?php if(Auth::isBadLoggin2()) { ?>
                    <p class="cervena">Nepodarilo sa prihlásiť už u nás máte účet</p>
                    <?php unset($_SESSION['bad2']); ?>
                <?php }?>
                <?php if(Auth::isBadLoggin3()) { ?>
                    <p class="cervena">Nepodarilo sa prihlásiť zadali ste zlé údaje</p>
                    <?php unset($_SESSION['bad3']); ?>
                <?php }?>

                <?php if(!Auth::isLogged()) { ?>
                <div class="container">
                    <p class="cierna">Už u nás máte účet? <a href="#" class="modre">Prihláste sa</a>.</p>
                </div>
                <?php }?>
            </form>

            <hr>

        </div>
    </div>

    <div class="col-22 col-s-4 aside">
        <?php if(Auth::isLogged()) { ?>
            <div class="login">
                <h2>Ste prihlaseny</h2>
                <form method="post">
                    <input type="submit" name="logout" value="Odhlasit">
                </form>
            </div>
        <?php } else { ?>
            <div class="login">
                <h2>Login</h2>
                <form method="post">
                    <label for="controle" class="cierna">Email:</label>
                    <input type="email" name="login">
                    <label for="controle" class="cierna">Heslo:</label>
                    <input type="password" name="password">
                    <input type="submit" value="Prihlasit">
                </form>
            </div>
        <?php } ?>
        <!--        <br>-->
        <!--        <div class="right">-->
        <!--            <img src="pravy.png" class="obr">-->
        <!--            <h2>Japonsko</h2>-->
        <!--            <p>Japonsko (jap. 日本 – Nippon alebo Nihon; formálne: jap. 日本国 – Nippon-koku alebo Nihon-koku) je štát ležiaci na východnom okraji ázijského kontinentu, na východ od Číny a Kórey. Rozkladá sa od Ochotského mora na severe, po Východočínske more na juhovýchode. Zo západu ho obklopuje Japonské more a z východu a juhu Tichý oceán.</p>-->
        <!--        </div>-->
    </div>
    <div class="col-1 col-s-0">

    </div>
</div>

</div>

<div>
    <div class="col-3">

    </div>
    <div class="col-6">
        <div class="footer">
            <p>Autor stránky - Daniel Závodský.</p>
        </div>
    </div>
    <div class="col-3">

    </div>
</div>
</body>
</html>
