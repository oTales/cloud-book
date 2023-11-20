<?php

namespace App\Library\Abstracts\Interfaces;

interface ServiceInterface
{
    public function validateOnInsert(array $params);

    public function validateOnUpdate(int $id, array $params);

    public function validateOnDelete(int $id);

    public function afterSave($entity, array $params);

    public function afterUpdate($entity, array $params);
}
