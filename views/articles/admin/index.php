<?php require ('views/layouts/adminNavbar.php'); ?>

<main class="admin-content">
    <table class="admin-articles-list">
        <thead>
            <td>ID</td>
            <td>Nazwa</td>
            <td>Data dodania</td>
            <td>Edycja</td>
        </thead>
        <tbody>
            <?php
                foreach ($this->articles as $article) {
                    $article = (object) $article;
                    echo '<tr>';
                        echo "<td>$article->id</td>";
                        echo "<td>$article->title</td>";
                        echo "<td>$article->createdAt</td>";
                        echo '<td><a href="'.\Kernel\Router::path('admin/articles/edit/'.$article->id).'">Edycja</a></td>';
                    echo '</tr>';
                }
            ?>
        </tbody>
    </table>
</main>