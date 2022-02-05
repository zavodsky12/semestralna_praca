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
                <p class="cervena">Zadali ste zly login</p>
                <?php unset($_SESSION['bad']); ?>
            <?php } ?>
            <form method="post">
                <label for="controle" class="cierna">Email:</label>
                <input type="email" name="login">
                <label for="controle" class="cierna">Heslo:</label>
                <input type="password" name="password">
                <input type="submit" value="Prihlasit">
            </form>
        </div>
    <?php } ?>
</div>
