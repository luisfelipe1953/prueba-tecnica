<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BaseRepository
{
    public $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Pagina los datos.
     *
     * @param int $paginateNum El número de elementos por página.
     * @return LengthAwarePaginator
     */
    public function paginate(int $paginateNum): LengthAwarePaginator
    {
        return $this->model::paginate($paginateNum);
    }

    /**
     * Obtener un registro por su ID.
     *
     * @param int $id El ID del registro a buscar.
     * @return Model
     */
    public function get(int $id): Model
    {
        $model = $this->model->find($id);

        if ($model === null) {
            throw new ModelNotFoundException();
        }

        return $model;
    }

    /**
     * Guardar un modelo en la base de datos.
     *
     * @param Model $model El modelo a guardar.
     * @return Model
     */
    public function save(Model $model): Model
    {   
        if ($model === null) {
            throw new ModelNotFoundException();
        }

        $model->save();

        return $model;
    }

    /**
     * Eliminar un modelo de la base de datos.
     *
     * @param Model $model El modelo a eliminar.
     * @return Model
     */
    public function destroy(Model $model): Model
    {   
        if ($model === null) {
            throw new ModelNotFoundException();
        }
        
        $model->delete();

        return $model;
    }
}
