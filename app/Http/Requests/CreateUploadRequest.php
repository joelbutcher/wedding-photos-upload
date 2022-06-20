<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUploadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'images' => ['array'],
            'images.*' => ['file', 'image'],
            'name' => ['string', 'required', 'min:3', 'max:255'],
            'email' => ['string', 'required', 'email', 'min:3', 'max:255'],
            'comment' => ['string', 'sometimes'],
        ];
    }

    public function images(): array
    {
        return $this->images;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function comment(): ?string
    {
        return $this->comment;
    }
}
