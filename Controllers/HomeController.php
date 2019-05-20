<?php
namespace Controllers;

use Kernel\Auth;
use Kernel\Controller;
use Kernel\View;
use Models\Article;
use Models\ArticleComment;
use Models\ArticleRating;
use Models\Users;

class HomeController extends Controller
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

    /**
     * Renders index view
     * @return View
     */
    public function index(): View {
        $params = [
            'homePage' => 1,
            'status' => 2,
        ];

        $this->view->articles = $this->articles->whereData($params);
        return $this->view->render('home/index');
    }

    public function articles(): View {
        $this->view->articles = $this->articles->where('status', '=', 2, 'createdAt', 'DESC');
        return $this->view->render('articles/index');
    }

    public function show(): View {
        $slug = func_get_args()[0];
        $article = $this->articles->where('slug', '=', $slug);

        if (!empty($article)) {
            if ($article[0]['status'] != 2 && !Auth::isAdmin() && $article[0]['authorId'] != Auth::user()->id) {
                return $this->redirect('/');
            }
            $ratio = $this->articlesRating->selectRaw('SELECT AVG(ratio) as average FROM  article_rating WHERE articleId = '.$article[0]['id'].' GROUP BY articleId');
            if (Auth::user()) {
                $userRatio = $this->articlesRating->whereData(['userId' => Auth::user()->id, 'articleId' => $article[0]['id']]);
            } else {
                $userRatio = '';
            }

            if (!empty($userRatio)) {
                $this->view->userRatio = $userRatio[0]['ratio'];
            }
            if (empty($ratio)) {
                $average = 'Brak ocen';
            } else {
                $average = round($ratio[0]['average'],2);
            }
            $author = $this->users->find($article[0]['authorId']);
            $article[0]['author'] = $author->name;
            $article[0]['average'] = $average;
            $this->view->article = (object) $article[0];

            $comments = $this->articleComment->selectRaw('SELECT 
                ac.content as content, 
                ac.createdAt as createdAt,
                u.name as name
                FROM article_comments as ac 
                JOIN users as u ON ac.userId = u.id 
                WHERE ac.articleId = '.$this->view->article->id.
                ' ORDER BY ac.createdAt DESC'
            );
            $this->view->comments = $comments;
            return $this->view->render('articles/show');
        }
        return $this->redirect('/');
    }
}