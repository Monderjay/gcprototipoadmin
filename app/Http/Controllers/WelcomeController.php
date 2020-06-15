<?php

namespace App\Http\Controllers;

use App\Category;
use App\Clasification;
use App\News;
use App\Podcast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function index()
    {
        //
        $newsFeatured = News::where('featured',true)->orderBy('created_at','desc')->get();
        $news = News::with('user')->orderBy('created_at','desc')->get();
        $featuredNews = collect();
        foreach ($newsFeatured as $item) {
            if ($item->category->name == "PlayStation" && $item->clasification->name == "Noticias" ||
                $item->category->name == "Xbox" && $item->clasification->name == "Noticias" ||
                $item->category->name == "Nintendo" && $item->clasification->name == "Noticias" ||
                $item->category->name == "Multi Consola" && $item->clasification->name == "Noticias" ||
                $item->category->name == "PC" && $item->clasification->name == "Noticias" ||
                $item->category->name == "Movil" && $item->clasification->name == "Noticias" ||
                $item->category->name == "Reseñas" && $item->clasification->name == "Noticias"){
                $featuredNews->push($item);
            }
        }
        $featuredNews = $featuredNews->forPage(0,10);


        $mobileSection=collect();
        foreach ($news as $item) {
            if ($item->category->name == "Movil" || $item->category->name == "PC" && $item->clasification->name == "Noticias"){
                $mobileSection->push($item);
            }
        }
        $mobileSection = $mobileSection->forPage(0,20);


        $reviewSection= collect();
        foreach ($news as $item) {
            if ($item->category->name == "PlayStation" && $item->clasification->name == "Reseñas" ||
                $item->category->name == "Xbox" && $item->clasification->name == "Reseñas" ||
                $item->category->name == "Nintendo" && $item->clasification->name == "Reseñas" ||
                $item->category->name == "Multi Consola" && $item->clasification->name == "Reseñas" ||
                $item->category->name == "PC" && $item->clasification->name == "Reseñas"||
                $item->category->name == "Movil" && $item->clasification->name == "Reseñas"){
                $reviewSection->push($item);
            }
        }
        $reviewSection= $reviewSection->forPage(0,6);


        $moreContent = collect();
        foreach ($newsFeatured as $item) {
            if ($item->category->name == "PC" && $item->clasification->name == "Noticias" ||
                $item->category->name == "Movil" && $item->clasification->name == "Noticias" ||
                $item->clasification->name == "Retro"
            ){
                $moreContent->push($item);
            }
        }
        $moreContent = $moreContent->forPage(0,8);


        $featuredReviews=collect();
        foreach ($newsFeatured as $item) {
            if ($item->clasification->name == "Reseñas"){
                $featuredReviews->push($item);
            }
        }
        $featuredReviews= $featuredReviews->forPage(0,8);


        $news = News::with('user')->orderBy('id','desc')->paginate(10);

        return view('welcome')->with(compact('news','featuredNews','mobileSection','reviewSection','moreContent'));
    }


    /*public function show($category,$clasification,$slug)
    {
        //
        $news=News::with('category')
            ->whereHas('category', function ($query) use ($category) {
                $query->where('categories.name', '=', $category);
            })
            ->whereHas('clasification', function ($query) use ($clasification) {
                $query->where('clasifications.name', '=', $clasification);
            })->where('slug',$slug)
            ->first();

        if ($news!=null) {
            //$related = News::where('title','like',"%$news->title%")->paginate(10);
            $title = explode(' ', $news->title);
            $firstWord = $title[0];
            $archives = News::where('title', 'like', "%$firstWord%")->orderBy('created_at','desc')->get();
            $related = collect();
            foreach ($archives as $archive) {
                if ($archive->title != $news->title && $archive->category->name == $category) {
                    $related->push($archive);
                }
            }
            $related = $related;
            return view('general.news')->with(compact('news', 'related'));
        }else{
            return back();
        }

    }*/


    public function show($arg)
    {
        //
        $news = News::where('slug',$arg)->first();
        $category = Category::where('name',$arg)->first();
        $clasification = Clasification::where('name',$arg)->first();
        $sectionFeatured = collect();

        if ($news!=null){
            $category = $news->category->name;
            $title = explode(' ', $news->title);

            $firstWord = $title[0];
            $archives=collect();
            for ($i=0;$i<count($title); $i++){
                $archives->push(News::where('title', 'like', "%$title[$i]%")->orderBy('created_at','desc')->get());
            }

            $all = collect();
            foreach ($archives as $archive){
                foreach ($archive  as $item) {
                    $all->push($item);
                }
            }

            //$c = $all->groupBy('title');
            $related = collect();
            foreach ($all  as $item) {
                if ($item->title != $news->title && $item->category->name == $category && $item->Clasification->name == $news->clasification->name){
                   $related->push($item);
                }
            }

            $related = $related->unique()->forPage(0,15);


            return view('general.news')->with(compact('news', 'related'));
        }elseif ($category != null){
            $newsCategory = News::with('category')
                ->whereHas('category', function ($query) use ($arg) {
                    $query->where('categories.name', '=', $arg);
                })->orderBy('created_at', 'desc')->paginate(10);


            $news = $newsCategory;
            foreach ($newsCategory as $featured){
                if($featured->featured == true && $featured->category->name == $arg){
                    $sectionFeatured->push($featured);
                }
            }
            $sectionFeatured = $sectionFeatured->forPage(0,8);
            $section = $arg;
            return view('general.categories')->with(compact('news','sectionFeatured','section'));
        }elseif ($clasification != null){

            $newsClasification = News::with('clasification')
                ->whereHas('clasification', function ($query) use ($arg) {
                    $query->where('clasifications.name', '=', $arg);
                })->orderBy('created_at', 'desc')->paginate(10);

            $news = $newsClasification;
            foreach ($newsClasification as $featured){
                if($featured->featured == true && $featured->clasification->name == $arg){
                    $sectionFeatured->push($featured);
                }
            }
            $sectionFeatured = $sectionFeatured->forPage(0,8);
            $section = $arg;
            return view('general.categories')->with(compact('news','sectionFeatured','section'));
        }else{
            return back();
        }
    }



    /*public function showCategories($section)
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
            return view('general.categories')->with(compact('news','sectionFeatured','section'));

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
                return view('general.categories')->with(compact('news','sectionFeatured','section'));
            }

        }else{
        return back();
        }
    }
    */


    public function showCategoryClasification($category, $clasification)
    {

        $section =$category.' | '.$clasification;

        //
        $news=News::with('category')
            ->whereHas('category', function ($query) use ($category) {
                $query->where('categories.name', '=', $category);
            })
            ->whereHas('clasification', function ($query) use ($clasification) {
                $query->where('clasifications.name', '=', $clasification);
            })->paginate(10);
        //dd($news);


        $sectionFeatured = collect();
        if (count($news)>0){
            $news = $news;
            foreach ($news as $featured){
                if($featured->featured == true && $featured->category->name == $category){
                    $sectionFeatured->push($featured);
                }
            }
            $sectionFeatured = $sectionFeatured->forPage(0,8);
            return view('general.categories')->with(compact('news','sectionFeatured','section'));

        }else{
            return back();
        }
    }


    public function search(Request $request)
    {
        //
        if ($request->input('search')!=null){
            $search = $request->input('search');
            $news = News::where('title','like',"%$search%")->orderBy('created_at','desc')->paginate(10);
            return view('general.search')->with(compact('news'));
        }else{
            return back();
        }
    }

    public function showPolitics(){
        return view('general.politics');
    }

    public function showInformation(){
        return view('general.information');
    }

    public function showContact(){
        return view('general.contact');
    }

    public function showVisits(){

    }
}
