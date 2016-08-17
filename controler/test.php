<?php include("../view/template/top.view.php"); ?>

<body>

    <?php include("../view/template/menu.view.php"); ?>
    <br><br><br><br>
    <div id="toto"></div>
    <form method="get" action="insererville.php">
        <input type="text" id="tata" name="ville"/>
        <input type="submit" value="Submit">
    </form>
    <div id="toto"></div>
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
					source : '../view/source.php',
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
        <?php
        include("../view/template/bottom.view.php");
        ?>
