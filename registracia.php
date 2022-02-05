<?php
require_once "funkcie/pripojDatabazu.php";
?>


<!DOCTYPE html>
<html>
<head>
    <?php
    require_once "funkcie/pripajanieSuborov.php";
    ?>
</head>

<body>
<?php
require_once "funkcie/hornaCast.php";
?>

<div class="row">
    <?php
    require_once "funkcie/lavaStrana.php";
    ?>
    <?php
    require_once "funkcie/menucko.php";
    ?>

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
                    <input class="registr" type="text" placeholder="Meno" name="username" id="username" required>

                    <label for="psw"><b class="cierna">Heslo</b></label>
                    <input class="registr" type="password" placeholder="Heslo" name="password" id="psw" required>

                    <label for="psw-repeat"><b class="cierna">Zopakujte heslo</b></label>
                    <input class="registr" type="password" placeholder="Zopakujte heslo" name="psw-repeat" id="psw-repeat" required>
                    <hr>
                    <p class="cierna">Vytvorením účtu súhlasíte s našími podmienkami používania <a class="modre" href="#">Terms & Privacy</a>.</p>

                    <?php if(Auth::isLogged()) { ?>
                        <br>
                        <p class="red">Už ste prihlásený</p>
                    <?php } else {?>
                        <button type="submit">Registrovať</button>
                    <?php }?>
                </div>
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
                        <p class="cierna">Už u nás máte účet? <a href="prihlasenie.php" class="modre">Prihláste sa</a>.</p>
                    </div>
                <?php }?>
            </form>

            <hr>

        </div>
    </div>

    <?php
    require_once "funkcie/praveMenucko.php";
    ?>
    <?php
    require_once "funkcie/pravaStrana.php";
    ?>
</div>

</div>

<?php
require_once "funkcie/spodnaCast.php";
?>
</body>
</html>
