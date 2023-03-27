<?php
/* 
 Template Name:  page
 */
 /* Initialize menu walker class the adds description to the collection menu */
function parent_theme_setup() {
    require_once __DIR__ . '/MainMenuWalker.php';
    require_once __DIR__ . '/itechMenuWalker.php';
    require_once __DIR__ . '/SitemapMenuWalker.php';
}

add_action( 'after_setup_theme', 'parent_theme_setup' );



add_action( 'widgets_init', function(){
         register_widget( 'lectiooxWidget' );
         register_widget( 'NewnoxWidget' );
         register_widget( 'TemplateWidget' );
         register_widget( 'FilteryoxWidget' );
         register_widget( 'meriesBoxWidget' );
});

?>
<?php get_header(); ?>

<?php get_template_part('template-part', 'head'); ?>

<?php get_template_part('template-part', 'topnav'); ?>

<?php
$looo = new WP_Query(array(
    'post_type' => '-post',
    'status' => 'publish',
    'visibility' => 'public',
    'posts_per_page' => 8,
    'orderby' => 'menu_order',
    'order'   => 'DESC',
));
if ($homePostLoop->have_posts()) :
    $itemCount = $homePostLoop->post_count;
?>
<section class="block">
    <div id="main-carousel" class="carousel slide" >

        <?php if ($itemCount > 1): ?>
        <ol class="carousel-indicators">
            <?php 
                for($i = 0; $i < $itemCount; $i++) { 
                    $class = ($i === 0 ? "active" : "");
                    echo "<li data-target=\"#main-carousel\" data-slide-to=\"{$i}\" class=\"{$class}\"></li>\n";
                }
            ?>
        </ol>
        <?php endif; ?>
        <div class="carousel-inner">
            
            <?php
                $count = 0;
                while ( $homePostLoop->have_posts() ) : $homePostLoop->the_post(); 
                    $extraClass = ($count === 0 ? " active" : "");
                    $pod = pods( 'home-post', get_the_ID() );
            ?>
                <div class="item<?php echo $extraClass; ?>">
                    <?php
                        $bgImage = $pod->field('background_image_'.get_lang());
                        echo wp_get_attachment_image( $bgImage['ID'], 'full', false, array('class' => 'img-responsive'));
                    ?>
                    <div class="carousel-caption">
                        <div class="caption">
                            <?php the_content(); ?>
                            <?php if($pod->field('button_text_'. get_lang())): ?>
                              <div class="buttons text-center">
                                    <a href="<?php echo $pod->field('destination_url_'. get_lang()); ?>" class="btn btn-sm btn-primary"><?php echo $pod->field('button_text_'. get_lang()); ?><span class="rarrow"></span></a>
                              </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php
                    $looo = new WP_Query(array(
    'post_type' => '-post',
    'status' => 'publish',
    'visibility' => 'public',
    'posts_per_page' => 8,
    'orderby' => 'menu_order',
    'order'   => 'DESC',
));
                endwhile; 
                wp_reset_postdata();
            ?>
        
</section>       
<?php endif; ?>
<?php get_template_part('template-part', 'container-top'); ?>

<!-- start content container -->
<div class="dmbs-content">
     <!-- ajout de Style : pour forcer flexbox sur bootstrap 3 qui ne le supporte pas -->
    <div class="row" style="display:flex; flex-wrap:wrap; justify-content:center;">
        
         <?php dynamic_sidebar( 'home_boxes' ); ?> 
        
        <?php //dynamic_sidebar( 'home_top' ); ?>
       
    </div>
  
    <div class="row">
        <div class="col-md-8 nopadding-left">
            <?php dynamic_sidebar( 'home_content' ); ?>
        </div>
        <div class="col-md-4">
            <?php dynamic_sidebar( 'home_right' ); ?>
        </div>
        
    </div>
</div>
<!-- end content container -->

<?php get_template_part('template-part', 'container-bottom'); ?>
</div>
        <?php if ($itemCount > 1): ?>
        <a class="carousel-control left" href="#main-carousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
        <a class="carousel-control right" href="#main-carousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
        <?php endif; ?>
    </div>
<?php

add_action( 'widgets_init', function(){
         register_widget( 'lectiooxWidget' );
         register_widget( 'NewnoxWidget' );
         register_widget( 'TemplateWidget' );
         register_widget( 'FilteryoxWidget' );
         register_widget( 'meriesBoxWidget' );
}); get_footer(); ?>
