<div class="admin-login-container">
    <div class="admin-login">

        <h1>Witamy w <b>Blogify</b></h1>

        <h4>Zanim przejdziesz dalej, musisz przejść proces autentyfikacji</h4>

        <?php if (isset($this->email)) echo '<span style="color: #F0AD4E">Błędne dane logowania!</span>'?>

        <form method="post" action="../admin/attempt">
            <input type="email" name="email" placeholder="E-mail" <?php if (isset($this->email)) echo 'value="'.$this->email.'"'?>>
            <input type="password" name="password" placeholder="Hasło">
            <input type="submit" value="Zaloguj się">
        </form>

        <div class="admin-login-credentials">
            <h3>Copyright &copy; Blogify <?= Date("Y") ?></h3>
            <h4>Made with 💙 by BlogifyDevs</h4>
        </div>
    </div>

    <div class="admin-login-content">

        <div class="admin-content-caption">
            <h1>Dzień dobry!</h1>

            <h2>Nowy Jork, Stany Zjednoczone</h2>
        </div>
    </div>
</div>