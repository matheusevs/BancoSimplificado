<?php 

require_once(RELATIVE_PATH . '/src/controllers/LoginController.php');
require_once(RELATIVE_PATH . '/src/controllers/UserController.php');
require_once(RELATIVE_PATH . '/src/controllers/ItemController.php');
require_once(RELATIVE_PATH . '/src/controllers/ParticipanteController.php');

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
    public $ItemController;
    public $ParticipanteController;
    
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
        $this->ItemController = new ItemController();
        $this->ParticipanteController = new ParticipanteController();

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

                    $userCreate = $this->UserController->saveUser($this->body);                        
                    echo json_encode($userCreate);
                    exit;

                }

                if($this->route == '/cadastrarItens'){

                    $this->validateToken();
                    
                    $createItem = $this->ItemController->saveItem($this->post);
                    if(isset($createItem['error'])){

                        header('Location: '. $this->url .'?msg=error');
                        exit;

                    }

                    header('Location: '. $this->url .'?msg=success');
                    exit;
                
                }

                if($this->route == '/cadastrarParticipantes'){

                    $this->validateToken();

                    $createParticipante = $this->ParticipanteController->saveParticipante($this->post);
                    if(isset($createParticipante['error'])){

                        header('Location: '. $this->url .'?msg=error');
                        exit;

                    }

                    header('Location: '. $this->url .'?msg=success');
                    exit;
                

                }

            break;
            
            case 'GET':

                if($this->route == '/item'){

                    $this->validateToken();
                    
                    if(!include_once('./src/views/item.php')){
                        include_once('./src/views/error.php');
                    }
                    exit;

                }

                if($this->route == '/participantes'){

                    $this->validateToken();
                    
                    if(!include_once('./src/views/participantes.php')){
                        include_once('./src/views/error.php');
                    }
                    exit;

                }

                if($this->route == '/listaItens'){

                    $this->validateToken();
                    
                    if(!include_once('./src/views/listaItens.php')){
                        include_once('./src/views/error.php');
                    }
                    exit;

                }

                if($this->route == '/listaParticipantes'){

                    $this->validateToken();
                    
                    if(!include_once('./src/views/listaParticipantes.php')){
                        include_once('./src/views/error.php');
                    }
                    exit;

                }

                if(preg_match('/^\/participantes\/(\d+)$/', $this->route, $matches)) {

                    $this->validateToken();

                    $id = $matches[1];
                    $getParticipanteById = $this->ParticipanteController->getParticipanteById($id);

                    echo json_encode($getParticipanteById);
                    exit;

                }

                if(preg_match('/^\/itens\/(\d+)$/', $this->route, $matches)) {

                    $this->validateToken();

                    $id = $matches[1];
                    $getItemById = $this->ItemController->getItemById($id);

                    echo json_encode($getItemById);
                    exit;

                }

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

                $this->validateToken();

                if(preg_match('/^\/editarParticipante\/(\d+)$/', $this->route, $matches)){
                    
                    $id = $matches[1];
                    $updateParticipantesById = $this->ParticipanteController->updateParticipantesById($id, $this->body);
                    
                    if(isset($updateParticipantesById['error'])){

                        echo json_encode($updateParticipantesById);

                    }

                    exit;
                    
                }

                if(preg_match('/^\/editarItem\/(\d+)$/', $this->route, $matches)){
                    
                    $id = $matches[1];
                    $updateItensById = $this->ItemController->updateItensById($id, $this->body);
                    
                    if(isset($updateItensById['error'])){

                        echo json_encode($updateItensById);

                    }

                    exit;
                    
                }

            break;

            case 'DELETE':

                $this->validateToken();

                if(preg_match('/^\/deletarParticipante\/(\d+)$/', $this->route, $matches)){
                    
                    $id = $matches[1];
                    $deleteParticipantesById = $this->ParticipanteController->deleteParticipantesById($id, $this->body);
                    
                    if(isset($deleteParticipantesById['error'])){

                        echo json_encode($deleteParticipantesById);

                    }

                    exit;
                    
                }

                if(preg_match('/^\/deletarItem\/(\d+)$/', $this->route, $matches)){
                    
                    $id = $matches[1];
                    $deleteItensById = $this->ItemController->deleteItensById($id, $this->body);
                    
                    if(isset($deleteItensById['error'])){

                        echo json_encode($deleteItensById);

                    }

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

    public function validateToken(){

        if(empty($this->token)){
            header('Location: '. $this->url .'/login');
            exit;
        } else {

            $validateToken = $this->UserController->validateToken($this->token);
            if($validateToken->num_rows == 0){
                setcookie("Authorization", "", time() - 3600, "/");
                header('Location: '. $this->url .'/login?userCreate=errorToken');
                exit;
            }

            return $validateToken;

        }
    }

}

