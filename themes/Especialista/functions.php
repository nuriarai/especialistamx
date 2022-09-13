<?php
// Enqueue extra scripts
function add_theme_scripts()
{
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js', array('jquery'), true);

    wp_enqueue_script(
        'support-cat',
        get_template_directory_uri() . '/assets/js/categories-extra.js',
        array('jquery'),
        1.1,
        true
    );
    wp_enqueue_script(
        'search-engine',
        get_template_directory_uri() . '/assets/js/search-engine.js',
        array('jquery')
    );

    //   wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css');
    wp_enqueue_style('default', get_stylesheet_uri());
    wp_enqueue_style('main', get_template_directory_uri() . '/assets/css/main.css', null, null, 'screen');
}
add_action('wp_enqueue_scripts', 'add_theme_scripts');



// Category Pills
if (function_exists('register_nav_menus')) {
    register_nav_menus(array('cat-pills' => 'Category Pills'));
}

// nav items pills
add_filter('nav_menu_link_attributes', 'category_pills', 10, 3);

function category_pills($atts, $item, $args)
{
    $class = 'nav-link font-12 bolder';
    $atts['class'] = $class;
    return $atts;
}

function the_title_limit($length, $replacer = '...')
{
    $string = get_the_title('', '', FALSE);
    if (strlen($string) > $length)
        $string = (preg_match('/^(.*)\W.*$/', substr($string, 0, $length + 1), $matches) ? $matches[1] : substr($string, 0, $length)) . $replacer;
    return $string;
}

if (function_exists('add_theme_support')) {
    add_theme_support('post-thumbnails');
    add_theme_support('align-wide');
    /*    add_theme_support('disable-custom-colors');
    add_theme_support('editor-color-palette', array(
        array(
            'name'  => __('Color Marca', 'ea_genesis_child'),
            'slug'  => 'brand',
            'color'    => '#FC2561',
        ),
        array(
            'name'  => __('Texto principal', 'ea_genesis_child'),
            'slug'  => 'primary-text',
            'color' => '#20313A',
        ),
        array(
            'name'  => __('Texto secundario', 'ea_genesis_child'),
            'slug'  => 'secondary-text',
            'color' => '#747A7B',
        ),
        array(
            'name'    => __('Destacado secundario', 'ea_genesis_child'),
            'slug'    => 'secondary-default',
            'color'    => '#319CE7',
        ),
    )); */
}

//wp_enqueue_script('support', bloginfo('template_url') . "/js/categories-extra.js");

// Resizing of post featured image
$width = 150;
$height = 150;
$crop = true;
set_post_thumbnail_size($width, $height, $crop);


// TODO: delete after changes NRA
/* Disable WordPress Admin Bar for all users */
add_filter('show_admin_bar', '__return_false');


add_action('acf/init', 'register_blocks');
function register_blocks()
{

    // Check function exists.
    if (function_exists('acf_register_block_type')) {

        // register a testimonial block.
        acf_register_block_type(array(
            'name'              => 'button-primary-filled',
            'title'             => __('Botón principal relleno'),
            'description'       => __('Botón con color de fondo.'),
            'render_template'   => 'template-parts/blocks/buttons/button-filled.php',
            'enqueue_style'     => get_template_directory_uri() . '/assets/css/blocks.css',
            'category'          => 'formatting',
            'icon'              => 'button',
            'mode'              => 'auto',
            'keywords'          => array('buttons', 'filled'),
            'supports'          => array(
                'align'         => false,
            ),
            'example'           => array(
                'attributes'    => array(
                    'mode'      => 'preview',
                    'data'      => array(
                        'button-primary-filled' => "APUNTARME A LA MASTERCLASS",
                        'is_preview'      => true
                    )
                )
            )
        ));

        acf_register_block_type(array(
            'name'              => 'button-primary-stroked',
            'title'             => __('Botón principal transparente'),
            'description'       => __('Botón transparente.'),
            'render_template'   => 'template-parts/blocks/buttons/button-stroked.php',
            'enqueue_style'     => get_template_directory_uri() . '/assets/css/blocks.css',
            'category'          => 'formatting',
            'icon'              => 'button',
            'keywords'          => array('buttons', 'stroked'),
            'mode'              => 'preview',
            'supports'          => array(
                'align'         => false
            ),

        ));

        acf_register_block_type(array(
            'name'              => 'products-list',
            'title'             => __('Productos'),
            'description'       => __('Lista de productos.'),
            'render_template'   => 'template-parts/blocks/products/products-list.php',
            'enqueue_style'     => get_template_directory_uri() . '/assets/css/blocks.css',
            'category'          => 'formatting',
            'icon'              => 'feedback',
            'keywords'          => array('product'),
            'mode'              => 'auto',
            'supports'          => array(
                'align'         => false,
            ),
        ));
    }
}
