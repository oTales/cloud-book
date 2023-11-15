<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

abstract class AbstractController extends Controller
{
    protected $with = [];

    protected $withCount = [];

    protected $service;

    protected $requestValidate;

    protected $requestValidateUpdate;
    protected $messageErrorDefault;
    protected $messageSuccessDefault;

    /**
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        if (! isset($request->with)) {
            $request->with = $this->with;
        }

        $items = $this
            ->service
            ->getAll($request->all(), $request->with)
            ->toArray();

        return $this->ok($items);
    }

    /**
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        try {
            if ($this->requestValidate) {
                $requestValidate = app($this->requestValidate);
                $this->validated = $request->validate($requestValidate->rules());
            }
        } catch (ValidationException $e) {
            return $this->error($this->messageErrorDefault, $e->errors());
        }

        try {
            DB::beginTransaction();
            $response = $this->service->save($this->validated);
            DB::commit();

            return $this->success($this->messageSuccessDefault, ['response' => $response]);
        } catch (\Exception|ValidationException $e) {
            DB::rollBack();
            if ($e instanceof ValidationException) {
                return $this->error($this->messageErrorDefault, $e->errors());
            }
            if ($e instanceof \Exception) {
                return $this->error($e->getMessage());
            }
        }
    }

    /**
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            if (! empty($this->requestValidateUpdate)) {
                $requestValidateUpdate = app($this->requestValidateUpdate);
                $this->validated = $request->validate($requestValidateUpdate->rules());
            }
        } catch (ValidationException $e) {
            return $this->error($this->messageErrorDefault, $e->errors());
        }

        try {
            DB::beginTransaction();
            $this->service->update($id, $this->validated);
            DB::commit();

            return $this->success($this->messageSuccessDefault);
        } catch (\Exception|ValidationException $e) {
            DB::rollBack();
            if ($e instanceof \Exception) {
                return $this->error($e->getMessage());
            }
            if ($e instanceof ValidationException) {
                return $this->error($this->messageErrorDefault, $e->errors());
            }
        }
    }

    /**
     * @return JsonResponse
     */
    public function show($id, Request $request)
    {
        if (! isset($request->with)) {
            $request->with = $this->with;
        }

        if (! isset($request->withCount)) {
            $request->withCount = $this->withCount;
        }

        try {
            return $this->ok($this->service->find($id, $request->with, $request->withCount));
        } catch (\Exception|ValidationException $e) {
            DB::rollBack();
            if ($e instanceof \Exception) {
                return $this->error($e->getMessage());
            }
            if ($e instanceof ValidationException) {
                return $this->error($this->messageErrorDefault, $e->errors());
            }
        }
    }

    /**
     * @return JsonResponse
     */
    public function destroy($id)
    {
        try {
            $this->service->delete($id);

            return $this->success($this->messageSuccessDefault);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * @param  null  $id
     * @return JsonResponse
     */
    public function preRequisite($id = null)
    {
        $preRequisite = $this->service->preRequisite($id);

        return $this->ok(compact('preRequisite'));
    }

    /**
     * @return JsonResponse
     */
    public function toSelect()
    {
        return $this->ok($this->service->toSelect(request()->all()));
    }
}
