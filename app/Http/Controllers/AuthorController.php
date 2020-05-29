<?php

namespace App\Http\Controllers;

use App\News;
use App\User;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    //
    public function show($username){
        $author = User::where('username',$username)->first();

        if ($author){
            $totalNews = News::with('user')
                ->whereHas('user', function ($query) use ($username) {
                    $query->where('users.username', '=', $username);
                })->count();

            $news=News::with('user')
                ->whereHas('user', function ($query) use ($username) {
                    $query->where('users.username', '=', $username);
                })->orderBy('updated_at','desc')->paginate(10);

            $collection1 = collect();
            $collection2 = collect();

            for ($i=0; $i<$news->count(); $i++){
                if ($i <=4){
                    $collection1->push($news[$i]);
                }else{
                    $collection2->push($news[$i]);
                }
            }

            return view('general.author')->with(compact('author', 'news','totalNews','collection1', 'collection2'));
        }else{
            return back();
        }




    }
}
