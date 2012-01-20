<% control ArchivePosts %>
	<% if First %>
		<ul class="year-container">
			<li class="year">
				<a class="toggle-open" href="#"><span>▼ </span></a>
				<a href="{$Parent.Link}date/{$Year}">$Year</a>
				<ul class="month-container">
					<li class="month">
						<a class="toggle-open" href="#"><span>▼ </span></a>
						<a href="{$Parent.Link}date/$Date.Format(Y/m)">$Month</a>
						<ul class="post-container">
	<% else %>
		<% if NewYear %>
						</ul>
					</li>
				</ul>
			</li>
			<li class="year">
				<a class="toggle-open" href="#"><span>▼ </span></a>
				<a href="{$Parent.Link}{$Year}">$Year</a>
				<ul class="month-container">
					<li class="month">
						<a class="toggle-open"><span>▼ </span></a>
						<a href="{$Parent.Link}date/$Date.Format(Y/m)">$Month</a>
						<ul class="post-container">
		<% else_if NewMonth %>
						</ul>
					</li>
					<li class="month">
						<a class="toggle-open" href="#"><span>▼ </span></a>
						<a href="{$Parent.Link}date/$Date.Format(Y/m)">$Month</a>
						<ul class="post-container">
		<% end_if %>
	<% end_if %>
	<li>
		<a href="$Link">$Title</a>
	</li>
	<% if Last %>
						</ul>
					</li>
				</ul>
			</li>
		</ul>
	<% end_if %>
<% end_control %>