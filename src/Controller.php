<?php

/*
 * This file is part of the Indigo Guardian Test project.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Guardian;

use Proton\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Main controller
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Controller
{
    /**
     * @var Application
     */
    private $app;

    /**
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Index action displaying the main site
     *
     * @param Request  $request
     * @param Response $response
     * @param array    $args
     *
     * @return Response
     */
    public function index(Request $request, Response $response, array $args)
    {
        $service = $this->app->getContainer()->get('Indigo\Guardian\Service\Resume');

        if ($service->check()) {
            $response->setContent("<h1>It Works!</h2>\n<br><a href=\"/logout\">Logout</a>");
        } else {
            $template = file_get_contents(APPPATH.'views/index.html');
            $response->setContent($template);
        }

        return $response;
    }

    /**
     * Login handler
     *
     * @param Request  $request
     * @param Response $response
     * @param array    $args
     *
     * @return Response
     */
    public function login(Request $request, Response $response, array $args)
    {
        $service = $this->app->getContainer()->get('Indigo\Guardian\Service\Login');

        $subject = [
            'username' => $request->request->get('username'),
            'password' => $request->request->get('password'),
        ];

        $service->login($subject);

        return new RedirectResponse('/');
    }

    /**
     * Logout handler
     *
     * @param Request  $request
     * @param Response $response
     * @param array    $args
     *
     * @return Response
     */
    public function logout(Request $request, Response $response, array $args)
    {
        $service = $this->app->getContainer()->get('Indigo\Guardian\Service\Logout');

        $service->logout();

        return new RedirectResponse('/');
    }
}
