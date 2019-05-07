<h1 class="teaser">Blog jakiego jeszcze nie znasz</h1>

<main class="container">
    <?php
    $counter = 1;
    $row = 0;
    echo '<div class="row">';
    foreach ($this->articles as $key => $article) {
        $article = (object) $article;
        if ($counter % 3 == 0) {
            $row += 1;
        }

        if ($row % 3 == 0) {
            if ($counter == 1) {
                $counter += 1;
                echo '<div class="photo-box col-33">';
                echo '<a href="'.\Kernel\Router::path('articles/'.$article->slug).'">';
                echo '<img src="'.\Kernel\Router::path('resources/images/articles/').$article->image.'">';
                echo '</a>';
                echo '<aside class="photo-box-caption">';
                echo '<span>'.$article->title.'</span>';
                echo '</aside>';
                echo '</div>';
            } else if ($counter == 2) {
                $counter += 2;
                echo '<div class="photo-box col-66">';
                echo '<a href="'.\Kernel\Router::path('articles/'.$article->slug).'">';
                echo '<img src="'.\Kernel\Router::path('resources/images/articles/').$article->image.'">';
                echo '</a>';
                echo '<aside class="photo-box-caption">';
                echo '<span>'.$article->title.'</span>';
                echo '</aside>';
                echo '</div>';
            } else {
                $counter = 0;
                echo '<div style="clear: both"></div></div><div class="row">';
                echo '<div class="photo-box col-66">';
                echo '<a href="'.\Kernel\Router::path('articles/'.$article->slug).'">';
                echo '<img src="'.\Kernel\Router::path('resources/images/articles/').$article->image.'">';
                echo '</a>';
                echo '<aside class="photo-box-caption">';
                echo '<span>'.$article->title.'</span>';
                echo '</aside>';
                echo '</div>';
            }
            // Przypadek 1 - 2
        } else if ($row % 3 == 1) {
            if ($counter == 0) {
                $counter += 1;
                echo '<div class="photo-box col-33">';
                echo '<a href="'.\Kernel\Router::path('articles/'.$article->slug).'">';
                echo '<img src="'.\Kernel\Router::path('resources/images/articles/').$article->image.'">';
                echo '</a>';
                echo '<aside class="photo-box-caption">';
                echo '<span>'.$article->title.'</span>';
                echo '</aside>';
                echo '</div>';
            } else {
                $counter = 0;
                echo '<div style="clear: both"></div></div><div class="row">';
                echo '<div class="photo-box col-33">';
                echo '<a href="'.\Kernel\Router::path('articles/'.$article->slug).'">';
                echo '<img src="'.\Kernel\Router::path('resources/images/articles/').$article->image.'">';
                echo '</a>';

                echo '<aside class="photo-box-caption">';
                echo '<span>'.$article->title.'</span>';
                echo '</aside>';
                echo '</div>';
            }
        } else {
            if ($counter < 3) {
                echo '<div class="photo-box col-33">';
                echo '<a href="'.\Kernel\Router::path('articles/'.$article->slug).'">';
                echo '<img src="'.\Kernel\Router::path('resources/images/articles/').$article->image.'">';
                echo '</a>';

                echo '<aside class="photo-box-caption">';
                echo '<span>'.$article->title.'</span>';
                echo '</aside>';
                echo '</div>';
                $counter++;
            }
            if ( $counter == 2) {
                $counter = 1;
                $row = 0;
            }
        }
    }
    echo '<div style="clear: both"></div></div>';
    ?>
</main>