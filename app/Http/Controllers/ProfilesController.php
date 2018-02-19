<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Profile;

class ProfilesController extends Controller
{
    // GET /profiles/{id}
    public function show(Profile $profile)
    {
        //dd(Storage::get($profile->image));
        return view('profiles.show', compact('profile'));
    }

    // GET /profiles/{id}/edit
    public function edit(Profile $profile)
    {
        return view('profiles.edit', compact('profile'));
    }

    // PUT/PATCH /profiles/{id}
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
