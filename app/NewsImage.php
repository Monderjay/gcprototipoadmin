<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsImage extends Model
{
    //
    public function news(){
        return $this->belongsTo('App\News');
    }

    public function getNewsImageAttribute(){
        $path="";
        if ($this->image != null) {
            if (substr($this->image, 0, 4) === "http") {
                return $this->image;
            } else {
                if ($this->size == "medium"){
                    $path = '/images/news_images_medium/' . $this->image;
                }elseif ($this->size == "small"){
                    $path = '/images/news_images_small/' . $this->image;
                }else{
                    $path = '/images/news_images/' . $this->image;
                }

            }
        }else{
            $path = '/images/news_images/default.jpg';
        }
        return $path;
    }
}
