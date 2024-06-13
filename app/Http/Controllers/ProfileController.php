<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Services\PresensiService;

class ProfileController extends Controller
{
    public function show(PresensiService $ps): View
    {
        $user = Auth::user();

        return view('profile.show', [
            'user' => $user,
            'jam' => $ps->getJamKerja($user)
        ]);
    }
    /**
     * Display the user's profile form.
     */
    public function edit(): View
    {
        return view('profile.edit', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $request->user()->authable->update($data);
        return Redirect::route('profile.show')->with('status', 'profile-updated');
    }
}
