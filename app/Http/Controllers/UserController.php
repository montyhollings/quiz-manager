<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserEditRequest;
use App\Http\Requests\UserRequest;
use App\Models\Quiz;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('usercanedit');
    }

    public function index(Request $request)
    {
        $Users = User::all();

        return view('user.index', compact('Users'));

    }
    public function create(Request $request)
    {
        $User = null;
        $form_url = route('users.submit_create');
        return view('user.add_edit', compact('User', 'form_url'));

    }

    public function submit_create(UserCreateRequest $request)
    {
        User::create($request->input());
        Session::flash('message', 'User Created!');
        Session::flash('alert-class', 'alert-success');
       return redirect()->route('users.index');

    }

    public function edit(Request $request, $user_id)
    {
        $User = User::findorfail($user_id);
        $form_url = route('users.submit_edit', [$user_id]);
        return view('user.add_edit', compact('User', 'form_url'));

    }
    public function submit_edit(UserEditRequest $request, $user_id)
    {
        $User = User::findorfail($user_id);
        $User->update($request->input());
        Session::flash('message', 'User Edited!');
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('users.index');

    }

    public function delete(Request $request, $user_id)
    {
        $User = User::with('role')->findorfail($user_id);
        if($User->id == Auth::user()->id)
        {
            Session::flash('message', 'Cannot delete yourself!');
            Session::flash('alert-class', 'alert-danger');
            return redirect()->route('users.index');
        }

        $User->delete();
        Session::flash('message', 'User Deleted!');
        Session::flash('alert-class', 'alert-danger');
        return redirect()->route('users.index');

    }
}
