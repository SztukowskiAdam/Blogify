<main class="container">
     <div class="photo-box-article">
            <img src="<?= \Kernel\Router::path('resources/images/articles/'.$this->article->image) ?>">

        <aside class="photo-box-caption">
            <span><?=$this->article->title ?></span>
        </aside>
     </div>

    <div class="article-time">
        <b>Data dodania:</b> <?php
        $arrLocales = array('pl_PL', 'pl','Polish_Poland.28592');
        setlocale( LC_ALL, $arrLocales );
        echo strftime("%e, %B %G %H:%M", strtotime($this->article->createdAt));
        ?>,
        <b>Autor:</b> <?=$this->article->author ?>
    </div>
    <div class="article-rate">
        <b>Ocena:</b> <?= $this->article->average ?> <i class="fas fa-star yellow"></i>
    </div>
    <div style="clear: both;"></div>

    <div class="article-content">
        <?php
        echo $this->article->content;
        ?>
    </div>


    <div class="article-add-comment">

        <?php if (\Kernel\Auth::user()) {
            echo 'Dodaj komentarz';
        } else {
            echo 'Zaloguj się aby dodać komentarz';
        }
        ?>
    </div>

    <div class="article-comments">
        <?php
            if (sizeof($this->comments) > 0) {
                foreach ($this->comments as $comment) {
                    $comment = (object) $comment;
                    echo '<div class="article-single-comment">';
                    echo '<h2><i class="fas fa-user-circle"></i>'.$comment->name.'</h2>';

                    echo strftime("%e, %B %G %H:%M", strtotime($comment->createdAt));
                    echo '<h4>'.$comment->content.'</h4>';
                    echo '</div>';
                }
            } else {
                echo 'Brak komentarzy';
            }

        ?>
    </div>
</main>