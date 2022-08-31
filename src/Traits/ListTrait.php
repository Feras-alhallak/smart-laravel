<?php

namespace Ferasalhallak\SmartLaravel\Traits;


trait ListTrait
{
    public function list($filter = [],$columns = ['id', 'name'])
    {
        $model = self::where(function ($query) use ($filter) {
            foreach ($filter as $col => $value) {
                $query->where($col, $value);
            }
        })->without($this->with);

        return $model->get($columns);
    }
}
