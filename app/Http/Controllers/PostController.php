<?php

namespace App\Http\Controllers;

use App\Events\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;

class PostController extends Controller
{
    public function index()
    {
        $user_id = 1;
        Event::dispatch(new Alert($user_id));

        dd("Check inbox");
    }
}
