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
        // ################## Tudo sobre mutiroes###################
        public function Appmutira(){
            $this->validaAutenticacao();

            $this->render('mutirae', 'layoutApp');
        }
        public function criarmutira(){
            $this->validaAutenticacao();

            $this->render('criarmutira','layoutApp');
        }
        public function cadastrarmutira(){
            $this->validaAutenticacao();

            $mutiroes = Conteiner::getModel('Mutiroes');

            $mutiroes->__set('id_usuario', $_SESSION['id']);
            $mutiroes->__set('titulo', $_POST['titulo-mutira']);
            $mutiroes->__set('texto', $_POST['texto-mutira']);
            $mutiroes->__set('data_mutirao', $_POST['data-mutira']);
            $mutiroes->__set('img', $_POST['imagem-mutira']);
            $mutiroes->__set('local', $_POST['local-mutira']);

            $mutiroes->salvarMutiroes();

            header('Location: /criarmutira');

        }


        public function Apprede(){
            $this->validaAutenticacao();
            // Recuperação dos tweets
            $mutira = Conteiner::getModel('Mutira');
            $mutira->__set('id_usuario',$_SESSION['id']);
            $mutiras = $mutira->getAll();
            $this->view->mutiras = $mutiras;
            
            $contMutira = $mutira->contMutira()[0]['count(*)'];
            $this->view->contMutira = $contMutira;
            
            $this->render('rede', 'layoutApp');
        }
        
        



    }
?>