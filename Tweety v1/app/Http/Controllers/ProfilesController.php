<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfilesController extends Controller
{
    public function show(User $user) {
        return view ('profiles.show', [
            'user' => $user,
            'tweets' => $user->tweets()->withLikes()->paginate(11)
        ]);
    }

    public function edit(User $user) {
        // Either check the authorization like this or by making a policy
//        abort_if($user->isNot(current_user()), 404);

        // Either do this or add middleware in the web route file
//        $this->authorize('edit', $user);

        return view('profiles.edit', compact('user'));
    }

    public function update(User $user) {
        $this->authorize('edit', $user);

        $attributes = request()->validate([
            'username' => [
                'string',
                'required',
                'alpha_dash',
                'max:255',
                Rule::unique('users')->ignore($user)
            ],
            'name' => ['string', 'required', 'max:255'],
            'avatar' => ['file'],
            'email' => ['string', 'required', 'email', 'max:255', Rule::unique('users')->ignore($user)],
            'password' => ['string', 'required', 'min:8', 'max:255'. 'confirmed']
        ]);

        if (request('avatar')) {
            $attributes['avatar'] = request('avatar')->store('avatar');
        }

        $user->update($attributes);

        return redirect($user->path());
    }
}
