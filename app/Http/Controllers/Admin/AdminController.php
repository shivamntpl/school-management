<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\RedirectResponse;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use App\Notifications\ForgotPassword;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;

class AdminController extends Controller
{

    public function create(){
        return view('adminauth.login');
    }

    /**
     * for login store admin creadentials
     */
    public function store(Request $request){
        $creadential = $request->validate([
            'email' => ['required','string','email','max:20'],
            'password' => ['required']

        ]);
        if (! Auth::guard('admins')->attempt($creadential ,$request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
            }
        $request->session()->regenerate();
        return redirect()->route('dashboard');

    }


    public function destroy(Request $request)
    {
        Auth::guard('admins')->logout();

        $request->session()->forget('admins');

        $request->session()->regenerateToken();

        return redirect()->route('auth.login')->with('status','you are successfully logout');
    }
}
