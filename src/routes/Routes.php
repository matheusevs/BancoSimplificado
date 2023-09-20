<?php 

require_once(RELATIVE_PATH . '/src/controllers/ItemController.php');
require_once(RELATIVE_PATH . '/src/controllers/ParticipanteController.php');

class Router
{

    private $method;
    private $route;
    public $url;
    public $body;
    public $ItemController;
    public $ParticipanteController;
    
    public function __construct()
    {

        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->route = $_SERVER['REQUEST_URI'];
        $this->url = $_SERVER['HTTP_ORIGIN'];
        $this->body = $_POST;
        $this->ItemController = new ItemController();
        $this->ParticipanteController = new ParticipanteController();
        
        $this->routes();

    }

    public function routes()
    {

        switch($this->method){

            case 'POST':
                if($this->route == '/cadastrarItens/'){
                    
                    $createItem = ItemController::saveItem($this->body);
                    if(isset($createItem['error'])){

                        header('Location: '. $this->url .'?msg=error');
                        exit;

                    }

                    header('Location: '. $this->url .'?msg=success');
                    exit;
                
                }

                if($this->route == '/cadastrarParticipantes/'){

                    $createParticipante = ParticipanteController::saveParticipante($this->body);
                    if(isset($createParticipante['error'])){

                        header('Location: '. $this->url .'?msg=error');
                        exit;

                    }

                    header('Location: '. $this->url .'?msg=success');
                    exit;
                

                }

            break;

        }
    
    }

}