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
        $introduction = substr($description,0,350).'...';
        return $introduction;
    }

    public function getMobileIntroductionAttribute(){
        /*$words = explode(' ',$description);
        $introduction = "" ;
        for ($i =0;$i<30;$i++){
            $introduction .= $words[$i].' ';
        }*/
        $description = $this->introduction;
        $introduction = substr($description,0,100).'...';
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
        return date("d-m-Y H:i:s a",strtotime($this->updated_at));
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

}
