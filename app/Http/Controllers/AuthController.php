<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\User;
use App\Models\UserAccount;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Mail;

class AuthController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function showLoginForm(){
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        return view("auth.register");
    }

    public function showForgotForm()
    {
        return view("auth.forgot");
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            "email" => ["required", "email", "string"],
            "password" => ["required"]
        ]);

        if(auth("web")->attempt($data)) {
            return redirect(route("dashboard"));
        }

        return redirect(route("login"))->withErrors(["email" => "Пользователь не найден, либо данные введены не правильно"]);
    }

    public function forgot(Request $request)
    {
        $data = $request->validate([
            "email" => ["required", "email", "string", "exists:users"],
        ]);

        $user = User::where(["email" => $data["email"]])->first();

        $password = uniqid();

        $user->password = bcrypt($password);
        $user->save();

        Mail::to($user)->send(new ForgotPassword($password));

        return redirect(route("dashboard"));
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            "name" => ["required", "string"],
            "email" => ["required", "email", "string", "unique:users,email"],
            "password" => ["required", "confirmed"]
        ]);

        $user = User::create([
            "name" => $data["name"],
            "email" => $data["email"],
            "password" => bcrypt($data["password"])
        ]);

        $account = Account::create([
            'creator' => $user->id,
            "token" => bcrypt($user->password)
        ]);

        $userAccount = UserAccount::create([
            'user_id' => $user->id,
            'user_type' => 3,
            "account_id" => $account->id
        ]);

        if($user) {
            //event(new Registered($user));

            auth("web")->login($user);
        }

        return redirect(route("dashboard"));
    }

    public function logout()
    {
        auth("web")->logout();

        return redirect(route("dashboard"));
    }
}
