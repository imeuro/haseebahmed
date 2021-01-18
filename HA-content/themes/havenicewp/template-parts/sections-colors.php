<?php
$categories = get_categories(array(
    'taxonomy' => 'category',
    'hide_empty' => 0
  ));
// foreach($categories as $cat) {
//    echo 'ID: ' . $cat->term_id."\n";
//    echo 'NAME: '. $cat->name."\n";
//    echo 'SLUG: '. $cat->slug."\n";
//    echo 'COLOR: '. get_field('category_color','category_'.$cat->term_id)."\n";

//    echo '-------------------'."\n";
// }
?>
<style>
/* SECTIONS COLOR VARS */
:root {
	--black:            #000;
	--grey:             #999;
	--white:            #fff;
	<?php 
	foreach($categories as $cat) {
		echo "\n\t--".$cat->slug.":\t".get_field('category_color','category_'.$cat->term_id).';';
	}
	?>

}

<?php 
foreach($categories as $cat) {
	echo ".color-".$cat->term_id." { color: var(--".$cat->slug."); } ";
	echo "a.color-".$cat->term_id." { color: var(--".$cat->slug."); } ";
	echo ".border-color-".$cat->term_id." { border-color: var(--".$cat->slug."); } ";
	echo ".background-color-".$cat->term_id." { background-color: var(--".$cat->slug."); } ";
	echo ".main-navigation .color-".$cat->term_id.":checked + label { color: var(--white); background-color: var(--".$cat->slug."); }\n";
}
?>
.color-uncategorized { color: var(--grey) } a.color-uncategorized { color: var(--grey) } .border-color-uncategorized { border-color: var(--grey);} .background-color-uncategorized { background-color: var(--grey);}
</style>