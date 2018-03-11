<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 15/12/2017
 * Time: 9:17 PM
 */

namespace Stock\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model as BaseModel;

abstract class Model extends BaseModel
{
    /**
     * @param array $items
     */
    public static function createAll(array $items)
    {
        $model = with(new static);

        $now = Carbon::now();
        $items = array_map(function ($item) use ($now, $model) {
            return $model->timestamps ? array_merge([
                'created_at' => $now,
                'updated_at' => $now,
            ], $item) : $item;
        }, $items);
        \DB::table($model->getTable())->insert($items);
    }

    /**
     * @return array
     */
    public static function getAppends()
    {
        $vars = get_class_vars(__CLASS__);

        return array_get($vars, 'appends');
    }


    /**
     * @param Builder $builder
     * @param $attribute
     * @return Builder|static
     */
    public function scopeHasAttribute(Builder $builder, $attribute)
    {
        return $builder->whereNotNull($attribute);
    }
}