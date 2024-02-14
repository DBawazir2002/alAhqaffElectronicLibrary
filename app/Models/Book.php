<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Book extends Model implements Searchable
{
    use HasFactory;

    protected $fillable = ['title', 'category_id', 'authorName', 'rate', 'size', 'brief', 'numberOfDownloads', 'created_at', 'updated_at' ,'bookCover', 'book'];

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getSearchResult(): SearchResult
    {
        $url = route('a',$this->slug);
        return new \Spatie\Searchable\SearchResult($this,$this->title);
    }
}
