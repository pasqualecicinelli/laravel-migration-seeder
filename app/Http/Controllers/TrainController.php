<?php

namespace App\Http\Controllers;

use App\Models\Train;
use Illuminate\Http\Request;

class TrainController extends Controller
{
    public function index()
    {
        $trains = Train::
            whereDate('departure_time', '=', '2023-10-17')->get();

        return view('train.index', compact('trains'));
    }
}