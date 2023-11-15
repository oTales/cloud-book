<?php

namespace App\Products\Abstracts\Services;

use App\Products\Abstracts\Interfaces\ServiceInterface;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

abstract class AbstractService implements ServiceInterface
{
    protected $with = [];

    protected $repository;

    /**
     * @return mixed
     */
    public function getAll(array $params = [], $with = [])
    {
        return $this->repository->all($params, $with);
    }

    /**
     * @return mixed
     *
     * @throws \Exception
     */
    public function find($id, array $with = [], array $withCount = [])
    {
        $result = $this->repository->find($id, $with, $withCount);
        if ($result == null) {
            throw new \Exception('Objeto não encontrado na base de dados');
        }

        return $result;
    }

    /**
     * @return array
     */
    public function beforeSave(array $data)
    {
        return $data;
    }

    /**
     * @return array
     */
    public function beforeUpdate($id, array $data)
    {
        return $data;
    }

    /**
     * @return mixed
     */
    public function save(array $data)
    {
        $data = $this->beforeSave($data);
        if ($this->validateOnInsert($data) !== false) {
            $entity = $this->repository->create($data);
            $this->afterSave($entity, $data);

            return $entity;
        }
    }

    public function afterSave($entity, array $params)
    {
        return $entity;
    }

    /**
     * @return mixed
     *
     * @throws \Exception
     */
    public function update($id, array $data)
    {
        $data = $this->beforeUpdate($id, $data);
        $this->validateOnUpdate($id, $data);
        $entity = $this->find($id);
        $updated = $this->repository->update($entity, $data);

        if ($updated) {
            $this->afterUpdate($entity, $data);
        }

        return $updated;
    }

    public function afterUpdate($entity, array $params)
    {
    }

    /**
     * @return mixed
     */
    public function beforeDelete($id)
    {
        return $id;
    }

    /**
     * @return mixed
     *
     * @throws \Exception
     */
    public function delete($id)
    {
        $this->validateOnDelete($id);
        $this->beforeDelete($id);
        $this->repository->delete($id);
        $this->afterDelete($id);

        return $id;
    }

    /**
     * @return mixed
     */
    public function afterDelete($id)
    {
        return $id;
    }

    /**
     * @return array
     */
    public function toSelect(?array $params = null)
    {
        return $this->repository->list($params);
    }

    /**
     * @return bool
     */
    public function validateOnInsert(array $params)
    {
        return true;
    }

    public function validateOnUpdate($id, array $params)
    {
    }

    /**
     * @throws \Exception
     */
    public function validateOnDelete($id)
    {
        $result = $this->repository->find($id);
        if ($result == null) {
            throw new \Exception('Objeto não encontrado na base de dados');
        }
    }

    /**
     * @return mixed
     */
    public function getRepository()
    {
        return $this->repository;
    }

    /**
     * @param  string  $message
     */
    public function makeRequestExterna(string $url, string $messageComparation): bool
    {
        $response = Http::get($url);

        return $response->status() === Response::HTTP_OK && $response->json()['message'] == $messageComparation;
    }

    /**
     * Pre Requisite default.
     */
    public function preRequisite($id = null)
    {
    }

    /**
     * Simples criação, sem validações.
     *
     * @return mixed
     */
    public function create(array $data)
    {
        $entity = $this->repository->create($data);
        $this->afterSave($entity, $data);

        return $entity;
    }

    /**
     * Converte um mixed de uuid para id.
     *
     * @return array
     */
    public function convertToId($data, string $type)
    {
        if (! is_array($data)) {
            $data = [$data];
        }

        $data = array_map(function ($item) use ($type) {
            return $this->convertToIdByType($item, $type);
        }, $data);

        return $data;
    }

    /**
     * Converte um uuid para id com base no tipo.
     *
     * @return mixed
     */
    public function convertToIdByType(string $item, string $type)
    {
        if (is_numeric($item)) {
            return $item;
        }

        $model = $type::where('uuid', $item)->first();

        return $model->id;
    }
}
