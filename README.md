Gebruikerssysteem moet later op een andere manier gekoppeld worden, voor nu handmatig een gebruiker aanmaken in de db en de volgende urls gebruiken:
/users/login/1
/users/logout


Één profiel/account voor de hele site (email, password)
Aparte user accounts per bedrijf (naam)


roosteruren.nl
- roosters
  - persoonlijk rooster
  - bekijken
  - bewerken
  - speciale roosters (EHBO/BHV)
  - openen/sluiten (optioneel)
  - beschikbaarheid
  - 
- medewerkers
  - overzicht
  - bewerken
- afdelingen
  - overzicht
  - bewerken
- verlof
  - nieuwe aanvragen
  - beheer
  - vakantieoverzicht (optioneel)
- ziek melden
  - ziek melden
  - beheer
- agenda
- berichten
  - nieuw bericht
- notificaties
  - overzicht
- instellingen
  - 
- profiel

Index roosteruren data: {
	gebruiker: #,
	datum: 2021-01-08,
	roosteruren: [
		{
			afdeling: #,
			gebruiker: #,
			datum: 2021-01-08,
			online: true,
			tijden: 8:00 - 19:00,
			uren: 10:00
		},
		{
			afdeling: #,
			gebruiker: #,
			datum: 2021-01-08,
			online: true,
			tijden: 19:00 - 21:00,
			uren: 2:00
		}
	],
	verlof: [
		{
			id: #,
			status: goedgekeurd,
			van: 2021-01-08 12:00,
			tot: 2021-01-10
		}
	]
}


Weekrooster bekijken (week + afdeling)
- Laad rooster voor week (online, opmerkingen)
- Laad uren voor afdeling+week
- Laad gebruikers voor afdeling
- Laad verlof voor gebruikers met overlap op week
- Laad ziekmeldingen voor gebruikers met overlap op week
- Laad uren op andere afdelingen voor alle gebruikers
- Laad vaste vrije dagen voor gebruikers

Persoonlijk weekrooster bekijken (week)
- Laad afdelingen voor gebruiker
- Laad uren voor gebruiker+week
- Laad roosters voor week+afdelingen
- Laad verlof voor gebruiker met overlap op week
- Laad ziekmeldingen voor gebruiker met overlap op week

Weekrooster bewerken (week + afdeling)
- Laad rooster voor week
- Laad uren voor afdeling+week
- Laad gebruikers voor afdeling
- Laad verlof voor gebruikers met overlap op week
- Laad ziekmeldingen voor gebruikers met overlap op week
- Laad uren op andere afdelingen voor alle gebruikers
- Laad vaste uren voor gebruikers
- Laad vaste vrije dagen voor gebruikers



Tabellen
- gebruikers
- vaste uren (gebruiker, weekdag, even/oneven week, tijden, uren, opmerkingen, vaste-vrije-dag)
- roosteruren (datum, gebruiker, afdeling, tijden, uren)
- weekroosters (week, afdeling, online, opmerkingen)
- verlof (gebruiker, status, van, tot)
- ziekmeldingen (gebruiker, status, van, tot)


Index roosteruren
- Gekoppelde datum
- Gekoppelde week
- Gekoppelde afdelingen
- Gekoppelde gebruiker
- Gekoppelde verlofaanvragen




Rooster online zetten
- Alle niet gevulde roosteruren vullen met een lege waarde zodat de vaste vrije uren niet meer aangepast kunnen worden
- Trigger index voor alle gekoppelde roosteruren

Rooster verwijderen
- Alle roosteruren voor die afdeling+week verwijderen zodat de vaste uren weer getoond worden
- Trigger index voor alle gekoppelde roosteruren

Roosteruren aanpassen
- Gekoppeld rooster offline zetten
- Update aanmaken en doorsturen naar medewerker
- Trigger index

Vaste uren aanpassen
- Trigger index vaste uren

Verlof aanmaken/verwijderen
- Trigger index gekoppelde roosteruren