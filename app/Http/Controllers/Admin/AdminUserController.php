<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\User_sipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminUserController extends Controller
{
    private $base_view = 'admin.user.';
    private $path = 'admin.users';


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with(['roles', 'permissions'])->paginate(10);
        
        // Count statistics
        $totalUsers = User::count();
        $activeUsers = User::where('active', 1)->count();
        $adminUsers = User::whereHas('roles', function($q) { 
            $q->where('name', 'Admin'); 
        })->count();
        $petugasUsers = User::whereHas('roles', function($q) { 
            $q->where('name', 'Petugas'); 
        })->count();
        
        $data = [
            'title' => 'User Management',
            'users' => $users,
            'totalUsers' => $totalUsers,
            'activeUsers' => $activeUsers,
            'adminUsers' => $adminUsers,
            'petugasUsers' => $petugasUsers,
        ];
        return view($this->base_view . 'index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::pluck('name', 'id');
        $permissions = Permission::pluck('name', 'id');
        
        return view($this->base_view . 'create', compact('roles', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:190',
            'email' => 'required|string|email|max:190|unique:users',
            'username' => 'required|string|max:190|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => 'nullable|string|max:20',
            'work' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:500',
            'ktp' => 'nullable|string|max:16',
            'nip' => 'nullable|string|max:50',
            'nik' => 'nullable|string|max:50',
            'role_id' => 'required|exists:roles,id',
            'permission_lists' => 'nullable|array',
            'permission_lists.*' => 'exists:permissions,id',
        ], [
            'required' => 'Kolom :attribute harus di isi!',
            'string' => 'Format :attribute tidak sesuai',
            'email' => 'Format :attribute tidak sesuai',
            'max' => 'Kolom :attribute maksimal :max Karakter',
            'unique' => 'Data :attribute sudah terdaftar',
            'exists' => 'Data :attribute tidak valid',
        ]);

        $req = $request->except('_token', 'password', 'role_id', 'permission_lists');
        $req['password'] = Hash::make($request->password);
        $req['active'] = 1;

        $model = User::create($req);
        $model->assignRole($request->role_id);

        if ($request->has('permission_lists')) {
            $model->givePermissionTo($request->permission_lists);
        }

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user->load(['roles', 'permissions']);
        return view($this->base_view . 'show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $user->load(['roles', 'permissions']);
        $roles = Role::pluck('name', 'id');
        $permissions = Permission::pluck('name', 'id');
        
        return view($this->base_view . 'edit', compact('user', 'roles', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:190',
            'email' => 'required|string|email|max:190|unique:users,email,' . $user->id,
            'username' => 'required|string|max:190|unique:users,username,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'work' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:500',
            'ktp' => 'nullable|string|max:16',
            'nip' => 'nullable|string|max:50',
            'nik' => 'nullable|string|max:50',
            'role_id' => 'required|exists:roles,id',
            'permission_lists' => 'nullable|array',
            'permission_lists.*' => 'exists:permissions,id',
        ], [
            'required' => 'Kolom :attribute harus di isi!',
            'string' => 'Format :attribute tidak sesuai',
            'email' => 'Format :attribute tidak sesuai',
            'max' => 'Kolom :attribute maksimal :max Karakter',
            'unique' => 'Data :attribute sudah terdaftar',
            'exists' => 'Data :attribute tidak valid',
        ]);

        $req = $request->except('_token', 'password', 'role_id', 'permission_lists');

        $user->update($req);
        $user->syncRoles([$request->role_id]);
        $user->syncPermissions($request->permission_lists ?? []);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil dihapus.');
    }

    /**
     * Toggle user active status
     */
    public function toggleStatus(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->update(['active' => $request->value]);

        return response()->json([
            'success' => true,
            'message' => 'Status user berhasil diperbarui.'
        ]);
    }

    /**
     * Show reset password form
     */
    public function resetPassword(User $user)
    {
        return view($this->base_view . 'reset-password', compact('user'));
    }

    /**
     * Update user password
     */
    public function updatePassword(Request $request, User $user)
    {
        $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'required' => 'Kolom :attribute harus di isi!',
            'confirmed' => 'Konfirmasi password tidak sesuai',
        ]);

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Password berhasil direset.'
        ]);
    }

}
