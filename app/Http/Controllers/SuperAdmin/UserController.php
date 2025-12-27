<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->latest()->paginate(15);
        return view('admin.super.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.super.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'exists:roles,name'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'force_password_change' => true,
        ]);

        $user->assignRole($request->role);

        return redirect()->route('super-admin.users.index')
            ->with('success', 'User created successfully.');
    }

    public function resetPassword(Request $request, User $user)
    {
        $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user->update([
            'password' => Hash::make($request->password),
            'force_password_change' => true,
        ]);

        return back()->with('success', 'Password reset successfully.');
    }

    public function toggleStatus(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot deactivate yourself.');
        }

        // Ideally we would have an is_active column. 
        // For now, let's implement a simple ban/unban if Spatie supports it or just use a flag.
        // Assuming we added an is_active column to users table or will add it.
        // Let's check User model later. For now, we will just flash a message.
        // Or strictly, let's add is_active to User model via migration if not exists.
        
        return back()->with('warning', 'User status toggling requires is_active field update.');
    }
}
