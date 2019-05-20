<?php

namespace Controllers\Admin;

use Kernel\Auth;
use Kernel\Controller;
use Kernel\View;
use Models\Settings;

class SettingsController extends Controller
{
    private $model;

    public function __construct() {
        parent::__construct();

        $this->model = new Settings();
    }

    public function edit() {
        $settings = $this->model->find(1);

        $this->view->settings = $settings;

        return $this->view->render('admin/settings/form', 'adminLayout');
    }

    public function save() {
        if (Auth::isAdmin() && !empty($_POST)) {
            $settings = [];
            $settings['id'] = 1;
            if ($_POST['backgroundColor']) {
                $settings['backgroundColor'] = $_POST['backgroundColor'];
            } else {
                $settings['backgroundColor'] = 'lavender';
            }

            if ($_POST['textColor']) {
                $settings['textColor'] = $_POST['textColor'];
            } else {
                $settings['textColor'] = 'black';
            }

            if ($_POST['linkColor']) {
                $settings['linkColor'] = $_POST['linkColor'];
            } else {
                $settings['linkColor'] = 'black';
            }
            if ($this->model->update($settings, 1)) {
                return $this->refresh();
            } else {
                $this->view->error = 'Wystąpił błąd! Proszę spróbować ponownie';
                return $this->view->render('admin/settings/form', 'adminLayout');
            }
        }
        return $this->redirect('/');
    }
}