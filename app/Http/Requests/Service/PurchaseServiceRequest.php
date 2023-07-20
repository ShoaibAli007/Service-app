<?php

namespace App\Http\Requests\Service;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseServiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'service_id' => 'required',
            'payment_method_nonce'=>'required'
        ]; 
    }
}
