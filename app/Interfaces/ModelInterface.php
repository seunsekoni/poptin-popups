<?php

namespace App\Interfaces;

interface ModelInterface
{
    public function getAll();
    public function getById(int $id);
    public function store($request);
    public function update($request, $model);
    public function delete($model);
}
