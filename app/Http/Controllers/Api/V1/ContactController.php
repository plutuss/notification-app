<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreContactRequest;
use App\Http\Requests\Api\UpdateContactRequest;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ContactController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $contacts = Contact::query()->paginate(12);

        return ContactResource::collection($contacts);
    }

    /**
     * @param  StoreContactRequest  $request
     * @return Application|ResponseFactory|Response
     */
    public function store(StoreContactRequest $request)
    {
        $contact = Contact::query()->create($request->validated());

        return response([
            'user' => new ContactResource($contact),
            'msg' => 'Ok, contact created'
        ]);
    }


    /**
     * @param  UpdateContactRequest  $request
     * @param  Contact  $contact
     * @return Application|ResponseFactory|Response
     */
    public function update(UpdateContactRequest $request, Contact $contact)
    {
        $contact->update($request->validated());

        return response([
            'user' => new ContactResource($contact),
            'msg' => 'Ok, contact updated'
        ]);
    }

    /**
     * @param  Contact  $contact
     * @return Application|ResponseFactory|Response
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return response([
            'msg' => 'Ok, contact deleted'
        ]);
    }


}
