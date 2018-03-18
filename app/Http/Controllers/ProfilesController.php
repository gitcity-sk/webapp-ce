<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Profile;

class ProfilesController extends Controller
{
    // GET /profiles/{id}
    /**
     * @param Profile $profile
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Profile $profile)
    {
        //dd(Storage::get($profile->image));
        return view('profiles.show', compact('profile'));
    }

    // GET /profiles/{id}/edit

    /**
     * @param Profile $profile
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Profile $profile)
    {
        return view('profiles.edit', compact('profile'));
    }

    // PUT/PATCH /profiles/{id}

    /**
     * @param Profile $profile
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Profile $profile)
    {
        if (request()->file()) {
            $path = request()->file('image')->store('avatars');

            $profile->update([
                'image' => $path
            ]);
        }

        $profile->update(request(['name', 'description', 'facebook', 'twitter']));

        return redirect('/profiles/' . $profile->id);
    }
}
