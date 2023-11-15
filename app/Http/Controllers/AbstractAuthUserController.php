<?php

namespace App\Http\Controllers;

use App\Products\Common\Traits\AuthUser;
use Illuminate\Http\Request;

class AbstractAuthUserController extends AbstractController
{
    use AuthUser;

    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        if (! isset($request->with)) {
            $request->with = $this->with;
        }

        $user = $this->userLogged();
        $payload = [
            ...$request->all(),
            'user_ext_uuid' => $user->uuid,
            'boss_ext_uuid' => isset($user->boss) ? $user->boss->uuid : null,
        ];

        $items = $this
            ->service
            ->getAll($payload, $request->with)
            ->toArray();

        return $this->ok($items);
    }

    public function toSelect(): \Illuminate\Http\JsonResponse
    {
        $user = $this->userLogged();
        $params = [
            ...request()->all(),
            'user_ext_uuid' => $user->uuid,
            'boss_ext_uuid' => isset($user->boss) ? $user->boss->uuid : null,
        ];

        return $this->ok($this->service->toSelect($params));
    }
}
