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
    |   Title : HtmlExtra Class
    |   Desc  : Builder class to make components
    |   Useage: Please Refer to readme.md 
    | 
    |
    */


namespace Pkeogan\LaravelHtmlExtra;


use Illuminate\Support\HtmlString;
use Illuminate\Contracts\View\Factory;
use App\Exceptions\GeneralException;


/**
 * Class HtmlExtra
 */
class HtmlExtra
{    

    protected $type = null;
    protected $view;
    protected $data;
    protected $types;
    protected $types_text;
    
  
    public function __construct (Factory $view) {
      $this->view = $view;
      $this->type = null;
      $this->data = ['name' => null,
                    'id' => null,
                    'helper_text' => null,
                    'value' => null,
                    'attributes' => null,
                    'data' => null];
      
      $this->types = ['box', 'label', 'text', 'password', 'email', 'hidden', 'textarea', 'date', 'time', 'dateTime', 'toggle', 'select', 'mulitple', 'slider', 'summernote', 'cropper']; 
      $this->singleAttributes = ['required', 'disabled', 'checked', 'autofocus', 'multiple', 'readonly'];
    }
  
  public function __call($name, $value)
    {
      
          $value = $value[0];
          $method = substr($name, 0, 4);
          $parameter = strtolower(substr($name, 4, 1)) . substr($name, 5);
      
    
          if($value == null){
              if($method == 'attr'){
                  if(!is_null($this->data['attributes'])){
                      $this->data['attributes'] =  array_merge($this->data['attributes'], [$parameter]);
                  } else {
                      $this->data['attributes'] =  [$parameter];
                  }
              } elseif($method == 'data') {
                 if(!is_null($this->data['data'])){
                      $this->data['data'] =  array_merge($this->data['data'], [$parameter]);
                  } else {
                      $this->data['data'] =  [$parameter];
                  }
              } 
          } else {
              if( $method == 'with'){
                  if(!in_array($parameter, array_keys($this->data))){
                      $this->data[$parameter] = $value;
                  }
              } elseif($method == 'attr') {
                  if(!is_null($this->data['attributes'])) {
                        $this->data['attributes'] =  array_merge($this->data['attributes'], [$parameter => $value]);
                  } else {
                        $this->data['attributes'] =  [$parameter => $value];
                  }
              } elseif($method == 'data') {
                  if(!is_null($this->data['data'])) {
                        $this->data['data'] =  array_merge($this->data['data'], [$parameter => $value]);
                  } else {
                        $this->data['data'] =  [$parameter => $value];
                  }
              }
          }
          return $this; // Continue The Chain
    }
  
  
    public function __get($value)
    {
        $method = substr($value, 0, 4);
        $parameter = substr($value, 4);
      
        if($method == 'attr'){ // Add to attributes array
				if(is_null($this->data['attributes'])){
				 $this->data['attributes'] =  [$parameter];
				} else {
				  $this->data['attributes'] =  array_merge($this->data['attributes'], [$parameter]);
				}
        } elseif($method == 'data') { // Add to data array
				if(is_null($this->data['data'])){
					$this->data['data'] =  [$parameter];                
				} else {
					$this->data['data'] =  array_merge($this->data['data'], [$parameter]);
				} 
        } elseif(in_array($value, $this->singleAttributes)){ //Single Attributes
			  if(is_null($this->data['attributes'])){
				 $this->data['attributes'] =  [$value];
			  } else {
				  $this->data['attributes'] =  array_merge($this->data['attributes'], [$value]);
			  }
        } elseif(in_array($value, $this->types)){ //for build()->text type methods
           $this->{$value}();
        }
		
        return $this;
    }
    
  public function box()
  {
    $this->type = 'box';
    return $this;
  }
    
  public function label()
  {
    $this->type = 'label';
    return $this;
  }
  
  public function text()
  {
    $this->type = 'text-input';
    $this->data['type'] = 'text';
    return $this;
  }
  
  public function password()
  {
    $this->type = 'text-input';
    $this->data['type'] = 'password';
    return $this;
  }
  
  public function email()
  {
    $this->type = 'text-input';
    $this->data['type'] = 'email';
    return $this;
  }
  
