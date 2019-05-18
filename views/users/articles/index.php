<main class="user-content">
    <div class="add-article-btn">
        <a class="btn" href="<?=\Kernel\Router::path('users/articles/create')?>">Dodaj artykuł</a>
    </div>
    <table class="articles-list">
        <thead>
            <td>ID</td>
            <td>Nazwa</td>
            <td>Status</td>
            <td>Data dodania</td>
            <td>Akcje</td>
        </thead>
        <tbody>
            <?php
                if (empty($this->articles)) {
                    echo '<tr>';
                    echo '<td colspan=5 style="text-align: center">';
                    echo 'Brak artykułów';
                    echo '</td>';
                    echo '</tr>';
                }
                foreach ($this->articles as $article) {
                    $article = (object) $article;
                    echo '<tr>';
                        echo "<td>$article->id</td>";
                        echo "<td>$article->title</td>";
                        if ($article->status == 1) {
                            echo "<td><i class=\"fas fa-exclamation-triangle yellow\"></i> Oczekuje na akceptację</td>";
                        } else if ($article->status == 2) {
                            echo "<td><i class=\"fas fa-check-circle green\"></i> Zaakceptowany</td>";
                        } else {
                            echo "<td><i class=\"fas fa-times-circle red\"></i> Odrzucony</td>";
                        }
                        echo "<td>$article->createdAt</td>";
                        echo '<td>';
                            echo '<a href="'.\Kernel\Router::path('articles/'.$article->slug).'">Podgląd</a>';
                        echo '</td>';
                    echo '</tr>';
                }
            ?>
        </tbody>
    </table>
</main>