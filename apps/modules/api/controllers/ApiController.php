<?php
namespace App\Modules\Api\Controllers;

use App\Modules\Api\Library\ApiProblem;
use App\Modules\Api\Library\Util;
use App\Modules\Api\Resources\AbstractResource;
use Phalcon\Http\Response\Headers;
use Phalcon\Mvc\Controller;

class ApiController extends Controller
{

    /**
     * @var Headers
     */
    protected $headers;

    public function getHeaders(){
        if(!isset($this->headers)){
            $this->headers = new Headers();
            $this->headers->set("Content-Type","Application/json");
        }
        return $this->headers;
    }
    public function indexAction()
    {
        $this->echoAsJson(array("api" => "Phalcon RESTFul API", "version" => "0.0.1"));
    }

    /**
     * handle a resource request
     * @param null|string $resource The requested resource
     * @param null|string $id an optional resource id
     */
    public function resourceAction($resource, $id = null)
    {
        $class = $this->getResourceClass($resource);

        if (!($class instanceof ApiProblem)) {
            $return = $this->dispatchResourceRequest($class, $this->request->getMethod(), $id, $this->request->getPost());
        } else {
            //An error occurred when trying to get the resource class, return that error instead
            $return = $class;
        }
        $this->echoAsJson($return);
    }

    /**
     * Try to get the class from a resource name string
     *
     * @param string $resourceName
     * @return AbstractResource|ApiProblem  A class inheriting the AbstractResource or an ApiProblem when no resource is found or when the resource does not match prerequisites
     */
    private function getResourceClass($resourceName)
    {

        //Only capitalize the first character
        $resource = ucfirst(strtolower($resourceName));

        $className = "App\\Modules\\Api\\Resources\\$resource";

        if (!class_exists($className)) {
            return new ApiProblem(404, "Resource not found");
        }

        //The class exists, create it
        $class = new $className();

        if (!($class instanceof AbstractResource)) {
            //The class has not inherited the mandatory AbstractResource class.
            return new ApiProblem(500, "Requested resource not an instance of AbstractResource");
        }

        return $class;
    }

    /**
     * Dispatch the request in the specified resource and return its result
     *
     */
    private function dispatchResourceRequest(AbstractResource $resource, $method, $id = null, $params = array())
    {
        switch ($method) {
            case 'POST':
                return $resource->create($params);
            case 'DELETE':
                if ($id !== null) {
                    return $resource->delete($id);
                } else {
                    return $resource->deleteList($params);
                }
            case 'GET':
                if ($id !== null) {
                    return $resource->fetch($id);
                } else {
                    return $resource->fetchAll();
                }
            case 'PATCH':
                return $resource->patch($id, $params);
            case 'PUT':
                if ($id !== null) {
                    return $resource->update($id, $params);
                } else {
                    return $resource->replaceList($params);
                }
            default:
                return new ApiProblem(405, "Specified method not allowed");
        }
    }

    /**
     * Return the object as json.
     * This object must be an array or must have the toArray() method implemented
     * @param mixed $object
     */
    private function echoAsJson($object){
        if(!is_array($object)){
            if(is_object($object) && method_exists($object, 'toArray')){
                $object = $object->toArray();
            }else{
                return $this->echoAsJson(new ApiProblem(500,"Cannot parse json from this object. Expected array or an object with the toArray() function implemented"));
            }
        }

        $this->getHeaders()->send();
        echo json_encode($object);
    }
}
