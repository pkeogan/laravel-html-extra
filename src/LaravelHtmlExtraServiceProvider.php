<?php

    /*
    |----------------------------------------------------------------------------------------------------
    |      __                               __   __  __________  _____       _______  ____________  ___    
    |     / /  ____ __________ __   _____  / /  / / / /_  __/  |/  / /      / ____| |/ /_  __/ __ \/   |
    |    / /  / __ `/ ___/ __ `| | / / _ \/ /  / /_/ / / / / /|_/ / /      / __/  |   / / / / /_/ / /| |
    |   / /__/ /_/ / /  / /_/ /| |/ /  __/ /  / __  / / / / /  / / /___   / /___ /   | / / / _, _/ ___ |
    |  /_____\__,_/_/   \__,_/ |___/\___/_/  /_/ /_/ /_/ /_/  /_/_____/  /_____//_/|_|/_/ /_/ |_/_/  |_|
    |----------------------------------------------------------------------------------------------------
    | Laravel HTML Extra - By Peter Keogan - Link:https://github.com/pkeogan/laravel-html-extra
    |----------------------------------------------------------------------------------------------------
    |   Title : Service Provider
    |   Desc  : This service provider injects the Form blade directives for views to be able to render the views.
    |   Useage: Please Refer to readme.md 
    | 
    |
    */


namespace Pkeogan\LaravelHtmlExtra;

use Form;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class LaravelHtmlExtraServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services and add all the directives. 
     * 
     *
     * @return void
     */
    public function boot()
    {
      //Publish Config File
        $this->publishes([
          __DIR__.'/laravel-html-extra.php' => config_path('laravel-html-extra.php'),
         ]);
      // adds our custom views to laravel can call them with adminlte::example.page
      view()->addNamespace('htmlextra', base_path('/vendor/pkeogan/laravel-html-extra/src/views'));

         // Register the form components
        //flatpickr componentes
        Form::component('datePicker', 'htmlextra::flatpickr', ['name', 'id', 'helper_text', 'value', 'attributes' => null ]);
        Form::component('dateTimePicker', 'htmlextra::dateTimePicker', ['name', 'id', 'helper_text', 'value', 'attributes' => null ]);
        Form::component('timePicker', 'htmlextra::timePicker', ['name', 'id', 'helper_text', 'value', 'attributes' => null ]);
        Form::component('slider', 'htmlextra::slider', ['name', 'id', 'helper_text', 'value', 'attributes' => ['min' => '0', 'max' => '100','step' => '1', 'pips' => '10', 'default' => '0', 'ticks' => null, 'ticks-labels' => null, 'tool-tip' => true, 'checked' => null]]);
        Form::component('toggle', 'htmlextra::toggle', ['name', 'id', 'helper_text', 'value', 'attributes' => null, 'data' => null]);
        Form::component('select2', 'htmlextra::select2', ['name', 'id', 'helper_text', 'items', 'attributes' => null, 'logic' => null]);
        Form::component('multiple2', 'htmlextra::select2', ['name', 'id', 'helper_text', 'items', 'attributes' => null, 'logic' => null]);
        Form::component('summernote', 'htmlextra::summernote', ['name', 'id', 'helper_text', 'attributes' => ['maxlength' => null, 'placeholder' => null, 'height' => null]]);
        Form::component('textInput', 'htmlextra::text-input', ['name', 'id', 'helper_text', 'type' => 'text', 'attributes' => null]);
        Form::component('cropit', 'htmlextra::cropit', ['id', 'attributes' => ['height' => 200, 'width' => 200]]);
      
        Validator::extend('phone', function($attribute, $value, $parameters, $validator) {
        return preg_match('%^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$%i', $value) && strlen($value) >= 10;
    });

	Validator::replacer('phone', function($message, $attribute, $rule, $parameters) {
			return str_replace(':attribute',$attribute, ':attribute is invalid phone number');
		});
        //yummy sauceee https://stackoverflow.com/questions/38135455/how-to-have-one-time-push-in-laravel-blade 
        // Lets us push scripts and styles only as componets are loaded. 
        Blade::directive('pushonce', function ($expression) {
            $domain = explode(':', trim(substr($expression, 1, -1)));
            $push_name = $domain[0];
            $push_sub = $domain[1];
            $isDisplayed = '__pushonce_'.$push_name.'_'.$push_sub;
            return "<?php if(!isset(\$__env->{$isDisplayed})): \$__env->{$isDisplayed} = true; \$__env->startPush('{$push_name}'); ?>";
        });
        Blade::directive('endpushonce', function ($expression) {
            return '<?php $__env->stopPush(); endif; ?>';
        });

        Blade::directive('IfHide', function ($input) {
            return '<?php if( isset('.$input.') && ('.$input.' == true) ){echo "hidden";} ?>';
        });
        Blade::directive('hideGroup', function ($input) {
            return '<?php if( isset($data["hideGroup"]) && ($data["hideGroup"] == true) ){echo "hidden";} ?>';
        });
        Blade::directive('labelRequired', function () {
          return '<?php if(in_array(\'required\', $attributes)){echo "<span class=\'form-input-required-label\' >(required)</span>";} ?>';
        });

      
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('htmlextra', function ($app) {
            return new HtmlExtra($app['view']);
        });
    }
}