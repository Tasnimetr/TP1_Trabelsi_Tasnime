<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $user = User::create($request->all());
        return (new UserResource($user))->response()->setStatusCode(201);
    }
}
