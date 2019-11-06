<div class="sidebar" id="sidebar">
			<nav class="sidebar-nav" id="sidebar-nav-scroller">
				<ul class="nav">
					<li class="nav-item">
						<a class="nav-link" href="{{ route('admin-panel') }}">
							<i class="mdi mdi-gauge"></i> Dashboard
							<span class="badge badge-main badge-boxed badge-warning">New</span>
						</a>

					</li>
					<li class="nav-item">
						<a class="nav-link" href="{{ route('admin.users') }}">
							<i class="mdi mdi-account-multiple"></i> Users
						</a>
					</li>

					 

					<!-- <li class="nav-title">Blogs</li> -->

					
 					<!-- <li class="nav-item">
							<a class="nav-link " href="">
								<i class="mdi mdi-atom"></i> Genre old
							</a>
					</li> -->


					<li class="nav-item">
						<a class="nav-link " >
							<i class="mdi mdi-atom"></i> Genre  
						</a>
						<ul>
						<li>
						<a class="nav-link " href="{{ route('admin-parent-genre') }}">
							Parent Genre</a>
						
						</li>
						<li>
							<a class="nav-link " href="{{ route('admin-child-genre') }}">
							Child Genre</a></li>
						</ul>
					</li>


					<li class="nav-item">
							<a class="nav-link " href="{{ route('admin.blog') }}">
								<i class="mdi mdi-atom"></i> Blog  
							</a>
					</li>
					<li class="nav-item">
							<a class="nav-link " href="{{ route('admin.recommended-blog') }}">
								<i class="mdi mdi-atom"></i> Recommended Stories
							</a>
					</li>
						<li class="nav-item">
							<a class="nav-link " href="{{ route('coming_soon_feeds') }}">
								<i class="mdi mdi-atom"></i> Manage Feeds
							</a>
					</li>
					
					<li class="nav-title"> Leads </li>
				 <li class="nav-item">
							<a class="nav-link " href="{{ route('admin.contactus') }}">
								<i class="mdi mdi-atom"></i> Contact Us Lead
							</a>
					</li>
					<li class="nav-item">
							<a class="nav-link " href="{{ route('admin.newsletter') }}">
								<i class="mdi mdi-atom"></i> Newsletter Leads
							</a>
					</li>
					
					<li class="divider"></li>

					<li class="nav-title"> System </li>
					<li class="nav-item">
							<a class="nav-link " href="{{ route('coming_soon') }}">
								<i class="mdi mdi-atom"></i> Reported Authors
							</a>
					</li>
					<li class="nav-item">
							<a class="nav-link " href="{{ route('admin.settings') }}">
								<i class="mdi mdi-settings"></i> General Settings
							</a>
					</li>
					<li class="nav-item">
							<a class="nav-link " href="{{ route('admin.smtp') }}">
								<i class="mdi mdi-atom"></i> SMTP Configuration
							</a>
					</li>
					
					<li class="divider"></li>

				</ul>
			</nav>

		</div>
		<!-- end sidebar -->