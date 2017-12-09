<?php

namespace App\Http\Controllers;

use App\Repositories\AuthorizedKeys;
use App\AuthorizedKey;

class AuthorizedKeysController extends Controller
{
    public function index(AuthorizedKeys $AuthorizedKeys)
    {
        $authorizedKeys = $AuthorizedKeys->byUser(auth()->id());

        return view('settings.authorized_keys.index', compact('authorizedKeys'));
    }

    public function store()
    {
        $this->validate(request(), [
            'title' => 'required|min:3',
            'public_key' => 'required'
        ]);

        auth()->user()->addKey(
            new AuthorizedKey(request(['title', 'public_key']))
        );

        return back();
    }

    public function destroy(AuthorizedKey $authorizedKey)
    {
        auth()->user()->removeKey($authorizedKey);

        return back();
    }
}
