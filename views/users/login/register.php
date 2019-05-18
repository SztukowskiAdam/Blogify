<div class="user-login">
    <h1>Utwórz konto aby mieć możliwość korzystania z całego serwisu</h1>
    <?php if (isset($this->error)) echo '<span style="color: #F0AD4E">'.$this->error.'</span>'?>

    <form method="post">
        <input type="text" name="name" placeholder="Twoja nazwa" <?php if (isset($this->name)) echo 'value="'.$this->name.'"'?>>
        <input type="email" name="email" placeholder="E-mail" <?php if (isset($this->email)) echo 'value="'.$this->email.'"'?>>
        <input type="password" name="password" placeholder="Hasło">
        <input type="password" name="repeatPassword" placeholder="Powtórz hasło">
        <input type="submit" value="Utwórz konto">
    </form>
</div>


