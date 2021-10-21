<?php

namespace App\Http\Controllers;

use App\Actions\Users\DeleteUser;
use App\Actions\Users\CreateNewUser;
use App\Actions\Users\UpdateUser;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Inertia\Inertia;
use Laravel\Jetstream\Contracts\DeletesTeams;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Users/Index', ['users' => User::orderBy('id', 'desc')->paginate()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\UserRequest $request
     * @param  App\Actions\Users\CreateNewUser $action
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request, CreateNewUser $action)
    {
        $action->create($request);
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\UserRequest $request
     * @param  \App\Models\User $user
     * @param  App\Actions\Users\UpdateUser $action
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user, UpdateUser $action)
    {
        $action->update($user, $request);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user,
     * @param  App\Actions\Users\DeleteUser $action
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, DeletesTeams $deletesTeams)
    {
        $deleteUser = new DeleteUser($deletesTeams);
        $deleteUser->delete($user);
        return back();
    }
}
