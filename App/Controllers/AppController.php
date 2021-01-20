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
        // ################## Tudo sobre mutiroes ###################
        public function Appmutira(){
            $this->validaAutenticacao();

            $mutiroes = Conteiner::getModel('Mutiroes');
            $mutiroess = $mutiroes->getMutiroes();
            $this->view->getMutiroes = $mutiroess ;

            $this->render('mutirae', 'layoutApp');
        }
        public function criarmutira(){
            $this->validaAutenticacao();


            $this->render('criarmutira','layoutApp');
        }
        public function cadastrarmutira(){
            
            $this->validaAutenticacao(); // Validação do usuario
            
            
            $mutiroes = Conteiner::getModel('Mutiroes');
            $arrayRESP = $mutiroes->IMGMutiroes();
            if($arrayRESP['status']){
                $mutiroes->__set('img',$arrayRESP['novoNome'] );
            }else{
                $mutiroes->__set('img','indisponivel.png');
            }
            

            $mutiroes->__set('id_usuario', $_SESSION['id']);
            $mutiroes->__set('titulo', $_POST['titulo-mutira']);
            $mutiroes->__set('texto', $_POST['texto-mutira']);
            $mutiroes->__set('data_mutirao', $_POST['data-mutira']);
            
            $mutiroes->__set('local', $_POST['local-mutira']);
            $mutiroes->salvarMutiroes();

            header('Location: /criarmutira');
        }
        public function removeMutiroes(){
            $this->validaAutenticacao();

            $mutiroes = Conteiner::getModel('Mutiroes');

            $mutiroes->__set('id_mutirao', $_POST['id_mutirao']);
            $mutiroes->__set('id_usuario', $_SESSION['id']);

            $mutiroes->removeMutiroes();

           

            
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

        public function Perfil(){
            $this->validaAutenticacao();
            $this->view->UsuarioSalvo = false;
            $this->render('perfil', 'layoutApp');
        }

        public function atualizar(){
            $this->validaAutenticacao();
            $usuario = Conteiner::getModel('Usuario');

            $nome_usuario =  isset($_POST['nome']) ? $_POST['nome'] : null;
            $senha_usuario =  isset($_POST['senha']) ? $_POST['senha'] : null;
            $cep =  isset($_POST['cep']) ? $_POST['cep'] : null;
            $cidade =  isset($_POST['cidade']) ? $_POST['cidade'] : null;
            $numero =  isset($_POST['numero']) ? $_POST['numero'] : '';
            $endereco =  isset($_POST['endereco']) ? $_POST['endereco'] : null;
            $complemento =  isset($_POST['complemento']) ? $_POST['complemento'] : null;


            $usuario->__set('nome_usuario', $nome_usuario);
            $usuario->__set('senha_usuario', md5($senha_usuario));
            $usuario->__set('cep', $cep);
            $usuario->__set('cidade_usuario', $cidade);
            $usuario->__set('numero_usuario', $numero);
            $usuario->__set('endereco_usuario', $endereco);
            $usuario->__set('complemento_usuario', $complemento);
            $usuario->__set('id', $_SESSION['id']);


            if($nome_usuario != null){
                $usuario->Atualizar('nome_usuario', 'nome_usuario');
            }
            if($senha_usuario != null){
                $usuario->Atualizar('senha_usuario', 'senha_usuario');
            }
            if($cep != null){
                $usuario->Atualizar('cep', 'cep');
            }
            if($cidade != null){
                $usuario->Atualizar('cidade_usuario', 'cidade_usuario');
            }
            if($endereco != null){
                $usuario->Atualizar('endereco_usuario', 'endereco_usuario');
            }
            if($complemento != null){
                $usuario->Atualizar('complemento_usuario', 'complemento_usuario');
            }
            if($numero != null){
                $usuario->Atualizar('numero_usuario', 'numero_usuario');
            }
            

            
            $this->view->UsuarioSalvo = true;
            $this->render('perfil', 'layoutApp');
        }


        



    }
?>