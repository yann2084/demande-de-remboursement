<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Remboursement mission</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="../../img/logoForm.png" type="image/x-icon" />
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../view/stylesheet.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="../../modules/nouvelle_demande/js/calculator/jquery.calculator.css">
    

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
    
    <script src='../../modules/nouvelle_demande/jquery.validate.min.js'></script>
    <script src='../../modules/nouvelle_demande/additional-methods.min.js'></script>
    
        <script type="text/javascript" src="../../modules/nouvelle_demande/js/calculator/jquery.plugin.js"></script>
    <script type="text/javascript" src="../../modules/nouvelle_demande/js/calculator/jquery.calculator.js"></script>
    <script type="text/javascript" src="../../modules/nouvelle_demande/js/calculator/jquery.calculator-fr.js"></script>

    
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>

<body>
    <div id="toto"></div>
    <form method="get" action="insererville.php">
        <input type="text" id="champ" name="ville"/>
        <input type="submit" value="Submit">
    </form>
    <script>

    function paspossible(){
        var depart1 = document.getElementById("champ");
        var autocomplete = new google.maps.places.Autocomplete(depart1);
    }


    $("#champ").autocomplete({
        source: [ "Grenoble, France", "Lyon, France", "Chambéry, France", "Paris, France", "Valence, France", "Gières, France" ],
        response: function(event, ui)
		{
            // ui.content is the array that's about to be sent to the response callback.
            document.getElementById('toto').innerHTML = ui.content.length;
            if (ui.content.length === 0)
			{
				$("#champ").autocomplete({
					source : 'source_villesAvion.php',
					response: function(event, ui)
					{
						if (ui.content.length === 0)
						{
							paspossible();
						}
					}
				});
			}
		}
	});

        </script>
        
<script src="../nouvelle_demande/js/myScript.js"></script>
<script src="../nouvelle_demande/js/scriptEtapes.js"></script>

        
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDprc5sfu1qrH8ChZ18E3q8_xijqIOTJGQ&signed_in=true&libraries=places&callback=initMap" async defer></script>
</body>
</html>

