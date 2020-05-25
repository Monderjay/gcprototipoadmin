<?php

namespace App\Http\Controllers;

use App\News;
use App\Podcast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function index()
    {
        //
        $newsFeatured = News::where('featured',true)->orderBy('updated_at','desc')->get();
        $news = News::with('user')->orderBy('updated_at','desc')->get();
        $featuredNews = collect();
        foreach ($newsFeatured as $item) {
            if ($item->category->name == "Playstation" && $item->clasification->name == "Noticias" ||
                $item->category->name == "Xbox" && $item->clasification->name == "Noticias" ||
                $item->category->name == "Nintendo" && $item->clasification->name == "Noticias" ||
                $item->category->name == "Multi Consola" && $item->clasification->name == "Noticias"){
                $featuredNews->push($item);
            }
        }
        $featuredNews = $featuredNews->forPage(0,8);


        $mobileSection=collect();
        foreach ($news as $item) {
            if ($item->category->name == "Movil" || $item->category->name == "PC" && $item->clasification->name == "Noticias"){
                $mobileSection->push($item);
            }
        }
        $mobileSection = $mobileSection->forPage(0,20);


        $reviewSection= collect();
        foreach ($news as $item) {
            if ($item->category->name == "Playstation" && $item->clasification->name == "Reseñas" ||
                $item->category->name == "Xbox" && $item->clasification->name == "Reseñas" ||
                $item->category->name == "Nintendo" && $item->clasification->name == "Reseñas" ||
                $item->category->name == "Multi Consola" && $item->clasification->name == "Reseñas" ||
                $item->category->name == "PC" && $item->clasification->name == "Reseñas"||
                $item->category->name == "Movil" && $item->clasification->name == "Reseñas"){
                $reviewSection->push($item);
            }
        }
        $reviewSection= $reviewSection->forPage(0,20);


        $featuredPcMovil = collect();
        foreach ($newsFeatured as $item) {
            if ($item->category->name == "PC" && $item->clasification->name == "Noticias" ||
                $item->category->name == "Movil" && $item->clasification->name == "Noticias" ||
                $item->clasification->name == "Reseñas"
            ){
                $featuredPcMovil->push($item);
            }
        }
        $featuredPcMovil = $featuredPcMovil->forPage(0,8);


        $featuredReviews=collect();
        foreach ($newsFeatured as $item) {
            if ($item->clasification->name == "Reseñas"){
                $featuredReviews->push($item);
            }
        }
        $featuredReviews= $featuredReviews->forPage(0,8);


        $news = News::with('user')->orderBy('id','desc')->paginate(10);

        return view('welcome')->with(compact('news','featuredNews','mobileSection','reviewSection','featuredPcMovil'));
    }


    public function show($category,$clasification,$id)
    {
        //
        $news=News::with('category')
            ->whereHas('category', function ($query) use ($category) {
                $query->where('categories.name', '=', $category);
            })
            ->whereHas('clasification', function ($query) use ($clasification) {
                $query->where('clasifications.name', '=', $clasification);
            })->where('id',$id)
            ->first();
        if ($news!=null) {
            $title = explode(' ', $news->title);
            $firstWord = $title[0];
            $archives = News::where('title', 'like', '%' . $firstWord . '%')->get();
            $related = collect();
            foreach ($archives as $archive) {
                if ($archive->title != $news->title && $archive->category->name == $category) {
                    $related->push($archive);
                }
            }
            $related = $related->forPage(0,8);
            return view('general.news')->with(compact('news', 'related'));
        }else{
            return back();
        }

    }


    public function showCategories($section)
    {

        //
        $news = null;
        $newsCategory = News::with('category')
            ->whereHas('category', function ($query) use ($section) {
                $query->where('categories.name', '=', $section);
            })->orderBy('created_at', 'desc')->paginate(10);


        $newsClasification = News::with('clasification')
            ->whereHas('clasification', function ($query) use ($section) {
                $query->where('clasifications.name', '=', $section);
            })->orderBy('created_at', 'desc')->paginate(10);




        $sectionFeatured = collect();
        if (count($newsCategory)>0){
            $news = $newsCategory;
            foreach ($newsCategory as $featured){
                if($featured->featured == true && $featured->category->name == $section){
                    $sectionFeatured->push($featured);
                }
            }
            $sectionFeatured = $sectionFeatured->forPage(0,8);
            return view('general.categories')->with(compact('news','sectionFeatured'));

        }elseif (count($newsClasification)>0) {
            $podcast=false;
            foreach ($newsClasification as $item){
                if ($item->clasification->name == "Podcast"){
                    $podcast = true;
                }
            }

            if ($podcast){
                $podcast =Podcast::all();
                return view('general.podcast')->with(compact('podcast'));
            }else{
                $news = $newsClasification;
                foreach ($newsClasification as $featured){
                    if($featured->featured == true && $featured->clasification->name == $section){
                        $sectionFeatured->push($featured);
                    }
                }
                $sectionFeatured = $sectionFeatured->forPage(0,8);
                return view('general.categories')->with(compact('news','sectionFeatured'));
            }

        }else{
        return back();
        }
    }

    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }

    public function showPolitics(){
        return view('general.politics');
    }
}
