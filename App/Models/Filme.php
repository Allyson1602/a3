<?php
    namespace App\Models;

    use MF\Model\Model;
    
    class Filme extends Model{
        private $id, $titulo, $descricao, $autor, $avaliacao, $lancamento, $poster;

        public function __get($atributo){
            return $this->$atributo;
        }
        public function __set($atributo, $valor){
            $this->$atributo = $valor;
        }

        // RECUPERA FILMES
        public function getFilmes(){
            $query = "SELECT id, titulo, avaliacao, poster 
                FROM filmes LIMIT 25";
            $stmt = $this->db->prepare($query);
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function pesquisaFilme($caracter){
            if($caracter != ''){
                $query_filmes = "SELECT id, titulo FROM filmes WHERE titulo LIKE '$caracter%' LIMIT 10";
                $stmt = $this->db->prepare($query_filmes);
                $stmt->execute();

                return $stmt->fetchAll(\PDO::FETCH_ASSOC);
            }
        }

        public function setAvaliacao($id, $avaliacao){
            $query = "UPDATE `filmes` SET `avaliacao`=`avaliacao`+{$avaliacao} WHERE `id`={$id}";
            $stmt = $this->db->prepare($query);
            $stmt->execute();

            $query = "SELECT `id`, `avaliacao` FROM `filmes` WHERE `id`=$id";
            $stmt = $this->db->prepare($query);
            $stmt->execute();

            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }

        public function getAssistir($id){
            $query = "SELECT id, titulo, descricao, diretor, avaliacao, lancamento, poster, trailer FROM filmes WHERE id=$id";
            $stmt = $this->db->prepare($query);
            $stmt->execute();

            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }
    }
?>