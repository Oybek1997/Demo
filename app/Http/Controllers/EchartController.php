<?php

namespace App\Http\Controllers;
use App\Documents;
use Illuminate\Http\Request;

class EchartController extends Controller
{

    public function echart(Request $request)
    {
        $private = Documents::where('privacy','private')->get();
        $public = Documents::where('privacy','public')->get();

        $private_count = count($private);
        $public_count = count($public);

        return view('documents.echart',compact('private_count','public_count'));
    }
}
