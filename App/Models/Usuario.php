<?php
namespace App\Models;
use MF\Model\Model;

    class Usuario extends Model{
        private $id;
        private $nome_usuario;
        private $senha_usuario;
        private $cep;
        private $numero_usuario;
        private $cidade_usuario;
        private $endereco_usuario;
        private $complemento_usuario;

        public function __get($atributo){
            return $this->$atributo;
        }
        public function __set($atributo, $valor){
            $this->$atributo = $valor;
        }
        
         //Validar se um cadastro pode ser feito
        public function validarCadastro(){
           //Tratativa dos dados enviados pelo formulário
           // A fazer
           return true;
        }

         //Salvar
        public function salvar(){
            $query = "INSERT INTO usuarios(nome_usuario, senha_usuario, cep, numero_usuario, cidade_usuario, endereco_usuario, complemento_usuario) VALUES(:nome_usuario, :senha_usuario, :cep, :numero_usuario, :cidade_usuario, :endereco_usuario,:complemento_usuario)";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':cep', $this->__get('cep'));
            $stmt->bindValue(':nome_usuario', $this->__get('nome_usuario'));
            $stmt->bindValue(':senha_usuario', $this->__get('senha_usuario'));
            $stmt->bindValue(':cidade_usuario', $this->__get('cidade_usuario'));
            $stmt->bindValue(':numero_usuario', $this->__get('numero_usuario'));
            $stmt->bindValue(':endereco_usuario', $this->__get('endereco_usuario')); 
            $stmt->bindValue(':complemento_usuario', $this->__get('complemento_usuario'));
            $stmt->execute();
            return $this;

        }

    }
?>