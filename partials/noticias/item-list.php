<h2 class="noticia__titulo"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
<?php
    $categories = get_the_category();
?>
<p class="noticia__meta">
<?php if (!is_category() && !empty($categories)) : ?>
    <span class="noticia__cartola">
        <a href="<?php echo get_category_link($categories[0]->term_id); ?>"><?php echo $categories[0]->cat_name; ?></a>
    </span>
    -
<?php endif; ?>
    <span class="noticia__data"><?php echo get_the_date(); ?></span>
</p>
<div class="noticia__resumo">
    <?php the_excerpt(); ?>
</div>
