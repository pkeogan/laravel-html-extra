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
    |   Title : HtmlExtra Facade Class
    |   Desc  : Facade Support Class
    |   Useage: Please Refer to readme.md 
    | 
    |
    */


namespace Pkeogan\LaravelHtmlExtra;

use Illuminate\Support\Facades\Facade;

/**
 * @see Pkeogan\HtmlExtra
 */
class HtmlExtraFacade extends Facade
{    

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'htmlextra';
    }
   
  
}