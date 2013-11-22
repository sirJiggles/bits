<?php

$month = date('n');
$year = date('Y');

$dates = array();

for ($i = 0; $i < 12; $i++) {
    // if ($year < 2013) continue;

    $dates[$year][] = $month;

    $month--;

    if ($month < 1) {
        $month = 13;
        $year--;
    }
}

?>

<ul>
    <li><a href="/blog-and-news/" class="<?php echo (!Uri::get_param('year')) ? 'active' : ''; ?>">All dates</a></li>
    <?php foreach ($dates as $year => $months) : ?>
        <li>
            <a href="<?php echo get_year_link($year); ?>" <?php if (Uri::get_param('year') == $year && !Uri::get_param('monthnum')) echo 'class="active"'; ?>>
                <?php echo $year; ?> (<?php echo count(get_posts(array(
                    'posts_per_page'    => -1,
                    'post_type'         => 'post',
                    'year'              => $year,
                ))); ?>)
            </a>
            <ul>
                <?php foreach ($months as $month) : ?>
                    <?php if($month > 12){  break; } ?>
                    <?php $full_date = "01-" . str_pad($month, 2, '0', STR_PAD_LEFT) . "-{$year}"; ?>
                    <?php $count = count(get_posts(array(
                                'posts_per_page'    => -1,
                                'post_type'         => 'post',
                                'year'              => $year,
                                'monthnum'          => $month,
                            )));
                        if($count <= 0){ break; }
                    ?>
                    <li>
                        <a href="<?php echo get_month_link($year, $month); ?>" <?php if (Uri::get_param('year') == $year && Uri::get_param('monthnum') == $month) echo 'class="active"'; ?>>
                            <?php echo date('M', strtotime($full_date)). '('.$count.')'; ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </li>
    <?php endforeach; ?>
</ul>