<?php
namespace App\Models;
use MF\Model\Model;

class Mutiroes extends Model{
    private $id_mutirao;
    private $id_usuario;
    private $titulo;
    private $texto;
    private $data_mutirao;
    private $img;
    private $local;

    public function __get($atributo){
        return $this->$atributo;
    }
    public function __set($atributo, $valor){
        $this->$atributo = $valor;
    }

    // Salvar um mutira

    public function salvarMutiroes(){
        $query = "INSERT INTO mutiroes (id_usuario, titulo, texto, data_mutirao, img_mutirao, localidade) VALUES(:id_usuario, :titulo, :texto, :data_mutirao, :img, :localidade)";
        $stmt =  $this->db->prepare($query);
        $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
        $stmt->bindValue(':titulo', $this->__get('titulo'));
        $stmt->bindValue(':texto', $this->__get('texto'));
        $stmt->bindValue(':data_mutirao', $this->__get('data_mutirao'));
        $stmt->bindValue(':img', $this->__get('img'));
        $stmt->bindValue(':localidade', $this->__get('local'));
        $stmt->execute();
        return $this;
    }

}

?>