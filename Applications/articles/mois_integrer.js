/**
 * Class calendar
 * @author Franckysolo
 * Le: 17/11/2008
 */

//		constructeur		//
function Calendrier(){
	// attributs //
	this.timer = null;
	this.champ = null;
	this.date = new Date();
	this.tab_jour = new Array('Lun','Mar','Mer','Jeu','Ven','Sam','Dim');
	this.tab_mois = new Array('Janvier','F&#233;vrier','Mars','Avril','Mai','Juin','Juillet','Ao&#251;t','Septembre','Octobre','Novembre','D&#233;cembre');
	this.nb_jour_mois = new Array(31,28,31,30,31,30,31,31,30,31,30,31);
	
	// m&#233;thodes //
	this.creer_div = creer_div;
	this.init_timer = init_timer;
	this.stop_timer = stop_timer;
	this.creer_champ = creer_champ;
	this.affiche = affiche;
	this.cache = cache_calendar;
	this.calendar = calendar;
	this.select_date = select_date;
	this.format = format;
}
// cr&#233;e la div calendar
function creer_div(){
	document.write('<div id="calendar" onmouseover="cal.stop_timer();" onmouseout="cal.init_timer();">&amp;nbsp;</div>');
}
	
// cr&#233;e le champ input en fonction du nom, onfocus on affiche le calendar
function creer_champ(nom){
	document.write("<input type='text' onfocus=\"cal.affiche(this);\" name=\""+nom+"\"  />");
}
	
// attribut la valeur "cliquez" au champ qui a le focus
function select_date(txt){
	txt = this.format(txt);
	this.champ.value = txt;
        //on cache le calendar
	this.cache();
}	
// ajoute la date cliqu&#233;e et format&#233;e xx/xx/xxxx dans un champ date ;-)
function format(txt){
	var reg = new RegExp ("[/]+","g");
	var tab_valeur = txt.split(reg);
	var jour = tab_valeur[0];
	// on ajoute 1 au mois pour avoir le num&#233;ro r&#233;el du mois
	var mois = parseInt(tab_valeur[1] )+ 1;
	var annee = tab_valeur[2];
	if(jour < 10)
	{
		jour = "0"+jour;
	}
	if(mois < 10)
	{
		mois = "0"+mois;
	}
return jour+"/"+mois+"/"+annee ;
}	
// d&#233;marre le timer
function init_timer(){
	if(this.timer == null)
	{
		this.timer = setTimeout("cache_calendar()",3000);
	}
}
// arr&#234;te le timer
function stop_timer(){
if(this.timer != null)
	{
		clearTimeout(this.timer);
		this.timer = null;
	}
}	
// affiche le calendar en dessous de l'input
function affiche(champ){
	this.stop_timer();//on arr&#234;te le timer
	this.champ = champ;
	var div = document.getElementById("calendar");
	// on le place juste en dessous
	div.style.top = (champ.offsetTop + champ.offsetHeight - 150)+"px";
	// on le d&#233;cale &#224; droite
	div.style.left = (champ.offsetLeft + 220 )+"px";
	this.calendar();// le calendar
	div.style.display = "block";// on affiche
	this.init_timer();//on demarre le timer
	}
	
// cache le calendar
function cache_calendar(){
	if(document.getElementById)
	{
		var div = document.getElementById("calendar");
		div.style.display = "none";// on cache
	}
cal.stop_timer();// on arr&#234;te le timer
}
	
// construit le calendar en html et calcule les dates
function calendar(){
	var annee = this.date.getFullYear();
	var mois = this.date.getMonth()  ;
	
	// calcul de premier jour du mois
	var time = new Date();
	time.setDate(1);
	time.setMonth(this.date.getMonth());
	time.setFullYear(this.date.getFullYear());
	var first_day = time.getDay();
	if( first_day == 0 )// dimanche
	{
		first_day = 7;
	}
	// le nb de jours dans le mois //
	var nb_jour = this.nb_jour_mois[this.date.getMonth()];
	// attention pour les ann&#233;es bissextiles, on change f&#233;vrier en 29 ;-)
	this.nb_jour_mois[1] = ( annee % 4 == 0 ) ? 29 : 28;
	// le jour courant
	var today = this.date.getDate();
	// lien et mois courant << mois Annee >> //
	var str = "<table class='calendar'><tr class='entete_cal'><th colspan='7'>";
	str +="<a href='#' onclick=\"cal.date.setMonth("+(this.date.getMonth() - 1)+");cal.calendar();\"><span class='bold'> << </span>&amp;nbsp;</a>"+this.tab_mois[mois]+" "+annee+"<a href='#' onclick=\"cal.date.setMonth("+(this.date.getMonth() + 1)+");cal.calendar();\">&amp;nbsp;<span class='bold'> >> </span></a></th></tr>";
	
	// en-t&#234;te avec nom des jours //
	str += "<tr class='jour'>";
	for (var i = 0 ; i < this.tab_jour.length; i++)
	{
		str += "<td>"+this.tab_jour[i]+"</td>";
	}
	str += "</tr>";
	/* on remplit maintenant &#224; partir du premier jour du mois... 
	* la premi&#232;re ligne par des blancs
	* tant qu'on n'est pas au 1er jour du mois
	*/ 
	str += "<tr>";// 1er ligne
	var n = 0;
	for (var i = 0; i < first_day - 1 ; i++)
	{
		// les cases vides pour  l'affichage :)
		str += "<td class='morte'>&nbsp;</td>";
												
	}
	for (var n = 0; n < 7 - i; n++){
		var txt = (n + 1)+"/"+mois+"/"+annee;
		str += ( (n + 1) == today) ? "<td class='rouge' onclick='cal.select_date(\""+txt+"\");'>"+(n + 1)+"</td>"  : "<td onclick='cal.select_date(\""+txt+"\");'>"+(n + 1)+"</td>";
	}
	str += "</tr>";// on ferme la premi&#232;re ligne
	
	// le reste des lignes //
	while ( n  < nb_jour )
	{
		str += "<tr>";
		for(var j = 0; j < 7 ; j++)
		{
			n++;
			if( n <= nb_jour )
			{
				var txt = n+"/"+mois+"/"+annee;
				//si c'est aujourd'hui on affiche en rouge le jour
				str += ( n == today) ? "<td class='rouge' onclick='cal.select_date(\""+txt+"\");'>"+n+"</td>"  : "<td onclick='cal.select_date(\""+txt+"\");'>"+n+"</td>";
			}
			else
			{
				str += "<td class='morte'>&nbsp;</td>";// on finit le tableau par des cases vides
														
			}
		}
		str += "</tr>";
	}
	str += "</table>";
	if(document.getElementById)
	{
                //on place notre calendar dans la div calendar
		document.getElementById('calendar').innerHTML = str;
	}
}