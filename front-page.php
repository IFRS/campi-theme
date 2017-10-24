<?php get_header(); ?>

<?php
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 3
    );

    $query = new WP_Query($args);
?>

<div class="row">
    <div class="col-xs-12">
    <?php while ($query->have_posts() && $query->current_post < 2) : $query->the_post(); ?>
        <?php if ($query->current_post == 0) : ?>
            <div class="row">
                <!-- Notícia Destaque -->
                <div class="col-xs-12 col-md-9">
                    <article class="noticia noticia-destaque">
                          <?php get_template_part('partials/noticias/item-front-page'); ?>
                    </article>
                </div>
        <?php endif; ?>
        <?php if ($query->current_post == 1) : ?>
                <!-- Notícia Normal -->
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <article class="noticia">
                        <?php get_template_part('partials/noticias/item-front-page'); ?>
                    </article>
                </div>
            </div> <!-- /.row -->
        <?php endif; ?>
        <?php if ($query->current_post == 2) : ?>
            <div class="row">
                <!-- Notícia Normal -->
                <div class="col-xs-12 col-sm-6 col-md-3 col-md-push-9">
                    <article class="noticia">
                        <?php get_template_part('partials/noticias/item-front-page'); ?>
                    </article>
                </div>
                <!-- Banners -->
                <div class="col-xs-12 col-md-9 col-md-pull-3">
                    <?php if (!dynamic_sidebar('widget-home')) : endif; ?>
                </div>
            </div>
        <?php endif; ?>
    <?php endwhile; ?>
    </div>
</div>

<hr class="separador-noticia"/>

<div class="row">
    <div class="col-xs-12">
        <?php wp_reset_query(); ?>
        <a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>" class="pull-right link-todas-noticias"><?php _e('Acesse mais notícias'); ?></a>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-md-6">
        <?php get_template_part('partials/editais/latest'); ?>
        <?php get_template_part('partials/documentos/latest'); ?>
    </div>
    <div class="col-xs-12 col-md-6">
        <?php if (!dynamic_sidebar('widget-home-side')) : endif; ?>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <h2><img class="img-responsive center-block" src="<?php echo get_template_directory_uri(); ?>/img/menu-campi-title.png" alt="Campi do IFRS"></h2>
        <?php
            if (is_front_page()) {
                get_template_part('partials/menus/campi');
            }
        ?>
    </div>
</div>

<?php if (is_active_sidebar('widget-gallery')) : ?>
<div class="row">
    <div class="col-xs-12">
        <?php if (!dynamic_sidebar('widget-gallery')) : endif; ?>
    </div>
</div>
<?php endif; ?>

<?php if (is_active_sidebar('widget-atalhos')) : ?>
<div class="row">
    <div class="col-xs-12">
        <h2 class="title-box"><?php _e('Acesso R&aacute;pido'); ?></h2>
        <nav>
            <ul class="area-atalhos">
                <?php if (!dynamic_sidebar('widget-atalhos')) : endif; ?>
            </ul>
        </nav>
    </div>
</div>
<?php endif; ?>

<hr class="banner-separator">

<div class="row">
    <div class="col-xs-12">
        <?php if (!dynamic_sidebar('widget-banners')) : endif; ?>
    </div>
</div>

<?php get_footer(); ?>
