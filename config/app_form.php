<?php
/**
 * Used to customize the output of the FormHelper class (e.g. $this->Form->control('username')).
 * Refer to the documentation at https://api.cakephp.org/3.6/class-Cake.View.Helper.FormHelper.html#%24_defaultConfig
 * to see which different templates we can configure and examples of what the template should look like.
 */
return [

    /**
     * This is the most important bit of this class. This is where I've overridden a series of templates from
     * https://api.cakephp.org/3.6/class-Cake.View.Helper.FormHelper.html#%24_defaultConfig so that they look
     * more like what the "Modular Default HTML" template (https://github.com/modularcode/modular-Default-html) uses.
     */
    'inputContainer' => '<div class="form-group mb-3 row {{inputContainerClass}}">{{content}}</div>',
    'label' => '<label class="col-sm-2 col-form-label" {{attrs}}><span>{{text}}</span></label>',
    'input' => '<div class="col-sm-10 {{inputClass}}">
        <input type="{{type}}" name="{{name}}" class="form-control underlined" {{attrs}}/>
        </div>',
    'textarea' => '<div class="col-sm-10">
        <textarea name="{{name}}" class="form-control underlined" {{attrs}}>{{value}}</textarea>
        </div>',

    // The additional "<span>" here is because the "Modular Default HTML template does some magic with regards to
    // styling checkboxes. It actually hides the real checkbox, and replaces it with a fancy box that it styles
    // itself.
    'checkbox' => '<input type="checkbox" class="checkbox" name="{{name}}" value="{{value}}"{{attrs}}><span></span>',

    'inputSubmit' => '<input type="{{type}}" class="btn btn-block btn-success" {{atrs}} />',
    'button' => '<button class="btn btn-success" {{atrs}}>{{text}}</button>',
];

