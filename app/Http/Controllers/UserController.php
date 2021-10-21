<?php

namespace App\Http\Controllers;

use App\Actions\Users\DeleteUser;
use App\Actions\Users\CreateNewUser;
use App\Actions\Users\UpdateUser;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;
use Inertia\Inertia;
use Laravel\Jetstream\Contracts\DeletesTeams;

class UserController extends Controller
{
    /**
     * User instances
    */
    protected $users;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $users)
    {
        $this->users = $users;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Users/Index', [
            'users' => $this->users::orderBy('id', 'desc')->paginate()
        ]);
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
        try {
            $action->create($request);
            $flashStatus = [
                'flash.banner' => trans('messages.saved'),
                'flash.bannerStyle' => 'success'
            ];
        } catch (Exception $ex) {
            if(env('AMBIENTE') === 'DEV')
                throw $ex;
            else
                $flashStatus = [
                    'flash.banner' => trans('messages.saved_failed'),
                    'flash.bannerStyle' => 'danger'
                ];
        }

        return back()->with($flashStatus);
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
        try {
            $action->update($user, $request);
            $flashStatus = [
                'flash.banner' => trans('messages.edited'),
                'flash.bannerStyle' => 'success'
            ];
        } catch (Exception $ex) {
            if(env('AMBIENTE') === 'DEV')
                throw $ex;
            else
                $flashStatus = [
                    'flash.banner' => trans('messages.edited_failed'),
                    'flash.bannerStyle' => 'danger'
                ];
        }

        return back()->with($flashStatus);
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
        try {
            $deleteUser = new DeleteUser($deletesTeams);
            $deleteUser->delete($user);

            $flashStatus = [
                'flash.banner' => trans('messages.deleted'),
                'flash.bannerStyle' => 'success'
            ];
        } catch (Exception $ex) {
            if(env('AMBIENTE') === 'DEV')
                throw $ex;
            else
                $flashStatus = [
                    'flash.banner' => trans('messages.delete_failed'),
                    'flash.bannerStyle' => 'danger'
                ];
        }

        return back()->with($flashStatus);


        return back();
    }
}
