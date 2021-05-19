<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Email;

class EmailController extends Controller
{
    public function getEmail(Request $request)
    {
        // dd("tes");
        $email = Email::where("id_customer", $request->customer)->get();
        $respond = [
            "success" => true,
            "data" => $email
        ];
        return response()->json($respond);
    }
}
