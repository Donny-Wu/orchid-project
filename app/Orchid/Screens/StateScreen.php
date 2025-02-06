<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Screen\Fields\Label;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Layout;
use Illuminate\Http\Request;

class StateScreen extends Screen
{
    public $clicks;
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'clicks'=>0,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'StateScreen';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::rows(
        [
                    Label::make('clicks')
                         ->title('Click Count:'),

                    Button::make('Increment Click')
                          ->type(Color::DARK())
                          ->method('increment')
                ]
                        
            )
        ];
    }
    public function increment(Request $request){
        $this->clicks++;
        // dd($this->clicks);
    }
}
