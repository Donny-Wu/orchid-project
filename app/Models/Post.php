<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;
use Orchid\Attachment\Attachable;
use Orchid\Attachment\Models\Attachment;
use Orchid\Filters\Types\Like;

class Post extends Model
{
    use HasFactory,AsSource,Attachable, Filterable;
    protected $fillable = [
        'title',
        'description',
        'body',
        'author'
    ];
    protected $allowedSorts = [
        'title',
        'created_at',
        'updated_at'
    ];
    protected $allowedFilters = [
        'title' => Like::class,
    ];

}
