<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title>ImaginR</title>
		<link rel="stylesheet" type="text/css" href="http://www.imagine-r.com/Styles/style.css">
	    <script type="text/javascript" src="http://www.imagine-r.com/Scripts/jquery.1.9.1.js"></script>
	    <link rel="stylesheet" type="text/css" href="http://www.imagine-r.com/prehome/css/style.css" media="all">
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	</head>
	<style type="text/css">
		body{
			font-family:'Calibri';
		}

		table, th, td {
		    border: 3px solid;
		    border-collapse: collapse;
		}
		table{
			border:3px solid;
			width:20%;
			margin:auto;
			font-size:1.5em;
			border-radius: 10px;
			overflow:hidden;
			margin-top:50px;
			margin-bottom:50px;
		}
		th, td {
		    padding: 5px;
		}

		#home #header {
		    background: url('./images/bg_home.jpg') center center no-repeat fixed;
		    color: #fff;
		}
	</style>
	<body style="font-family:'Calibri'">
		<a href="{{URL::to('')}}" class="logo"><img src="{{URL::to('images/logo_imaginer.png')}}" alt="IMAGINE R" /></a>

	<Panel id="ctl00_ContentPlaceHolder1_divSite">
	<nav class="nav fixOnBottom" role="navigation">
	    

	<ul>
	    <li><a id="lien_formulaire" href="#" style="font-family:'Calibri'">Forfait</a></li><!--
	    --><li><a id="lien_bons_plans" href="#" style="font-family:'Calibri'">Les bons plans</a></li><!--
	    --><li><a id="lien_a_suivre" href="#" style="font-family:'Calibri'">À suivre</a></li><!--
	    --><li><a id="lien_challenges" href="#" style="font-family:'Calibri'">Les challenges</a></li>
	</ul>
	    
	<div class="box_search">
	    <div class="icon"></div>

	    <div id="ctl00_ContentPlaceHolder1_BoxSearch_pnlForm">
		
	            <input name="ctl00$ContentPlaceHolder1$BoxSearch$txtRecherche" type="text" id="ctl00_ContentPlaceHolder1_BoxSearch_txtRecherche" value="Que recherches-tu ?" class="search" />
	            <input type="button" name="ctl00$ContentPlaceHolder1$BoxSearch$btnSearch" value="OK" onclick="javascript:__doPostBack(&#39;ctl00$ContentPlaceHolder1$BoxSearch$btnSearch&#39;,&#39;&#39;)" id="ctl00_ContentPlaceHolder1_BoxSearch_btnSearch" />
	        
	</div>

	</div>
	<span class="close_search">Fermer</span>
	</nav>
	<div id="ctl00_ContentPlaceHolder1_BoxLog_divLog" class="log">



	    <div id="ctl00_ContentPlaceHolder1_BoxLog_offline" class="offline">
	        <a href="{{URL::to('register')}}" style="font-family:'Calibri'">S'inscrire</a>
	        <a style="right:0;width:136px;font-family:'Calibri'" href="{{URL::to('login')}}">Se connecter</a>
	    </div>

	    
	</div>

	<div id="home" class="h100">
	    <div id="header">
	        <div id="intro">
	            <h1 style="font-family:'Calibri'">Avec ta carte ImaingR l'île-de-france est à tes pieds</h1>
	            <p style="font-family:'Calibri'">Des économies toute l'année pour bouger en illimité</p><br>
	            <table>
	            	<tr>
						<th style="width: 50%;"><i class="fa fa-credit-card"></i></th>
						<th><i class="fa fa-hourglass-o"></i></th>		
					</tr>
					<tr>
						<td>7€</td>
						<td>7 Jours</td>
					</tr>
					<tr>
						<td>15€</td>
						<td>30 Jours</td>
					</tr>
	            </table>
	            <br>
	            <a href="{{URL::to('register')}}" class="btn" style="font-family:'Calibri'">S'abonnez</a>
	            <!-- <a href="#" class="btn" style="font-family:'Calibri'">Gérer ton forfait</a> -->
	        </div>
	    </div>


	    </footer>
	</div>
	</Panel>

	</body>
</html>