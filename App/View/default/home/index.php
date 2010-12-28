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
							<th style="text-align: center; width: 25px;">#</th><th>State</th><th>Type</th><th>Severity</th><th>Title</th><th>Assigned to</th>
						</tr>
					</thead>
					<tbody>
					<?php if(count($tickets) > 0): ?>
				 		<?php foreach($tickets as $ticket):?>
							<tr>
								<td class="num"><a href="<?php echo $baseUrl . 'ticket/view/' . $ticket['id'] . '/' . str_replace(' ', '-', $ticket['title']); ?>" title=""><?php echo $ticket['id']; ?></a></td>
								<td class="ttstate"><a href="<?php echo $baseUrl . 'ticket/view/' . $ticket['id'] . '/' . str_replace(' ', '-', $ticket['title']); ?>" title=""><?php echo ucfirst($ticket['status']); ?></a></td>
								<td><a href="<?php echo $baseUrl . 'ticket/view/' . $ticket['id'] . '/' . str_replace(' ', '-', $ticket['title']); ?>" title=""><?php echo ucwords(str_replace('_', ' ', $ticket['ticket_type']));?></a></td>
								<td><a href="<?php echo $baseUrl . 'ticket/view/' . $ticket['id'] . '/' . str_replace(' ', '-', $ticket['title']); ?>" title=""><?php echo ucfirst($ticket['severity']);?></a></td>
								<td class="issue st-new"><a href="<?php echo $baseUrl . 'ticket/view/' . $ticket['id'] . '/' . str_replace(' ', '-', $ticket['title']); ?>" title=""><?php echo ucfirst($ticket['title']);?></a></td>
								<td><a href="<?php echo $baseUrl . 'ticket/view/' . $ticket['id'] . '/' . str_replace(' ', '-', $ticket['title']); ?>" title=""><?php echo ucwords($ticket['user_assigned_fn'] . ' ' . $ticket['user_assigned_ln']);?></a></td>
							</tr>
						<?php endforeach;?>
					<?php else:?>
						<tr><td colspan="8" id="no_tickets">No tickets present</td></tr>
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
		
<style type="text/css">
		
.num {
text-align: center;
}

table {
	width: 916px; 
	border-spacing: 0;
	border-collapse: separate;
}

table a { text-decoration: none; }
table a:hover { text-decoration: underline; }

tr {
border-color: inherit;
display: table-row;
vertical-align: inherit;
}

tr:hover td {
	background-color: #43474C;
}

table[cellspacing=0] {
border-spacing: 0px 0px;
}

thead {
border-color: inherit;
display: table-header-group;
vertical-align: middle;
}

table.data th {
padding: 9px;
text-align: left;
}

th {
font-weight: bold;
}

td, th {
display: table-cell;
vertical-align: inherit;
}


table.data td {
border-bottom: 1px solid #E0E0E0;
padding: 9px;
}

.data .ttstate {
white-space: nowrap;
}

td.issue {
width: 40%;
}
		</style>