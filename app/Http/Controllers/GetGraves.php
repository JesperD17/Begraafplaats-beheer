<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GetGraves extends Controller
{
    public function index()
    {
        return response()->json($this->fetchByUser(auth()->id()));
    }

    public function fetchByUser($userId)
    {
        $graves = DB::table('graves as G')
            ->leftJoin('grave_agreements as GA', 'G.id', '=', 'GA.grave_id')
            ->leftJoin('rights_holders as RH', 'RH.id', '=', 'GA.rights_holder_id')
            ->leftJoin('rights_holder_users as RHU', 'RHU.rights_holder_id', '=', 'RH.id')
            ->leftJoin('users as U', 'U.id', '=', 'RHU.user_id')
            ->select(
                'G.cemetery_id',
                'G.latitude',
                'G.longitude',
                'G.image_url',
                'G.number',
                'G.costs',
                'G.type',
                'G.term',
                'RH.first_name',
                'RH.infix',
                'RH.last_name'
            )
            ->where('U.id', $userId)
            ->get();

        return $graves;
    }
}
