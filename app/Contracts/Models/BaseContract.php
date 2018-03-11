<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 21/11/2017
 * Time: 6:38 PM
 */

namespace Stock\Contracts\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseContract
 * @package Stock\Contracts\Models
 */
class BaseContract
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @return Model
     */
    public function builder()
    {
        return $this->model;
    }

    /**
     * get all models
     * @param bool $trashed
     * @return \Illuminate\Database\Eloquent\Collection|Model[]
     */
    public function all($trashed = false)
    {
        if ($trashed === true) {
            return $this->builder()->withTrashed()->get();
        } else {
            return $this->builder()->all();
        }
    }

    /**
     * get model by id
     * @param $id
     * @param bool $throw
     * @return Model|null
     */
    public function get($id, $throw = true)
    {
        if ($throw === true) {
            return $this->builder()->findOrFail($id);
        } else {
            return $this->builder()->find($id);
        }
    }

    /**
     * create a new model
     * @param array $data
     * @return Model
     */
    public function store(array $data)
    {
        $data = $this->__getData($data);
        return $this->builder()->create($data);
    }

    /**
     * update an existing model
     * @param Model $model
     * @param array $data
     * @return bool
     */
    public function update(Model $model, array $data)
    {
        $data = $this->__getData($data);
        return $model->update($data);
    }

    /**
     * @param array $search
     * @param array $data
     * @return Model
     */
    public function updateOrStore(array $search, array $data)
    {
        $data = $this->__getData($data);
        $model = $this->builder()->updateOrCreate($search, $data);
        return $model;
    }

    /**
     * delete a model
     * @param Model $model
     * @param bool $force
     * @return bool
     * @throws \Exception
     */
    public function delete(Model $model, $force = false)
    {
        if ($force === true) {
            return $model->forceDelete();
        } else {
            return $model->delete();
        }
    }

    /**
     * restore a model
     * @param Model $model
     * @return bool
     */
    public function restore(Model $model)
    {
        return $model->restore();
    }

    private function __getData(array $data)
    {
        return array_only($data, $this->builder()->getFillable());
    }
}