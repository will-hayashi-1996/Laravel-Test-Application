<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Http;
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

    public function GetApiData(Request $request, $search){

        $response = Http::withHeaders([
            'Authorization' => 'Bearer YOUR_ACCESS_TOKEN',
            'Accept' => 'application/json',
        ])->get("https://api.unsplash.com/search/photos/?client_id=".config('app.api_key')."&query=" . urlencode($search));
        

        return response($response->json()['results'],200);

    }

    public function GetColorPositionRandom(Request $request){

            $grid = [];
            for ($i = 0; $i < 3; $i++) {
                for ($j = 0; $j < 3; $j++) {
                    // Randomly assign true or false
                    $grid[$i][$j] = (bool) rand(0, 1);
                }
            }

            return response($grid,200);

    }

    public function SetColorPosition(Request $request, $array, $row, $col)
    {

        $row = (int)$row;

        $col = (int)$col;

        
        // Step 1: Convert the input into a flat array
        if (is_string($array)) {
            // If the input is a string, split it into an array
            $array = array_map('trim', explode(',', $array));
        }
    
        // Step 2: Validate the flat array
        if (!is_array($array) || count($array) !== 9) {
            return response("Invalid input: Expected a flat array with 9 elements.", 400);
        }
    
        // Step 3: Convert the flat array into a 3x3 grid
        $grid = [];
        for ($i = 0; $i < 3; $i++) {
            for ($j = 0; $j < 3; $j++) {
                $index = $i * 3 + $j; // Calculate the index in the flat array
                $grid[$i][$j] = filter_var($array[$index], FILTER_VALIDATE_BOOLEAN);
            }
        }
    
        // Step 4: Validate that $row and $col are within the grid bounds
        if (!isset($grid[$row][$col])) {
            return response("Invalid row or column index.", 400);
        }

    
        $result = $grid;
    
        $result[$row][$col] = !$grid[$row][$col];
    
        if ($row > 0 && isset($grid[$row - 1][$col])) {
            $result[$row - 1][$col] = !$grid[$row - 1][$col];
        }
    
        if ($row < count($grid) - 1 && isset($grid[$row + 1][$col])) {
            $result[$row + 1][$col] = !$grid[$row + 1][$col];
        }
    
        if ($col > 0 && isset($grid[$row][$col - 1])) {
            $result[$row][$col - 1] = !$grid[$row][$col - 1];
        }
    
        if ($col < count($grid[$row]) - 1 && isset($grid[$row][$col + 1])) {
            $result[$row][$col + 1] = !$grid[$row][$col + 1];
        }
    
        return response($result, 200);
    }



}
