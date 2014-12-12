<?php

namespace Phire\Controller;

use Phire\Form;
use Pop\Http\Response;
use Pop\View\View;

class IndexController extends AbstractController
{

    public function index()
    {
        if (!isset($this->sess->user)) {
            Response::redirect(BASE_PATH . APP_URI . '/login');
        } else {
            echo 'Hello Phire!';
        }
    }

    public function login()
    {
        if (isset($this->sess->user)) {
            Response::redirect(BASE_PATH . APP_URI);
        } else {
            $view        = new View($this->viewPath . '/login.phtml');
            $view->title = 'Login';
            $view->form  = new Form\Login();

            if ($this->request->isPost()) {
                $view->form->setFieldValues($this->request->getPost(), [
                    'strip_tags'         => null,
                    'html_entity_decode' => [ENT_QUOTES, 'UTF-8']
                ]);
                if ($view->form->isValid()) {
                    echo 'Good!';
                    exit();
                }
            }

            $this->response->setBody($view->render());
            $this->send();
        }
    }

    public function logout()
    {
        $this->sess->kill();
        Response::redirect(BASE_PATH . APP_URI . '/login');
    }

    public function error()
    {

        $view = new View($this->viewPath . '/error.phtml');
        $view->title = 'Error';

        $this->response->setBody($view->render());
        $this->send(404);
    }

}