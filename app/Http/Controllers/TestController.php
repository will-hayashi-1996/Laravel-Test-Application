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

        if((int) $search > 0){
            $user=User::find($search);
        }else{
            $user=User::where('name',$search)->first();
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

        $users=User::whereNotnull('id');

    }



}
