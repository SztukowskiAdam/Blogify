<?php
namespace Controllers;

use Kernel\Auth;
use Kernel\Controller;
use Kernel\View;
use Models\Article;
use Models\ArticleComment;
use Models\ArticleRating;
use Models\Users;

class ArticlesController extends Controller
{
    private $articles, $users, $articlesRating, $articleComment;

    public function __construct()
    {
        parent::__construct();

        $this->articles = new Article();
        $this->users = new Users();
        $this->articlesRating = new ArticleRating();
        $this->articleComment = new ArticleComment();
    }

    public function create(): View {
        if ($user = Auth::user()) {
            return $this->view->render('users/articles/form');
        }
        return $this->redirect('users/articles');
    }

    public function store(): View {
        if (!empty($_POST) && Auth::user()) {
            $article = [];

            if (!empty($_POST['title'])) {
                $article['title'] = $_POST['title'];
            } else {
                $this->view->error = 'Pusty tytuł!';
                $this->view->article = (object)$_POST;
                return $this->view->render('users/articles/form');
            }

            if (!empty($_POST['slug']) && $_POST['slug'] === strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $_POST['slug'])))) {
                $article['slug'] = $_POST['slug'];
            } else {
                $this->view->error = 'Przyjazny adres jest błędny!';
                $this->view->article = (object)$_POST;
                return $this->view->render('users/articles/form');
            }

            if (!empty($_POST['content'])) {
                $article['content'] = $_POST['content'];
            } else {
                $this->view->error = 'Pusta treść';
                $this->view->article = (object)$_POST;
                return $this->view->render('users/articles/form');
            }


            $article['homePage'] = 0;
            $article['inSlider'] = 0;
            $article['status'] = 1;

            if (!empty($_FILES['image']['name'])) {
                $imagePath = "resources/images/articles/";
                $uniquesavename=time().uniqid(rand());
                $ext = substr($_FILES['image']['name'], strrpos($_FILES['image']['name'], '.'));
                $destFile = $imagePath . $uniquesavename . $ext;
                $filename = $_FILES["image"]["tmp_name"];
                if (file_exists($destFile)) {
                    $this->view->error = 'Plik już istnieje!';
                    $this->view->article = (object)$_POST;
                    return $this->view->render('users/articles/form');
                }else{
                    move_uploaded_file($filename,  $destFile);
                    $article['image'] = $uniquesavename.$ext;
                }
            }


            $article['authorId'] = Auth::user()->id;
            if ($this->articles->save($article)) {
                return $this->redirect('users/articles');
            } else {
                $this->view->error = 'Błąd w czasie tworzenia artykułu!';
                $this->view->article = (object)$_POST;
                return $this->view->render('users/articles/form');
            }
        }
        return $this->redirect('users/articles');
    }

}