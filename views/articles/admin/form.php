<?php
    if (!empty($this->article && $this->article)) {
        echo $this->article->title;
        echo '<img src="'.\Kernel\Router::path('resources/images/articles/').$this->article->image.'" width="500px" height="500px">';
    }
?>
