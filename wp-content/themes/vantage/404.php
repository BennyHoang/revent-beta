<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package vantage
 * @since vantage 1.0
 * @license GPL 2.0
 */

get_header(); ?>


	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<style>


	.error-template {padding: 40px 15px;text-align: center;}
	.error-actions {margin-top:15px;margin-bottom:15px;}
	.error-actions .btn { margin-right:10px; }

</style>

<div id="primary" class="content-area">
	<div id="content" class="site-content" role="main">


				<div class="entry-content">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<div class="error-template">
									<h1>
										Oops!</h1>
									<h2>
										404 Not Found</h2>
									<div class="error-details">
										Siden du pr&oslash;ver &aring; n&aring; ble ikke funnet.
									</div>
									<div class="error-actions">
										<a href="http://www.revent.no" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-home"></span>
											Ta meg til forsiden </a><a href="mailto:kontakt@revent.no" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-envelope"></span> Send oss en mail </a>
									</div>
								</div>
							</div>
						</div>
					</div>




				<?php do_action('vantage_entry_main_bottom') ?>

			</div><!-- .entry-main -->

		</article><!-- #post-0 .post .error404 .not-found -->

	</div><!-- #content .site-content -->
</div><!-- #primary .content-area -->

<?php get_footer(); ?>