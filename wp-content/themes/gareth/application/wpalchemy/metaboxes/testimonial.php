<?php global $wpalchemy_media_access; ?>
<div class="my_meta_control">

	<?php $mb->the_field('title'); ?>
	<p>
		<label for="<?php $mb->the_name(); ?>">Title:</label>
		<input type="text" name="<?php $mb->the_name(); ?>" id="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" />
	</p>


	<?php $mb->the_field('name'); ?>
	<p>
		<label for="<?php $mb->the_name(); ?>">Name:</label>
		<input type="text" name="<?php $mb->the_name(); ?>" id="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" />
	</p>

	<?php $mb->the_field('position'); ?>
	<p>
		<label for="<?php $mb->the_name(); ?>">Position:</label>
		<input type="text" name="<?php $mb->the_name(); ?>" id="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" />
	</p>

</div>