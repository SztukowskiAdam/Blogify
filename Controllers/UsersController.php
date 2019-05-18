<?php
namespace Controllers;

use DTO\UsersDTO;
use Kernel\Auth;
use Kernel\Controller;
use Kernel\View;
use Models\Article;
use Models\ArticleComment;
use Models\ArticleRating;
use Models\Users;

class UsersController extends Controller
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

    public function index(): View {
        if ($user = Auth::user()) {
            $this->view->articles = $this->articles->where('authorId', '=', $user->id, 'createdAt', 'DESC');
            return $this->view->render('users/articles/index');
        }
        return $this->redirect('/');
    }

    public function login(): View {
        if (Auth::user()) {
            return $this->redirect('users/articles');
        }
        return $this->view->render('users/login/login');
    }

    public function attempt(): View {
        if (!empty($_POST)) {
            $user = Auth::attempt($_POST['email'], $_POST['password']);

            if (Auth::user()) {
                $this->view->user = $user;
                return $this->redirect('/');
            } else {
                $this->view->email = $_POST['email'];
            }
        }
        return $this->view->render('users/login/login');
    }

    public function register() {
        if (Auth::user()) {
            return $this->redirect('users/articles');
        }
        return $this->view->render('users/login/register');
    }

    public function storeUser() {
        $user = new UsersDTO();

        if (!Auth::user() && !empty($_POST)) {
            $user->name = $_POST['name'];
            $user->email = $_POST['email'];
            $user->password = $_POST['password'];
            $user->repeatPassword = $_POST['repeatPassword'];
            if ($auth = Auth::register($user) !== true) {
                $this->view->error = $auth;
                $this->view->user = $user;
                return $this->view->render('users/login/register');
            }
        }
        return $this->redirect('/');
    }

    public function dashboard(): View {
        if (Auth::isAdmin()) {
            $article = new Article();
            $this->view->countArticles = sizeof($article->getAll());
            $this->view->user = Auth::user();
            return $this->view->render('admin/dashboard/dashboard', 'adminLayout');
        }
        else return $this->redirect('/');
    }


    public function logout(): View {
        if (Auth::user()) {
            session_destroy();
        }
        return $this->redirect('/');
    }

}