<div class="vertical-menu">
    <a href="<?php echo \Kernel\Router::path('admin/dashboard') ?>" <?php if (\Kernel\Router::currentUrl() === \Kernel\Router::path('admin/dashboard')) echo 'class="active"';?>>Dashboard</a>
    <a href="<?php echo \Kernel\Router::path('admin/articles') ?>" <?php if (\Kernel\Router::currentUrl() === \Kernel\Router::path('admin/articles')) echo 'class="active"';?>>Artykuły</a>
</div>