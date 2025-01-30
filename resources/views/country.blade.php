<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>
    <body>
        <h1>Country</h1>
        @foreach ($resultados as $resultado)
            {{"Code: " . $resultado->Code;}}<br>
            {{"Name: " . $resultado->Name;}}<br>
            {{"Continent: " . $resultado->Continent;}}<br>
            {{"Region: " . $resultado->Region;}}<br>
            {{"SurfaceArea: " . $resultado->SurfaceArea;}}<br>
            {{"IndepYear: " . $resultado->IndepYear;}}<br>
            {{"Population: " . $resultado->Population;}}<br>
            {{"LifeExpectancy: " . $resultado->LifeExpectancy;}}<br>
            {{"GNP: " . $resultado->GNP;}}<br>
            {{"GNPOld: " . $resultado->GNPOld;}}<br>
            {{"LocalName: " . $resultado->LocalName;}}<br>
            {{"GovernmentForm: " . $resultado->GovernmentForm;}}<br>
            {{"HeadOfState: " . $resultado->HeadOfState;}}<br>
            {{"Capital: " . $resultado->Capital;}}<br>
            {{"Code2: " . $resultado->Code2}}<br><br>
        @endforeach
    </body>
</html>