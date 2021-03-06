<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>RoosterUren</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
		<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
		<style>
#root, body, html {
	height: 100%;
	background: #fafbfe;
	font-family: Nunito, sans-serif;
	color: #6c757d;
	font-size: .9rem;
	font-weight: 400;
	line-height: 1.5;
}
.wrapper {
	align-items: stretch;
	display: flex;
	width: 100%;
}


.sidemenu {
	min-width: 260px;
	max-width: 260px;
	background: #313a46;
	box-shadow: 0 0 35px 0 rgba(154,161,171,.15);
	color: #8391a2;
	padding-top: 20px;
}
.sidemenu h3 {
	text-transform: uppercase;
	font-family: Nunito, sans-serif;
	font-size: .6875rem;
	letter-spacing: .05em;
	font-weight: 700;
	padding: 10px 30px;
	margin: 0;
}
.sidemenu ul {
	padding: 0;
}
.sidemenu li {
	list-style: none;
	font-size: .9375rem;
	padding: 5px 30px;
}
.sidemenu li a {
	color: inherit;
	text-decoration: none;
	transition: all .4s;
}
.sidemenu li.active a {
	color: #fff;
}
.sidemenu li:hover a {
	color: #bccee4;
}
.sidemenu .icon {
	margin-right: 5px;
}
.sidemenu .button {
	padding: 0px 30px;
}



.content {
	display: flex;
	width: 100%;
	min-height: 100vh;
	min-width: 0;
	flex-direction: column;
}



.topnav {
	background: #fff;
	padding-left: 5px;
	padding-right: 5px;
	min-height: 70px;
	box-shadow: 0 0 35px 0 rgba(154,161,171,.15);
}
.topnav .flag {
	height: 13px;
	border-radius: 1px;
	box-shadow: 1px 1px 3px rgba(0,0,0,0.1);
	margin-right: 5px;
}
.topnav .my-account {
	border-left: 1px solid #f1f3fa;
	border-right: 1px solid #f1f3fa;
	background-color: #fafbfd;
	padding: 0px 10px;
	margin-top: -1rem;
	margin-bottom: -1rem;
	padding-top: 0.5rem;
}
.topnav .my-account .profile-img {
	width: 40px;
	height: 40px;
	border-radius: 20px;
	border: 1px solid #555;
	float: left;
}
.topnav .my-account .username {
	margin-left: 60px;
	font-weight: bold;
	font-size: 90%;
}
.topnav .my-account .function {
	font-size: 70%;
	margin-left: 60px;
}
.my-account .dropdown-toggle::after {
	display: none;
}
.topnav a {
	color: #98a6ad;
}
.topnav a:hover {
	color: #555;
}
.topnav .notifications {
	font-size: 150%;
}
.topnav .notifications .nav-link {
	padding: 0 15px;
}

.topnav .search {
	position: relative;
	box-shadow: 0 0 40px rgba(51, 51, 51, .1);
	width: 500px;
}
.topnav .search input {
	height: 46px;
	text-indent: 30px;
	border: 1px solid #d6d4d4
}
.topnav .search input:focus {
	box-shadow: none;
	border: 1px solid #0d6efd;
}
.topnav .search .fa-search {
	position: absolute;
	top: 16px;
	left: 16px;
	color: #98a6ad;
}
.topnav .search button {
	position: absolute;
	top: 5px;
	right: 5px;
	height: 36px;
}


.mainmenu {
	min-width: 85px;
	max-width: 85px;
}
.mainmenu .item {
	display: block;
	text-align: center;
	color: #6c757d;
	text-decoration: none;
	padding: 10px 0px;
	transition: all .2s;
}
.mainmenu .item:hover {
	background: #6c757d;
	color: #fff;
}
.mainmenu .item .icon {
	font-size: 200%;
	color: #6c757d;
}
.mainmenu .item:hover .icon {
	color: #fff;
}
.mainmenu .item b {
	font-size: 10px;
	text-transform: uppercase;
	font-weight: normal;
}


.page-content {
	padding: 0px 15px;
}


