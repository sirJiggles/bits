<?php global $wpalchemy_media_access; ?>
<div class="my_meta_control">


	<?php $mb->the_field('url'); ?>
	<p>
		<label for="<?php $mb->the_name(); ?>">URl:</label>
		<input style="width:300px;" type="text" name="<?php $mb->the_name(); ?>" id="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" required="required" placeholder="/page-name or http://someurl.co.uk" />
	</p>


</div>