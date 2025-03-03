<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\CreateRequest;
use App\Http\Requests\Users\UpdateRequest;
use App\Http\Resources\Users\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
      return UserResource::collection(User::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request): UserResource
    {
        $validated = $request->validated();
        $validated['password'] = bcrypt('password');
        return UserResource::make(User::create($validated));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): UserResource
    {
      return UserResource::make($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, User $user): UserResource
    {
      $validated = $request->validated();
      $user->update($validated);
      return UserResource::make($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): JsonResponse
    {
        $user->delete();
        return response()->json(null, 204);
    }
}
