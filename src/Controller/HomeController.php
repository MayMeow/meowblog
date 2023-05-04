<?php
declare(strict_types=1);

namespace MeowBlog\Controller;

use Cake\Routing\Router;

/**
 * Home Controller
 */
class HomeController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        // dd(Router::fullBaseUrl());
        $this->Authorization->skipAuthorization();
    }
}
