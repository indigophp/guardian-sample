<?php

/*
 * This file is part of the Indigo Guardian Test project.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require __DIR__.'/../vendor/autoload.php';

use Proton\Application;
use League\Container\Container;

define('APPPATH', realpath(__DIR__.'/../app/').'/');

$bootstrap = require APPPATH.'bootstrap.php';
$container = new Container($bootstrap);

$app = new Application;
$app->setContainer($container);

$app->get('/', 'controller::index');
$app->post('/login', 'controller::login');
$app->get('/logout', 'controller::logout');

$app->run();
