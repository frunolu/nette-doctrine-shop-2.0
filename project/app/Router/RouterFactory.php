<?php

declare(strict_types=1);

namespace App\Router;

use Nette;
use Nette\Application\Routers\RouteList;


final class RouterFactory
{
	use Nette\StaticClass;

	public static function createRouter(): RouteList
	{
		$router = new RouteList;
        $router[] = $frontRouter = new RouteList('Front');
        $frontRouter->addRoute('','Homepage:default');
        $frontRouter->addRoute('<slug [a-z-]+>','Category:default');
        $frontRouter->addRoute('product/<slug [a-z-]+>','Product:default');
//        $router->addRoute('<slug [a-z-]+>','Category:default');
//        $router->addRoute('product/<slug [a-z-]+>','Product:default');
//		$router->addRoute('<presenter>/<action>[/<id>]', 'Homepage:default');
		return $router;
	}
}
