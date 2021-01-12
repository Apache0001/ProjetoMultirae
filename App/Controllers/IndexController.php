<?php
    namespace App\Controllers ;
    // Os recurso do miniframework
    use MF\Controller\Action ;
    use MF\Model\Conteiner;

    //Os models


    class IndexController extends Action{

        //Renderizando arquivos dentro da View index
        public function index(){
            $this->view->login = isset($_GET['login']) ? $_GET['login'] : '';
            
            $this->render('index','layout');


        }

        public function recursos(){
            $this->view->login = isset($_GET['login']) ? $_GET['login'] : '';

            $this->render('recursos', 'layout');
        }

        public function cadastro(){

            $this->render('cadastro', 'layout');
        }
        public function inscreverse(){
             #definindo parametros para tratamentos de erros e recuperação de dados
             $this->view->erroCadastro = false;
             $this->view->usuario = array(
                'nome' => '',
                'csenha' => '',
                'senha' => '',
                'cep' => '',
                'numero' => '',
                'cidade' => '',
                'complemento' => '',
                'endereco' => '',
             );
             #rederizando página inscreverse
             $this->render('inscreverse','layout');
        }

        public function registrar(){
            
             //receber os dados do formulário
            //usando método statico da classe Conteiner
            # pegando valores do formulário vindo de inscreverse
            $usuario = Conteiner::getModel('Usuario');
            $usuario->__set('nome_usuario', $_POST['nome']);
            $usuario->__set('senha_usuario', md5($_POST['senha']));
            $usuario->__set('cep', $_POST['cep']);
            $usuario->__set('cidade_usuario', $_POST['cidade']);
            $usuario->__set('numero_usuario', $_POST['numero']);
            $usuario->__set('endereco_usuario', $_POST['endereco']);
            $usuario->__set('complemento_usuario', $_POST['complemento']);

        

                $usuario->salvar();
                $this->render('cadastro');
           
        }
    }

?>