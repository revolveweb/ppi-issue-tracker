<!--
		<div class="spacer"></div>
		<div class="wrap">
			<section id="status">
				<ul>
					<li id="version"><a href="#" class="ninja">
						<h5>Latest Version</h5>
						<span>v1.2.8 beta</span>
					</a></li>
					<li><a href="#" class="ninja">
						<h5>Bug Reports</h5>
						<span>37 open / 129 resolved</span>
					</a></li>
					<li><a href="#" class="ninja">
						<h5>Dive into Development</h5>
						<span>PPI is open source, help us make it better!</span>
					</a></li>
					<li><a href="#" class="ninja">
						<h5>Getting started</h5>
						<span>New to PPI? Get started here!</span>
					</a></li>
				</ul>
			</section>
		</div>-->

		<div class="wrap">
			<section id="newsletter">
				<h5>Search Issue Tracker</h5>
				<form action="" method="post" id="ticket_search">
					<input style="width: 200px;" type="email" name="email" placeholder="Your search term.." required="required" id="ticket_keyword" />
					<button type="submit"><span class="button green">Search</span></button>
				</form>
			</section>
		</div>
		<?php if(isset($keyword) && $keyword != ''): ?>
		<div class="wrap">
			<p style="font-size: 14px; margin-bottom: 20px;">Searching for <strong><?php echo $keyword; ?></strong> - <a style="text-decoration: none;" href="<?php echo $baseUrl; ?>" title="Clear Search">Clear</a></p>
		</div>
		<?php endif; ?>

		<div class="wrap">
			<article class="content box_1" style="padding: 25px; width: 915px; text-align: left; position: relative;">
			<?php if($isLoggedIn): ?>
			<div class="" style="position: absolute; top: 12px; right: 20px;">
			<button type="submit"><span class="button green" id="create-ticket-button">Create ticket</span></button>
			</div>
			<?php endif; ?>

				<table cellpadding="0" cellpadding="0" class="data" id="ticket_list_table" style="margin-top: 30px;">
					<thead>
						<tr>
<!--   						<th style="text-align: center; width: 25px;">#</th><th>State</th><th>Type</th><th>Severity</th><th>Title</th><th>Assigned to</th> -->
						<th style="text-align: left;">Select a category</th>
						</tr>
					</thead>
					<tbody>
					<?php if(count($cats) > 0): ?>
				 		<?php foreach($cats as $cat):?>
							<tr>
								<td><a href="<?php echo $baseUrl; ?>ticket/index/filter/cat/<?php echo str_replace(' ', '-', $cat['title']); ?>"><?php echo $cat['title']; ?></a></td>
							</tr>
						<?php endforeach;?>
					<?php else:?>
						<tr><td colspan="8" id="no_tickets">No categories present</td></tr>
					<?php endif;?>
					</tbody>
				</table>
			</article>
		</div>
		<div class="spacer_large"></div>

<script language="javascript">
jQuery(document).ready(function($) {
	$('#ticket_search').submit(function() {
		if(jQuery.trim($('#ticket_keyword').val()) != "") {
			window.location.href = baseUrl + "home/search/keyword/" + $('#ticket_keyword').val();
		}
		return false;
	});

	$('#create-ticket-button').click(function() {
		window.location.href = baseUrl + 'ticket/create';
	});
});
</script>
