# HtmlBuilder
Useful helper for builder HTML entities with php

You should not use this to build full DOM et full pages since it mays get harder to load than pure HTML, however it ensure a correct HTML syntax and some friendly tools for creating tags.

A use case example would be outputting an edit button to a datatable.

## Introduction

Install it via composer
```
composer require nicklayb/htmlbuilder
```

### Creating simple DOM element

For example, if you would like to create a `input` of type `text` with name `my_input` and classes `super-input` and `holy-input`, you could do it that way.
```php
<?php

$tag = '<input type="text" name="my_input" class="super-input holy-input">';
```
Or you could do it that way
```php
<?php

use Nicklayb\HtmlBuilder\Tags\Input;

$tag = new Input('text');
$tag->name('my_input')
    ->classes([
        'super-input',
        'holy-input',
    ])
$tag->make();

```

The make method will return your string dom element

You may say "Well, how is that an improvement if it takes more lines?". It simply because it allows you to manipulate element easily. You could swipe class in an easier way than concatenating string. And so, I found it's better to take 5 lines of ~15 characters each than one of concatenation an ternary that takes 70 characters.

### Each tag, each class
Most of the tags have their own class which let's you use them for what they need to be used. As example, you would never set a value attribute to a div. Let's see some examples.
```php
<?php

use Nicklayb\HtmlBuilder\Tags\A;
use Nicklayb\HtmlBuilder\Tags\Input;
use Nicklayb\HtmlBuilder\Tags\Select;

$tag = new A('http://google.ca');   //
$tag = new A;                       //  Both of these will output '<a href="http://google.ca"></>'
$tag->href('http://google.ca');     //

$tag = new Input;                   //  '<input type="text" />'
$tag = new Input('password');       //  '<input type="password" />'

$tag = new Select([         //  <select>
    '-1'=>'Refused',        //      <option value="1">Accepted</option>
    '0'=>'Pending',         //      <option value="1">Accepted</option>
    '1'=>'Accepted'         //      <option value="1">Accepted</option>
]);                         //  </select>
```

### Nesting is fun
You can easily nest tags, let's nest some stuff together

```php
<?php

use Nicklayb\HtmlBuilder\Tags\Div;

$div = new Div([
    'main',
    'primary-div'
]);
$div->child(
    (new Div('second'))->child(
        (new Div('third'))->content('Tada, stuff!')
    )
);

echo $div->make();

/*
    Will result in

    <div class="main primary-div">
        <div class="second">
            <div class="third">
                Tada, stuff!
            </div>
        </div>
    </div>
*/
```

### Custom tag list

Let's say for example you would use the bootstrap button sometimes but don't want to always rewrite it. You could create a custom tag, like this one
```php
<?php

use Nicklayb\HtmlBuilder\Tags\Button as BaseButton;

class BsButton extends BaseButton
{
    public function __construct($color = 'default', $size = '')
    {
        __parent::__construct();
        $this->classes([
            'btn',
            ($size != '') ? 'btn-'.$size : '',
            'btn-'.$color
        ]);
    }
}

//  And you can easily use it
use MyNamespace\BsButton;

(new BsButton)->make()      //  <button class="btn btn-default"></button>
(new BsButton('danger'))    //  <button class="btn btn-danger"></button>   

```

## Conclusion

Thank you for using, testing and improving it and feel free to contact me for any question.

Ending joke :
> A QA engineer enter a bar
> He order 1 beer
> He order 0.3 beer
> He order null beer
> He order a lizard
> He order ¡ beer
