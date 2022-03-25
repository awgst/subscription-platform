<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{
    private $model;

    public function __construct(Model $model)
    {   
        $this->model = $model;
    }

    public function getModel()
    {
        return $this->model;
    }

    protected function setModel($model)
    {
        $this->model = $model;
    }

    public function fetch($with=null)
    {
        $model = $this->model;
        if ($with) {
            $model = $model->with($with);
        }
        
        return $model->latest()
                    ->all();
    }

    public function find($id, $with=null)
    {
        $model = $this->model;
        if ($with) {
            $model = $model->with($with);
        }

        return $model->find($id);
    }

    public function findOrFail($id, $with=null)
    {
        $model = $this->model;
        if ($with) {
            $model = $model->with($with);
        }

        return $model->findOrFail($id);
    }

    public function paginate($paginateNumber, $with=null)
    {
        $model = $this->model;
        if ($with) {
            $model = $model->with($with);
        }

        return $model->latest()
                    ->paginate($paginateNumber);
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $updated = $this->findOrFail($id);
        $updated->update($data);
        return $updated;
    }

    public function destroy($id)
    {
        return $this->find($id)->delete();
    }
}