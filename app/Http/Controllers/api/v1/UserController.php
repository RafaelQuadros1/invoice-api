<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return UserResource::collection(User::with('invoices')->paginate());

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        try {
            $user = User::create($request->validated());

            return $this->success(
                'User created successfully',
                new UserResource($user),
                201
            );
        } catch (\Exception $e) {
            return $this->errors(
                'User creation failed',
                ['error' => $e->getMessage()],
                500
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new UserResource(User::findOrFail($id)->load('invoices'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->update($request->validated());

            return $this->success(
                'User updated successfully',
                new UserResource($user->load('invoices')),
                200
            );
        } catch (\Exception $e) {
            return $this->errors(
                'User update failed',
                ['error' => $e->getMessage()],
                500
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return $this->success(
                'User deleted successfully',
                null,
                200
            );
        } catch (\Exception $e) {
            return $this->errors(
                'User delete failed',
                ['error' => $e->getMessage()],
                500
            );
        }
    }
}
