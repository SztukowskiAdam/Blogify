<div class="vertical-menu">
    <a href="<?php echo \Kernel\Router::path('admin/dashboard') ?>" <?php if (\Kernel\Router::currentUrl() === \Kernel\Router::path('admin/dashboard')) echo 'class="active"';?>>Dashboard</a>
    <a href="<?php echo \Kernel\Router::path('admin/articles') ?>" <?php if (\Kernel\Router::currentUrl() === \Kernel\Router::path('admin/articles')) echo 'class="active"';?>>Artykuły</a>
    <a href="<?php echo \Kernel\Router::path('admin/articles/create') ?>" <?php if (\Kernel\Router::currentUrl() === \Kernel\Router::path('admin/articles/create')) echo 'class="active"';?>>Nowy artykuł</a>
    <a href="<?php echo \Kernel\Router::path('admin/settings') ?>" <?php if (\Kernel\Router::currentUrl() === \Kernel\Router::path('admin/settings')) echo 'class="active"';?>>Motywy</a>
</div>