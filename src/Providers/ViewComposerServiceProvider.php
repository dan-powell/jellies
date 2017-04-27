<?php namespace DanPowell\Jellies\Providers;

use View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider {
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->view->composer(
            ['jellies::message.list.messageList'],
            'DanPowell\Jellies\Http\ViewComposers\MessageComposer'
        );
    }
}
