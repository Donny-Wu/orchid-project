<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use App\Models\Post;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;



class PostListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'posts';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('title','Title')->sort()->filter(Input::make())->render(function(Post $post){
                return Link::make($post->title)->route('platform.post.edit',['post'=>$post]);
            }),
            TD::make('created_at','Created')->sort(),
            TD::make('updated_at','Last edit')->sort()
        ];
    }
}
