<?php
namespace App\Models;
use MF\Model\Model;

class Mutira extends Model{
    private $id;
    private $id_usuario;
    private $mutira;
    private $data;

    public function __get($atributo){
        return $this->$atributo;
    }
    public function __set($atributo, $valor){
        $this->$atributo = $valor;
    }

    // Salvar um mutira

    public function salvar(){
        $query = "INSERT INTO mutiras (id_usuario, mutira) VALUES(:id_usuario, :mutira)";
        $stmt =  $this->db->prepare($query);
        $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
        $stmt->bindValue(':mutira', $this->__get('mutira'));
        $stmt->execute();
        return $this;
    }

     //Deletar Mutirae
     public function removeMutira(){
        $query = "DELETE FROM mutiras where id_usuario = :id_usuario and mutira = :mutira";
        $stmt =  $this->db->prepare($query);
        $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
        $stmt->bindValue(':mutira', $this->__get('mutira'));
        $stmt->execute();
        return $this;
    
    }
    //Recuperar mutira de outras pessoas
    public function getAll(){

        $query = "
        SELECT
             m.id, m.id_usuario, u.nome_usuario, m.mutira , DATE_FORMAT(m.data,'%d/%m/%Y %H:%i') as data 
        FROM 
            mutiras as m left join usuarios as u on (m.id_usuario = u.id_usuario) 
            
        ORDER by 
            m.data desc
        ";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    //Contanto o numero de mutiras

    public function contMutira(){
        $query ="SELECT count(*) from mutiras where id_usuario = :id_usuario ";

        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }


}

?>