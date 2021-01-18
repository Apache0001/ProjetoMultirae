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
    public function IMGMutiroes(){
            //Pegando valores do formulário
            $status = 'false';
            $novoNome = '';
            //Nome da imagem
            //Caminho da imagem
            $img =  $_FILES['imagem-mutira']['name'];
            $arquivo_tmp = $_FILES['imagem-mutira']['tmp_name'];

            $extensao = pathinfo($img, PATHINFO_EXTENSION);
            $extensao =  strtolower($extensao);
            
            if(strstr('.jpg;.jpeg;.gif;.png', $extensao)){
                $novoNome = uniqid(time()).'.'.$extensao;
                $destino = 'img/mutiroes/'.$novoNome;

                if(@move_uploaded_file($arquivo_tmp, $destino)){
                    $status = true;
                }
            }
            return array(
                'status' => $status,
                'novoNome' => $novoNome
            );

    }
    
     //Deletar Mutiroes
     public function removeMutiroes(){
        $query = "DELETE FROM mutiroes where id_usuario = :id_usuario and id_mutirao = :id_mutirao";
        $stmt =  $this->db->prepare($query);
        $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
        $stmt->bindValue(':id_mutirao', $this->__get('id_mutirao'));
        $stmt->execute();
        return $this;
    
    }

    public function getMutiroes(){
        $query = "SELECT id_mutirao, id_usuario, titulo, texto, data_mutirao, img_mutirao, localidade from mutiroes order by data_mutirao desc";
        $stmt =  $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    

}

?>