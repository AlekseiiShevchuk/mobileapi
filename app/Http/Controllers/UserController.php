<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserUpdateRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Register a new user.
     *
     * @param  UserRegisterRequest $request
     * @return \Illuminate\Http\Response
     */
    public function register(UserRegisterRequest $request)
    {
        $user = User::create([
            'id_gender' => $request['id_gender'],
            'firstname' => $request['firstname'],
            'lastname' => $request['lastname'],
            'email' => $request['email'],
            'newsletter' => !empty($request['newsletter'])?$request['newsletter']:0,
            'id_lang' => !empty($request['id_lang'])?$request['id_lang']:2,
            'birthday' => !empty($request['birthday'])?$request['birthday']:null,
            'date_add' => new \DateTime('now'),
            'date_upd' => new \DateTime('now'),
            'passwd' => md5(User::_COOKIE_KEY_.$request['passwd']),
            'secure_key'=> md5(uniqid(rand(), true))
        ]);
        $freshUserFromDb = User::find($user->id_customer);
        return response($freshUserFromDb, 201);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserUpdateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request)
    {
        /* @var User $user */
        $user = Auth::user();
        $user->update($request->all());
        $user->date_upd = new \DateTime('now');
        if(!empty($request['passwd'])){
            $user->passwd = md5(User::_COOKIE_KEY_.$request['passwd']);
        }
        $user->save();
        $freshUserFromDb = User::find($user->id_customer);
        return $freshUserFromDb;
    }
}
