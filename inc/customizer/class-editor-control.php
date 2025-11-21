<?php
if (!defined('ABSPATH')) {
    exit;
}

if (class_exists('WP_Customize_Control')) {
    class Velocity_Editor_Control extends WP_Customize_Control
    {
        public $type = 'velocity_editor';
        public function render_content()
        {
            $editor_id = $this->id . '_editor';
            echo '<span class="customize-control-title">' . esc_html($this->label) . '</span>';
            echo '<textarea id="' . esc_attr($editor_id) . '" rows="12">' . esc_textarea($this->value()) . '</textarea>';
            echo '<script>(function(){var id=' . json_encode($editor_id) . ';var setting=' . json_encode($this->id) . ';function init(){if(window.wp&&wp.editor&&typeof wp.editor.initialize==="function"){try{wp.editor.initialize(id,{tinymce:true,quicktags:true,mediaButtons:true});}catch(e){}var setFromTa=function(){try{var ta=document.getElementById(id);if(ta){wp.customize(setting).set(ta.value);}}catch(e){}};var ed=(window.tinymce&&tinymce.get(id))||null;if(ed){ed.on("change",function(){try{ed.save();}catch(e){} setFromTa();});ed.on("keyup",function(){try{ed.save();}catch(e){} setFromTa();});}var ta=document.getElementById(id);if(ta){ta.addEventListener("input",setFromTa);ta.addEventListener("change",setFromTa);} }else{setTimeout(init,200);} } init();})();</script>';
        }
    }
}