<?php
namespace App\Http\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Documents;

class IsOwner implements Rule
{
public function passes($attribute, $value)
{
return auth()->user()->id == \App\Documents::find($value)->user_id;
}

public function message()
{
return 'You are forbidden from taking this action!';
}
}
