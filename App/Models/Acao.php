<?php
    namespace App\Models;

    use MF\Model\Model;

    class Acao extends Model{
        private $id, $id_titulo;

        public function __get($atributo){
            return $this->$atributo;
        }
        public function __set($atributo, $valor){
            $this->$atributo = $valor;
        }

        public function getFilmes(){
            $query = "SELECT filmes.id, filmes.titulo, filmes.descricao, filmes.diretor, filmes.avaliacao, filmes.lancamento, filmes.poster
            FROM filmes
            INNER JOIN acao ON filmes.id=acao.id_titulo";
            $stmt = $this->db->prepare($query);
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
        public function getSeries(){
            $query = "SELECT series.id, series.titulo, series.descricao, series.temporadas, series.avaliacao, series.lancamento, series.poster
            FROM series
            INNER JOIN acao ON series.id=acao.id_titulo";
            $stmt = $this->db->prepare($query);
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
    }
?>