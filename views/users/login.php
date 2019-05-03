Login page!

<form method="post" action="../admin/attempt">
    <input type="email" name="email" <?php if (isset($this->email)) echo 'value="'.$this->email.'"'?>>
    <input type="password" name="password">
    <input type="submit" value="Prześlij">
</form>