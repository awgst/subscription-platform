<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function subscribe($id, $websiteId)
    {
        try {
            $user = User::find($id);
            if (is_null($user)) {
                throw new Exception('User not found');
            }
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
