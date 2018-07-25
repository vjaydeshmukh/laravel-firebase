<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class FirebaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $serviceAccount = ServiceAccount::fromJsonFile(storage_path('app/public') . '/json/laravel-firebase-7e60e-08e8bb5f866d.json');

        $firebase = (new Factory())->withServiceAccount($serviceAccount)
            ->withDatabaseUri('https://laravel-firebase-7e60e.firebaseio.com/')
            ->create();

        $database = $firebase->getDatabase();

        $chat = $database->getReference('chat/messages')
            ->push([
                'title' => 'Laravel Firebase' ,
                'body' => 'Getting started with Laravel Firebase'
            ]);

        dd($chat->getvalue());
    }
}
