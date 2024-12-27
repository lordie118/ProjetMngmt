<?php
namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Models\User;
use App\Models\Workspace;
use App\Notifications\InviteUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Filament\Notifications\Notification;

class InvitationController extends Controller {
    public function invite(Request $request, Workspace $workspace) {

        if($workspace->owner_id != auth()->user()->id) {
            abort(403);
        }
        $request->validate([
            'email' => 'required|email'
        ]);

        $invitation = Invitation::create([
            'email' => $request->email,
            'workspace_id' => $workspace->id,
            'invited_by' => Auth::id(),
            'token' => Str::random(32),
        ]);

        $invitation->notify(new InviteUser($invitation));
        session()->flash('success', 'Invitation sent successfully!');
         return redirect('/account');
    }

    public function accept($token) {
        $invitation = Invitation::where('token', $token)->firstOrFail();
       
        DB::transaction(function() use ($invitation) {
            $name = explode('@', $invitation->email)[0];
            $user = User::firstOrCreate(
                ['email' => $invitation->email],
                [
             'name' => $name, // Assign the placeholder name
                    'password' => bcrypt(Str::random(16))
                ]
            );

            $invitation->workspace->members()->attach($user->id);

            $invitation->delete();
        });

        // Optionally log the user in
        Auth::login(User::where('email', $invitation->email)->first());

        return redirect('/account');
    }
}
