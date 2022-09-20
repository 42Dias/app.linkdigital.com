<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Controller\Component\RequestHandlerComponent;
use Cake\Network\Request;
use Cake\I18n\Date;
use Cake\I18n\Time;


class EmailController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    public function display()
    {
        $this->viewBuilder()->Layout('email');
        $this->set('title', 'E-mail - Sr. Invest');

        $path = func_get_args();

        $count = count($path);
        if (!$count) {
            return $this->redirect('/');
        }
        $page = $subpage = null;

        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }

        $this->set(compact('page', 'subpage'));

        try {
            $this->render(implode('/', $path));
        } catch (MissingTemplateException $e) {
            if (Configure::read('debug')) {
                throw $e;
            }
            throw new NotFoundException();
        }

    }

}
