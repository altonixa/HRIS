<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        $user = $event->user;

        if (is_null($user->last_login_at)) {
            // First time logic could go here if needed specifically beyond email
            // e.g. AuditLog::create([...]);
        }
        
        // Update last login timestamp
        $user->last_login_at = now();
        $user->save();
        
        // In a real scenario, the 'Scenario B' email trigger would be checked here
        // But per requirements, Admin creation triggers it (Scenario A).
        // Scenario B covers legacy users.
        if (is_null($user->email_sent_at)) {
             // Dispatch email job
             // Mail::to($user->email)->queue(new \App\Mail\UserOnboardingEmail($user));
             // $user->email_sent_at = now();
             // $user->save();
             // Kept commented out until Mail configuration is finalized to prevent accidental spam during dev
        }
    }
}
