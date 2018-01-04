<?php

namespace App\Traits;

use App\Http\Flash;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

/**
 *
 */
trait ChangePassword
{

    public function updatePassword($request, User $account)
    {
        $this->validateChangePasswordRequest($request);

        if (!$this->isValidUser($request, $account)) {
            return redirect()->back()->withErrors(['Invalid Request -> Unauthorized']);
        }

        if (Hash::check($request->input($this->oldPasswordField), $account->password)) {
            return $this->saveNewPassword($request);
        }

        return redirect()->back()
            ->withErrors(['You entered an invalid password']);
    }

    public function validateChangePasswordRequest($request)
    {
        $validator = Validator::make($request->all(), [
            $this->oldPasswordField => "required",
            $this->newPasswordField => "required|min:6|confirmed|different:{$this->oldPasswordField}",
        ])->validate();
    }

    public function isValidUser($request, $user)
    {
        if ($request->user()->id === $user->id) {
            return true;
        }

        return false;
    }

    public function saveNewPassword($request)
    {
        return DB::transaction(function () use ($request) {

            $user = User::find($request->user()->id);
            $user->password = Hash::make($request->input($this->newPasswordField));

            if ($user->save()) {
                return $this->passwordChanged() ?: redirect()->back();
            }

            return redirect()->back()
                ->withErrors(['Unable to save the new password. Try again.']);
        });
    }

    public function passwordChanged()
    {
        Flash::make()
            ->withMessage('Password changed successfully.')
            ->createFlash('success');
    }
}
