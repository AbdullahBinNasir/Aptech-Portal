<!-- <div class="left-side-bar"> -->
<div class="left-side-bar side " style="background-color: #211f20;">
<!-- <div class="left-side-bar side " style="background-color: #ae1f24;"> -->
	<div class="brand-logo m-3">
		<a href="adminDashboard.php">
			<img src="vendors/images/apt_logo.png" alt="" class="dark-logo">
			<img src="vendors/images/apt_logo.png" alt="" class="light-logo">
		</a>
		<div class="close-sidebar" data-toggle="left-sidebar-close">
			<i class="ion-close-round"></i>
		</div>
	</div>
	<div class="menu-block customscroll">
		<div class="sidebar-menu">
			<ul id="accordion-menu">
				<li class="dropdown">
					<a href="javascript:;" class="dropdown-toggle">
						<span class="micon dw dw-house-1"></span><span class="mtext">Home</span>
					</a>
					<ul class="submenu">
						<li><a href="adminDashboard.php">Dashboard</a></li>
						<!-- <li><a href="index2.html">Dashboard style 2</a></li> -->
					</ul>
				</li>
				<li class="dropdown">
					<a href="javascript:;" class="dropdown-toggle">
						<span class="micon dw dw-edit2"></span><span class="mtext">Student Approval</span>
					</a>
					<ul class="submenu">
						<li><a href="students.php">All Student</a></li>
						<li><a href="PendingApprovalstd.php">Pending Student Approval</a></li>
						<li><a href="Approvedstudents.php">Approved Students</a></li>
						<li><a href="Declinedstudents.php">Declined Students</a></li>

					</ul>
				</li>
				<li class="dropdown">
					<a href="javascript:;" class="dropdown-toggle">
						<span class="micon dw dw-edit2"></span><span class="mtext">Faculty Approval</span>
					</a>
					<ul class="submenu">
						<li><a href="faculty.php">All Faculties</a></li>
						<li><a href="PendingApprovalfaculty.php">Pending Faculty Approval</a></li>
						<li><a href="Approvedfaculty.php">Approved Faculties</a></li>
						<li><a href="Declinedfaculty.php">Declined Faculties</a></li>

					</ul>
				</li>
				<li class="dropdown">
					<a href="javascript:;" class="dropdown-toggle">
						<span class="micon dw dw-edit2"></span><span class="mtext">Add New HR</span>
					</a>
					<ul class="submenu">
						<li><a href="ViewHr.php">View/Remove HR</a></li>
						<li><a href="AddHr.php">Add HR</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="javascript:;" class="dropdown-toggle">
						<span class="micon dw dw-edit2"></span><span class="mtext">Department</span>
					</a>
					<ul class="submenu">
						<li><a href="department_display.php">View/Remove Department</a></li>
						<li><a href="department_insert.php">Add Department</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="javascript:;" class="dropdown-toggle">
						<span class="micon dw dw-edit2"></span><span class="mtext">Attendance</span>
					</a>
					<ul class="submenu">
						<li><a href="Attandance_std.php">View Students Attendance</a></li>
						<li><a href="Attandance_emp.php">View Employees Attedance</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="javascript:;" class="dropdown-toggle">
						<span class="micon dw dw-apartment"></span><span class="mtext"> Batches </span>
					</a>
					<ul class="submenu">
						<li><a href="ViewBatch.php">View/Edit Batch</a></li>
						<li><a href="AddBatch.php">Add Batch</a></li>
						<!-- <li><a href="UpdateBatch.php">Edit Batch</a></li> -->
					</ul>
				</li>
				<li class="dropdown">
					<a href="javascript:;" class="dropdown-toggle">
						<span class="micon dw dw-apartment"></span><span class="mtext"> Courses </span>
					</a>
					<ul class="submenu">
						<li><a href="Courses.php">View Course</a></li>
						<li><a href="add_Courses.php">Add Course</a></li>
						<!-- <li><a href="ui-cards-hover.html">Edit Course</a></li> -->
					</ul>
				</li>
				<li class="dropdown">
					<a href="javascript:;" class="dropdown-toggle">
						<span class="micon dw dw-apartment"></span><span class="mtext"> Events </span>
					</a>
					<ul class="submenu">
						<li><a href="abc_display.php">View Events</a></li>
						<li><a href="abc.php">Add Event</a></li>
						<!-- <li><a href="">Delete Event</a></li> -->
					</ul>
				</li>
				<li class="dropdown">
					<a href="javascript:;" class="dropdown-toggle">
						<span class="micon dw dw-apartment"></span><span class="mtext"> Faculty GPA </span>
					</a>
					<ul class="submenu">
						<li><a href="facul_gp_ajax.php">View Faculty GPA</a></li>
		
						<!-- <li><a href="">Delete Event</a></li> -->
					</ul>
				</li>
				<li class="dropdown">
					<a href="javascript:;" class="dropdown-toggle">
						<span class="micon dw dw-apartment"></span><span class="mtext"> Assign E-Project </span>
					</a>
					<ul class="submenu">
						<li><a href="E_projectAppr.php">Assign E-Project</a></li>
						<li><a href="admin_grade_submission.php">Assign E-Project Grades</a></li>
		
						<!-- <li><a href="">Delete Event</a></li> -->
					</ul>
				</li>
				<li class="dropdown">
					<a href="javascript:;" class="dropdown-toggle">
						<span class="micon dw dw-apartment"></span><span class="mtext">Books</span>
					</a>
					<ul class="submenu">
						<li><a href="book_create.php">Add Book</a></li>
						<li><a href="book_read.php">View Book</a></li>
		
						<!-- <li><a href="">Delete Event</a></li> -->
					</ul>
				</li>
				<!-- <li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-analytics-21"></span><span class="mtext">Charts</span>
						</a>
						<ul class="submenu">
							<li><a href="highchart.html">Highchart</a></li>
							<li><a href="knob-chart.html">jQuery Knob</a></li>
							<li><a href="jvectormap.html">jvectormap</a></li>
							<li><a href="apexcharts.html">Apexcharts</a></li>
						</ul>
					</li> -->
				<!-- <li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-right-arrow1"></span><span class="mtext">Additional Pages</span>
						</a>
						<ul class="submenu">
							<li><a href="video-player.html">Video Player</a></li>
							<li><a href="login.html">Login</a></li>
							<li><a href="forgot-password.html">Forgot Password</a></li>
							<li><a href="reset-password.html">Reset Password</a></li>
						</ul>
					</li> -->
				<!-- <li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-browser2"></span><span class="mtext">Error Pages</span>
						</a>
						<ul class="submenu">
							<li><a href="400.html">400</a></li>
							<li><a href="403.html">403</a></li>
							<li><a href="404.html">404</a></li>
							<li><a href="500.html">500</a></li>
							<li><a href="503.html">503</a></li>
						</ul>
					</li> -->

				<!-- <li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-copy"></span><span class="mtext">Extra Pages</span>
						</a>
						<ul class="submenu">
							<li><a href="blank.html">Blank</a></li>
							<li><a href="contact-directory.html">Contact Directory</a></li>
							<li><a href="blog.html">Blog</a></li>
							<li><a href="blog-detail.html">Blog Detail</a></li>
							<li><a href="product.html">Product</a></li>
							<li><a href="product-detail.html">Product Detail</a></li>
							<li><a href="faq.html">FAQ</a></li>
							<li><a href="profile.html">Profile</a></li>
							<li><a href="gallery.html">Gallery</a></li>
							<li><a href="pricing-table.html">Pricing Tables</a></li>
						</ul>
					</li> -->
				<!-- <li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-list3"></span><span class="mtext">Multi Level Menu</span>
						</a>
						<ul class="submenu">
							<li><a href="javascript:;">Level 1</a></li>
							<li><a href="javascript:;">Level 1</a></li>
							<li><a href="javascript:;">Level 1</a></li>
							<li class="dropdown">
								<a href="javascript:;" class="dropdown-toggle">
									<span class="micon fa fa-plug"></span><span class="mtext">Level 2</span>
								</a>
								<ul class="submenu child">
									<li><a href="javascript:;">Level 2</a></li>
									<li><a href="javascript:;">Level 2</a></li>
								</ul>
							</li>
							<li><a href="javascript:;">Level 1</a></li>
							<li><a href="javascript:;">Level 1</a></li>
							<li><a href="javascript:;">Level 1</a></li>
						</ul>
					</li> -->
				<!-- <li>
						<a href="sitemap.html" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-diagram"></span><span class="mtext">Sitemap</span>
						</a>
					</li>
					<li>
						<a href="chat.html" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-chat3"></span><span class="mtext">Chat</span>
						</a>
					</li>
					<li>
						<a href="invoice.html" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-invoice"></span><span class="mtext">Invoice</span>
						</a>
					</li>
					<li>
						<div class="dropdown-divider"></div>
					</li>
					<li>
						<div class="sidebar-small-cap">Extra</div>
					</li>
					<li>
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-edit-2"></span><span class="mtext">Documentation</span>
						</a>
						<ul class="submenu">
							<li><a href="introduction.html">Introduction</a></li>
							<li><a href="getting-started.html">Getting Started</a></li>
							<li><a href="color-settings.html">Color Settings</a></li>
							<li><a href="third-party-plugins.html">Third Party Plugins</a></li>
						</ul>
					</li> -->
				<!-- <li>
						<a href="https://dropways.github.io/deskapp-free-single-page-website-template/" target="_blank" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-paper-plane1"></span>
							<span class="mtext">Landing Page <img src="vendors/images/coming-soon.png" alt="" width="25"></span>
						</a>
					</li> -->
			</ul>
		</div>
	</div>
</div>