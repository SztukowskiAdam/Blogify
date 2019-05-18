<div class="user-login">
    <h1>Zaloguj się aby mieć możliwość korzystania z całego serwisu</h1>
    <?php if (isset($this->email)) echo '<span style="color: #F0AD4E">Błędne dane logowania!</span>'?>

    <form method="post">
        <input type="email" name="email" placeholder="E-mail" <?php if (isset($this->email)) echo 'value="'.$this->email.'"'?>>
        <input type="password" name="password" placeholder="Hasło">
        <input type="submit" value="Zaloguj się">
    </form>
</div>


