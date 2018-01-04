<?php

namespace App\Http\Controllers;

use App\Http\Flash;
use App\Traits\ChangePassword;
use App\Traits\UpdateProfile;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    use ChangePassword;
    use UpdateProfile;

    protected $oldPasswordField = 'currentPassword';
    protected $newPasswordField = 'newPassword';

    protected $nameField = 'name';
    protected $emailField = 'email';
    protected $phoneField = 'phone';

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->User();
        return view('account', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $route)
    {
        if ($route == 'avatar' && $request->avatar) {
            return $this->updateAvatar($request);
        }

        if ($route == 'profile') {
            return $this->updateUserProfile($request, $request->user());
        }

        if ($route == 'password') {
            return $this->updatePassword($request, $request->user());
        }
    }

    public function updateAvatar(Request $request)
    {
        $request->validate(['avatar' => "required|image"]);

        $user = $request->user();
        $user->avatar = $request->avatar->store('avatar', 'public');
        $user->save();

        Flash::make()
            ->titleAs('Avatar Updated.')
            ->createFlash('success');

        return redirect()->back();
    }
}
