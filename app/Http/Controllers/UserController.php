<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    private $user;
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function subscribe($id, $websiteId)
    {
        try {
            $user = $this->user->find($id);
            // Check user
            if (is_null($user)) {
                throw new Exception('User not found');
            }
            // Check if user is already subscribed or not
            if ($user->websites()->find($websiteId)) {
                throw new Exception('Already subscribed');
            }
            $user->websites()->attach([$websiteId]);
            $message = 'Successfully subscribed';
        } catch (Exception $e) {
            $message = $e->getMessage();
        }

        return response()->json(['message' => $message], 200);
        
    }
}
