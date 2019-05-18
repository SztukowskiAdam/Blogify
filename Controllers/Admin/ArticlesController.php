<?php

namespace Controllers\Admin;

use Kernel\Auth;
use Kernel\Controller;
use Kernel\View;
use Models\Article;
use Models\ArticleComment;
use Models\ArticleRating;

class ArticlesController extends Controller
{
    private $articles, $articleComments, $articleRatings;

    public function __construct() {
        parent::__construct();

        $this->articles = new Article();
        $this->articleComments = new ArticleComment();
        $this->articleRatings = new ArticleRating();
    }

    public function adminIndex(): View {
        if (Auth::isAdmin()) {
            $this->view->articles = $this->articles->getAll('createdAt', 'DESC');
            return $this->view->render('admin/articles/index', 'adminLayout');
        }
        return $this->redirect('/');
    }

    public function save(): View {
        if (!empty($_POST) && Auth::isAdmin()) {
            $article = [];

            if (!empty($_POST['title'])) {
                $article['title'] = $_POST['title'];
            } else {
                $this->view->error = 'Pusty tytuł!';
                $this->view->article = (object)$_POST;
                return $this->view->render('admin/articles/form', 'adminLayout');
            }

            if (!empty($_POST['slug']) && $_POST['slug'] === strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $_POST['slug'])))) {
                $article['slug'] = $_POST['slug'];
            } else {
                $this->view->error = 'Przyjazny adres jest błędny!';
                $this->view->article = (object)$_POST;
                return $this->view->render('admin/articles/form', 'adminLayout');
            }

            if (!empty($_POST['content'])) {
                $article['content'] = $_POST['content'];
            } else {
                $this->view->error = 'Pusta treść';
                $this->view->article = (object)$_POST;
                return $this->view->render('admin/articles/form', 'adminLayout');
            }

            if (!empty($_POST['homePage'])) {
                $article['homePage'] = 1;
            } else {
                $article['homePage'] = 0;
            }

            if (!empty($_POST['inSlider'])) {
                $article['inSlider'] = 1;
            } else {
                $article['inSlider'] = 0;
            }

            if (!empty($_POST['status'])) {
                $article['status'] = $_POST['status'];
            } else {
                $article['status'] = 1;
            }

            if (!empty($_FILES['image']['name'])) {
                $imagePath = "resources/images/articles/";
                $uniquesavename=time().uniqid(rand());
                $ext = substr($_FILES['image']['name'], strrpos($_FILES['image']['name'], '.'));
                $destFile = $imagePath . $uniquesavename . $ext;
                $filename = $_FILES["image"]["tmp_name"];
                if (file_exists($destFile)) {
                    $this->view->error = 'Plik już istnieje!';
                    $this->view->article = (object)$_POST;
                    return $this->view->render('admin/articles/form', 'adminLayout');
                }else{
                    move_uploaded_file($filename,  $destFile);
                    $article['image'] = $uniquesavename.$ext;
                }
            } else if (empty($_POST['id'])){
                $this->view->error = 'Nie załadowano pliku!';
                $this->view->article = (object)$_POST;
                return $this->view->render('admin/articles/form', 'adminLayout');
            }

            if (!empty($_POST['id'])) {;
                if ($this->articles->update($article, $_POST['id'])) {
                    return $this->redirect('admin/articles');
                } else {
                    $this->view->error = 'Błąd w czasie aktualizacji artykułu!';
                    $this->view->article = (object)$_POST;
                    return $this->view->render('admin/articles/form', 'adminLayout');
                }
            } else {
                $article['authorId'] = Auth::user()->id;
                if ($this->articles->save($article)) {
                    return $this->redirect('admin/articles');
                } else {
                    $this->view->error = 'Błąd w czasie tworzenia artykułu!';
                    $this->view->article = (object)$_POST;
                    return $this->view->render('admin/articles/form', 'adminLayout');
                }
            }
        }
        return $this->redirect('admin/dashboard');
    }

    public function create(): View {
        $this->view->article = new Article();
        return $this->view->render('admin/articles/form', 'adminLayout');
    }

    public function edit(): View {
        if (Auth::isAdmin()) {
            $this->view->article = $this->articles->find((int)func_get_args()[0]);
            return $this->view->render('admin/articles/form', 'adminLayout');
        }
        return $this->redirect('/');
    }

    public function delete(): View {

        if (Auth::isAdmin() && !empty(func_get_args()[0])) {
            $articleId = (int) func_get_args()[0];
            $this->articleRatings->deleteWhere('articleId', '=', $articleId);
            $this->articleComments->deleteWhere('articleId', '=', $articleId);
            $this->articles->delete($articleId);

            return $this->redirect('admin/articles');
        }
        return $this->redirect('/');
    }
}