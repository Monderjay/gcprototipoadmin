<?php

namespace App\Http\Controllers;

use App\Category;
use App\Clasification;
use App\News;
use Illuminate\Http\Request;

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
                $item->category->name == "Multiplataforma" && $item->clasification->name == "Noticias" ||
                $item->category->name == "PC" && $item->clasification->name == "Noticias" ||
                $item->category->name == "Movil" && $item->clasification->name == "Noticias" ||
                $item->clasification->name == "Reseñas"){
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
                $item->category->name == "Multiplataforma" && $item->clasification->name == "Reseñas" ||
                $item->category->name == "PC" && $item->clasification->name == "Reseñas"||
                $item->category->name == "Movil" && $item->clasification->name == "Reseñas"){
                $reviewSection->push($item);
            }
        }
        $reviewSection= $reviewSection->forPage(0,6);


        $retroContent = collect();
        foreach ($newsFeatured as $item) {
            if ($item->clasification->name == "Retro"){
                $retroContent->push($item);
            }
        }
        $retroContent = $retroContent->forPage(0,6);


        $moreContent = collect();
        foreach ($newsFeatured as $item) {
            if ($item->category->name == "PC" && $item->clasification->name == "Noticias" ||
                $item->category->name == "Movil" && $item->clasification->name == "Noticias"
            ){
                $moreContent->push($item);
            }
        }
        $moreContent = $moreContent->forPage(0,6);


        $featuredReviews=collect();
        foreach ($newsFeatured as $item) {
            if ($item->clasification->name == "Reseñas"){
                $featuredReviews->push($item);
            }
        }
        $featuredReviews= $featuredReviews->forPage(0,6);


        $news = News::with('user')->orderBy('id','desc')->paginate(9);

        return view('welcome')->with(compact('news','featuredNews','mobileSection','reviewSection','retroContent','moreContent'));
    }



    public function show($arg)
    {
        $newsFeatured = News::where('featured',true)->orderBy('created_at','desc')->get();
        $news = News::with('user')->orderBy('created_at','desc')->get();
        $featuredNews = collect();
        $reviewSection= collect();


        foreach ($news as $item) {
            if ($item->category->name == "PlayStation" && $item->clasification->name == "Reseñas" ||
                $item->category->name == "Xbox" && $item->clasification->name == "Reseñas" ||
                $item->category->name == "Nintendo" && $item->clasification->name == "Reseñas" ||
                $item->category->name == "Multiplataforma" && $item->clasification->name == "Reseñas" ||
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


            $related = collect();
            foreach ($all  as $item) {
                if ($item->title != $news->title && $item->category->name == $category && $item->Clasification->name == $news->clasification->name){
                   $related->push($item);
                }
            }

            $related = $related->unique()->forPage(0,10);


            return view('general.news')->with(compact('news', 'related')); //Vista de cada noticia

        }elseif ($category != null){
            $newsCategory = News::with('category')
                ->whereHas('category', function ($query) use ($arg) {
                    $query->where('categories.name', '=', $arg);
                })->orderBy('created_at', 'desc')->paginate(9);


            $news = $newsCategory;
            foreach ($newsCategory as $featured){
                if($featured->featured == true && $featured->category->name == $arg){
                    $sectionFeatured->push($featured);
                }
            }
            $featuredNews = $sectionFeatured->forPage(0,10);
            $section = $arg;

            if ($category ->name== "PlayStation"){
                $category1 = "Xbox";
                $category2 = "Nintendo";
            }elseif ($category->name == "Xbox"){
                $category1 = "PlayStation";
                $category2 = "Nintendo";
            }elseif ($category->name == "Nintendo"){
                $category1 = "PlayStation";
                $category2 = "Xbox";
            }
            elseif ($category->name == "Multiplataforma"){
                $category1 = "PC";
                $category2 = "Movil";
            }elseif ($category->name == "PC"){
                $category1 = "Multiplataforma";
                $category2 = "Movil";
            }elseif ($category->name == "Movil"){
                $category1 = "PC";
                $category2 = "Multiplataforma";
            }


            $fanboySection = collect();
            foreach ($newsFeatured as $item) {
                if ($item->category->name == $category1 && $item->clasification->name == "Noticias" ||
                    $item->category->name == $category2 && $item->clasification->name == "Noticias"
                ){
                    $fanboySection->push($item);
                }
            }
            $fanboySection = $fanboySection->forPage(0,10);

            return view('general.categories')->with(compact('news','sectionFeatured','section', 'fanboySection','featuredNews'));
        }elseif ($clasification != null){

            $newsClasification = News::with('clasification')
                ->whereHas('clasification', function ($query) use ($arg) {
                    $query->where('clasifications.name', '=', $arg);
                })->orderBy('created_at', 'desc')->paginate(9);

            $news = $newsClasification;
            foreach ($newsClasification as $featured){
                if($featured->featured == true && $featured->clasification->name == $arg){
                    $sectionFeatured->push($featured);
                }
            }
            $featuredNews = $sectionFeatured->forPage(0,8);
            $section = $arg;



            if ($clasification->name== "Noticias"){
                $clasification1 = "Reseñas";
                $clasification2 = "Retro";
            }elseif ($clasification->name == "Reseñas"){
                $clasification1 = "Noticias";
                $clasification2 = "Retro";
            }elseif ($clasification->name == "Retro"){
                $clasification1 = "Reseñas";
                $clasification2 = "Noticias";
            }

            $fanboySection = collect();
            foreach ($newsFeatured as $item) {
                if ($item->clasification->name == $clasification1 || $item->clasification->name == $clasification2){
                    $fanboySection->push($item);
                }
            }
            $fanboySection = $fanboySection->forPage(0,10);

            return view('general.categories')->with(compact('news','sectionFeatured','section','reviewSection', 'fanboySection', 'featuredNews'));
        }else{
            return back();
        }
    }



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

}
