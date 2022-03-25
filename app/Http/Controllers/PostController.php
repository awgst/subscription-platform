<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Website;
use App\Services\SendEmailToSubscriber;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function store(Request $request, $websiteId)
    {
        try {
            $website = Website::find($websiteId);
            if (is_null($website)) {
                throw new Exception('Website not found');
            }

            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'description' => 'required'
            ]);
     
            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Error, the given data is invalid', 
                    'errors' => $validator->getMessageBag()->getMessages()
                ]);
            }
            $data = $validator->validated();
            $data['website_id'] = $websiteId;
            $post = Post::create($data);
            // $this->afterCreate($post);
            (new SendEmailToSubscriber($post))->send();
            $message = 'Post successfully created';
        } catch (Exception $e) {
            $message = $e->getMessage();       
        }

        return response()->json(['message' => $message], 200);
    }

    private function afterCreate($post)
    {
        // Artisan::call('send:email-subscriber', ['websiteId' => $post->website_id, 'postId' => $post->id]);
    }
}
