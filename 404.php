<?php get_header(); ?>
<div class="govuk-width-container">
	<?php if(!is_front_page()): ?>
	<a href="/" class="govuk-back-link">Back</a>
	<?php endif; ?>
	<main class="govuk-main-wrapper ">
		<div class="govuk-grid-row">
			<div class="govuk-grid-column-full-width">
			<h1><?php _e( 'Sorry 404 - Article Not Found', 'gdstheme' ); ?></h1>
			<p><?php _e( 'The article you were looking for was not found, but maybe try looking again!', 'gdstheme' ); ?></p>
			<?php get_search_form(); ?>
		</div>
	</main>
</div>

<?php get_footer(); ?>
