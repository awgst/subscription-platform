<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Repositories\PostRepository;
use App\Repositories\WebsiteRepository;
use App\Services\SendEmailToSubscriber;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    private $post;
    public function __construct(PostRepository $post)
    {
        $this->post = $post;    
    }

    public function store(Request $request, $websiteId)
    {
        try {
            // Check Website
            $website = resolve(WebsiteRepository::class)->find($websiteId);
            if (is_null($website)) {
                throw new Exception('Website not found');
            }

            // Validation
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

            // Create post and send email to subscriber
            $post = $this->post->store($data);
            (new SendEmailToSubscriber($post))->send();
            $message = 'Post successfully created';
        } catch (Exception $e) {
            $message = $e->getMessage();       
        }

        return response()->json(['message' => $message], 200);
    }
}
