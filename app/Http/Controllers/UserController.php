<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\ResponseResource;
use App\Http\Resources\UserResource;
use App\Jobs\ExportUserJob;
use App\Models\User;
use App\Services\UserService;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Return the paginated users
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return UserResource::collection($this->userService->_paginate(5));
    }

    /**
     * Get the user by id
     * @param User $user
     * @return UserResource
     */
    public function show(User $user): UserResource
    {
        return new UserResource($user);
    }

    /**
     * Update the user
     * @param UpdateUserRequest $request
     * @param User $user
     * @return ResponseResource
     */
    public function update(UpdateUserRequest $request, User $user): ResponseResource
    {
        try {
            $user->update($request->all());
            return new ResponseResource("Resource updated successfully", ["success" => true]);
        } catch (\Exception $exception) {
            return new ResponseResource($exception->getMessage(), ["success" => false], 500);
        }
    }

    /**
     * Dispatch the job to generate the file and send within the email attachment.
     * @return ResponseResource
     */
    public function exportUsers(): ResponseResource
    {
        ExportUserJob::dispatch()->onQueue("default");
        return new ResponseResource("File will be send you via email soon.");
    }

}
