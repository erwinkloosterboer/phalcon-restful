<?php
namespace App\Modules\Api\Resources;

class User extends AbstractResource
{

    /**
     * Create a resource
     */
    public function create($data)
    {
        return array("method"=>"create");
    }

    /**
     * Delete a resource
     *
     * @param  mixed $id
     * @return array|void
     */
    public function delete($id)
    {
        return array("method"=>"delete");
    }

    /**
     * Delete a collection, or members of a collection
     *
     * @param  mixed $data
     * @return array|void
     */
    public function deleteList($data)
    {
        return array("method"=>"deleteList");
    }

    /**
     * Fetch a resource
     *
     * @param  mixed $id
     * @return array
     */
    public function fetch($id)
    {
        return array("method"=>"fetch");
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return array|void
     */
    public function fetchAll($params = array())
    {
        return array("method"=>"fetchAll");
    }

    /**
     * Patch (partial in-place update) a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return array|void
     */
    public function patch($id, $data)
    {
        return array("method"=>"patch");
    }

    /**
     * Replace a collection or members of a collection
     *
     * @param  mixed $data
     * @return array|void
     */
    public function replaceList($data)
    {
        return array("method"=>"replaceList");
    }

    /**
     * Update a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return array|void
     */
    public function update($id, $data)
    {
        return array("method"=>"update");
    }
}