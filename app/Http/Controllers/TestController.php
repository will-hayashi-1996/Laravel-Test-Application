<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Inertia\Inertia;

class TestController extends Controller
{
    public function teste(Request $request, $search){

        
        $user=User::where('id',$search)->get();
        if(!$user->isNotEmpty()){
            $user=User::where('name',$search)->get();
        }

        if(!$user->isNotEmpty()){
            $user=User::where('email',$search)->get();
        }

        return response($user,200);
    }

    public function testePost(Request $request){
        User::create([
        'name' =>  $request->name,
        'email' => $request->email,
        'password' =>'teste',
        ]);
    }

    public function renderScreen1(){
        return Inertia::render('Screen1');
    }

    public function renderScreen2(){
        return Inertia::render('Screen2');
        
    }

    public function renderScreen3(){

        return Inertia::render('Screen3');
        
    }

    public function GetUsers(){

        $users=User::whereNotnull('id')->paginate(20);

        return response($users,200);

    }



}
