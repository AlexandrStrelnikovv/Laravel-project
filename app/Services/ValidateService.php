<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function Laravel\Prompts\error;

class ValidateService
{
    public static function ValidateTask(Request $request)
    {
        $validate = Validator::make($request->all(),
            [
                'name' => 'required|max:256',
                'description' => 'required|max:256',
                'priority' => 'required|max:256',
                'executor_user_id' => 'required|integer',
            ],
            [
                'name.required' => 'Имя не должно быть пустым!',
                'description.required' => 'Введите текст задачи',
                'executor_user_id.required' => 'Выберите исполнителя',
            ]
        );

        if($validate->fails()){
            return [
                'success' => false,
                'errors' => $validate->errors()->toArray(),
                ];
        }

        return [
            'success' => true,
            'validData' => $validate->validated(),
        ];
    }

    public static function ValidateUpdatedTask(Request $request)
    {
        $validate = Validator::make($request->all(),
            [
                'name' => 'required|max:256',
                'description' => 'required|max:256',
                'priority' => 'required|max:256',
            ],
            [
                'name.required' => 'Имя не должно быть пустым!',
                'description.required' => 'Введите текст задачи',
            ]
        );

        if($validate->fails()){
            return [
                'success' => false,
                'errors' => $validate->errors()->toArray(),
            ];
        }

        return [
            'success' => true,
            'validData' => $validate->validated(),
        ];
    }
}
