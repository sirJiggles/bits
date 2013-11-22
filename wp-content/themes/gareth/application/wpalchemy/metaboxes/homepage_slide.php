<div class="my_meta_control">
	<?php $mb->the_field('cite'); ?>
	<p>
		<label for="<?php $mb->the_name(); ?>">Citation:</label>
		<input type="text" name="<?php $mb->the_name(); ?>" id="<?php $mb->the_name(); ?>" placeholder="Craig Tyrrell" value="<?php $mb->the_value(); ?>" />
	</p>
	<?php $mb->the_field('link_text'); ?>
	<p>
		<label for="<?php $mb->the_name(); ?>">Link text:</label>
		<input type="text" name="<?php $mb->the_name(); ?>" id="<?php $mb->the_name(); ?>" placeholder="Mett our team" value="<?php $mb->the_value(); ?>" />
	</p>

	<?php $mb->the_field('link_location'); ?>
	<p>
		<label for="<?php $mb->the_name(); ?>">Link location:</label>
		<input type="text" name="<?php $mb->the_name(); ?>" id="<?php $mb->the_name(); ?>" placeholder="/team" value="<?php $mb->the_value(); ?>" />
	</p>
</div>