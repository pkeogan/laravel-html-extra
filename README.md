

# READ ME BEFORE MOVING ONWARD
Package is under heavy development and not ready for release, Package is complete and working. I am just working on all of the bugs and perfecting it before I release. At the time there is no install guide. Will be soon though! Make sure you watch!

# Laravel Html Extra
[![Latest Stable Version](https://poser.pugx.org/pkeogan/laravel-html-extra/v/stable)](https://packagist.org/packages/pkeogan/laravel-html-extra) [![Total Downloads](https://poser.pugx.org/pkeogan/laravel-html-extra/downloads)](https://packagist.org/packages/pkeogan/laravel-html-extra) [![Latest Unstable Version](https://poser.pugx.org/pkeogan/laravel-html-extra/v/unstable)](https://packagist.org/packages/pkeogan/laravel-html-extra)
## Description
A Laravel 5.5 Package that extends[LaravelCollective/html](https://github.com/LaravelCollective/html) further with different js plugins. Every component is also setup to be displayed the same, with label, the input, a some helper text. 

## Features
This package extends LaravelCollective/html package to include the following
* Text Inputs (Same as LaravelCollective/html, but build in with labels ect)
* [Date Picker](https://chmln.github.io/flatpickr/)
* [Toggle](http://www.bootstraptoggle.com/)
* [Select/Pillbox](https://select2.org/)
* [Slider](https://refreshless.com/nouislider/)
* [Text Editor](https://summernote.org/)
* Fileuploader (Not Decided Yet)
* [Image Uploaded and Cropper](https://fengyuanchen.github.io/cropperjs/) 
#  Table of Contents
* [Description](#description)  
* [Table of Contents](#table-of-contents)  
* [Install](#install)  
* [ Usage](#usage)
	* [Form:: Facade Usage](#form-usage)
	* [HtmlExtra Method Chaining](#htmlextra-usage)
		* [Step 1 - Initialization ](#step-1-initialization )
		* [Step 2 - Parameters](#step-2-parameters)
		* [Step 3 - Render](#step-3-render)
* [ Components](#components-types)
	* [Text Input Type](#text-input) - basic text input
	* [Summernote Type](#summernote) - creates a summernote editor
	* [NoUiSlider Type](#nouislider) - creates a NoUISlider component
	* [Bootstrap Toggle Type](#bootstrap-toggle) - creates a Bootstrap Toggle component
	* [Select2 Type](#select2-type) - creates a Select2 component, select only 1
	* [Flatpickr Type](#flatpickr-type) - creates a Flatpickr component, with only the time
	* [Cropper Type](#cropper-type) - creates a Croppercomponent
	* [File Type](#) - coming soon....
	* [Drawintg Type](#) - coming soon....
* [ Custom Blade Directives](#custom-blade-directives)


#  Install

# Usage
There are two ways to implement this package into your code. You can use the Form:: facade that is created by laravelCollective/html, or you can use the custom HtmlExtra Facade. The differnce, is that the HtmlExtra facade uses method chaining, to create components and render them, where as the laravelCollective/html facade just calls the views and you must inject the parameters in the right order.
#### Form:: Usage Example
	{{ Form::textInput('Name', 'id', 'helper_text', 'Type',  $attributes[...]) }}
#### HtmlExtra:: Usage Example
	{{ HtmlExtra::text()->name('Name')->id('1')->helperText('This is an input')->attributes(['required' => 'true'])->render() }}

## Form:: Usage
You can all for a component over LaravelCollective/html's Component Magic Methods
```
{{ Form::textInput('Name', 'id', 'helper_text', 'Type',  $attributes[...]) }}
```
**Future Documentation on how to use this coming in the future.**
## HtmlExtra:: Usage
Using the HtmlExtra method chaining can be easy, and more friendly to look at. most importantly it can be done with a smaller amount of code, due to the fact you do not have to declare null variables.
### Step 1: Initialization 
First Step Is To Declare the type, you can do this two ways, which ever you prefer.
```
// Facade Based, with build() and without 
{{ HtmlExtra::build()->text->... }}
{{ HtmlExtra::text()->... }}

// Service Binding Based
{{ app()->htmlextra()->build()->text->... }}
{{ app()->htmlextra()->text()->... }}
```
##### Types
* `HtmlExtra::text()->` -[Text Input Type](#text-input) - basic text input
* `HtmlExtra::textarea()->` -[Text Input Type](#text-input) - basic text area input
* `HtmlExtra::textField()->` -[TextField Input Type](#textfield-input) - basic textField input
* `HtmlExtra::password()->` -[Text Input Type](#text-input) - password input
* `HtmlExtra::email()->` -[Text Input Type](#text-input) - email input
* `HtmlExtra::hidden()->` -[Text Input Type](#text-input) - hidden input
* `HtmlExtra::summernote()->` -[Summernote Type](#summernote) - creates a summernote editor
* `HtmlExtra::slider()->`-[NoUiSlider Type](#nouislider) - creates a NoUISlider component
* `HtmlExtra::toggle()->` -[Bootstrap Toggle Type](#bootstrap-toggle) - creates a Bootstrap Toggle component
* `HtmlExtra::select()->` - [Select2 Type](#select2-type) - creates a Select2 component, select only 1
* `HtmlExtra::multiple()->` - [Select2 Type](#select2-type) - creates a Select2 component, select multiple* `HtmlExtra::date()->` - [Flatpickr Type](#flatpickr-type) - creates a Flatpickr component, with only the date
* `HtmlExtra::time()->` - [Flatpickr Type](#flatpickr-type) - creates a Flatpickr component, with only the time
* `HtmlExtra::dateTime()->` - [Flatpickr Type](#flatpickr-type) - creates a Flatpickr component, with the dateTime
* `HtmlExtra::cropper()->` - [Cropper Type](#cropper-type) - creates a Croppercomponent
* `HtmlExtra::file()->` - UNDECIDED
* `HtmlExtra::drawing()->` - UNDECIDED

### Step 2: Parameters
Next step you must declare the parameters and set them!
```
{{ HtmlExtra::build()->text->name('Some Name')->id('Some Id')->helperText('This is some helping Text') }}
{{ HtmlExtra::toggle()->name('Some Name')->helperText('Some Helper Text')->id('Some Id')->data(['some-atttribute' => 'some value'])... }}
```
####  Parameter Methods
* `...->name('Some Name')->...` - The name of the input, used for label **REQUIRED!** $string
* `...->id('Foo')->...` - The name of the ID, needs to be alpha-numeric-dash (If not supplied, this will take the name and convert it to alpha numeric) $string
* `...->helperText('Some Details')->...` - The Helper Text, under the input **REQUIRED!** $string
* `...->value('Bar')->...` - The default value of the input $mixed 
* `...->attributes(['class' => 'form-control', 'style' => 'color: fff;'])->...` - Attributes that get passed directly to the html `<input>` Element. $array
* `...->data(['data-width' => 100])->...` - The data that will be passed into the view. Used to control the JavaScript! $array

#### Magic Methods
You may also pass varibles, attributes and data to your component without using the above parameter methods the first 4 letters must be the same as below, then te letters following it will be the name/key. The method will then take the value you are sending. 
* `...->withFoo($var)->... //Replace foo`- pass a variable into the component view
* `...->attrBar($var)->... //Replace Bar`- add to the attributes array
* `...->dataBaz($var)->... //Replace Baz`- add to the data array
##### Examples
```
{{ HtmlExtra::text()->name('Some Name')withRole('admin')... }} // Would pass $role = admin into the view.
{{ HtmlExtra::toggle()->name('Some Name')attrClass('hide-div')... }} // Would add 'class' => 'hide-div' to the attributes array
{{ HtmlExtra::select()->name('Some Name')dataDisable(true)... }} // would add 'disable' => true to the data array
```
#### Magic Setters (Its really a Magic Getter, but hey its setting something)
you may also pass single values into the attribute or data arrays.
* `...->attrFoo->... //Replace Foo` - add to the attributes array
* `...->attrBaz->... // Replace Baz` -  add to the data array
```
{{ HtmlExtra::text()->name('Some Name')->attrRequired->... }} // would add 'required' to the end of the attributes array
{{ HtmlExtra::toggle()->name('Some Name')->attrDisabled->... }} // would add 'disabled' to the end of the attributes array
{{ HtmlExtra::select()->name('Some Name')->dataStop->... }} // would add 'stop' to the end of the data array
```
### Step 3: Render
The last thing you need to do, is tell the HtmlExtra to render what you gave it. 
Simply chain the `...->render()` method to the end of a Facade Chain
#### Example
	`{{ HtmlExtra::select()->name('Some Name')->id('1')->render() }}`
In the future I will look into expanding this into other ways.



## Basic Text Input
Provides access to Form's basic form input, only difference is this will have the same style as all the other inputs, and create the label and helper text for you.
### Blade Directive
```
{{ Form::textInput('Name', 'id', 'helper_text', 'Type',  $attributes[...]) }}
```
### Parameters
* **Name** - This will become the label and if no placeholder is set in attribute, this will display in the placeholder*REQUIRED*
* **id** -This will be the id of the toggle, and the id of the request key *REQUIRED*
* **Helper Text** - This is the text displayed underneath the toggle to give more information
* **Type** - Type of input OPTIONS: text, password, email *DEFAULT: 'text'*
* **Attributes[]** - An array that contains the attributes for the input. Gets passed directly to the Form::text *DEFAULT: Null*
### Avaible Attributes
Again, you can use anything that you would normaling use in the Form::text method call for the attributes
[HTML5 Inputs Attributes](https://www.w3schools.com/tags/tag_input.asp)
```         
['value'                   => 'String',   // Value of the input upon page load DEFAULT: NULL
'placeholder'              => 'String',   // placeholder text DEFAULT: 'Enter ' . $Name
'maxlength'                => 'String',   // max amount of chars allowed
'required'                 => boolean,   // If use, label will get a * after it
'autocomplete'             => 'String',   // Use On or Off Only
'autofocus'                =>  boolean,   // Specifies that an <input> element should automatically get focus when the page loads, only use once!
```
### Simple Usage
```
{{ Form::texInput('Label', 'toggle-id', 'This is some helper text', true}}

```
## flatpickr v4 Component
### Blade Directive
```
{{ Form::datePicker('Name', 'id', 'helper_text', $date,  $attributes[...]) }}
{{ Form::timePicker('Name', 'id', 'helper_text', $date,  $attributes[...]) }}
{{ Form::dateTimePicker('Name', 'id', 'helper_text', $date,  $attributes[...]) }}
```
### Parameters
* **Name** - This will become the label and if no placeholder is set in attribute, this will display in the placeholder*REQUIRED*
* **id** -This will be the id of the toggle, and the id of the request key *REQUIRED*
* **Helper Text** - This is the text displayed underneath the toggle to give more information *REQUIRED* (leave '' if you dont want helper_text)
* **$Date** - Date Value *REQUIRED* Set to null if you want it empty
* **Attributes[]** - An array that contains the attributes for the flatpickr, see below for more information *DEFAULT: Null*
### Avaible Attributes
```       

['enableTime'              => 'boolean',  // Allow Time to be selected (you can use dateTimePicker or timePicker instead if you want)
'enableSeconds'            => 'boolean',  // enable seconds to be captures, but be using dateTimePicker, or timePicker
'noCalendar'               => boolean,   // will not display a day picking
//NOTE the above 3 are linked with the date format. see flatpickr.blade.php

//You can also pass in normal text attributes that are HTML complainct 
```

### Simple Usage
```
{{ Form::datePicker('Date of Birth', 'date_of_birth', 'Users Date Of Birth', null ) }}
{{ Form::dateTimePicker('Time Clocked In', 'clock_in_at', 'Time Clocked', null ) }}


```

### Advanced Usage - With Attributes
```
{{ Form::datePicker('Date of Birth', 'date_of_birth', 'Users Date Of Birth', null, ['required' => 'required'] ) }}
```




## select2 Component
### Blade Directive
```
{{ Form::select2('Name', 'id', 'helper_text', $items[],  $attributes[...], $logic[...]) }}
```
### Parameters
* **Name** - This will become the label and if no placeholder is set in attribute, this will display in the placeholder*REQUIRED*
* **id** -This will be the id of the toggle, and the id of the request key *REQUIRED*
* **Helper Text** - This is the text displayed underneath the toggle to give more information *REQUIRED* (leave '' if you dont want helper_text)
* **$items[]** - List of Items to Display. Needs to be a keypair array. *REQUIRED*
* **Attributes[]** - An array that contains the attributes for the select2, see below for more information *DEFAULT: Null*
* **Data[]** - A Keypair Array that if selected will display certain divID by removing class hide-div *DEFAULT: Null*
### Avaible Attributes
```         
['multiple'              => 'String',  // Allow Multiple Selects
'placeholder'            => 'String',  // placeholder text DEFAULT: 'Enter ' . $Name
'required'               => boolean,   // If use, label will get a * after it
'allow-clear'            => boolean,   // Provides an X to hit so you can clear the selection
'tags'                   => boolean,   //Allows user to type their own awnser in
'maximumSelectionLength' =>  int,      // If mutiple is used, this will set the maxium amount of selectins you can choose
```

### Simple Usage
```
{{ Form::select2('Users', 'user_id', 'A List Of Users', $users) }}

```

### Advanced Usage - With Attributes
```
{{ Form::select2('Users', 'user_id', 'A List Of Users', $users, ['mutiple' => 'mutiple', 'tags' => 'true']) }}
```

### Advanced Usage - With Attributes and Logic
Display a Select 2 input, and if peter is selected, then show a div with id
```
@php
  $users = ['Peter' => 1, 'John' => 2],
@endphp
...
{{ Form::select2('Users', 'user_id', 'A List Of Users', $users, ['mutiple' => 'mutiple', 'tags' => 'true'], ['Peter', => 'hide-me']) }}
<div class="hide-div", id="hide-me">
    //Show some stuff
</div>

```


## Toggle Component
A Form::checkbox masked by a bootstrap-toggle
### Blade Directive
```
{{ Form::toggle('Name', 'id', 'helper_text', $boolean,  $attributes[...], $data[...]) }}
```
### Facade Call
```
{{ HtmlExtra::toggle()->withName()->withId()->withHelperText()->withValue()->withAttributes()->withData() }}
```

### Parameters
* **Name** - This will become the label *REQUIRED*
* **id** -This will be the id of the toggle, and the id of the request key *REQUIRED*
* **Helper Text** - This is the text displayed underneath the toggle to give more information *REQUIRED*
* **$boolean** - Default state of the toggle, true or false only *REQUIRED*
* **Attributes[]** - An array that contains the attributes for the HTML INPUT, see below for more information *REQUIRED*
* **Data[]** - an ans) an Array that contains the data for the TOGGLE JAVASCIRPT *REQUIRED*
### $Attributes[]
This array is passed to the Form::checkbox beneath all of the javascript
```         
['required'                 => boolean,   // If use, label will get a * after it
]
```
### $Data[] Parameters
This array is passed to the bootstrap toogle element

```         
['data-on'             => 'String',   //Text Displayed when Toggle Is On DEFAULT = ON
 'data-off'            => 'String',   //Text Displayed when Toggle Is On DEFAULT = OFF
 'data-label'          => 'String',   //label of toggle if data-on and data-off are not set' NO DEFAULT
 'data-size'           => 'String',   //Overrides height and width. OPTIONS: large, normal, small, mini
 'data-offstyle'       => 'String',   // Style OPTIONS: primary, default, warning, danger, success, info
 'data-onstyle'        => 'String',   // Style OPTIONS: primary, default, warning, danger, success, info
 'data-width'          =>   int,      // Width of toggle DEFAULT 200
 'data-height          =>   int,      // Height of toggle DEFAULT 30
 'show-id-if-toggled' =>  'Array',    // If turned toggle, this will remove the hide-div from the inputed div#ID
 'hide-id-if-toggled' =>  'Array',     // If turned toggle, this will remove the hide-div from the inputed div#ID
 'disable-id-if-toggled' =>  'Array', //if the toggle is toggle, disablen another toggle
 'enable-id-if-toggled' =>  'Array',  //if the toggle is enable, enable another toggle
```

### Simple Usage
```
{{ Form::toggle('Label', 'toggle-id', 'This is some helper text', true}}

```

### Advanced Usage - With Attributes
```
{{ Form::toggle('Label', 'toggle-id', 'This is some helper text', true,  $data['data-label' => 'Hello There'] }}

```

### Advanced Usage - With Attributes and Logic
Displays 3 toggles, 2 visble and 1 hidden. If the first one is selected, is will display the third. Only the first and second toggle can be selected at the same time. (like radio buttons)
```
{{ Form::toggle('Label', 'toggle-id', 'This is some helper text', false,  $attributes['data-label' => 'Hello There', 'show-id-if-selected' => 'hide-me'], ['toggle-id2'] }}
{{ Form::toggle('Label', 'toggle-id2', 'This is some helper text', false,  $attributes['data-label' => 'Hello There2'], ['toggle-id'] }}
<div class="hide-div", id="hide-me">
{{ Form::toggle('Label', 'toggle-id3', 'This is some helper text', false,  $attributes['data-label' => 'Hello There3', ], ['toggle-id'] }}
</div>

```

## Custom Blade Directives
There are some custom blade directives added in order to make this all work. 
### @pushonce('stack:component') && @endpushonce
```
@pushonce('stack:component')
   //stuff to push to stack
@endpushonce
```
## Parameters
* **stack** - Name of the stack you want to push to. CANNOT HAVE DASHES *REQUIRED*
* **component** - Name of the component, this creates a boolean with this name and is used to check if its been called CANNOT HAVE DASHES *REQUIRED*
### Usage
Lets say you want to push a script to the stack `scripts` and the name of your widget is `select2`
```
// In Blade View
...
@pushonce('scripts:select2')
   <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
@endpushonce
```

On the first time loading this blade view, it will push, but the second time it will be false and not push anything


## License
Please see LICENSE.md
