<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthValidation
{
    static $instance = null;

    // Singleton pattern to ensure only one instance
    static function getInstance(){
        if(self::$instance == null){
            self::$instance = new self();
        }
        return self::$instance;
    }

    // Validate the request based on the method type
    public function validate($method, $request)
    {
        $rules = [];
        switch($method) {
            case 'register':
                $rules = [
                    'first_name' => 'required|string|max:255',
                    'last_name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:user',
                    'password' => 'required|string|min:8|confirmed',
                ];
                break;

            case 'login':
                $rules = [
                    'email' => 'required|email',
                    'password' => 'required|string',
                ];
                break;
        }

        $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                throw new \Exception($validator->errors()->first());
            }

            return true;
        }
}
