<?php
    namespace App\ModelS;

    use MF\Model\Model;

    class Series extends Model{
        private $id, $titulo, $descricao, $temporadas, $avaliacao, $lancamento, $poster;

        public function __get($atributo){
            return $this->$atributo;
        }
        public function __set($atributo, $valor){
            $this->$atributo = $valor;
        }

        // RECUPERA SÉRIES
        public function getSeries(){
            $query = "SELECT id, titulo, avaliacao, poster
            FROM series LIMIT 25";
            $stmt = $this->db->prepare($query);
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function pesquisaSerie($caracter){
            if($caracter != ''){
                $query = "SELECT id, titulo FROM series WHERE titulo LIKE '$caracter%' LIMIT 10";
                $stmt = $this->db->prepare($query);
                $stmt->execute();
    
                return $stmt->fetchAll(\PDO::FETCH_ASSOC);
            }
        }

        public function setAvaliacao($id, $avaliacao){
        $query = "UPDATE `series` SET `avaliacao`=`avaliacao`+{$avaliacao} WHERE `id`={$id}";
            $stmt = $this->db->prepare($query);
            $stmt->execute();

            $query = "SELECT `id`, `avaliacao` FROM `series` WHERE `id`=$id";
            $stmt = $this->db->prepare($query);
            $stmt->execute();

            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }
        
        public function getAssistir($id){
            $query = "SELECT id, titulo, descricao, temporadas, avaliacao, lancamento, poster, trailer FROM series WHERE id=$id";
            $stmt = $this->db->prepare($query);
            $stmt->execute();

            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }
    }
?>