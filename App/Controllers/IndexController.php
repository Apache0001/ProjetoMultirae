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
        //Cadastro de usuario com sucesso
        public function cadastro(){

            $this->render('cadastro', 'layout');
        }
        //Inscricao de usuario
        public function inscreverse(){
             #definindo parametros para tratamentos de erros e recuperação de dados
             $this->view->erroCadastro = array();
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
             $resp = array(
                'valido' => true,
                'validoNome' => true,
                'validoSenha' => true,
                'validoCep' => true
 
            );
            
             $this->view->CadastroErro = array(
                'erronome' => true,
                'errosenha' => true,
                'errocep' => true
            );
             #rederizando página inscreverse
             $this->render('inscreverse','layout');
        }
        public function mutirao(){
            $this->render('mutirao');
        }
        public function sobreNos(){
            $this->render('sobreNos');
        }

        //Registrar usuario
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

            
            $resp = $usuario->validarCadastro();
           
            

            if($resp['valido'] == true){
                $usuario->salvar();
                $this->render('cadastro');
                
            }
            else{
                $this->view->CadastroErro = array(
                    'erronome' => $resp['validoNome'],
                    'errosenha' => $resp['validoSenha'],
                    'errocep' => $resp['validoCep'],
                );
                $this->view->usuario = array(
                    'nome' => $_POST['nome'],
                    'cep' => $_POST['cep'],
                    'complemento' => $_POST['complemento'],
                    'endereco' => $_POST['endereco'],
                    'numero' => $_POST['numero']
                );

                $this->render('inscreverse');
            }
           
        }
    }

?>