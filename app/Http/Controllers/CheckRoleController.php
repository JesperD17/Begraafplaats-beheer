<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckRoleController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::check()) {
            $roleID = $request->user()->role_id;

            $roles = DB::table('roles')->get();

            return response()->json($roles);
        }
        return null;
    }
}
