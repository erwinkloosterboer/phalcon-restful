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
    public function indexAction($resource = null, $id = null)
    {
        $method = $this->request->getMethod();

        $resource = ucfirst(strtolower($resource));
        $className = "App\\Modules\\Api\\Resources\\$resource";

        if (!class_exists($className)) {
            $return = array("resource not found");
        } else {

            //The class exists, create it
            $class = new $className();

            if (!($class instanceof AbstractResource)) {
                $return = array("Resource not an instance of AbstractResource");
            } else {
                switch ($method) {
                    case 'POST':
                        $return = $class->create($this->request->getPost());
                        break;
                    case 'DELETE':
                        if ($id !== null) {
                            $return = $class->delete($id);
                        } else {
                            $return = $class->deleteList($this->request->getPost());
                        }
                        break;
                    case 'GET':
                        if ($id !== null) {
                            $return = $class->fetch($id);
                        } else {
                            $return = $class->fetchAll();
                        }
                        break;
                    case 'PATCH':
                        $return = $class->patch($id, $this->request->getPost());
                        break;
                    case 'PUT':
                        if ($id !== null) {
                            $return = $class->update($id, $this->request->getPost());
                        } else {
                            $return = $class->replaceList($this->request->getPost());
                        }
                        break;
                }
            }

        }

        header("Content-Type: Application/json");
        echo json_encode($return);

        die();
    }

}
