<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Post;

class AdminController extends Controller
{
    // Tampilkan form login
    public function showLoginForm()
    {
        return view('admin.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // simpan session
            session(['admin_id' => $user->id, 'admin_name' => $user->name]);
            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', 'Email atau password salah.');
    }

    // Dashboard admin
    public function dashboard()
    {
        $posts = Post::with(['category', 'tags'])->get();
        return view('admin.dashboard',compact('posts'));
     }
    

    // Logout
    public function logout(Request $request)
    {
        $request->session()->forget(['admin_id', 'admin_name']);
        return redirect()->route('home')->with('success', 'Anda berhasil logout.');
    }
}
