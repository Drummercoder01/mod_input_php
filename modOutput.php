<?php

/*****************
 * Initialisatie *
 *****************/
$_output= "<h1>Tabellen:</h1>";
//setlocale(LC_ALL, 'nl_NL');

/*****************
 * Verwerking    *
 *****************/

//------uitlezen gegevens---------
// open file 
$_pointer = fopen("modules.csv","rb") 
    or die("openen mislukt");

// lees alle records/lijnen --> tot end-of-file (feof)
while (! feof($_pointer))
{
// zet de geleven array (fgetcsv) om naar inidividuele variabelen
    list($_modNaam, $_beginDatum, $_eindDatum) = fgetcsv($_pointer);
    
    if ($_modNaam != "")
    {                           
        $_output.="<table border=1>
    <tr>
        <td rowspan=2>$_modNaam</td>
        <td>$_beginDatum</td>
    </tr>
    <tr>
        <td>$_eindDatum</td>
    </tr>
    
    </table>";

    }
}
//sluit file
fclose($_pointer);


// vervolledig output met een link naar het invoer-script
$_output.="<hr><a href=modInput.php>&lt;invoeren&gt;</a></hr>";
    

//----- output --> boodschap naar gebruiker
    

echo($_output);
?>