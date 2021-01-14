<?php
    namespace App\Controllers ;
    // Os recurso do miniframework
    use MF\Controller\Action ;
    use MF\Model\Conteiner;

    class AppController extends Action{

        public function timeline(){
            //Verifica se o usuário está logado
            $this->validaAutenticacao();

            $this->render('timeline','layoutApp');
        }

        //acesso restrito
        public function acessorestrito(){
            $this->render('acessorestrito', 'layoutAcesso');
        }
        //Validação de autenticação

        public function validaAutenticacao(){
            session_start();
            if(!isset($_SESSION['id']) || $_SESSION['id'] == '' ||  !isset($_SESSION['nome']) || $_SESSION['nome'] == ''){
                header('Location: /acessorestrito');
            }
        }

    }
?>