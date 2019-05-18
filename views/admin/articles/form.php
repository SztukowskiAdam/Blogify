<?php require ('views/layouts/adminNavbar.php'); ?>

<main class="admin-content">
    <?php if (isset($this->error)) { echo '<div class="article-form-error">'.$this->error.'</div>'; } ?>
    <form class="articles-form" method="post" enctype="multipart/form-data" action="<?=\Kernel\Router::path('admin/articles/save') ?>">
        <input type="hidden" name="id" value="<?= $this->article->id?>">
        <div class="articles-form-title">
            <label for="title">Tytuł:</label>
            <input id="title" type="text" name="title" value="<?= $this->article->title?>">
            <input id="slug-2" type="hidden" name="slug" value="<?= $this->article->slug ?>">
        </div>
        <div class="articles-form-slug">
            <label for="slug">Przyjazny adres:</label>
            <input id="slug" type="text" value="<?= $this->article->slug ?>" disabled>
        </div>
        <div style="clear: both"></div>
        <div class="articles-form-image">
            <input id="imgInp" type="file" name="image" accept="image/x-png,image/gif,image/jpeg">

            <?php if (!empty($this->article->image)) {
                echo '<img id="article-image" src="'.\Kernel\Router::path('resources/images/articles/'.$this->article->image).'">';
            } else {
                echo '<img id="article-image" class="display-none" src="#">';
            }
            ?>
        </div>

        <div class="article-form-checkboxes">
            <div class="articles-form-home-page">
                Pokaż na stronie głównej
                <input type="checkbox" name="homePage" <?php if (!empty($this->article->homePage)) echo 'checked'?>>
            </div>
            <div class="articles-form-in-slider">
                Pokazuj w sliderze
                <input type="checkbox" name="inSlider" <?php if (!empty($this->article->inSlider)) echo 'checked'?>>
            </div>
            <div class="article-form-status">
                Status:
                <select name="status">
                    <option value="1" <?php if (!empty($this->article->status) && $this->article->status == 1) echo 'selected="selected"'?>>Oczekuje</option>
                    <option value="2" <?php if (!empty($this->article->status) && $this->article->status == 2) echo 'selected="selected"'?>>Zaakceptowany</option>
                    <option value="3" <?php if (!empty($this->article->status) && $this->article->status == 3) echo 'selected="selected"'?>>Odrzucony</option>
                </select>
            </div>
        </div>
        <div style="clear: both"></div>

        <div class="article-form-textarea">
            <textarea name="content" id="editor">
                <?= $this->article->content ?>
            </textarea>
            <input class="btn btn-article-submit" type="submit" value="Zapisz">
        </div>

    </form>


    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
            console.error( error );
        } );
    </script>
</main>