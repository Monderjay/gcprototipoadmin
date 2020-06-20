<?php

namespace App;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use App\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    //
    use SoftDeletes;

    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function clasification(){
        return $this->belongsTo('App\Clasification');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function images(){
        return $this->hasMany('App\NewsImage');
    }

    public function getNewsIntroductionAttribute(){
        /*$words = explode(' ',$description);
        $introduction = "" ;
        for ($i =0;$i<30;$i++){
            $introduction .= $words[$i].' ';
        }*/
        $description = $this->introduction;
        $introduction = substr($description,0,130).' ...';
        return $introduction;
    }

    public function getNewsTitleAttribute(){
        $title = $this->title;
        $title = $this->title;
        if (strlen($title) > 70){
            $title = substr($title,0,70).' ...';
        }else{
            $title = substr($title,0,70);
        }


        return $title;
    }

    public function getMobileIntroductionAttribute(){
        /*$words = explode(' ',$description);
        $introduction = "" ;
        for ($i =0;$i<30;$i++){
            $introduction .= $words[$i].' ';
        }*/
        $description = $this->introduction;
        $introduction = substr($description,0,105).'...';
        return $introduction;
    }

    public function getCategoryNameAttribute(){
        if ($this->category_id == null){
            return "Sin Categoria";
        }else{
            return $this->category->name;
        }
    }

    public function getClasificationNameAttribute(){
        if ($this->clasification_id == null){
            return "Sin Vlasificación";
        }else{
            return $this->clasification->name;
        }
    }

    public function getDateAttribute(){
        return date("d-m-Y H:i:s a",strtotime($this->created_at));
        //return date("d-m-Y H:i",strtotime($this->publish_date));
    }

    public function getNewsImageFeaturedAttribute(){
        $featuredImage = $this->images()->where('featured',true)->first();

        if (!$featuredImage){
            $featuredImage = $this->images()->first();
            if ($featuredImage == null){
                return '/images/news_images/default.jpeg';
            }else{
                if (substr($featuredImage->image,0,4)==="http"){
                    return $featuredImage->image;
                }else{
                    return '/images/news_images/'.$featuredImage->image;
                }
            }
        }else{
            if (substr($featuredImage->image,0,4) === "http"){
                return $featuredImage->image;
            }else{
                return '/images/news_images/'.$featuredImage->image;
            }
        }
    }



    public function getNewsImageFeaturedMediumAttribute(){
        $featuredImageMedium = $this->images()->where('size','medium')->first();

        if (!$featuredImageMedium){
            $featuredImageMedium = $this->images()->first();
            if ($featuredImageMedium == null){
                return '/images/news_images/default.jpeg';
            }else{
                if (substr($featuredImageMedium->image,0,4)==="http"){
                    return $featuredImageMedium->image;
                }else{
                    return '/images/news_images_medium/'.$featuredImageMedium->image;
                }
            }
        }else{
            if (substr($featuredImageMedium->image,0,4) === "http"){
                return $featuredImageMedium->image;
            }else{
                return '/images/news_images_medium/'.$featuredImageMedium->image;
            }
        }
    }

    public function getNewsImageFeaturedSmallAttribute(){
        $featuredImageSmall = $this->images()->where('size','small')->first();

        if (!$featuredImageSmall){
            $featuredImageSmall = $this->images()->first();
            if ($featuredImageSmall == null){
                return '/images/news_images/default.jpeg';
            }else{
                if (substr($featuredImageSmall->image,0,4)==="http"){
                    return $featuredImageSmall->image;
                }else{
                    return '/images/news_images_small/'.$featuredImageSmall->image;
                }
            }
        }else{
            if (substr($featuredImageSmall->image,0,4) === "http"){
                return $featuredImageSmall->image;
            }else{
                return '/images/news_images_small/'.$featuredImageSmall->image;
            }
        }
    }

}
