<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>RoosterUren</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    </head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<div class="container">
				<a class="navbar-brand" href="#">RoosterUren</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" id="dropdownRoosters" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">Roosters</a>
							<ul class="dropdown-menu" aria-labelledby="dropdownRoosters">
								<li><a class="dropdown-item" href="#">Persoonlijk rooster</a></li>
								<li><a class="dropdown-item" href="#">Bekijk roosters</a></li>
								<li><a class="dropdown-item" href="#">Bewerk roosters</a></li>
							</ul>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" id="dropdownVerlof" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">Verlof</a>
							<ul class="dropdown-menu" aria-labelledby="dropdownVerlof">
								<li><a class="dropdown-item" href="#">Nieuwe aanvraag</a></li>
								<li><a class="dropdown-item" href="#">Beheer aanvragen</a></li>
								<li><a class="dropdown-item" href="#">Vakantieoverzicht</a></li>
							</ul>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="dropdownZiekMelden" role="button" data-bs-toggle="dropdown" aria-expanded="false">Ziek melden</a>
							<ul class="dropdown-menu" aria-labelledby="dropdownZiekMelden">
								<li><a class="dropdown-item" href="#">Ziek melden</a></li>
								<li><a class="dropdown-item" href="#">Beheer meldingen</a></li>
							</ul>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="dropdownBerichten" role="button" data-bs-toggle="dropdown" aria-expanded="false">Berichten</a>
							<ul class="dropdown-menu" aria-labelledby="dropdownBerichten">
								<li><a class="dropdown-item" href="#">Nieuw bericht</a></li>
								<li><a class="dropdown-item" href="#">Inbox</a></li>
								<li><a class="dropdown-item" href="#">Verzonden</a></li>
							</ul>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="dropdownInstellingen" role="button" data-bs-toggle="dropdown" aria-expanded="false">Beheer</a>
							<ul class="dropdown-menu" aria-labelledby="dropdownInstellingen">
								<li><a class="dropdown-item" href="#">Algemene instellingen</a></li>
								<li><a class="dropdown-item" href="#">Gebruikers</a></li>
								<li><a class="dropdown-item" href="#">Afdelingen</a></li>
								<li><a class="dropdown-item" href="#">Rechten</a></li>
								<li><a class="dropdown-item" href="#">Groepen</a></li>
							</ul>
						</li>
					</ul>
					<ul class="navbar-nav me-2">
						<li class="nav-item">
							<a class="nav-link" aria-current="page" href="#">Notificaties</a>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" id="dropdownAccount" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">Gebruikers Naam</a>
							<ul class="dropdown-menu" aria-labelledby="dropdownAccount">
								<li><a class="dropdown-item" href="#">Profiel bewerken</a></li>
								<li><a class="dropdown-item" href="#">Uitloggen</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		
		<div class="container">
			<h1>Week 2 2021 (4 t/m 10 jan)</h1>
			<input type="text" class="form-control mb-3 mt-3" placeholder="Opmerkingen bij dit rooster...">
			<div class="row">
				<div class="col-10">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th rowspan="2">Afdelingsnaam</th>
								<th>Ma 4 jan</th>
								<th>Di 5 jan</th>
								<th>Wo 6 jan</th>
								<th>Do 7 jan</th>
								<th>Vr 8 jan</th>
								<th>Za 9 jan</th>
								<th>Zo 10 jan</th>
								<th rowspan="2">Totaal</th>	
							</tr>
							<tr>
								<th></th>
								<th></th>
								<th></th>
								<th>Koopavond</th>
								<th></th>
								<th></th>
								<th></th>	
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Gebruiker A<br><i>Afdelingshoofd</i></td>
								<td>9:00 - 18:00<br>8 uur</td>
								<td>9:00 - 14:00<br>4 uur<br><b>Kassa</b><br>14:00 - 18:00</td>
								<td>9:00 - 18:00<br>8 uur</td>
								<td>9:00 - 18:00<br>8 uur</td>
								<td>9:00 - 18:00<br>8 uur</td>
								<td>Vaste vrije dag</td>
								<td></td>
								<td>36 uur<br><i>Contract: 40 uur</i></td>
							</tr>
							<tr>
								<td>Gebruiker B<br><i>Verkoopmedewerker</i></td>
								<td>9:00 - 18:00<br>8 uur</td>
								<td>9:00 - 18:00<br>8 uur</td>
								<td>9:00 - 18:00<br>8 uur</td>
								<td>9:00 - 18:00<br>8 uur</td>
								<td>9:00 - 18:00<br>8 uur</td>
								<td></td>
								<td></td>
								<td>40 uur<br><i>Contract: 40 uur</i></td>
							</tr>
						</tbody>
						<tfoot>
							<tr>
								<th>Totaal:</th>
								<th>16 uur</th>
								<th>12 uur</th>
								<th>16 uur</th>
								<th>16 uur</th>
								<th>16 uur</th>
								<th>0 uur</th>
								<th>0 uur</th>
								<th>76 uur</th>
							</tr>
						</tfoot>
					</table>
				</div>
				<div class="col-2">
					<div class="d-grid gap-2">
						<div class="btn btn-primary active">Magazijn</div>
						<div class="btn btn-secondary">Kassa</div>
						<div class="btn btn-secondary">Winkel</div>
						<hr>
						<div class="btn btn-secondary">EHBO</div>
						<div class="btn btn-secondary">BHV</div>
						<hr>
						<div class="btn btn-success">Nieuwe afdeling</div>
						
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