  public function textarea()
  {
    $this->type = 'text-input';
    $this->data['type'] = 'textarea';
    return $this;
  }
  
  public function hidden()
  {
    $this->type = 'text-input';
    $this->data['type'] = 'hidden';
    return $this;
  }
  
  public function build()
  {
    return $this;
  }
  
  public function toggle()
  {
    $this->type = 'toggle';
    return $this;
  }
	
  public function dateTime()
  {
    $this->type = 'flatpickr';
  	$this->data['data'] = ['enableTime' => true, 'noCalendar' => false];			
    return $this;
  }
	
	
public function time()
  {
    $this->type = 'flatpickr';
	$this->data['data'] = ['enableTime' => true, 'noCalendar' => true];			  
    return $this;
  }
	
  public function date()
  {
    $this->type = 'flatpickr';
	$this->data['data'] = ['enableTime' => false, 'noCalendar' => false];	
    return $this;
  }
    
  public function nestable()
  {
    $this->type = 'nestable';
    return $this;
  }
    
  public function slider()
  {
    $this->type = 'slider';
    return $this;
  }
	
  public function summernote()
  {
    $this->type = 'summernote';
    return $this;
  }
  
  public function select()
  {
    $this->type = 'select2';
    return $this;
  }

	public function selectModel()
  {
    $this->type = 'select-model';
    return $this;
  }
  
    public function multiple()
  {
    $this->type = 'select2';
    $this->data['attributes'] = ['multiple' => 'multiple'];
    return $this;
  }
  
  public function name(String $input)
  {
    $this->data['name'] = $input;
    return $this;
  }
  
  public function id(String $input)
  {
    $this->data['id']= $input;
    return $this;
  }
  
  public function helperText(String $input)
  {
    $this->data['helper_text'] = $input;
    return $this;
  }
  
  public function value($input)
  {
    $this->data['value'] = $input;
    return $this;
  }
	
	private function mergeIfNull()
	{
		
	}
  
  public function attributes(Array $input)
  {
    if(is_null($this->data['attributes'])){
      $this->data['attributes'] = $input;
    } else {
      $this->data['attributes'] = array_merge($this->data['attributes'], $input);
    }
    return $this;
  }
  
  public function data($input)
  {
  	if(is_null($this->data['data'])){
      $this->data['data'] = $input;
    } else {
      $this->data['data'] = array_merge($this->data['data'], $input);
    }
    return $this;
    $this->data['data'] = $input;
    return $this;
  }
  
  public function compile()
  {
        if(! isset($this->data['name'])){ throw new HtmlExtraException('ERROR: NAME WASNT SET '); };
        if(! isset($this->data['id'])){ $this->data['id'] = str_replace(' ', '_', strtolower($this->data['name'])); }; //if the ID wasnt set, set it to the $this->name alpah-underscore lower case
  }
  
  public function render()
  {
        $this->compile();
        $type = $this->type;
        $data = $this->data;
        $this->type = null;
      //reset for next render call.
        $this->data = ['name' => null,
                    'id' => null,
                    'helper_text' => null,
                    'value' => null,
                    'attributes' => null,
                    'data' => null];
    
        return $this->renderComponent($type, $data);
  }
	
public function dd()
  {
        $this->compile();
        $type = $this->type;
        $data = $this->data;
        $this->type = null;
      //reset for next render call.
        $this->data = ['name' => null,
                    'id' => null,
                    'helper_text' => null,
                    'value' => null,
                    'attributes' => null,
                    'data' => null];
    
		dd($data);
  }
  
  
    /**
     * Transform the string to an Html serializable object
     *
     * @param $html
     *
     * @return \Illuminate\Support\HtmlString
     */
    protected function toHtmlString($html)
    {
        return new HtmlString($html);
    }
  
    /**
     * Render Component
     *
     * @param        $name
     * @param  array $arguments
     *
     * @return \Illuminate\Contracts\View\View
     */
    protected function renderComponent($type, $data)
    {


        return new HtmlString(
          $this->view->make('htmlextra::' . $type, $data)->render()
        );
    }
  
  
}