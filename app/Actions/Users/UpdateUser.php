<?php

namespace App\Actions\Users;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UpdateUser
{
    /**
     * Update a registered user.
     *
     * @param  array  $input
     * @param App\Http\Requests\UserRequest $request
     * @return \App\Models\User
     */
    public function update(User $user, UserRequest $request)
    {
        $data = $request->all();
        $data['password'] = isset($data['password']) ? Hash::make($data['password']) : $user->password;
        $user->update($data);
    }
}
