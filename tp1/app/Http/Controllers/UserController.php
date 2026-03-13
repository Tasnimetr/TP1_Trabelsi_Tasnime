<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use OpenApi\Attributes as OA;

class UserController extends Controller
{
    #[OA\Post(
        path: "/api/users",
        summary: "Créer un utilisateur",
        description: "Creates a new user and returns the created user object",
        tags: ["Users"],
        requestBody: new OA\RequestBody(
            required: true,
            description: "User object that needs to be created",
            content: new OA\JsonContent(
                required: ["firstName", "lastName", "email", "phone"],
                properties: [
                    new OA\Property(property: "firstName", type: "string", example: "John"),
                    new OA\Property(property: "lastName", type: "string", example: "Doe"),
                    new OA\Property(property: "email", type: "string", format: "email", example: "john@example.com"),
                    new OA\Property(property: "phone", type: "string", format: "phone", example: "444-999-8888")
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: "User created successfully"
            ),
            new OA\Response(
                response: 422,
                description: "Validation error"
            )
        ]
    )]
    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->validated());
        return (new UserResource($user))->response()->setStatusCode(201); //create fait -> Created
    }

    #[OA\Put(
        path: "/api/users/{id}",
        summary: "Update an existing user",
        description: "Updates user data",
        tags: ["Users"],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "User ID",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer")
            )
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: "name", type: "string", example: "Jane Doe"),
                    new OA\Property(property: "email", type: "string", format: "email", example: "jane@example.com")
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: "User updated successfully",
                content: new OA\JsonContent(ref: "#/components/schemas/User")
            ),
            new OA\Response(
                response: 404,
                description: "User not found"
            ),
            new OA\Response(
                response: 422,
                description: "Validation error"
            )
        ]
    )]
     public function update(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->validated());
        return (new UserResource($user))->response()->setStatusCode(201); //update fait -> OK
    }
}