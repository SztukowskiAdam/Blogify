<div class="navbar">
    <ul class="nav">
        <li <?php if (\Kernel\Router::currentUrl() === \Kernel\Router::path('/')) echo 'class="active"';?>>
            <a href="<?= \Kernel\Router::path('/')?>">
                Strona główna
            </a>
        </li>
        <li <?php if (\Kernel\Router::currentUrl() === \Kernel\Router::path('/admin/login')) echo 'class="active"';?>>
            <a href="<?= \Kernel\Router::path('/admin/login')?>">
                Admin
            </a>
        </li>
        <li><a href="#">O nas</a></li>

        <?php if (\Kernel\Auth::user()) echo '<li><a href="'.\Kernel\Router::path('/admin/logout').'">Wyloguj</a></li>';?>
    </ul>
</div>
