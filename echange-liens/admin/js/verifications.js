var checkbox = 0;

function requete(numero)
{
	var xhr = null;
	if(window.XMLHttpRequest || window.ActiveXObject)
	{
		if(window.XMLHttpRequest)
			xhr = new XMLHttpRequest();
		else
		{
			try {
				xhr = new ActiveXObject('Msxml2.XMLHTTP');
			} catch(e) {
				xhr = new ActiveXObject('Microsoft.XMLHTTP');
			}
		}
	}
	
	var url = document.getElementById('url' + numero).value;
	var retour = document.getElementById('retour' + numero).value;
	var mail = document.getElementById('mail' + numero).value;
	var titre = document.getElementById('titre' + numero).value;
	
	xhr.open('GET', 'index.php?page=verifications&url=' + url + '&retour=' + retour + '&mail=' + mail + '&titre=' + titre, true);
	
	var date = new Date();
	var timestamp = Math.round(date.getTime() / 1000);
	
	var interval = null;
	
	xhr.onreadystatechange = function()
	{
		if(xhr.readyState == 1)
		{
			document.getElementById('current').innerHTML = '<span class="title">Site en cours</span><hr />Site en cours : <a href="' + unescape(url) + '">' + unescape(url) + '</a>. Connexion établie. Attente de la réponse ...<br /><br />';
			interval = setInterval(
				function()
				{
					var date = new Date();
					var actuel_time = Math.round(date.getTime() / 1000);
					if(actuel_time >= timestamp + 10)
						xhr.abort();
				}
			, 1000);
		}
		
		if(xhr.readyState == 4)
		{
			clearInterval(interval);
			numero++;
			var reponses = document.getElementById('reponses');
			if(xhr.responseText == 'INVALIDE')
			{
				if(reponses.innerHTML == 'Aucun site pour le moment.')
					reponses.innerHTML = '';
				reponses.innerHTML += '<input type="hidden" name="url' + checkbox + '" value="' + unescape(url) + '" /><input type="checkbox" name="checkbox' + checkbox + '" checked="checked" /> Le site <a href="' + unescape(url) + '">' + unescape(url) + '</a> ne contient plus le lien retour ! Le lien de retour devait être placé à l\'adresse <a href="' + unescape(retour) + '">' + unescape(retour) + '</a><br />';
				checkbox++;
			}
			else if(xhr.responseText == '')
			{
				if(reponses.innerHTML == 'Aucun site pour le moment.')
					reponses.innerHTML = '';
				reponses.innerHTML += '<input type="hidden" name="url' + checkbox + '" value="' + unescape(url) + '" /><input type="checkbox" name="checkbox' + checkbox + '" checked="checked" /> Le site <a href="' + unescape(url) + '">' + unescape(url) + '</a> ne répond pas. Le lien de retour se trouve à l\'adresse <a href="' + unescape(retour) + '">' + unescape(retour) + '</a><br />';
				checkbox++;
			}
			else if(xhr.responseText == 'ERREUR')
			{
				if(reponses.innerHTML == 'Aucun site pour le moment.')
					reponses.innerHTML = '';
				reponses.innerHTML += '<input type="hidden" name="url' + checkbox + '" value="' + unescape(url) + '" /><input type="checkbox" name="checkbox' + checkbox + '" checked="checked" /> Le chargement de la page contenant le lien retour (<a href="' + unescape(retour) + '">' + unescape(retour) + '</a>) a échoué. Site web : <a href="' + unescape(url) + '">' + unescape(url) + '</a>.<br />';
				checkbox++;
			}
			
			if(document.getElementById('url' + numero))
				requete(numero);
			else
			{
				document.getElementById('current').innerHTML = '<span class="title">Site en cours</span><hr />Analyse terminée.<br /><br />';
				if(reponses.innerHTML != 'Aucun site pour le moment.')
					reponses.innerHTML += '<br /><input type="submit" value="Supprimer" />';
			}
		}
	}
	
	xhr.send(null);
}

function lancement()
{
	if(document.getElementById('url0'))
	{
		document.getElementById('avertissement').innerHTML = 'Si vous avez beaucoup de sites, cela peut prendre du temps.';
		requete(0);
	}
	else
		document.getElementById('avertissement').innerHTML = 'Aucun site n\'est inscrit.';
}