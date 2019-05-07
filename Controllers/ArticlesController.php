<?php

namespace Controllers;

use Kernel\Auth;
use Kernel\Controller;
use Kernel\View;
use Models\Article;

class ArticlesController extends Controller
{
    private $articles;

    public function __construct() {
        parent::__construct();

        $this->articles = new Article();
    }

    public function index(): View {
        $this->view->articles = $this->articles->getAll('createdAt', 'DESC');
        return $this->view->render('articles/index');
    }

    public function show(): View {
        $slug = func_get_args()[0];
        $article = $this->articles->where('slug', '=', $slug);

        if (!empty($article)) {
            $this->view->article = (object) $article[0];
            return $this->view->render('articles/show');
        }
        return $this->redirect('/');
    }

    public function adminIndex(): View {
        if (Auth::user()) {
            $this->view->articles = $this->articles->getAll('createdAt', 'DESC');
            return $this->view->render('articles/admin/index');
        }
        return $this->redirect('/');
    }

    public function save(): View {
        if (!empty($_POST)) {
            $article = [];

            if (!empty($_POST['title'])) {
                $article['title'] = $_POST['title'];
            } else {
                $this->view->error = 'Pusty tytuł!';
                $this->view->article = (object)$_POST;
                return $this->view->render('articles/admin/form');
            }

            if (!empty($_POST['slug']) && $_POST['slug'] === strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $_POST['slug'])))) {
                $article['slug'] = $_POST['slug'];
            } else {
                $this->view->error = 'Przyjazny adres jest błędny!';
                $this->view->article = (object)$_POST;
                return $this->view->render('articles/admin/form');
            }

            if (!empty($_POST['content'])) {
                $article['content'] = $_POST['content'];
            } else {
                $this->view->error = 'Pusta treść';
                $this->view->article = (object)$_POST;
                return $this->view->render('articles/admin/form');
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

            if (!empty($_FILES['image']['name'])) {
                $imagePath = "resources/images/articles/";
                $uniquesavename=time().uniqid(rand());
                $ext = substr($_FILES['image']['name'], strrpos($_FILES['image']['name'], '.'));
                $destFile = $imagePath . $uniquesavename . $ext;
                $filename = $_FILES["image"]["tmp_name"];
                if (file_exists($destFile)) {
                    $this->view->error = 'Plik już istnieje!';
                    $this->view->article = (object)$_POST;
                    return $this->view->render('articles/admin/form');
                }else{
                    move_uploaded_file($filename,  $destFile);
                    $article['image'] = $uniquesavename.$ext;
                }
            } else if (empty($_POST['id'])){
                $this->view->error = 'Nie załadowano pliku!';
                $this->view->article = (object)$_POST;
                return $this->view->render('articles/admin/form');
            }

            if (!empty($_POST['id'])) {
                if ($this->articles->update($article, $_POST['id'])) {
                    return $this->redirect('admin/articles');
                } else {
                    $this->view->error = 'Błąd w czasie aktualizacji artykułu!';
                    $this->view->article = (object)$_POST;
                    return $this->view->render('articles/admin/form');
                }
            } else {
                if ($this->articles->save($article)) {
                    return $this->redirect('admin/articles');
                } else {
                    $this->view->error = 'Błąd w czasie tworzenia artykułu!';
                    $this->view->article = (object)$_POST;
                    return $this->view->render('articles/admin/form');
                }
            }
        }
        return $this->redirect('admin/dashboard');
    }

    public function create(): View {
        $this->view->article = new Article();
        return $this->view->render('articles/admin/form');
    }

    public function edit(): View {
        if (Auth::user()) {
            $this->view->article = $this->articles->find((int)func_get_args()[0]);
            return $this->view->render('articles/admin/form');
        }
        return $this->redirect('/');
    }
}