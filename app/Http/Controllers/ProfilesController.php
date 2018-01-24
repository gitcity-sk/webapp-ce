<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;

class ProfilesController extends Controller
{
    // GET /profiles/{id}
    public function show(Profile $profile)
    {
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
        $profile->update(request(['name', 'description', 'facebook', 'twitter']));

        return redirect('/profiles/' . $profile->id);
    }
}
