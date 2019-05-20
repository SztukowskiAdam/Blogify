<?php require ('views/layouts/adminNavbar.php'); ?>

<main class="admin-content">
    <?php if (isset($this->error)) { echo '<div class="article-form-error">'.$this->error.'</div>'; } ?>
    <form class="articles-form" method="post" action="<?=\Kernel\Router::path('admin/settings') ?>">

        Kolor tła: <input type="color" id="backgroundColor" name="backgroundColor" value="<?=$this->settings->backgroundColor?>">
        <br>
        <br>

        Kolor tekstu: <input type="color" id="textColor" name="textColor" value="<?=$this->settings->textColor?>">
        <br>
        <br>
        Kolor linków: <input type="color" id="linkColor" name="linkColor" value="<?=$this->settings->linkColor?>">

        <br>
        <br>
        <input class="btn btn-article-submit" type="submit" value="Zapisz">
    </form>
</main>