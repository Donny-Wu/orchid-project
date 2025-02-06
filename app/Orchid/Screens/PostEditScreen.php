<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Alert;

class PostEditScreen extends Screen
{
    public $post;
    
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Post $post,Request $request): iterable
    {
        // dd($request->route('post'));
        if($request->route('post') instanceof Post){
            $post = $request->route('post');
        }
        $this->post = $post;
        return [
            'post'=>$post
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->post->exists ? 'Edit post' : 'Creating a new post';
    }

    public function description():?string
    {
        return 'Blog Posts';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Create post')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->post->exists),

            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->post->exists),

            Button::make('Remove')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->post->exists),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::rows([
                Input::make('post.title')
                ->title('Title')
                ->placeholder('Attractive but mysterious title')
                ->help('Specify a short descriptive title for this post.'),

                TextArea::make('post.description')
                    ->title('Description')
                    ->rows(3)
                    ->maxlength(200)
                    ->placeholder('Brief description for preview'),

                Relation::make('post.author')
                    ->title('Author')
                    ->fromModel(User::class, 'name'),

                Quill::make('post.body')
                    ->title('Main text'),
            ])
        ];
    }
    public function createOrUpdate(Request $request){
        if($this->post == null){
            $this->post = new Post();
        }
        $this->post->fill($request->get('post'))->save();
        Alert::info('You have successfully created a post');
        return redirect()->route('platform.post.list');
    }
    public function remove(Post $post,Request $request){
        $post = $request->route('post');
        if($post==null){
            return redirect()->route('platform.post.list');
        }
        $post->delete();
        Alert::info('You have successfully deleted the post');
        return redirect()->route('platform.post.list');
    }
}
