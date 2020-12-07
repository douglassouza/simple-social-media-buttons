<?php
/*
Plugin name: Social Media Accessible
Plguin URI: https://wordpress.org/plugins
Description: Widget of social media acessible
Author: Douglas Bernardes de Souza
Version: 1.0
*/

/**
 * WP Bootstrap Starter Theme Widgets
 *
 * @package WP_Bootstrap_Starter
 */

class social_media_accessible extends WP_Widget
{

    function __construct()
    {
        $widget_opt = array(
            'classname' => 'social_media_accessible',
            'description' => __('Social Media Accessible', 'wp-bootstrap-starter')
        );
        // parent::__construct( widget ID, widget name, widget description )
        parent::__construct(
            'social_media_accessible',
            __('Social Media Accessible', 'wp-bootstrap-starter'),
            $widget_opt
        );

        // Register stylesheets and scripts for the frontend
        add_action('wp_enqueue_scripts', array($this, 'register_plugin_assets'));

        // Register stylesheets and scripts for the backend
        add_action('admin_enqueue_scripts', array($this, 'register_plugin_admin_assets'));
    }

    public function widget($args, $instance)
    {
        $title = apply_filters('widget_title', esc_html($instance['title']));
        $icon_size = $instance['icon_size'];
        $class_icon = 'text-center align-middle d-inline-block ' . ($instance['icon_type'] == 'square' ? '' : ($instance['icon_type'] == 'square with round border' ? 'rounded' : 'rounded-circle'));
        $style_icon = "height:{$icon_size}px;line-height:{$icon_size}px;width:{$icon_size}px;font-size:" . ($icon_size - 12) . "px" . ($instance['icon_background'] == 'original' ? '' : ';background-color:' . ($instance['icon_background'] == 'transparent' ? 'transparent' : $instance['icon_background_color'])) . ";";

        echo $args['before_widget'];

        //if title is present
        if (!empty($title))
            echo $args['before_title'] . $title . $args['after_title'];
        //output

        if (!empty($instance['link_facebook'])) :
?>
            <a href="<?= $instance['link_facebook']; ?>" class="fab fa-facebook-f <?= $class_icon; ?>" target="_blank" style="<?= $style_icon; ?>"><span class="sr-only">Facebook</span></a>
        <?php
        endif;
        if (!empty($instance['link_twitter'])) :
        ?>
            <a href="<?= $instance['link_twitter']; ?>" class="fab fa-twitter <?= $class_icon; ?>" target="_blank" style="<?= $style_icon; ?>"><span class="sr-only">Twitter</span></a>
        <?php
        endif;
        if (!empty($instance['link_instagram'])) :
        ?>
            <a href="<?= $instance['link_instagram']; ?>" class="fab fa-instagram <?= $class_icon; ?>" target="_blank" style="<?= $style_icon; ?>"><span class="sr-only">Instagram</span></a>
        <?php
        endif;
        if (!empty($instance['link_linkedin'])) :
        ?>
            <a href="<?= $instance['link_linkedin']; ?>" class="fab fa-linkedin-in <?= $class_icon; ?>" target="_blank" style="<?= $style_icon; ?>"><span class="sr-only">Linkedin</span></a>
        <?php
        endif;
        echo $args['after_widget'];
    }

