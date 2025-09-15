<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $request->user()->fill($request->validated());

            if ($request->user()->isDirty('email')) {
                $request->user()->email_verified_at = null;
            }

            $request->user()->save();

            DB::commit();

            return Redirect::route('profile.edit')->with('status', 'profile-updated');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Profile update error: ' . $e->getMessage());

            return Redirect::route('profile.edit')->with('error', 'حدث خطأ أثناء تحديث الملف الشخصي');
        }
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        DB::beginTransaction();

        try {
            $user = $request->user();

            Auth::logout();

            $user->delete();

            DB::commit();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return Redirect::to('/');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Profile delete error: ' . $e->getMessage());

            return Redirect::route('profile.edit')->with('error', 'حدث خطأ أثناء حذف الحساب');
        }
    }
}
