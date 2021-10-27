<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class SubscriberController extends Controller
{
    use ResponseTrait;

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'website_id'     => 'required|integer|gt:0',
            'email'     => 'required|email',
        ]);

        if ($validator->fails()) {
            return $this->commonErrorResponse($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if ($this->exitingSubscriber($request->website_id, $request->email)) {
            return $this->commonErrorResponse('This email is already subscribed to this website', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $subscriber = Subscriber::create($request->all());
            return $this->commonSuccessResponse($subscriber, Response::HTTP_CREATED);
        } catch (Exception $e) {
            Log::debug($e->getMessage());
            return $this->commonErrorResponse('something went wrong', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    private function exitingSubscriber(int $websiteId, string $email): bool
    {
        return Subscriber::where(['website_id' => $websiteId, 'email' => $email])->count();
    }
}
