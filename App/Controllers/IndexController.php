<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action {

	public function index(){
		$filmes = Container::getModel('Filme');
		$series = Container::getModel('Series');

		$this->view->filmes = $filmes->getFilmes();
		$this->view->series = $series->getSeries();

		// print($_SERVER['REMOTE_ADDR']); // id usuário para usar na avaliacao

		$this->render('index');
	}
	public function tipoFilme(){
		$tipo_filme = Container::getModel($_POST['genero']);

		if($_POST['tipo'] == 'filmes'){
			return print(json_encode($tipo_filme->getFilmes()));
		}else if($_POST['tipo'] == 'series'){
			return print(json_encode($tipo_filme->getSeries()));
		}
	}
	public function pesquisaVideo(){
		$filmes = Container::getModel('Filme');
		$series = Container::getModel('Series');

		$filmes_series = [$series->pesquisaSerie($_POST['video']), $filmes->pesquisaFilme($_POST['video'])];

		return print(json_encode($filmes_series));
	}
	public function avaliacaoVideo(){
		$filmes = Container::getModel('Filme');
		$series = Container::getModel('Series');

		if($_POST['tipo'] == 'filmes'){
			$retorno_avaliacao = [$filmes->setAvaliacao($_POST['id'], $_POST['avaliacao']), $_POST['id']];

			print(json_encode($retorno_avaliacao));
		}else{
			$retorno_avaliacao = [$series->setAvaliacao($_POST['id'], $_POST['avaliacao']), $_POST['id']];

			print(json_encode($retorno_avaliacao));
		}
	}

	public function assistir(){
		$filmes = Container::getModel('Filme');
		$series = Container::getModel('Series');

		$this->view->filmes = $filmes->getAssistir($_GET['id']);
		$this->view->series = $series->getAssistir($_GET['id']);

		$this->render('assistir');
	}

}


?>