<html>
	<head>
		<title>Sponsoringformular</title>
		<style>
			body{
				background-color: #fff;
				font-family: Arial;
				font-size: 14px;
			}
			.formTable{
				width:600px;
				font-size: inherit;
			}
			.formTable td{
				border-bottom: 1px solid #000;
				padding-top: 10px;
			}
			.formTable .titel{ 
				padding-right: 15px; 
				width: 200px;
				color: #44a;
				font-weight: bold;
				font-size: 12px;
			}
			.paketTable{
				border: 2px solid #86B404;
				padding: 10px;

				width: 600px;
			}
			.ungerade{
				background-color: #eee;
			}
			.paketTable .bezeichnung{
				width: 500px;
			}
			.paketTable .preis{
				color: #86B404;
				font-weight: bold;
				text-align: right;
			}
			.sponsorTable{
				width: 600px;
				font-size: inherit;
			}

			.total{
				text-align: right;
				color: #86B404;
				font-weight: bold;
				padding: 10px;
			}
			.goldsponsor{
				background-color: #FFD700;
				padding: 10px;
				width: 400px;
				font-weight: bold;
			}
			.silbersponsor{
				background-color: #C0C0C0;
				padding: 10px;
				width: 400px;
				font-weight: bold;
			}
			.bronzesponsor{
				background-color: #DAA520;
				padding: 10px;
				width: 400px;
				font-weight: bold;
			}
		</style>
	</head>
	<body>
		<table class="formTable" cellpadding="0" cellspacing="0">
			<tr>
				<td class="titel">Sponsor / Firmenname</td>
				<td>{FIRMA}</td>
			</tr>
			<tr>
				<td class="titel">Sponsorenadresse</td>
				<td>{ADRESSE1}</td>
			</tr>
			<tr>
				<td class="titel">Rechnungsadresse</td>
				<td>{ADRESSE2}</td>
			</tr>
			<tr>
				<td class="titel">E-Mail</td>
				<td>{MAIL}</td>
			</tr>
			<tr>
				<td class="titel">Telefon</td>
				<td>{TELEFON}</td>
			</tr>
			<tr>
				<td class="titel">Bemerkung</td>
				<td>{BEMERKUNG}</td>
			</tr>
			<tr>
				<td class="titel">VBC Kontaktperson</td>
				<td>{VBCPERSON}</td>
			</tr>
		</table>
		{KONTAKT}<br><br>
		<table class="paketTable" cellpadding="0" cellspacing="0">
			{PAKETE}
		</table>
		<br>
		<table class="sponsorTable">
			<tr>
				{SPONSORTYP}
				<td class="total">{TOTAL}.-</td>
			</tr>
	</body>
</html>