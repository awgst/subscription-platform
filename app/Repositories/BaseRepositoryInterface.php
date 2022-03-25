<?php

namespace App\Repositories;

interface BaseRepositoryInterface
{
    public function fetch(array $with=null);
    public function paginate(int $paginateNumber, array $with=null);
    public function find($id, array $with=null);
    public function findOrFail($id, array $with=null);
    public function store(array $data);
    public function update($id, array $data);
    public function destroy($id);
    public function getModel();
}