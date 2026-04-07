<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'murid');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('nis', 'like', '%' . $request->search . '%')
                  ->orWhere('kelas', 'like', '%' . $request->search . '%');
            });
        }

        $members = $query->withCount(['loans', 'activeLoans'])->latest()->paginate(15)->withQueryString();
        return view('admin.members.index', compact('members'));
    }

    public function show(User $member)
    {
        $loans = $member->loans()->with('book')->latest()->paginate(10);
        return view('admin.members.show', compact('member', 'loans'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'nis'      => 'required|string|max:20|unique:users,nis',
            'kelas'    => 'required|string|max:50',
            'phone'    => 'nullable|string|max:20',
            'password' => ['required', Password::min(6)],
        ]);

        $data['password'] = Hash::make($data['password']);
        $data['role']      = 'murid';

        User::create($data);
        return redirect()->route('admin.members.index')
            ->with('success', 'Anggota berhasil ditambahkan.');
    }

    public function update(Request $request, User $member)
    {
        $data = $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email,' . $member->id,
            'nis'       => 'required|string|max:20|unique:users,nis,' . $member->id,
            'kelas'     => 'required|string|max:50',
            'phone'     => 'nullable|string|max:20',
            'is_active' => 'boolean',
        ]);

        if ($request->filled('password')) {
            $request->validate(['password' => Password::min(6)]);
            $data['password'] = Hash::make($request->password);
        }

        $data['is_active'] = $request->boolean('is_active');
        $member->update($data);

        return redirect()->route('admin.members.show', $member)
            ->with('success', 'Data anggota berhasil diperbarui.');
    }

    public function destroy(User $member)
    {
        if ($member->activeLoans()->exists()) {
            return back()->with('error', 'Anggota masih memiliki pinjaman aktif.');
        }
        $member->delete();
        return redirect()->route('admin.members.index')
            ->with('success', 'Anggota berhasil dihapus.');
    }

    public function toggleActive(User $member)
    {
        $member->update(['is_active' => !$member->is_active]);
        $status = $member->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return back()->with('success', "Akun anggota berhasil {$status}.");
    }
}
