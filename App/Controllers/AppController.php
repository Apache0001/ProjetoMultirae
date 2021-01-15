<?php
    namespace App\Controllers ;
    // Os recurso do miniframework
    use MF\Controller\Action ;
    use MF\Model\Conteiner;

    class AppController extends Action{

        public function timeline(){
            //Verifica se o usuário está logado
            $this->validaAutenticacao();
             // Recuperação dos tweets
             $mutira = Conteiner::getModel('Mutira');
             $mutira->__set('id_usuario',$_SESSION['id']);
             $mutiras = $mutira->getAll();
             $this->view->mutiras = $mutiras;

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

        // ############################# Mutiras ##########################

        public function salvarMutira(){

            $this->validaAutenticacao();

            $tweet = Conteiner::getModel('Mutira');

            $tweet->__set('mutira', $_POST['textmutira']);
            
            $tweet->__set('id_usuario', $_SESSION['id']);

            print_r($_POST);
            $tweet->salvar();
        
           // header('Location: /timeline');
        }
        public function removeMutira(){
            //verificar se o usuario ta logado
            $this->validaAutenticacao();

            $tweet = Conteiner::getModel('Mutira');
            $tweet->__set('mutira', $_POST['mutira']);
            $tweet->__set('id_usuario', $_SESSION['id']);
            

            $tweet->removeMutira();

            //header('Location: /timeline');

        }



    }
?>