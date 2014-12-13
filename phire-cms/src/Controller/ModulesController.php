<?php

namespace Phire\Controller;

use Phire\Form;
use Pop\Http\Response;

class ModulesController extends AbstractController
{

    public function index()
    {
        $this->prepareView('modules.phtml');
        $this->view->title = 'Modules';
        $this->response->setBody($this->view->render());
        $this->send();
    }

}