<?php require ('views/layouts/adminNavbar.php'); ?>

<main class="admin-content">
    <table class="admin-articles-list">
        <thead>
            <td>ID</td>
            <td>Nazwa</td>
            <td>Na stronie głównej</td>
            <td>W sliderze</td>
            <td>Data dodania</td>
            <td>Akcje</td>
        </thead>
        <tbody>
            <?php
                foreach ($this->articles as $article) {
                    $article = (object) $article;
                    echo '<tr>';
                        echo "<td>$article->id</td>";
                        echo "<td>$article->title</td>";
                        if ($article->homePage) {
                            echo "<td><i class=\"fas fa-check-circle green\"></i></td>";
                        } else {
                            echo "<td><i class=\"fas fa-times-circle red\"></i></td>";
                        }
                        if ($article->inSlider) {
                            echo "<td><i class=\"fas fa-check-circle green\"></i></td>";
                        } else {
                            echo "<td><i class=\"fas fa-times-circle red\"></i></td>";
                        }
                        echo "<td>$article->createdAt</td>";
                        echo '<td>';
                            echo '<a href="'.\Kernel\Router::path('admin/articles/edit/'.$article->id).'">Edycja</a>';
                            echo '<a href="'.\Kernel\Router::path('articles/'.$article->slug).'">Podgląd</a>';
                            echo '<a href="'.\Kernel\Router::path('admin/articles/delete/'.$article->id).'">Usuń</a>';
                        echo '</td>';
                    echo '</tr>';
                }
            ?>
        </tbody>
    </table>
</main>