.page-title-box .page-title {
	font-size: 18px;
	margin: 0;
	line-height: 75px;
	overflow: hidden;
	white-space: nowrap;
	text-overflow: ellipsis;
	color: inherit;
	font-weight: 700;
}



.card {
	border: none;
	box-shadow: 0 0 35px 0 rgba(154,161,171,.15);
}


.week-grid {
	display: grid;
	grid-template-columns: 200px 1fr 1fr 1fr 1fr 1fr 1fr 1fr 100px;
}
.week-grid > div {
	border-left: 1px solid #f1f3fa;
	padding: 4px 8px;
}
.week-grid > div:first-child {
	border-left: none;
}
.week-grid.header > div {
	border-bottom: 1px solid #ccc;
}
.week-grid.header .day {
	text-align: center;
}


.content-row {
	border-top: 1px solid #eee;
}
.header + .content-row {
	border-top: none;
}

.week-grid.footer > div {
	border-top: 1px solid #ccc;
}

.time-range-container {
	margin-top: 3px;
}
.time-range-container:first-child {
	margin-top: 0px;
}
.time-range-block {
	border: 1px solid transparent;
	border-radius: .25rem;
	padding: 4px 8px;
	white-space: nowrap;
	overflow: hidden;
}
.time-range-block.afdeling-range {
	background-color: #d1e7dd;
	border-color: #badbcc;
	color: #0f5132;
}
.time-range-block.other-afdeling-range {
	background-color: #fff3cd;
	border-color: #ffecb5;
	color: #664d03;
}
.time-range-block.verlof-range {
	color: #055160;
	background-color: #cff4fc;
	border-color: #b6effb;
}
.time-range-block.ziek-range {
	color: #055160;
	background-color: #cff4fc;
	border-color: #b6effb;
}

.has-conflict {
	background-color: #f8d7da;
}

.vaste-vrije-dag {
	background-color: #eee;
}


