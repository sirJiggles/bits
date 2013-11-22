<?php 
$parts = explode('/', $_SERVER['REQUEST_URI']); 

if( $parts[2] == '' || !isset($parts[2]) ){ 
    $class="active";
}else{
    $class="";
}

?>
<nav role="navigation" class="sub-nav">
    <h3><a class="sub-cat" href="#" title="Categories">Categories<span class="arrow-right icon-play"></span></a></h3>
    <ul>
        <li><a href="<?php echo site_url('/blog-and-news/'); ?>" class="<?php echo $class; ?>">All categories</a></li>
        <?php wp_list_categories(array(
            'title_li' => '',
            'exclude' => 1,
        )); ?>
    </ul>
</nav>

<nav role="navigation" class="sub-nav">
    <h3><a class="sub-cat" href="#" title="Archive">Archive<span class="arrow-right icon-play"></span></a></h3>
    <?php get_template_part('helper', 'archive'); ?>

</nav>