<?php
Form::macro("semanticCheckbox", function ($name, $value = 1, $checked = null, $options = array()) {


    $string = "<div class='ui toggle checkbox ";
    $string .= $checked ? 'checked' : 'unchecked';
    $string .= "'>";
    $string .= '<input type="hidden" name="' . $name . '" value="0"/>';
    $string .= Form::checkbox($name, $value, $checked);
    $string .= '</div>';


    return $string;


//    return '<input name="' . $name . '" value="0" type="hidden">' . Form::checkbox($name, $value, $checked, $options);
});