<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * create
     *
     * @param  mixed  $attributes
     * @return void
     */
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    /**
     * find
     *
     * @param  mixed  $id
     * @return void
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * findAll
     *
     * @return void
     */
    public function findAll()
    {
        return $this->model->all();
    }

    /**
     * whereFirst
     *
     * @param  mixed  $column
     * @param  mixed  $value
     * @return void
     */
    public function whereFirst($column, $value)
    {
        return $this->model->where($column, $value)->first();
    }
    
    /**
     * findAllPaginated
     *
     * @param  mixed $relations
     * @param  mixed $paginate
     * @return void
     */
    public function findAllPaginated()
    {
        return $this->model->paginate('10');
    }
}
