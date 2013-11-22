<?php

$paged = (get_query_var('paged') > 0) ? get_query_var('paged') : 1;
$perpage = 5;
$show_pages = 5;

$total_pages = $wp_query->max_num_pages;


if ($total_pages > $show_pages) {
	$start = $paged - (floor($show_pages / 2));
	$end = $paged + (floor($show_pages / 2));

	if ($start < 1) $start = 1;
	if ($end > $total_pages) $end = $total_pages;
} else {
	$start = 1;
	$end = $total_pages;
}

?>

<?php if ($total_pages > 1) : ?>
	<div class="pagination-first-last">
		<ul>
			<li><a href="<?php echo get_pagenum_link(1); ?>" title="First Page" class="first <?php if ($paged <= 1) echo 'inactive'; ?> icon-fast-backward arrow-right"></a></li>
			<li><a href="<?php echo get_pagenum_link($paged - 1); ?>" title="Previous Page" class="previous arrow-left icon-play <?php if ($paged <= 1) echo 'inactive'; ?>"></a></li>

			<?php if ($total_pages > 1) : ?>
				<?php for ($i = $start; $i <= $end; $i++) : ?>
					<li>
						<a href="<?php echo get_pagenum_link($i); ?>" class="<?php if ($paged == $i || (!$paged && $i == 1)) echo 'active'; ?>"><?php echo $i; ?></a>
					</li>
				<?php endfor; ?>
			<?php endif; ?>

			<li><a href="<?php echo get_pagenum_link(($paged) ? $paged + 1 : 2); ?>" title="Next Page"  class="next arrow-right icon-play <?php if ($total_pages <= $paged) echo 'inactive'; ?>"></a></li>
			<li><a href="<?php echo get_pagenum_link($total_pages); ?>" title="Last Page" class="last <?php if ($total_pages <= $paged) echo 'inactive'; ?> icon-fast-forward arrow-right"></a></li>
		</ul>
	</div>
<?php endif; ?>