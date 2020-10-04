<?php

namespace App;

use MF\Init\Bootstrap;

class Route extends Bootstrap {

	protected function initRoutes() {

		$routes['home'] = array(
			'route' => '/',
			'controller' => 'indexController',
			'action' => 'index'
		);
		$routes['tipoFilme'] = array(
			'route' => '/tipoFilme',
			'controller' => 'indexController',
			'action' => 'tipoFilme'
		);
		$routes['pesquisaVideo'] = array(
			'route' => '/pesquisa_video',
			'controller' => 'indexController',
			'action' => 'pesquisaVideo'
		);
		$routes['avaliacaoVideo'] = array(
			'route' => '/avaliacao_video',
			'controller' => 'indexController',
			'action' => 'avaliacaoVideo'
		);
		$routes['assistir'] = array(
			'route' => '/assistir',
			'controller' => 'indexController',
			'action' => 'assistir'
		);

		$this->setRoutes($routes);
	}

}

?>