.footer .day {
	text-align: center;
}
.bezetting-under {
	background-color: #f8d7da;
}
.bezetting-over {
	background-color: #fff3cd;
}
		</style>
    </head>
	<body>
		<div class="wrapper">
			<div class="mainmenu">
				<a href="#" class="item active">
					<i class="fas fa-calendar-alt icon"></i><br><b>Rooster</b>
				</a>
				<a href="#" class="item">
					<i class="fas fa-plane-departure icon"></i><br><b>Vrij vragen</b>
				</a>
				<a href="#" class="item">
					<i class="fas fa-hospital-user icon"></i><br><b>Ziek melden</b>
				</a>
				<a href="#" class="item">
					<i class="far fa-envelope icon"></i><br><b>Berichten</b>
				</a>
				<a href="#" class="item">
					<i class="fas fa-users icon"></i><br><b>Gebruikers</b>
				</a>
				<a href="#" class="item">
					<i class="fas fa-building icon"></i><br><b>Afdelingen</b>
				</a>
				<a href="#" class="item">
					<i class="fas fa-clipboard-list icon"></i><br><b>Beheer</b>
				</a>
				<a href="#" class="item">
					<i class="fas fa-cog icon"></i><br><b>Instellingen</b>
				</a>
				<a href="#" class="item">
					<i class="far fa-question-circle icon"></i><br><b>Help</b>
				</a>
			</div>
			<div class="sidemenu">
				<h3>Afdelingen</h3>
				<ul>
					<li>
						<a href="#" class="item">
							<i class="far fa-check-circle icon"></i> Persoonlijk rooster
						</a>
					</li>
					<li>
						<a href="#" class="item">
							<i class="far fa-check-circle icon"></i> Kantoor
						</a>
					</li>
					<li class="active">
						<a href="#" class="item">
							<i class="far fa-check-circle icon"></i> Tuinmeubelen
						</a>
					</li>
					<li>
						<a href="#" class="item">
							<i class="far fa-check-circle icon"></i> Kassa
						</a>
					</li>
					<li>
						<a href="#" class="item">
							<i class="far fa-circle icon"></i> Restaurant
						</a>
					</li>
				</ul>
				<h3>Speciale afdelingen</h3>
				<ul>
					<li>
						<a href="#" class="item">
							<i class="far fa-check-circle icon"></i> EHBO
						</a>
					</li>
					<li class="active">
						<a href="#" class="item">
							<i class="far fa-check-circle icon"></i> BHV
						</a>
					</li>
				</ul>
				<div class="d-grid button">
					<a href="" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Nieuwe afdeling</a>
				</div>
			</div>
			<div class="content">
				<div class="navbar navbar-expand-lg topnav">
					<div class="container-fluid">
						<form class="d-flex">
							<div class="search">
								<i class="fa fa-search"></i>
								<input type="text" class="form-control" placeholder="Afdeling, gebruiker, pagina...">
								<button class="btn btn-outline-primary btn-sm">Zoek</button>
							</div>
						</form>
						<div class="d-flex">
							<div class="navbar-collapse d-flex">
								<ul class="navbar-nav me-auto mb-2 mb-lg-0">
									<li class="nav-item dropdown">
										<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
											<img src="/images/flags/nl.png" class="flag"> Nederlands
										</a>
										<ul class="dropdown-menu">
											<li><a class="dropdown-item" href="#"><img src="/images/flags/nl.png" class="flag"> Nederlands</a></li>
											<li><a class="dropdown-item" href="#"><img src="/images/flags/gb.png" class="flag"> English</a></li>
										</ul>
									</li>
									<li class="nav-item notifications">
										<a class="nav-link" href="#">
											<i class="far fa-bell"></i>
										</a>
									</li>
									<li class="nav-item dropdown my-account">
										<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
											<img src="/images/profile-pic.jpg" class="profile-img">
											<div class="username">Bart Kaandorp</div>
											<div class="function">Afdelingsleider</div>
										</a>
										<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
											<li><a class="dropdown-item" href="#">Action</a></li>
											<li><a class="dropdown-item" href="#">Another action</a></li>
											<li><hr class="dropdown-divider"></li>
											<li><a class="dropdown-item" href="#">Something else here</a></li>
										</ul>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				
				<div class="page-content">
					<div class="container-fluid">
						<div class="row">
							<div class="col-12">
								<div class="page-title-box">
									<h4 class="page-title">Rooster Tuinmeubelen, week 25 2020</h4>
								</div>
								<div class="card">
									<div class="card-body">
										
										<div class="alert alert-info">Opmerkingen bij dit rooster: dit is een test rooster</div>
										
										<div class="week-grid header">
											<div class="label">Tuinmeubelen</div>
											<div class="day">Maandag<br><small>1 februari 2021</small></div>
											<div class="day">Dinsdag<br><small>2 februari 2021</small></div>
											<div class="day">Woensdag<br><small>3 februari 2021</small></div>
											<div class="day">Donderdag<br><small>4 februari 2021</small></div>
											<div class="day">Vrijdag<br><small>5 februari 2021</small><div class="time-range-container"><div class="time-range-block verlof-range" style="width: 100%;margin-left:0%;">Koopavond</div></div></div>
											<div class="day">Zaterdag<br><small>6 februari 2021</small></div>
											<div class="day">Zondag<br><small>7 februari 2021</small></div>
											<div class="sum"></div>
										</div>
										<div class="week-grid content-row">
											<div class="label">Bart Kaandorp<br><small>Afdelingsleider</small></div>
											<div class="day"><div class="time-range-container"><div class="time-range-block afdeling-range" style="width: 100%;margin-left:0%;">9:00 - 18:00</div></div></div>
											<div class="day"><div class="time-range-container"><div class="time-range-block afdeling-range" style="width: 100%;margin-left:0%;">9:00 - 18:00</div></div></div>
											<div class="day"><div class="time-range-container"><div class="time-range-block afdeling-range" style="width: 100%;margin-left:0%;">9:00 - 18:00</div></div></div>
											<div class="day"><div class="time-range-container"><div class="time-range-block afdeling-range" style="width: 80%;margin-left:0%;">9:00 - 18:00</div></div></div>
											<div class="day has-conflict">
												<div class="time-range-container"><div class="time-range-block afdeling-range" style="width: 100%;margin-left:0%;">9:00 - 18:00</div></div>
												<div class="time-range-container"><div class="time-range-block other-afdeling-range" style="width: 100%;margin-left:0%;">Kassa: 9:00 - 18:00</div></div>
											</div>
											<div class="day"></div>
											<div class="day"><div class="time-range-container"><div class="time-range-block ziek-range" style="width: 100%;margin-left:0%;">Ziek</div></div></div>
											<div class="sum">40:00<br><small>contract: 40:00</small><br><small>kosten: &euro; 800,00</small></div>
										</div>
										<div class="week-grid content-row">
											<div class="label">Sanne Klaver<br><small>Stagiere</small></div>
											<div class="day"><div class="time-range-container"><div class="time-range-block afdeling-range" style="width: 50%;margin-left:15%;">10:00 - 14:00</div></div></div>
											<div class="day"><div class="time-range-container"><div class="time-range-block afdeling-range" style="width: 100%;margin-left:0%;">9:00 - 18:00</div></div></div>
											<div class="day"><div class="time-range-container"><div class="time-range-block afdeling-range" style="width: 100%;margin-left:0%;">9:00 - 18:00</div></div></div>
											<div class="day"><div class="time-range-container"><div class="time-range-block afdeling-range" style="width: 80%;margin-left:0%;">9:00 - 18:00</div></div></div>
											<div class="day"><div class="time-range-container"><div class="time-range-block afdeling-range" style="width: 100%;margin-left:0%;">9:00 - 18:00</div></div></div>
											<div class="day vaste-vrije-dag"></div>
											<div class="day vaste-vrije-dag"></div>
											<div class="sum">40:00<br><small>contract: 40:00</small></div>
										</div>
										<div class="week-grid content-row">
											<div class="label">Stendert Baars</div>
											<div class="day"></div>
											<div class="day"></div>
											<div class="day"></div>
											<div class="day">
												<div class="time-range-container"><div class="time-range-block afdeling-range" style="width: 50%;margin-left:0%;">9:00 - 12:00</div></div>
												<div class="day"><div class="time-range-container"><div class="time-range-block verlof-range" style="width: 50%;margin-left:50%;">Vrij vanaf 12:00</div></div></div>
											</div>
											<div class="day"><div class="time-range-container"><div class="time-range-block verlof-range" style="width: 100%;margin-left:0%;">Vrij</div></div></div>
											<div class="day"><div class="time-range-container"><div class="time-range-block verlof-range" style="width: 100%;margin-left:0%;"><i class="far fa-clock"></i> Vrij (in behandeling)</div></div></div>
											<div class="day"></div>
											<div class="sum">40:00<br><small>contract: 40:00</small></div>
										</div>
										<div class="week-grid content-row">
											<div class="label"><input type="text" class="form-control" placeholder="Medewerker toevoegen..."></div>
											<div class="day"></div>
											<div class="day"></div>
											<div class="day"></div>
											<div class="day"></div>
											<div class="day"></div>
											<div class="day"></div>
											<div class="day"></div>
											<div class="sum"></div>
										</div>
										<div class="week-grid footer">
											<div class="label">Totaal</div>
											<div class="day">16:00</div>
											<div class="day">16:00</div>
											<div class="day">16:00</div>
											<div class="day">16:00</div>
											<div class="day">16:00</div>
											<div class="day"></div>
											<div class="day"></div>
											<div class="sum">80:30</div>
										</div>
										<div class="week-grid footer">
											<div class="label">Bezetting</div>
											<div class="day">2 / 2</div>
											<div class="day">2 / 2</div>
											<div class="day bezetting-over">2 / 1</div>
											<div class="day">3 / 3</div>
											<div class="day bezetting-under">2 / 4</div>
											<div class="day">0 / 0</div>
											<div class="day">0 / 0</div>
											<div class="sum"></div>
										</div>
										<div class="week-grid footer">
											<div class="label">Kosten</div>
											<div class="day">&euro; 150,00</div>
											<div class="day">&euro; 150,00</div>
											<div class="day">&euro; 150,00</div>
											<div class="day">&euro; 150,00</div>
											<div class="day">&euro; 150,00</div>
											<div class="day">&euro; 0,00</div>
											<div class="day">&euro; 0,00</div>
											<div class="sum">&euro; 1.050,00</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</body>
</html>
