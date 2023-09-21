<?php 

require_once(RELATIVE_PATH . '/src/controllers/ItemController.php');
require_once(RELATIVE_PATH . '/src/controllers/ParticipanteController.php');

class Router
{

    private $method;
    private $route;
    public $url;
    public $post;
    public $body;
    public $ItemController;
    public $ParticipanteController;
    
    public function __construct()
    {

        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->route = $_SERVER['REQUEST_URI'];
        $this->url = $_SERVER['HTTP_ORIGIN'];
        $this->post = $_POST;
        $this->body = json_decode(file_get_contents('php://input'), true);
        $this->ItemController = new ItemController();
        $this->ParticipanteController = new ParticipanteController();
        
        $this->route = $this->validateRouteUrl($this->route);
        $this->routes();

    }

    public function routes()
    {

        switch($this->method){

            case 'POST':
                if($this->route == '/cadastrarItens'){
                    
                    $createItem = $this->ItemController->saveItem($this->post);
                    if(isset($createItem['error'])){

                        header('Location: '. $this->url .'?msg=error');
                        exit;

                    }

                    header('Location: '. $this->url .'?msg=success');
                    exit;
                
                }

                if($this->route == '/cadastrarParticipantes'){

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
                    
                    if(!include_once('./src/views/item.php')){
                        include_once('./src/views/error.php');
                    }
                    exit;

                }

                if($this->route == '/participantes'){
                    
                    if(!include_once('./src/views/participantes.php')){
                        include_once('./src/views/error.php');
                    }
                    exit;

                }

                if($this->route == '/listaItens'){
                    
                    if(!include_once('./src/views/listaItens.php')){
                        include_once('./src/views/error.php');
                    }
                    exit;

                }

                if($this->route == '/listaParticipantes'){
                    
                    if(!include_once('./src/views/listaParticipantes.php')){
                        include_once('./src/views/error.php');
                    }
                    exit;

                }

                if(preg_match('/^\/participantes\/(\d+)$/', $this->route, $matches)) {

                    $id = $matches[1];
                    $getParticipanteById = $this->ParticipanteController->getParticipanteById($id);

                    echo json_encode($getParticipanteById);
                    exit;

                }

                if(preg_match('/^\/itens\/(\d+)$/', $this->route, $matches)) {

                    $id = $matches[1];
                    $getItemById = $this->ItemController->getItemById($id);

                    echo json_encode($getItemById);
                    exit;

                }

                if($this->route == '/'){
                    
                    if(!include_once('./index.php')){
                        include_once('./src/views/error.php');
                    }

                } else {

                    if($this->route){
                        include_once('./src/views/error.php');
                    }

                }

                if($this->route == '/login'){

                    if(!include_once('./src/views/login.php')){
                        include_once('./src/views/error.php');
                    }
                    exit;

                }

            break;

            case 'PUT':

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

}

