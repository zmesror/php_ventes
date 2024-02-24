<?php
require '../vendor/autoload.php';



$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$router = new App\Router(dirname(__DIR__) . '/views');
$router
    ->get('/', 'item/index', 'home')
    ->get('/item/[*:name]-[i:id]', 'item/show', 'item')
    ->match('/login', 'auth/login', 'login')
    ->match('/logout', 'auth/logout', 'logout')
    ->match('/signup', 'auth/signup', 'signup')
    ->get('/admin', 'admin/item/index', 'admin')
    ->match('/admin/item/[i:id]', 'admin/item/edit', 'admin_item_update')
    ->post('/admin/item/[i:id]/delete', 'admin/item/delete', 'admin_item_delete')
    ->match('/admin/item/new', 'admin/item/new', 'admin_item_new')
    ->get('/about', 'about', 'about')
    ->run();

