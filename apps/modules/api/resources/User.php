<?php
namespace App\Modules\Api\Resources;

class User extends AbstractResource
{

    public function create($data)
    {
        // TODO: Implement create() method.
    }

    public function fetch($id)
    {
        return array("Fetching resource with id $id");
    }

    public function fetchAll()
    {
        return array("Fetching all available resources");
    }
}