<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreLetterRequest;
use App\Http\Requests\Api\UpdateLetterRequest;
use App\Http\Resources\LetterResource;
use App\Models\Letter;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class LetterController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $letters = Letter::query()->paginate(12);

        return LetterResource::collection($letters);
    }

    /**
     * @param  StoreLetterRequest  $request
     * @return Application|ResponseFactory|Response
     */
    public function store(StoreLetterRequest $request)
    {
        $letter = Letter::query()->create($request->validated());

        return response([
            'user' => new LetterResource($letter),
            'msg' => 'Ok, letter created'
        ]);
    }

    /**
     * @param  UpdateLetterRequest  $request
     * @param  Letter  $letter
     * @return Application|ResponseFactory|Response
     */
    public function update(UpdateLetterRequest $request, Letter $letter)
    {
        $letter->update($request->validated());

        return response([
            'user' => new LetterResource($letter),
            'msg' => 'Ok, letter updated'
        ]);
    }

    /**
     * @param  Letter  $letter
     * @return Application|ResponseFactory|Response
     */
    public function destroy(Letter $letter)
    {
        $letter->delete();

        return response([
            'msg' => 'Ok, letter deleted'
        ]);
    }
}
