<main class="container">
     <div class="photo-box-article">
            <img src="<?= \Kernel\Router::path('resources/images/articles/'.$this->article->image) ?>">

        <aside class="photo-box-caption">
            <span><?=$this->article->title ?></span>
        </aside>
     </div>

    <div class="article-time">
        Data dodania: <?php $time = new DateTime($this->article->createdAt); echo $time->format('Y-m-d'); ?>
    </div>

    <div class="article-content">
        <?= $this->article->content ?>
    </div>
</main>