$(document).ready(function () {
    requete10Derniers();
    requeteDernier();
   
    $("#getSimple").click(function () {
        console.log($("#magnSeuleGet").val());
        $.ajax({
            url: "WSAjouterSeismeSimpleGET.php?magn=" + $("#magnSeule").val(),
            dataType: "json",
            success: function (json) {
                alert(json.succes);
                requete10Derniers()

            },
            error: function (blabla) {
                alert(blabla.responseText);

            }
        });
    });
    $("#postSimple").click(function () {
        console.log($("#magnSeulePost").val());
        $.ajax({
            url: "WSAjouterSeismeSimplePOST.php",
            dataType: "json",
            type: "POST",
            data: {
                magn: $("#magnSeule").val()
            },
            success: function (json) {
                alert(json.succes);
                requete10Derniers()

            },
            error: function (blabla) {
                alert(blabla.responseText);

            }
        });
    });
    $("#post").click(function () {
        $.ajax({
            url: "WSAjouterSeismePOST.php",
            dataType: "json",
            type: "POST",
            data: {
                date: $("#date").val(),
                heure: $("#heure").val(),
                lat: $("#lat").val(),
                long: $("#long").val(),
                magn: $("#magn").val(),
                prof: $("#prof").val(),
                nbe_stations: $("#nbeStations").val(),
                ville: $("#ville").val(),
                distance: $("#distance").val()
                
            },
            success: function (json) {
                alert(json.succes);
                requete10Derniers()

            },
            error: function (blabla) {
                alert(blabla.responseText);

            }
        });
    })
    $("#get").click(function () {
        $.ajax({
            url: "WSAjouterSeismeGET.php?date=" + $("#date").val() +"&heure=" + $("#heure").val()+ "&lat="+ $("#lat").val() + "&long=" + $("#long").val() +"&magn=" + $("#magn").val() + "&prof=" +$("#prof").val()+"&nbe_stations=" +  $("#nbeStations").val() + "&ville=" + $("#ville").val() + "&distance=" + $("#distance").val(),
            dataType: "json",
            success: function (json) {
                alert(json.succes);
                requete10Derniers()

            },
            error: function (blabla) {
                alert(blabla.responseText);

            }
        });
    })
})



function requete10Derniers() {
    $.ajax({
        url: "WS10Derniers.php",
        dataType: "json",
        success: function (json) {
            $("#tableau10derniers").html("<tr><th>Date et heure</th><th>Latitude</th><th>Longitude</th> <th>Magnitude</th><th>Profondeur</th><th>Nombre de stations</th><th>Ville</th><th>Distance</th></tr>");
            console.log(json);
            for (var i = 0; i < json.length; i++) {
                var ligne = "<tr><td>" + json[i].date_heure + "</td>" + "<td>" + json[i].lat + "°</td>" + "<td>" + json[i].long + "°</td>" + "<td>" + json[i].magn + "</td>" + "<td>" + json[i].prof + "km</td>" + "<td>" + json[i].nbe_stations + "</td>" + "<td>" + json[i].ville + "</td>" + "<td>" + json[i].distance + "km</td></tr>";

                $("#tableau10derniers").append(ligne);
            }



        }
    });
}


function requeteDernier() {
    enneigement = [];
    chute = [];
    $.ajax({
        url: "WSTempsReel.php",
        dataType: "json",
        success: function (json) {
            console.log(json);
            var ligne = "Le <strong>" + json.date_heure + "</strong> à " + json.distance + "km de <strong>" + json.ville + "</strong> ( " + json.lat + ", " + json.long + "), " + "séisme de magnitude <strong>" + json.magn + "</strong> à " + json.prof + "km de profondeur mesuré par " + json.nbe_stations + " stations";
            console.log(ligne);
            $("#dernier").html(ligne);





        }
    });
}
