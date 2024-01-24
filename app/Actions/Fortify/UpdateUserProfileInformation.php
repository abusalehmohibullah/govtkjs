<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Teacher;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, string>  $input
     */
    public function update(User $user, array $input): void
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
            'date_of_birth' => ['nullable', 'date', 'max:255'],
            'nid' => ['nullable', 'string', 'max:255'],
            'joining_date' => ['nullable', 'date', 'max:255'],
            'qualification' => ['nullable', 'string'],
            'mobile_no' => ['nullable', 'string'],
            'facebook' => ['nullable', 'string'],
            'instagram' => ['nullable', 'string'],
            'twitter' => ['nullable', 'string'],
            'linkedin' => ['nullable', 'string'],
            'youtube' => ['nullable', 'string'],
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'name' => $input['name'],
                'email' => $input['email'],
            ])->save();
        }

        $user->teacher()->update([
            'date_of_birth' => $input['date_of_birth'],
            'nid' => $input['nid'],
            'joining_date' => $input['joining_date'],
            'qualification' => $input['qualification'],
            'mobile_no' => $input['mobile_no'],
            'facebook' => $input['facebook'],
            'instagram' => $input['instagram'],
            'twitter' => $input['twitter'],
            'linkedin' => $input['linkedin'],
            'youtube' => $input['youtube'],
        ]);
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, string>  $input
     */
    protected function updateVerifiedUser(User $user, array $input): void
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
