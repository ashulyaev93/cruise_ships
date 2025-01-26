<?php

namespace App\Http\Controllers\Admin\Main;

use App\Models\Ship;
use Illuminate\Routing\Controller;

class IndexController extends Controller
{
    public function __invoke()
    {
        $totalShips = Ship::count();

        return view('admin.main.index', compact('totalShips'));
    }
}
