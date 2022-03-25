<?php

namespace App\Traits;

trait WithSelect
{
    public function select(array $select)
    {
        $model = $this->getModel();
        $model = $model->select($select);
        $this->setModel($model);

        return $this;
    }
}