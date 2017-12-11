<?php
/**
 * Created by PhpStorm.
 * User: gavlak
 * Date: 06/02/17
 * Time: 12:49
 */

/**
 * Authentication
 */
$router->post('/login', 'SessionsController#create');
$router->post('/sign-up', 'SignupController#create');
$router->delete('/logout', 'SessionsController#destroy');

/* Users */
$router->get('/users', 'UserController#index');
$router->get('/users/:id', 'UserController#show');
$router->get('/current_user', 'UserController#current_user');

$router->patch('/users/:id', 'UserController#update');
$router->delete('/users/:id', 'UserController#destroy');

/**
 * Application
 */
$router->get('/', 'PagesController#index');
$router->post('/', 'PagesController#create');

/* Projects */
$router->get('/projects', 'ProjectsController#index');
$router->post('/projects', 'ProjectsController#create');

$router->get('/projects/:id', 'ProjectsController#show');
$router->patch('/projects/:id', 'ProjectsController#update');
$router->delete('/projects/:id', 'ProjectsController#destroy');

$router->post('/projects/:id/trackings', 'TrackingsController#create');
$router->post('/trackings/:id', 'TrackingsController#create');
$router->patch('/trackings/:id', 'TrackingsController#update');
$router->delete('/trackings/:id', 'TrackingsController#destroy');

/* Trackings */
$router->get('/trackings', 'TrackingsController#day');