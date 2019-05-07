<?php require ('views/layouts/adminNavbar.php'); ?>

<main class="admin-content">
    <div class="dashboard">
        Witaj <?= $this->user->name ?>! Jak Ci mija dzień? <br>
        Obecnie posiadamy <?= $this->countArticles ?> Artykułów <br>
        Rozgość się i zapoznaj z działaniem panelu :)
    </div>
</main>