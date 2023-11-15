<?php

namespace App\Products\Abstracts\Repositories;

use App\Products\Abstracts\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository implements RepositoryInterface
{
    /**
     * Model.
     *
     * @var mixed
     */
    protected $model;

    public function getModel(): Model
    {
        return $this->model;
    }

    /**
     * @return mixed
     */
    public function all(?array $params = null, array $with = [])
    {
        return $this->getModel()->query($params)->with($with)->paginate(10)->withQueryString();
    }

    public function allWithOutPaginate($params = null, $with = [])
    {
        return $this->getModel()->query($params)->with($with)->get();
    }

    /**
     * Retorna em forma de lista para selecte.
     *
     * @return mixed
     */
    public function list(?array $params = null): array
    {
        return $this->getModel()->all()
            ->sortBy($params['sort_by'] ?? 'name')
            ->pluck($params['pluck'] ?? 'name', 'id')
            ->all();
    }

    public function create($params): Model
    {
        return $this->getModel()->create($params);
    }

    /**
     * @return mixed
     */
    public function find(mixed $id, array $with = [], array $withCount = [])
    {
        if (is_numeric($id)) {
            return $this->getModel()->with($with)->withCount($withCount)->find($id);
        }

        return $this->findOneWhere(['uuid' => $id], $with, $withCount);
    }

    /**
     * @return mixed
     */
    public function findOrFail($id)
    {
        return $this->getModel()->findOrFail($id);
    }

    public function delete($id)
    {
        $model = $this->find($id);
        $model->delete();
    }

    public function update(Model $entity, $data)
    {
        return $entity->fill($data)->save();
    }

    /**
     * @return mixed
     */
    public function where(array $where, array $with = [], array $withCount = [])
    {
        return $this->getModel()->where($where)->with($with)->withCount($withCount)->get();
    }

    /**
     * Delete com condição.
     */
    public function deleteWhere($where)
    {
        $this->getModel()->where($where)->delete();
    }

    /**
     * Retorna o primeiro registro encontrado.
     *
     * @return mixed
     */
    public function findOneWhere(array $where, array $with = [], array $withCount = [])
    {
        $object = $this->where($where, $with, $withCount);

        return $object->first();
    }

    /**
     * Retorna o ID pelo UUID.
     *
     * @return mixed
     */
    public function getIdByUuid(string $uuid)
    {
        return $this->findOneWhere(['uuid' => $uuid])->id ?? null;
    }

    /**
     * getAttribute.
     *
     * @param  mixed  $value
     * @return void
     */
    public function getAttribute($params, $value, $default = null)
    {
        return (isset($params[$value])) ? $params[$value] : $default;
    }

    /**
     * @return mixed
     */
    public function createOrUpdate(array $paramsValidation, array $params)
    {
        return $this->model->updateOrCreate($paramsValidation, $params);
    }
}
