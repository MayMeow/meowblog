<div class="article">
<!-- !!TODO Rename this documment and controller's function -->
<h1>Graph</h1>

<div class="epg" style=" margin: 20px 0;">
<div class="epg__year">2023</div>
                <div class="epg__months">
                    <div>Jan</div>
                    <div>Feb</div>
                    <div>Mar</div>
                    <div>Apr</div>
                    <div>May</div>
                    <div>Jun</div>
                    <div>Jul</div>
                    <div>Aug</div>
                    <div>Sep</div>
                    <div>Oct</div>
                    <div>Nov</div>
                    <div>Dec</div>
                </div>
    <div class="epg__squares">
<?php
if ($offset) {
    foreach (range(1, $offset) as $_) {
        echo '<div class="epg__box epg__box--empty"></div>';
    }
}

foreach(range(0, $daysCount -1) as $i) {
    if (array_search($i, $daysWithArticle) !== false) {
        echo '<div class="epg__box epg__hasPost"></div>';
    } else {
        echo '<div class="epg__box"></div>';
    }
}
?>
</div></div>

Based on https://postgraph.rknight.me/

</div>