<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GetRightsHolders extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax() && !$request->expectsJson()) {
            return redirect('/');
        }

        $rightsHolders = DB::table('rights_holders')->get();
        return response()->json($rightsHolders);
    }
}