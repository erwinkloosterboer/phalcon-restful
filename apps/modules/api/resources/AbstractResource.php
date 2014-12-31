<?php
namespace App\Modules\Api\Resources;

abstract class AbstractResource {
    public abstract function create($data);
    public abstract function fetch($id);
    public abstract function fetchAll();
}