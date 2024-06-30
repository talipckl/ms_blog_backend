<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'posts';
    protected $date=['created_at','updated_at','deleted_at'];
    protected $fillable = [
        'user_id',
        'category_id',
        'slug',
        'title',
        'content',
    ];
    public static function slugGenarator($title, $id)
    {
        $slugifiedTitle = Str::slug($title, '-');
        $slug = "{$slugifiedTitle}";
        $originalSlug = $slug;
        $counter = 1;

        while (self::where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-{$counter}";
            $counter++;
        }
        return $slug;
    }
    public function save(array $options = [])
    {
        if (empty($this->slug) && !empty($this->title)) {
            parent::save($options);
            $this->slug = self::slugGenarator($this->title, $this->id);
        }

        parent::save($options);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
}
