	<header>
		<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
			<div class="container-fluid">
				<a class="navbar-brand" href="#">Demo</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarColor02">
					<ul class="navbar-nav me-auto">
						<li class="nav-item">
							<div class="nav-link" onClick="loadSetPage('home');">Trang chủ</div>
						</li>	
						<li class="nav-item dropdown">
						  <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Công việc</a>
						  <div class="dropdown-menu">
							<?php if($account->isAdmin()) { ?>
							<div class="dropdown-item" onClick="loadSetPage('manageUserPage');">Quản lý user</div>
							<?php } ?>
							<div class="dropdown-item" onClick="loadSetPage('jobPage');">Danh sách công trình</div>
							<?php if(!$account->isAdmin()) { ?>
							<div class="dropdown-item" onClick="loadSetPage('jobPageContent');">Nhập nội dung</div>
							<?php } ?>
						  </div>
						</li>					
						
					</ul>
					
					<ul class="navbar-nav">
						<li class="nav-item">
							<div class="nav-link "  onClick="loadSetPage('myAccount');">Xin chào, <?=$_SESSION['fullname']?></div>
						</li>
						<li class="nav-item">
							<div class="nav-link " id="login" onClick="logoutPage();">Đăng xuất</div>
						</li>
					</ul>
					
				</div>
			</div>
		</nav>

	</header>