<?php 

require_once(RELATIVE_PATH . '/src/controllers/LoginController.php');
require_once(RELATIVE_PATH . '/src/controllers/UserController.php');
require_once(RELATIVE_PATH . '/src/controllers/TransactionController.php');

class Router
{

    private $method;
    private $route;
    public $url;
    public $post;
    public $body;
    public $token;
    public $LoginController;
    public $UserController;
    public $TransactionController;
    
    public function __construct()
    {

        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->route = $_SERVER['REQUEST_URI'];
        $this->url = $_SERVER['HTTP_ORIGIN'];
        $this->post = $_POST;
        $this->body = json_decode(file_get_contents('php://input'), true);
        $this->token = $_COOKIE['Authorization'];
        $this->LoginController = new LoginController();
        $this->UserController = new UserController();
        $this->TransactionController = new TransactionController();

        $this->route = $this->validateRouteUrl($this->route);
        $this->routes();

    }

    public function routes()
    {

        switch($this->method){

            case 'POST':

                if($this->route == '/login'){

                    $login = $this->LoginController->login($this->body);
                    echo json_encode($login);
                    exit;

                }

                if($this->route == '/logout'){

                    $this->validateToken();

                    setcookie("Authorization", "", time() - 3600, "/");
                    echo json_encode(true);
                    exit;

                }

                if($this->route == '/createUser'){

                    $userCreate = $this->UserController->insertUser($this->body);     
                    echo json_encode($userCreate);
                    exit;

                }

                if($this->route == '/cadastrarUsuario'){

                    $this->validateToken(true);
                    $cadastrarUsuario = $this->UserController->insertUser($this->post, 'createAdmin', $this->token);
                    $error = 'error';
                    
                    if($cadastrarUsuario['error'] == 'O usuário já existe.'){
                        $error = 'userExists';
                    }

                    if(isset($cadastrarUsuario['error'])){
                        header("Location: {$this->url}?msg={$error}");
                        exit;

                    }

                    header('Location: '. $this->url .'?msg=success');
                    exit;

                }

                if($this->route == '/transaction'){

                    $this->validateToken();
                    $transaction = $this->TransactionController->makeTransfer($this->body, $this->token);
                    echo json_encode($transaction);
                    exit;

                }

            break;
            
            case 'GET':

                if($this->route == '/login'){

                    if(!include_once('./src/views/login.php')){
                        include_once('./src/views/error.php');
                    }
                    exit;

                }

                if($this->route == '/cadastrar'){
                    
                    if(!include_once('./src/views/cadastrar.php')){
                        include_once('./src/views/error.php');
                    }
                    exit;

                }

                if($this->route == '/cadastrarUsuarios'){

                    $this->validateToken(true);
                    
                    if(!include_once('./src/views/cadastrarUsuarios.php')){
                        include_once('./src/views/error.php');
                    }
                    exit;

                }

                if($this->route == '/listarUsuarios'){

                    $this->validateToken(true);
                    
                    if(!include_once('./src/views/listarUsuarios.php')){
                        include_once('./src/views/error.php');
                    }
                    exit;

                }

                if($this->route == '/editarMeuUsuario'){

                    $this->validateToken();

                    if(!include_once('./src/views/editarUsuario.php')){
                        include_once('./src/views/error.php');
                    }
                    exit;

                }

                if($this->route == '/listarLogs'){

                    $this->validateToken(true);
                    
                    if(!include_once('./src/views/listarLogs.php')){
                        include_once('./src/views/error.php');
                    }
                    exit;

                }

                if($this->route == '/transferencia'){

                    $this->validateToken();
                    
                    if(!include_once('./src/views/transferencia.php')){
                        include_once('./src/views/error.php');
                    }
                    exit;

                }

                if($this->route == '/saldo'){

                    $this->validateToken();
                    
                    if(!include_once('./src/views/saldo.php')){
                        include_once('./src/views/error.php');
                    }
                    exit;

                }

                if(preg_match('/^\/usuarios\/(\d+)$/', $this->route, $matches)) {

                    $this->validateToken(true);

                    $id = $matches[1];
                    $getUserById = $this->UserController->getUserById($id, $this->token, true);
                    echo json_encode($getUserById);
                    exit;

                }

                if(preg_match('/^\/MeuUsuario\/(\d+)$/', $this->route, $matches)) {

                    $this->validateToken();

                    $id = $matches[1];
                    $getUserById = $this->UserController->getUserById($id, $this->token);
                    echo json_encode($getUserById);
                    exit;

                }

                if($this->route == '/'){

                    $this->validateToken();
                    
                    if(!include_once('./index.php')){
                        include_once('./src/views/error.php');
                    }

                } else {

                    if($this->route){
                        include_once('./src/views/error.php');
                        exit;
                    }
                }
                
            break;

            case 'PUT':

                if(preg_match('/^\/editarMeuUsuario\/(\d+)$/', $this->route, $matches)){

                    $this->validateToken();
                    $id = $matches[1];
                    $updateUser = $this->UserController->updateUser($this->body, $id, 'updateMyUser', $this->token, true);
                    echo json_encode($updateUser);
                    exit;
                    
                }

                if(preg_match('/^\/editarUsuario\/(\d+)$/', $this->route, $matches)){

                    $this->validateToken(true);
                    $id = $matches[1];
                    $updateUser = $this->UserController->updateUser($this->body, $id, 'updateAdmin', $this->token);
                    echo json_encode($updateUser);
                    exit;
                    
                }

                if(preg_match('/^\/editarSenha\/(\d+)$/', $this->route, $matches)){

                    $this->validateToken();
                    $id = $matches[1];
                    $updatePassword = $this->UserController->updatePassword($id, $this->token, $this->body);
                    echo json_encode($updatePassword);
                    exit;
                    
                }

            break;

            case 'DELETE':


                if(preg_match('/^\/deletarUsuario\/(\d+)$/', $this->route, $matches)){

                    $this->validateToken(true);
                    $id = $matches[1];
                    $deleteUser = $this->UserController->deleteUser($id, $this->token, true);
                    echo json_encode($deleteUser);
                    exit;
                    
                }

                if(preg_match('/^\/deletarMeuUsuario\/(\d+)$/', $this->route, $matches)){

                    $this->validateToken();
                    $id = $matches[1];
                    $deleteMyUser = $this->UserController->deleteUser($id, $this->token, false, true);
                    echo json_encode($deleteMyUser);
                    exit;

                }

            break;

        }
    
    }

    public function validateRouteUrl($route){
        
        if(empty($_GET['msg'])) {
            $url = strtok($route, '?');
            
            return $url;
        }

    }

    public function validateToken($haveAdmin = null){

        if(empty($this->token)){
            header('Location: '. $this->url .'/login');
            exit;
        } else {

            $validateToken = $this->UserController->validateToken($this->token, $haveAdmin);
            if($validateToken->num_rows == 0){
                setcookie("Authorization", "", time() - 3600, "/");
                header('Location: '. $this->url .'/login?userCreate=errorToken');
                exit;
            }

            return $validateToken;

        }
    }

}

