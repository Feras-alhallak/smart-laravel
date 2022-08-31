<?php

namespace App\Models\Base;

class BaseModel extends BaseModel
{

    public function totalStatistics($statistics, $period = 'last_12_month')
    {
        $tableName = $this->getTable();

        $result = [];
        foreach ($statistics as $name => $statisticConditions) {

            $query = $this->selectRaw('count(*) as count');


            foreach ($statisticConditions as $key => $value) {
                if(str_contains($key,'.')){
                    $pos = strrpos($key, '.');
                    $prefix = substr($key, 0, $pos);
                    $suffix = substr($key, $pos + 1);

                    $query = $query->whereRelation($prefix,$suffix, $value);
                }else{
                    $query = $query->where($key, $value);
                }
            }


            switch (request()->totalStatistics ?? $period) {
                case 'last_12_month':
                    $query = $query->whereRaw("${tableName}.created_at > DATE_SUB(NOW(),INTERVAL 1 YEAR)");
                    break;
                case "last_15_days":
                    $query = $query->whereRaw("${tableName}.created_at > DATE_SUB(NOW(),INTERVAL 15 DAY)");
                    break;
                case "last_12_quarters":
                    $query = $query->whereRaw("${tableName}.created_at > DATE_SUB(NOW(),INTERVAL 12 QUARTER)");
                    break;
                case "last_5_year":
                    $query = $query->whereRaw("${tableName}.created_at > DATE_SUB(NOW(),INTERVAL 5 YEAR)");
                    break;
            }

            $result[$name]  = $query->first();
        }

        return $result;
    }
}
