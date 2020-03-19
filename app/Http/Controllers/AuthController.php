<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Redirect, Response;
use App\User;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect as FacadesRedirect;
use Illuminate\Support\Facades\Session as FacadesSession;
use Session;
use Symfony\Component\HttpFoundation\Session\Session as HttpFoundationSessionSession;

class AuthController extends Controller
{

    public function index()
    {
        return view('user.login');
    }

    public function registration()
    {
        return view('user.reg');
    }

    public function postLogin(Request $request)
    {
        // $this->validateLogin($request);

        // $credentials = $request->only('email', 'password');
        // if (Auth::attempt($credentials)) {
        //     // Authentication passed...
        //     return redirect()->intended('dashboard');
        // }
        // if ($this->attemptLogin($request)) {
        //     return redirect()->intended('dashboard');
        // }
        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']], $request['remember'])) {
            return redirect(route('home'));
        }
        return redirect(route('login'))->withSuccess('Oppes! You have entered invalid credentials');
    }
    // private function attemptLogin(Request $request)
    // {
    //     return Auth::guard()->attempt(
    //         $this->credentials($request),
    //         $request->filled('remember')
    //     );
    // }
    // private function validateLogin(Request $request)
    // {
    //     $request->validate([
    //         Auth::username() => 'required|string',
    //         'password' => 'required|string',
    //     ]);
    // }
    public function postRegistration(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'gender' => 'required',
            'email' => 'required|email|unique:users',
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $data = $request->all();

        $check = $this->create($data);

        return redirect(route('home'))->withSuccess('Great! You have Successfully loggedin');
    }

    public function dashboard()
    {

        if (Auth::check()) {
            return view('home');
        }
        return redirect(route('login'));
    }

    public function create(array $data)
    {
        if ($data['gender']) {
            $avatar = 'default/avatar/male.png';
        } else {
            $avatar = 'default/avatar/female.png';
        }
        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'gender' => $data['gender'],
            'avatar' => $avatar,
            'password' => bcrypt($data['password']),
        ]);
        $id = User::where('slug', str_slug($user->name))->count();
        $user->slug = str_slug($user->name) . '-' . $id;
        $user->save();
        return $user;
    }

    public function logout()
    {
        session()->flush();
        Auth::logout();
        return Redirect(route('login'));
    }
}
