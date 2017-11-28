<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\wisata;
use App\Review;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;

class ReviewController extends Controller
{
    // Validation rules for the ratings
    public function getCreateRules()
    {
        return array(
            'comment'=>'required|min:10',
            'rating'=>'required|integer|between:1,5'
        );
    }
    // Relationships
    public function user()
    {
        return $this->belongsTo('User');
    }
    public function wisata()
    {
        return $this->belongsTo('wisata');
    }
    // Scopes
    public function scopeApproved($query)
    {
           return $query->where('approved', true);
    }
    public function scopeSpam($query)
    {
           return $query->where('spam', true);
    }
    public function scopeNotSpam($query)
    {
           return $query->where('spam', false);
    }
    // Attribute presenters
    public function getTimeagoAttribute()
    {
        $date = \Carbon\Carbon::createFromTimeStamp(strtotime($this->created_at))->diffForHumans();
        return $date;
    }
    // this function takes in product ID, comment and the rating and attaches the review to the product by its ID, then the average rating for the product is recalculated
    public function storeReviewForWisata($wisata, $comment, $rating)
    {
        $wisata = Product::find($wisataID);
        //$this->user_id = Auth::user()->id;
        $this->comment = $comment;
        $this->rating = $rating;
        $product->reviews()->save($this);
        // recalculate ratings for the specified product
        $product->recalculateRating($rating);
    }
    public function reviews()
	{
	    return $this->hasMany('Review');
	}
	// The way average rating is calculated (and stored) is by getting an average of all ratings, 
	// storing the calculated value in the rating_cache column (so that we don't have to do calculations later)
	// and incrementing the rating_count column by 1
    public function recalculateRating($rating)
    {
    	$reviews = $this->reviews()->notSpam()->approved();
	    $avgRating = $reviews->avg('rating');
		$this->rating_cache = round($avgRating,1);
		$this->rating_count = $reviews->count();
    	$this->save();
    }
}