<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Validator;

class EventValidation
{
    static $instance = null;

    private function __construct() {}

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function validate($method, $request)
    {
        $rules = [];
        switch($method) {
            case 'create':
                $rules = [
                    'event_name' => ['required', 'string', 'max:255'],
                    'description' => ['required', 'string'],
                    'location' => ['required', 'string', 'max:255'],
                    'image_url' => ['nullable', 'url'],
                    'date' => ['required', 'date', 'after:today'],
                    'participants_number' => ['required', 'integer', 'min:0'],
                    'max_participants_number' => ['required', 'integer', 'min:1', 'gte:participants_number'],
                    'verified_at' => ['nullable', 'date'],
                ];
                break;
        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            throw new \Exception($validator->errors()->first());
        }

        return true;
    }
}
