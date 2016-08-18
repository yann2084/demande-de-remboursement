

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Remboursement mission</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
    
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>



    <br><br><br><br>
    <div id="toto"></div>
    <form method="get" action="insererville.php">
        <input type="text" id="tata" name="ville"/>
        <input type="submit" value="Submit">
    </form>
    <script>


    function autocompVille(){
        var depart1 = (document.getElementById("tata"));
        var autocomplete = new google.maps.places.Autocomplete(depart1);
    }


    $("#tata").autocomplete({
        source: [ "Grenoble, France", "Lyon, France", "Chambéry, France", "Chambéry, France", "Paris, France", "Valence, France", "Gières, France" ],
        response: function(event, ui)
		{
            // ui.content is the array that's about to be sent to the response callback.
            document.getElementById('toto').innerHTML = ui.content.length;
            if (ui.content.length === 0)
			{
				$("#tata").autocomplete({
					source : 'source_villesAvion.php',
					response: function(event, ui)
					{
						if (ui.content.length === 0)
						{
							autocompVille();
						}
					}
				});
			}
		}
	});

        </script>
        
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDprc5sfu1qrH8ChZ18E3q8_xijqIOTJGQ&signed_in=true&libraries=places&callback=initMap" async defer></script>
</body>
</html>

