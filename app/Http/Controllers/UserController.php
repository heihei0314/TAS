<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * 顯示應用程式中所有使用者的列表。
     *
     * @return Response
     */
    public function counter()
    {
        $metrics = DB::select('SELECT COUNT(*) as "count" FROM metrics;');
        DB::table('metrics')->truncate();
        return $metrics[0]->count;
    }
    public function store($ip)
    {
        DB::table('metrics')->insert(['ip' => $ip]);
    }
}