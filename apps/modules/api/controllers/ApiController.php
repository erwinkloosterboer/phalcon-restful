<?php
namespace App\Modules\Api\Controllers;

use App\Modules\Api\Resources\AbstractResource;
use Phalcon\Mvc\Controller;
use \App\Models\Services\Services as Services;

class ApiController extends Controller
{


    /**
     * dispatch rest
     * */
    public function indexAction($resource = null, $id=null)
    {
        $method = $this->request->getMethod();

        $resource = ucfirst($resource);
        $className = "App\\Modules\\Api\\Resources\\$resource";

        if(!class_exists($className)){
            $return = array("resource not found");
        }else{
            /* @var $class AbstractResource */
            $class = new $className();

            switch ($method) {
                case 'GET':
                    if (!empty($id)) {
                        $return = $class->fetch($id);
                    } else {
                        $return = $class->fetchAll();
                    }
                    break;
                case 'POST':
                    $response = Services::getService($this->_model)->save($input);
                    break;
                case 'PUT':
                    $response = Services::getService($this->_model)->update($input, $id);
                    break;
                case 'DELETE':
                    $response = Services::getService($this->_model)->delete($id);
                    break;
            }
        }

        header("Content-Type: Application/json");
        echo json_encode($return);

        die();
    }

}
