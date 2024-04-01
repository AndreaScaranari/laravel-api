<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;
use Illuminate\Database\Eloquent\Builder;

class Project extends Model
{
    use HasFactory;
    use softDeletes;

    protected $fillable = ['title', 'slug', 'content', 'is_published', 'type_id'];

    public function getFormattedDate($column, $format = 'd/m/Y H:i:s'){
    return Carbon::create($this->$column)->format($format);    
    }

    public function printImage(){
        return asset('storage/' . $this->image);
    }

    public function getAbstract()
    {
        return substr($this->content, 0, 350);
    }

    public function type(){
        return $this->belongsTo(Type::class);
    }

    public function technologies(){
        return $this->belongsToMany(Technology::class);
    }

    // # Query Scope
    public function scopePublic(Builder $query, $status)
    {
        if(!$status) return $query;
        $value = $status === 'published';
        return $query->whereIsPublished($value);
    }

    public function scopeType(Builder $query, $type_id)
    {
        if(!$type_id) return $query;
        return $query->whereTypeId($type_id);
    }

    public function scopeTechnology(Builder $query, $technology_id)
    {
        if(!$technology_id) return $query;
        return $query->whereHas('technologies', function($query) use ($technology_id) {$query->where('technologies.id', $technology_id);
        });
    }

}
