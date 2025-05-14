<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all users from the database
        $users = User::whereHas('role', function($query) {
            $query->where('role_name', '!=', 'customer');
        })->orderBy('fullname')->get();

        // Return the users to a view
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Fetch all roles from the database
        $roles = Role::all();
        // Return the view to create a new user
        return view('admin.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'fullname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'phone' => 'required|string|max:255|unique:users,phone',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id',
        ], [
            'fullname.required' => 'The full name is required.',
            'username.required' => 'The username is required.',
            'phone.required' => 'The phone number is required.',
            'email.required' => 'The email address is required.',
            'password.required' => 'The password is required.',
            'role_id.required' => 'The role is required.',
            'password.confirmed' => 'The password confirmation does not match.',
            'username.unique' => 'The username has already been taken.',
            'phone.unique' => 'The phone number has already been taken.',
            'email.unique' => 'The email address has already been taken.',
        ]);

        // Create a new user
        $validatedData['password'] = bcrypt($validatedData['password']);

        User::create($validatedData);

        // Redirect to the users index with a success message
        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);

        // Fetch all roles from the database
        $roles = Role::all();

        // Return the view to edit the user
        return view('admin.user.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'fullname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'phone' => 'required|string|max:15',
            'email' => 'required|email|unique:users,email,'. $user->id,
            'password' => ['nullable','string','min:8','confirmed', function($attribute, $value, $fail) use ($user) {
                    if(Hash::check($value, $user->password)) {
                        $fail("Password baru tidak boleh sama dengan password lama");
                    }
                },
            ],
            'role_id' => 'required|exists:roles,id',
        ], [
            'fullname.required' => 'The full name is required.',
            'username.required' => 'The username is required.',
            'phone.required' => 'The phone number is required.',
            'email.required' => 'The email address is required.',
            'role_id.required' => 'The role is required.',
            'password.confirmed' => 'The password confirmation does not match.'
        ]);

        // Create a new user
        $validatedData['password'] = bcrypt($validatedData['password']);

        $user->update($validatedData);

        // Redirect to the users index with a success message
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the role by ID
        $user = User::findOrFail($id);

        // Delete the role
        $user->delete();

        // Redirect to the roles index with a success message
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
