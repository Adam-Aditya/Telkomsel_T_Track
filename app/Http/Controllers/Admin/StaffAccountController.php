<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role; // Asumsi Anda memiliki model Role, jika menggunakan tabel roles
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffAccountController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        // Mengambil semua user kecuali akun Admin yang sedang login saat ini (agar tidak terhapus sendiri)
        $users = User::with('role')
            ->when($search, function($query) use ($search) {
                return $query->where('name', 'LIKE', "%{$search}%")
                             ->orWhere('email', 'LIKE', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        // Ambal data role untuk opsi dropdown di form (biasanya id 1: Admin, 2: Staff, 3: Manager)
        // Jika Anda menggunakan data statis, kita bisa passing array di view nanti
        return view('admin.users.index', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role_id' => 'required|integer',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Akun staff baru berhasil didaftarkan ke sistem!');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'role_id' => 'required|integer',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;

        // Jika password diisi, perbarui passwordnya
        if ($request->filled('password')) {
            $request->validate(['password' => 'string|min:8']);
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Data kredensial akun berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Hak otorisasi akun telah dihapus dari sistem!');
    }
}