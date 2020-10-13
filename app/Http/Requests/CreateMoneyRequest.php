<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMoneyRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'wallet_id' => 'required|exists:wallets,id',
            'amount'    => 'required|numeric|min:0',
            'type'      => 'required|boolean',
            'name'      => 'required|string'
        ];
    }
}
