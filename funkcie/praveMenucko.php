<div class="col-22 col-s-4 aside">
    <?php if(Auth::isLogged()) { ?>
        <div class="login">
            <h2>Ste prihlásený ako <?=$_SESSION['username']?></h2>
            <form method="post">
                <input type="submit" name="logout" value="Odhlasit">
            </form>
        </div>
    <?php } else { ?>
        <div class="login">
            <h2>Login</h2>
            <?php if(Auth::isBadLoggin()) { ?>
                <p class="cervena">Zadali ste zlý login</p>
                <?php unset($_SESSION['bad']); ?>
            <?php } ?>
            <form method="post">
                <label for="controle" class="cierna">Email:</label>
                <input type="email" name="login" id="controle">
                <label for="controle2" class="cierna">Heslo:</label>
                <input type="password" name="password" id="controle2">
                <input type="submit" value="Prihlásiť">
            </form>
        </div>
    <?php } ?>
    <br>
    <?php if(Auth::isLogged()) { ?>
        <div class="kosik">
            <h2>Váš košík</h2>
            <?php
            require_once "selectmaxminNakup.php";
            $userN = $_SESSION['name'];
            for ($i = $min; $i < $max+1; $i++) {
                $stmt = $con->prepare("SELECT objednavky.pocet_kusov as pocet_kusov, nazov, cena FROM objednavky JOIN produkty USING(id_produktu) JOIN pouzivatelia USING(id_pouzivatela) WHERE id_nakupu = '$i' AND email LIKE ?");
                $stmt->execute([$userN]);
                $string = $stmt->fetch(PDO::FETCH_ASSOC);
                if (!empty($string)) { ?>
                    <div class="right">
                        <p class="cierna"><b>Názov:</b> <?=$string['nazov']?></p>
                        <p class="cierna"><b>Počet kusov:</b> <?=$string['pocet_kusov']?></p>
                        <p class="cierna"><b>Celková cena:</b> <?=$string['cena'] * $string['pocet_kusov']?> €</p>
                    </div>
                    <br>
                <?php } ?>
            <?php } ?>
            <button onclick="window.location.href = '/semestralka/kosik.php';"><b>Pozrieť košík</b></button>
        </div>
    <?php } else { ?>
        <div class="registracia">
            <h2>Registrácia</h2>
            <div class="right">
                <p class="normalne">Ak ešte u nás nemáte konto, zaregistrujte sa</p>
                <button onclick="window.location.href = '/semestralka/registracia.php';"><b>Registrovať</b></button>
            </div>
        </div>
    <?php } ?>
</div>
<div class="col-1 col-s-0">

</div>
