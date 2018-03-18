<?php

namespace App\Http\Controllers;

use App\Repositories\AuthorizedKeys;
use App\AuthorizedKey;

class AuthorizedKeysController extends Controller
{
    /**
     * @param AuthorizedKeys $AuthorizedKeys
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(AuthorizedKeys $AuthorizedKeys)
    {
        $authorizedKeys = $AuthorizedKeys->byUser(auth()->id());

        return view('settings.authorized_keys.index', compact('authorizedKeys'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * @param AuthorizedKey $authorizedKey
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(AuthorizedKey $authorizedKey)
    {
        auth()->user()->removeKey($authorizedKey);

        return back();
    }
}
