<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SendNotificationRequest;
use App\Models\Contact;
use App\Models\Letter;
use App\Notifications\ContactNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller
{
    /**
     * @param  SendNotificationRequest  $request
     * @return JsonResponse
     */
    public function send(SendNotificationRequest $request): JsonResponse
    {
        $letter = Letter::query()->findOrFail($request->letter_id);
        $contacts = Contact::query()->find($request->contacts);

        Notification::send($contacts, new ContactNotification($letter));

        return response()->json([
            'msg' => 'Ok, notification sent by contact'
        ]);
    }
}
