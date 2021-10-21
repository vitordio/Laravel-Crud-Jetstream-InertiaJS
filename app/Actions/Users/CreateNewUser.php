<?php

namespace App\Actions\Users;

use App\Http\Requests\UserRequest;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateNewUser
{
    /**
     * Create a newly registered user.
     *
     * @param App\Http\Requests\UserRequest $request
     * @return \App\Models\User
     */
    public function create(UserRequest $request)
    {
        return DB::transaction(function () use ($request) {
            return tap(User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]), function (User $user) {
                $this->createTeam($user);
            });
        });
    }

    /**
     * Create a personal team for the user.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    protected function createTeam(User $user)
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0]."'s Team",
            'personal_team' => true,
        ]));
    }
}
