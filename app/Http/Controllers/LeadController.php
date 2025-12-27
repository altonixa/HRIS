<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Lead;
use App\Mail\DemoRequestNotification;
use Illuminate\Support\Facades\Mail;
use App\Mail\DemoAccessCredentials;

class LeadController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'organization' => 'nullable|string|max:255',
            'whatsapp_number' => 'required|string|max:20',
            'message' => 'nullable|string',
        ]);

        $lead = Lead::create($validated);


        // Send email notification to Altonixa
        Mail::to('altonixa@gmail.com')->send(new DemoRequestNotification($lead));

        // Send demo credentials to the user
        Mail::to($lead->email)->send(new DemoAccessCredentials($lead->name));

        return back()->with('success', 'Thank you! Access credentials have been sent to your email.');
    }
}
