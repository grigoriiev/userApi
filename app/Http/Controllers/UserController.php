<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $users = User::all();
            return response()->json([
                'success' => true,
                'message' => $users
            ], 200);

        } catch (Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => "Users has been false."
            ], 500);
        }

    }

    /**
     * Store a newly created resource in storage.
     * @return JsonResponse
     */
    public function store(UserRequest $request): JsonResponse
    {
        try {
            $data = User::create([
                'age' => (int)$request->input('age'),
                'name' => $request->input('name'),
                'email' => $request->input('email'),
            ]);
            return response()->json([
                "success" => true,
                "message" => "User has been store successfully id " . $data->id . "."
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                "success" => false,
                "message" => "User has been store false "
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            $user = User::findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => $user
            ], 200);
        } catch (Throwable $th) {

            return response()->json([
                "success" => false,
                "message" => "User has been show false."
            ], 404);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param $id
     * @return JsonResponse
     */
    public function update(UserRequest $request, int $id): JsonResponse
    {
        try {
            $user = User::findOrFail($id);
            $user->update([
                'age' => (int)$request->input('age'),
                'name' => $request->input('name'),
                'email' => $request->input('email'),
            ]);
            return response()->json([
                "success" => true,
                "message" => "User has been update successfully."
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => "User updated false!"
            ], 404);
        }

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */

    public function destroy(int $id): JsonResponse
    {

        try {
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json([
                'success' => true,
                'message' => "User deleted successfully!",
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => "User deleted false!",
            ], 404);
        }

    }


}
