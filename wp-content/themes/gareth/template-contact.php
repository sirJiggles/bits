<?php /* Template Name: Contact */ ?>
<?php get_header(); ?>

<div class="contact">

	<?php while (have_posts()) : the_post(); ?>

		<div class="row">
		    <div class="title-row">
		        <h2>Get in touch with us</h2>
		    </div>
		</div>

		<div class="row">
			<div class="grid-7 contact-grid">
				<div class="map-wrapper">
					<h3>How to find us</h3>
					<div id="map-container"></div>
				</div>
			</div>

			<div class="grid-5 end contact-grid">

				<div class="contact-details">
					<h3>Tyrrell &amp; Company</h3>

					<ul>
						<li>Suite D,</li>
						<li>South Cambridge Business Park,</li>
						<li>Babraham Road,</li>
						<li>Sawston,</li>
						<li>Cambridge,</li>
						<li>Cambridgeshire</li>
						<li>CB22 3JH</li>
					</ul>

					<ul>
						<li><strong>Telephone:</strong>01223 832477</li>
						<li><strong>Fax:</strong>01223 832488</li>
						<li><strong>Email:</strong><a href="mailto:info@tyrrellandcompany.co.uk" title="Click here to email us">info@tyrrellandcompany.co.uk</a></li>
					</ul>

					<ul>
						<li><strong>Opening Times:</strong></li>
						<li>Monday to Friday 9am to 5pm</li>
					</ul>
				</div>

				<div class="contact-wrapper">
					<?php $form = Form_Handler::get_instance()->get_form_class('contact'); ?>

					<?php if (!$form->submitted()) : ?>

						<?php echo $form->errors(); ?>

						<h3>Make an enquiry</h3>

						<?php the_content(); ?>

						<form id="contact" action="/contact" method="post" class="contact-form">
							<fieldset>

								<label for="name">Name <span>*</span></label>
					            <input type="text" id="fname" name="fname" placeholder="Your name" value="<?php echo Uri::get_param('fname'); ?>"/>

					            <label for="email">Email address <span>*</span></label>
					            <input type="email" name="email" id="email" value="<?php echo Uri::get_param('email'); ?>" placeholder="sample@emailprovider.com" required="required"/>

					            <label for="telephone">Telephone number</label>
					            <input type="tel" name="telephone" id="telephone" value="<?php echo Uri::get_param('telephone'); ?>" placeholder="01263 111 111" />
				            	

					            <label for="message">Message <span>*</span></label>
					            <textarea name="message" id="message" placeholder="Enter your message here" required="required"><?php echo Uri::get_param('message'); ?></textarea>

					            <input type="submit" name="submit-contact" value="Send your message" class="btn" />
					            <a href="#" class="js-submit btn">Send your message</a>

			                	<input type="hidden" name="form" value="contact" />
		                	</fieldset>
						</form>

					<?php else: ?>
						<div class="contact-thanks">
							<h3>Email sent</h3>
							<p>Thank you for contacting us, someone will be in touch with you as soon as possible.</p>
						</div>
					<?php endif; ?>
				</div>

			</div>

		</div>

	<?php endwhile; ?>

</div>

<?php get_footer(); ?>