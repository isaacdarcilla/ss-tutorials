 <% include Banner %>

<!-- BEGIN CONTENT WRAPPER -->
<div class="content">
	<div class="container">
		<div class="row">

			<!-- BEGIN MAIN CONTENT -->
			<div class="main col-sm-8">
				<div id="blog-listing" class="list-style clearfix">
					<div class="row">
                        <% loop $Children %>
						<div class="item col-md-6">
							<div class="image">
								<a href="$Link">
									<span class="btn btn-default">Read More</span>
								</a>
								<img src="http://placehold.it/766x515" alt="" />
							</div>
							<div class="tag"><i class="fa fa-file-text"></i></div>
							<div class="info-blog">
								<ul class="top-info">
									<li><i class="fa fa-calendar"></i> $Date.Long</li>
									<li><i class="fa fa-comments-o"></i> 2</li>
									<li><i class="fa fa-tags"></i> Properties, Prices, best deals</li>
								</ul>
								<h3>
									<a href="$Link">$Title</a>
								</h3>
								<% if $Teaser %>
                                <p>$Teaser</p>
                                <% else %>
                                <p>$Content.FirstSentence</p>
                                <% end_if %>
							</div>
						</div>
                        <% end_loop %>
					</div>
				</div>
			</div>
			<!-- END MAIN CONTENT -->

		</div>
	</div>
</div>
