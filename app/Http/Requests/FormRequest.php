<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest as LaravelFormRequest;
use Illuminate\Http\JsonResponse;

abstract class FormRequest extends LaravelFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    abstract public function authorize();
    abstract public function rules();

    /**
     * Get the failed validation response for the request.
     *
     * @param array $errors
     * @return JsonResponse
     */
    public function response(array $errors)
    {
        $transformed = [];
        foreach ($errors as $field => $message) {
            \array_merge($transformed, $message[0]);
        }

        return response()->json([
            'status' => false,
            'error' => [
                'code' => JsonResponse::HTTP_UNPROCESSABLE_ENTITY,
                'messages' => $transformed
            ]
        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
    }
}