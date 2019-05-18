<main class="user-content">
    <?php if (isset($this->error)) { echo '<div class="article-form-error">'.$this->error.'</div>'; } ?>
    <form class="articles-form" method="post" enctype="multipart/form-data" action="<?=\Kernel\Router::path('users/articles/create') ?>">
        <div class="articles-form-title">
            <label for="title">Tytuł:</label>
            <input id="title" type="text" name="title">
            <input id="slug-2" type="hidden" name="slug">
        </div>
        <div class="articles-form-slug">
            <label for="slug">Przyjazny adres:</label>
            <input id="slug" type="text" disabled>
        </div>
        <div style="clear: both"></div>
        <div class="articles-form-image">
            <input id="imgInp" type="file" name="image" accept="image/x-png,image/gif,image/jpeg">

            <img id="article-image" class="display-none" src="#">

        </div>
        <div style="clear: both"></div>

        <div class="article-form-textarea">
            <textarea name="content" id="editor-user">
            </textarea>
            <input class="btn btn-article-submit" type="submit" value="Zapisz">
        </div>

    </form>


    <script>
        ClassicEditor
            .create( document.querySelector( '#editor-user' ) )
            .catch( error => {
            console.error( error );
        } );
    </script>
</main>