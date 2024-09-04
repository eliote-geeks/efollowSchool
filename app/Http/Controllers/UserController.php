<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'Administrateur')->orWhere('role', 'Informaticien')->orWhere('role', 'Intendant')->orWhere('role', 'Superviseur')->orWhere('role', 'Controlleur')->get();
        return view('users.users', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = Hash::make($request->password);
        $user->save();
        User::log('utilisateur ajouté: '.$user->name.' role: '.$user->role);
        return redirect()->back()->with('success', 'Utilisateur AJouté !!');
    }

    public function update(User $user, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            // 'password' => 'required',
            'role' => 'required',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        if (isset($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        User::log('utilisateur mis à jour: '.$user->name.' role: '.$user->role);
        return redirect()->back()->with('success', 'Utilisateur Edité !!');
    }

    public function delete(User $user)
    {
        if ($user->status == 1) {
            $user->password = '//';
            $user->status = 0;
            $user->save();
            User::log('utilisateur status modifié: '.$user->name.' role: '.$user->role);
            return redirect()->back()->with('success', 'Utilisateur Désactivé !!');
        } else {
            $user->status = 1;
            $user->save();
            return redirect()->back()->with('success', 'Utilisateur Réactivé Veuillez lui attribuer un nouveau mot de passe !!');
        }
    }
}
