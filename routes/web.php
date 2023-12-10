<?php

use App\Models\Song;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\DB;

Route::get("/",function(){
    return view("index",[
        "songs" => DB::table('songs')->paginate(10)
    ]);
})->name("index");
Route::get("/login", function () {
    return view('login');
})->name("login");
Route::get("/register", function () {
    return view("register");
})->name("register");

Route::post("/authenticate", function (Request $request) {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->route('index')
            ->withSuccess('You have successfully logged in!');
    }

    return back()->withErrors([
        'email' => 'Your provided credentials do not match in our records.',
    ])->onlyInput('email');
})->name("authenticate");

Route::post("/store", function (Request $request) {
    $request->validate([
        'name' => 'required|string|max:250',
        'email' => 'required|email|max:250|unique:users',
        'password' => 'required|min:8|confirmed'
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password)
    ]);

    $credentials = $request->only('email', 'password');
    Auth::attempt($credentials);
    $request->session()->regenerate();
    return redirect()->route('index')
        ->withSuccess('You have successfully registered & logged in!');
})->name("store");

Route::get('logout', function (){
    auth()->logout();
    Session()->flush();
    return Redirect::to('/');
})->name('logout');

Route::get("/createsong",function(Request $request){
    return view("createsong");
})->name("createsong");

Route::post("/createsong",function(Request $request){
    $request->validate([
        'name' => 'required',
        'singer' => 'required',
        'written_by' => 'required',
        'publisher'=> 'required',
        'lyrics' => 'required',
        'album_img'=>'required',
        'album_name'=>'required'
    ]);
    $song = new Song;
    $song->name = $request["name"];
    $song->singer = $request["singer"];
    $song->written_by = $request["written_by"];
    $song->publisher = $request["publisher"];
    $song->lyrics = $request["lyrics"];
    $song->album_name = $request["album_name"];
    $song->album_img = $request["album_img"];
    $song->user_id = Auth::user()->id;
    $song->save();
    return redirect()->route('index')->withSuccess('Song Created Successfully!');
});
Route::get("/list",function(Request $request){
    return view("list", [
        "songs" => DB::table('songs')->paginate(10)
    ]);
});
Route::get("/{id}",function(Request $request,$id){
    return view("details",[
        "song" => DB::table("songs")->find($id)
    ]);
});
Route::get("/list",function(Request $request){
    $search = $_GET["q"] ?? "";
    $songs = DB::table("songs")
    ->where('name', 'like', '%' . $search . '%')
    ->orWhere('singer', 'like', '%' . $search . '%')
    ->orWhere('lyrics', 'like', '%' . $search . '%')
    ->paginate(10);
    return view("/list",[
        "songs"=>$songs
    ]);
});