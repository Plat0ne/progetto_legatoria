<?php
namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;


class UserControllerAdmin extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.crud_utenti.index', [
            'title' => 'Users',
            'users' => $users
        ]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'operatore' => 'nullable|boolean',
        ]);

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'operatore' => $request->operatore ?? 0
            ]);
        
            if (!$user) {
                return response()->json(['success' => false, 'message' => 'errore interno, utente nullo'], 422);
            }
        
            return response()->json(['success' => true, 'message' => 'Utente creato con successo!'], 200);
        } catch (\Exception $e) {
            error_log($e->getMessage());
            return response()->json(['success' => false, 'message' => 'Eccezione: ' . $e->getMessage()], 422);
        }
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'operatore' => 'nullable|boolean',
        ]);

        try {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'operatore' => $request->operatore ?? 0
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Utente aggiornato con successo!'
            ]);
        } catch (\Exception $e) {
            error_log($e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Eccezione: ' . $e->getMessage(),
                'errors' => $request->errors()
            ], 422);
        }
    }

    public function destroy(User $user)
    {
        if (empty($user->id)) {
            return redirect()->route('admin.utenti.index')->with('error', 'Codice utente non disponibile! '. $user);
        }
        try {
            $user->delete();
            return redirect()->route('admin.utenti.index')->with('success', 'utente (' . $user->name . ') eliminato!');
        } catch (\Exception $e) {
            return redirect()->route('admin.utenti.index')->with('error', 'Errore durante l\'eliminazione dell\'utente!');
        }
    }
}
