<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Selected;
use App\Models\Unselected;
use App\Models\UserTable;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = UserTable::with('service')->get();
        return response()->json($users);
    }

    public function store(Request $request)
    {
        $user = UserTable::create($request->all());

        if ($request->has('service_id')) {
            Selected::create(['user_id' => $user->id, 'service_id' => $request->service_id]);
        } else {
            Unselected::create(['user_id' => $user->id, 'service_id' => null]);
        }

        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $user = UserTable::findOrFail($id);
        $user->update($request->all());

        if ($request->has('service_id')) {
            $selected = Selected::firstOrNew(['user_id' => $user->id]);
            $selected->service_id = $request->service_id;
            $selected->save();
        } else {
            Unselected::create(['user_id' => $user->id, 'service_id' => null]);
        }

        return response()->json($user);
    }

    public function destroy($id)
    {
        $user = UserTable::findOrFail($id);
        $user->delete();
        return response()->json('User deleted successfully');
    }
}
