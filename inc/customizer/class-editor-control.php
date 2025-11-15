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
        wp_editor($this->value(), $editor_id, [
            'textarea_rows' => 10,
            'media_buttons' => true,
        ]);
        echo '<script>(function(){var id=' . json_encode($editor_id) . ';var setting=' . json_encode($this->id) . ';function bind(){if(window.tinymce&&tinymce.get(id)){var ed=tinymce.get(id);var sync=function(){wp.customize(setting).set(ed.getContent());};ed.on("change",sync);ed.on("keyup",sync);}else{setTimeout(bind,200);}}bind();})();</script>';
    }
}
}