    public function form($instance)
    {
        $title = '';
        if (isset($instance['title']))
            $title = $instance['title'];

        $icon_size = 32;
        if (isset($instance['icon_size']))
            $icon_size = $instance['icon_size'];

        $icon_type_options = array(
            'square',
            'square with round border',
            'round'
        );
        $icon_type = 'square';
        if (isset($instance['icon_type']))
            $icon_type = $instance['icon_type'];

        $icon_background_options = array(
            'original',
            'transparent',
            'custom'
        );
        $icon_background = 'original';
        if (isset($instance['icon_background']))
            $icon_background = $instance['icon_background'];

        $icon_background_color = '#000000';
        if (isset($instance['icon_background_color']))
            $icon_background_color = $instance['icon_background_color'];

        $link_facebook = '';
        if (isset($instance['link_facebook']))
            $link_facebook = $instance['link_facebook'];

        $link_twitter = '';
        if (isset($instance['link_twitter']))
            $link_twitter = $instance['link_twitter'];

        $link_instagram = '';
        if (isset($instance['link_instagram']))
            $link_instagram = $instance['link_instagram'];

        $link_linkedin = '';
        if (isset($instance['link_linkedin']))
            $link_linkedin = $instance['link_linkedin'];

        ?>
        <p>
            <label for="<?= $this->get_field_id('title'); ?>"><?= __('Title:', 'wp-bootstrap-starter'); ?></label>
            <input class="widefat" id="<?= $this->get_field_id('title'); ?>" name="<?= $this->get_field_name('title'); ?>" type="text" value="<?= esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?= $this->get_field_id('icon_size'); ?>"><?= __('Icon Size:', 'wp-bootstrap-starter'); ?></label>
            <input class="widefat" id="<?= $this->get_field_id('icon_size'); ?>" name="<?= $this->get_field_name('icon_size'); ?>" type="number" value="<?= intval($icon_size); ?>" />
        </p>
        <p>
            <label for="<?= $this->get_field_id('icon_type'); ?>"><?= __('Icon Type:', 'wp-bootstrap-starter'); ?></label>
            <select class="widefat" id="<?= $this->get_field_id('icon_type'); ?>" name="<?= $this->get_field_name('icon_type'); ?>">
                <?php foreach ($icon_type_options as $option) : ?>
                    <option value="<?= $option; ?>" <?= selected($icon_type, $option); ?>><?= __($option, 'wp-bootstrap-starter'); ?></option>
                <?php endforeach; ?>
            </select>
        </p>
        <p>
            <label for="<?= $this->get_field_id('icon_background'); ?>"><?= __('Icon Background:', 'wp-bootstrap-starter'); ?></label>
            <select class="widefat cmb-icon-background" id="<?= $this->get_field_id('icon_background'); ?>" name="<?= $this->get_field_name('icon_background'); ?>">
                <?php foreach ($icon_background_options as $option) : ?>
                    <option value="<?= $option; ?>" <?= selected($icon_background, $option); ?>><?= __($option, 'wp-bootstrap-starter'); ?></option>
                <?php endforeach; ?>
            </select>
        </p>
        <p  class="box-icon-background-custom <?= $icon_background != 'custom' ? 'hidden' : ''; ?>">
            <label for="<?= $this->get_field_id('icon_background_color'); ?>"><?= __('Icon Background Color:', 'wp-bootstrap-starter'); ?></label>
            <input class="widefat" style="width:50px;" id="<?= $this->get_field_id('icon_background_color'); ?>" name="<?= $this->get_field_name('icon_background_color'); ?>" type="color" value="<?= esc_attr($icon_background_color); ?>" />
        </p>
        <p>
            <label for="<?= $this->get_field_id('link_facebook'); ?>"><?= __('Link Facebook:', 'wp-bootstrap-starter'); ?></label>
            <input class="widefat" id="<?= $this->get_field_id('link_facebook'); ?>" name="<?= $this->get_field_name('link_facebook'); ?>" type="url" placeholder="https://www.facebook.com/ID" value="<?= esc_url($link_facebook); ?>" />
        </p>
        <p>
            <label for="<?= $this->get_field_id('link_twitter'); ?>"><?= __('Link Twitter:', 'wp-bootstrap-starter'); ?></label>
            <input class="widefat" id="<?= $this->get_field_id('link_twitter'); ?>" name="<?= $this->get_field_name('link_twitter'); ?>" type="url" placeholder="https://twitter.com/ID" value="<?= esc_url($link_twitter); ?>" />
        </p>
        <p>
            <label for="<?= $this->get_field_id('link_instagram'); ?>"><?= __('Link Instagram:', 'wp-bootstrap-starter'); ?></label>
            <input class="widefat" id="<?= $this->get_field_id('link_instagram'); ?>" name="<?= $this->get_field_name('link_instagram'); ?>" type="url" placeholder="https://www.instagram.com/ID" value="<?= esc_url($link_instagram); ?>" />
        </p>
        <p>
            <label for="<?= $this->get_field_id('link_linkedin'); ?>"><?= __('Link Linkedin:', 'wp-bootstrap-starter'); ?></label>
            <input class="widefat" id="<?= $this->get_field_id('link_linkedin'); ?>" name="<?= $this->get_field_name('link_linkedin'); ?>" type="url" placeholder="https://www.linkedin.com/in/ID" value="<?= esc_url($link_linkedin); ?>" />
        </p>
<?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = array();

        $instance['title'] = !empty($new_instance['title']) ? strip_tags($new_instance['title']) : '';
        $instance['icon_size'] = !empty($new_instance['icon_size']) ? intval($new_instance['icon_size']) : 32;
        $instance['icon_type'] = $new_instance['icon_type'];
        $instance['icon_background'] = $new_instance['icon_background'];
        $instance['icon_background_color'] = $new_instance['icon_background_color'];
        $instance['link_facebook'] = !empty($new_instance['link_facebook']) ? esc_url($new_instance['link_facebook']) : '';
        $instance['link_twitter'] = !empty($new_instance['link_twitter']) ? esc_url($new_instance['link_twitter']) : '';
        $instance['link_instagram'] = !empty($new_instance['link_instagram']) ? esc_url($new_instance['link_instagram']) : '';
        $instance['link_linkedin'] = !empty($new_instance['link_linkedin']) ? esc_url($new_instance['link_linkedin']) : '';

        return $instance;
    }

    public function register_plugin_assets()
    {
        wp_enqueue_style('style-social-media', plugins_url( 'css/main.css', __FILE__ ));
        wp_enqueue_style('style-font-awesome', plugins_url( 'css/all.min.css', __FILE__ ));
    }

    public function register_plugin_admin_assets()
    {
        wp_enqueue_script( 'admin-script', plugins_url('admin/main.js', __FILE__ ));
    }
}

function social_media_accessible_register_widget()
{
    register_widget('social_media_accessible');
}
add_action('widgets_init', 'social_media_accessible_register_widget');
