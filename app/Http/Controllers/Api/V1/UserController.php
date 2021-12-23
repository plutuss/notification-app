<?php

namespace App\Http\Controllers\Api\V1;

use App\Filters\UserFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreUserRequest;
use App\Http\Requests\Api\UpdateUserRequest;
use App\Http\Resources\ContactResource;
use App\Http\Resources\LetterResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class UserController extends Controller
{


    public function index()
    {
        $users = User::query()
            ->paginate(9);

        return UserResource::collection($users);
    }


    /**
     * @param  StoreUserRequest  $request
     * @return Application|ResponseFactory|Response
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::query()->create(
            $request->validated()
        );

        return response([
            'user' => new UserResource($user),
            'msg' => __('messages.add_user')
        ]);
    }


    /**
     * @param  User  $user
     * @return array
     */
    public function show(User $user): array
    {

        $contacts = $user->contacts;
        $letters = $user->letters;

        return [
            'contacts' => ContactResource::collection($contacts),
            'letters' => LetterResource::collection($letters),
        ];
    }


    /**
     * @param  UpdateUserRequest  $request
     * @param  User  $user
     * @return Response
     */
    public function update(UpdateUserRequest $request, User $user): Response
    {
        $user->update(
            $request->validated()
        );

        return response([
            'user' => new UserResource($user),
            'msg' => __('messages.update_user')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $user
     * @return Response
     */
    public function destroy(User $user): Response
    {
        $user->delete();

        return response([
            'msg' => __('messages.delete_user')
        ]);
    }
}
