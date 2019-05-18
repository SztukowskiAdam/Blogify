<div class="navbar">
    <ul class="nav">
        <li <?php if (\Kernel\Router::currentUrl() === \Kernel\Router::path('/')) echo 'class="active"';?>>
            <a href="<?= \Kernel\Router::path('/')?>">
                Strona główna
            </a>
        </li>
        <li <?php if (\Kernel\Router::currentUrl() === \Kernel\Router::path('/articles')) echo 'class="active"';?>>
            <a href="<?= \Kernel\Router::path('/articles')?>">
                Wszystkie artykuły
            </a>
        </li>

        <?php
        if (!\Kernel\Auth::user()) {
            echo '<li ';
            if (\Kernel\Router::currentUrl() === \Kernel\Router::path('/login')) echo 'class="active"';
            echo '>';
            echo '<a href="'.\Kernel\Router::path('/login').'">';
            echo 'Zaloguj się</a></li>';


            echo '<li ';
            if (\Kernel\Router::currentUrl() === \Kernel\Router::path('/register')) echo 'class="active"';
            echo '>';
            echo '<a href="'.\Kernel\Router::path('/register').'">';
            echo 'Utwórz konto</a></li>';
        }

        if (\Kernel\Auth::user() && !\Kernel\Auth::isAdmin()) {
            echo '<li ';
            if (\Kernel\Router::currentUrl() === \Kernel\Router::path('/users/articles')) echo 'class="active"';
            echo '>';
            echo '<a href="'.\Kernel\Router::path('/users/articles').'">';
            echo 'Twoje artykuły</a></li>';

            echo '<li><a href="'.\Kernel\Router::path('/logout').'">Wyloguj</a></li>';
        }
        ?>

        <?php
        if (\Kernel\Auth::isAdmin()) {
            echo '<li ';
            if (\Kernel\Router::currentUrl() === \Kernel\Router::path('/admin/dashboard')) echo 'class="active"';
            echo '>';
            echo '<a href="'.\Kernel\Router::path('/admin/dashboard').'">';
            echo 'Dashboard</a></li>';
            echo '<li><a href="'.\Kernel\Router::path('/admin/logout').'">Wyloguj</a></li>';
        }
        ?>
    </ul>
</div>
