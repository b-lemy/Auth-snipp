<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateInfoRequest;
use App\Http\Requests\UpdatePassRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class Usercontroller extends Controller
{
    public function index()
    {
        $user = User::paginate();

        return UserResource::collection($user);
    }

    public function show($id)
    {
        $user = User::find($id);

        return new UserResource($user);
    }

    public function delete($id)
    {
        User::destroy($id);

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function updateInfo(UpdateInfoRequest $request)
    {
        $user = Auth::user();

        $user->update($request->only('first_name', 'last_name', 'email', 'role_id'),
        );

        return response(new UserResource($user), Response::HTTP_ACCEPTED);


    }

    public function user()
    {
        return new UserResource(Auth::user());
    }

    public function update(Request $request, $id)
    {

        $user = User::find($id);

        $user->update($request->only('first_name', 'last_name', 'email', 'role_id'),
        );

        return response(new UserResource($user), Response::HTTP_ACCEPTED);
    }

    public function updatePassword(UpdatePassRequest $request)
    {
        $user = Auth::user();

        $user->update([
                'password' => Hash::make($request->input('password'))]
        );

        return response(new UserResource($user), Response::HTTP_ACCEPTED);


    }

}
