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
        if (\Kernel\Auth::user()) {
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
