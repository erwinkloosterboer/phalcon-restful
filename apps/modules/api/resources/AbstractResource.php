<?php
namespace App\Modules\Api\Resources;

abstract class AbstractResource {
     /**
      * Create a resource
      * @param  mixed $data
      * @return array
      */
    public abstract function create($data);

    /**
     * Delete a resource
     *
     * @param  mixed $id
     * @return array
     */
    public abstract function delete($id);

    /**
     * Delete a collection, or members of a collection
     *
     * @param  mixed $data
     * @return array
     */
    public abstract function deleteList($data);

    /**
     * Fetch a resource
     *
     * @param  mixed $id
     * @return array
     */
    public abstract function fetch($id);

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return array
     */
    public abstract function fetchAll($params = array());

    /**
     * Patch (partial in-place update) a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return array
     */
    public abstract function patch($id, $data);

    /**
     * Replace a collection or members of a collection
     *
     * @param  mixed $data
     * @return array
     */
    public abstract function replaceList($data);

    /**
     * Update a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return array
     */
    public abstract function update($id, $data);
}