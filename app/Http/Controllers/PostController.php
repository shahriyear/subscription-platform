<?php

namespace App\Http\Controllers;

use App\Jobs\SubscriberMailQueueJob;
use App\Models\Post;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    use ResponseTrait;

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'website_id'     => 'required|integer|gt:0',
            'title'          => 'required',
            'description'    => 'required',
        ]);

        if ($validator->fails()) {
            return $this->commonErrorResponse($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $post = Post::create($request->all());
            if ($post) {
                $this->dispatchSubscriberMailQueueJob($post);
            }
            return $this->commonSuccessResponse($post, Response::HTTP_CREATED);
        } catch (Exception $e) {
            Log::debug($e->getMessage());
            return $this->commonErrorResponse('something went wrong', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    private function dispatchSubscriberMailQueueJob($post)
    {
        $job = new SubscriberMailQueueJob($post->toArray());
        $job->delay(now()->addSeconds(5));
        dispatch($job);
    }
}
