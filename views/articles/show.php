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
        <b>Ocena:</b> <span id="current-ratio"><?= $this->article->average ?></span> <i class="fas fa-star yellow"></i> <br> <br>
        <?php if (\Kernel\Auth::user() && $this->article->status == 2) {
            echo 'Twoja ocena:';
            echo '<i class="fas fa-star ratio ratio-1';
            if (isset($this->userRatio) && $this->userRatio >= 1) {
                echo ' ratio-selected';
            }
            echo '" data-ratio="1" data-article="'.$this->article->id.'"></i>';

            echo '<i class="fas fa-star ratio ratio-2';
            if (isset($this->userRatio) && $this->userRatio >= 2) {
                echo ' ratio-selected';
            }
            echo '" data-ratio="2" data-article="'.$this->article->id.'"></i>';

            echo '<i class="fas fa-star ratio ratio-3';
            if (isset($this->userRatio) && $this->userRatio >= 3) {
                echo ' ratio-selected';
            }
            echo '" data-ratio="3" data-article="'.$this->article->id.'"></i>';

            echo '<i class="fas fa-star ratio ratio-4';
            if (isset($this->userRatio) && $this->userRatio >= 4) {
                echo ' ratio-selected';
            }
            echo '" data-ratio="4" data-article="'.$this->article->id.'"></i>';

            echo '<i class="fas fa-star ratio ratio-5';
            if (isset($this->userRatio) && $this->userRatio >= 5) {
                echo ' ratio-selected';
            }
            echo '" data-ratio="5" data-article="'.$this->article->id.'"></i>';

        } else if ($this->article->status != 2) {
            echo 'Ocenianie jest tymczasowo wyłączone ze względu na nieaktywny artykuł';
        } else {
            echo '<a href="'.\Kernel\Router::path('login').'">Zaloguj się</a> aby ocenić artykuł';
        }
        ?>


    </div>
    <div style="clear: both;"></div>

    <div class="article-content">
        <?php
        echo $this->article->content;
        ?>
    </div>


    <div class="article-add-comment">

        <?php if (\Kernel\Auth::user() && $this->article->status == 2) {
            echo '<form method="POST">';
            echo '<textarea name="comment"></textarea>';
            echo '<input type="hidden" name="articleId" value="'.$this->article->id.'">';
            echo '<input type="submit" value="Dodaj komentarz">';
        } else if ($this->article->status != 2) {
            echo 'Dodawanie komentarzy jest tymczasowo wyłączone ze względu na nieaktywny artykuł';
        } else {
            echo '<a href="'.\Kernel\Router::path('login').'">Zaloguj się</a> aby dodać komentarz';
        }
        ?>
    </div>

    <div class="article-comments">
        <?php
            if (sizeof($this->comments) > 0) {
                foreach ($this->comments as $comment) {
                    $comment = (object) $comment;
                    echo '<div class="article-single-comment">';
                    echo '<h2><i class="fas fa-user-circle"></i> '.$comment->name.'</h2>';

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