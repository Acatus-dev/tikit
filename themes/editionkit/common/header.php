<!DOCTYPE html>
<html lang="<?php echo get_html_lang(); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if ($description = option('description')): ?>
    <meta name="description" content="<?php echo $description; ?>">
    <?php endif; ?>

    <?php
    if (isset($title)) {
        $titleParts[] = strip_formatting($title);
    }
    $titleParts[] = option('site_title');
    ?>
    <title><?php echo implode(' &middot; ', $titleParts); ?></title>

    <?php echo auto_discovery_link_tags(); ?>

    <!-- Plugin Stuff -->
    <?php fire_plugin_hook('public_head', array('view'=>$this)); ?>

    <!-- Stylesheets -->
    <?php
//     queue_css_url('//fonts.googleapis.com/css?family=Ubuntu:300,400,500,700,300italic,400italic,500italic,700italic');
    queue_css_file(array('iconfonts', 'normalize', 'style', 'editionkit'), 'screen');
    queue_css_file('print', 'print');
    echo head_css();
    ?>

    <!-- JavaScripts -->
    <?php 
    queue_js_file(array(
        'vendor/selectivizr',
        'vendor/jquery-accessibleMegaMenu',
        'vendor/respond',
        'vendor/modernizr',
        'jquery-extra-selectors',
        'globals',
        'editionkit'
    )); 
    ?>

    <?php echo head_js(); ?>
</head>
<?php echo body_tag(array('id' => @$bodyid, 'class' => @$bodyclass)); ?>
    <a href="#content" id="skipnav"><?php echo __('Skip to main content'); ?></a>
    <?php fire_plugin_hook('public_body', array('view'=>$this)); ?>
    <div id="wrap">
        <header role="banner">
            <div class="top-header">
                <nav id="admin-nav">
                    <?php if($user = current_user()) {
                    
                        $links = array(
                            array(
                                'label' => __('Welcome, %s', $user->name),
                                'uri' => admin_url('/users/edit/'.$user->id)
                            ),
                            array(
                                'label' => __('Omeka Admin'),
                                'uri' => admin_url('/')
                            ),
                            array(
                                'label' => __('Log Out'),
                                'uri' => url('/users/logout')
                            )
                        );
                    
                    } else {
                        $links = array();
                    }
                    
                    echo nav($links, 'public_navigation_admin_bar');
                    ?>
                </nav>
            </div>
            <div class="bottom-header">
                <div id="site-title">
                    <?php echo link_to_home_page(theme_logo()); ?>
                </div>
                <div id="search-container" role="search">
                    <?php if (get_theme_option('use_advanced_search') === null || get_theme_option('use_advanced_search')): ?>
                    <?php echo search_form(array('show_advanced' => true)); ?>
                    <?php else: ?>
                    <?Php echo search_form(); ?>
                    <?php endif; ?>
                </div>
                <?php fire_plugin_hook('public_header', array('view'=>$this)); ?>
            </div>
        </header>

        <nav id="top-nav" class="top" role="navigation">
            <?php echo public_nav_main(); ?>
        </nav>

        <div id="content" role="main" tabindex="-1">
            <?php
                if(! is_current_url(WEB_ROOT)) {
                  fire_plugin_hook('public_content_top', array('view'=>$this));
                }
            ?>
