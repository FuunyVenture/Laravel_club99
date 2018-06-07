<?php

namespace App;

use App\BaseModel;
use Illuminate\Support\Str;

class Page extends BaseModel
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    protected $dates = ['published_at'];

    function scopePublished($query)
    {
        return $query->where('published', 1);
    }

    function scopePage($query)
    {
        return $query->where('blog_post', 0);
    }

    function scopePost($query)
    {
        return $query->where('blog_post', 1)->orderBy('published_at', 'desc');
    }

    function getPublishedAttribute()
    {
        return $this->attributes['published'] ? 'published' : 'not yet';
    }

    function getBlogPostAttribute()
    {
        return $this->attributes['blog_post'] ? 'Blog Post' : 'Page';
    }

    function getSlugAttribute()
    {
        return ($this->attributes['blog_post'] ? 'blog/' : 'page/') . $this->attributes['slug'];
    }
    function excerpt()
    {
		$content = preg_replace("/<img(.*?)>/si", "", $this->content);
		$content = preg_replace('/(<.*?>)|(&.*?;)/', '', $content)  ;

        return Str::words($content,30); 

    }	
	
}
