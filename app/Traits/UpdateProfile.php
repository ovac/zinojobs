<?php

namespace App\Traits;

use App\Http\Flash;

/**
 *
 */
trait UpdateProfile
{

    public function updateUserProfile($request, $user)
    {
        $this->validateUpdateProfileRequest($request);

        if (!$this->isValidUser($request, $user)) {

            return redirect()
                ->back()
                ->withErrors(['Invalid Request -> Unauthorized']);
        }

        $user->update(
            $request->only(
                $this->nameField,
                $this->emailField,
                $this->phoneField
            )
        );

        Flash::make()
            ->titleAs('Profile Updated.')
            ->createFlash('success');

        return redirect()->back();

    }

    public function validateUpdateProfileRequest($request)
    {
        $this->validate($request, [
            $this->emailField => "email",
            $this->phoneField => "required",
            $this->nameField => "required",
        ]);
    }
}
