<div id="slider">
    <div id="slider-wrapper">
<?php
foreach ($this->slider as $article) {
    $article = (object) $article;
    echo '<div class="slide">';
    echo '<a href="'.\Kernel\Router::path('articles/'.$article->slug).'">';
        echo '<img src="'.\Kernel\Router::path('resources/images/articles/'.$article->image).'" alt="" />';
        echo '<p class="caption">'.$article->title.'</p>';
    echo '</a>';
    echo '</div>';
}
echo '</div><div id="slider-nav">';

$counter = 1;
for ($i = 0; $i < sizeof($this->slider); $i++) {
    echo '<a href="#" data-slide="'.$i.'">'.$counter.'</a>';
    $counter ++;
}
?>
    </div>
</div>
