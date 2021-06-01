<?php
/*****************
 * Initialisatie *
 *****************/

$_srv= $_SERVER['PHP_SELF'];
setlocale (LC_ALL, 'nl_NL');
$_output="";

//toon formulier
/*****************
 *output / verwerking*
 *****************/

if(!isset($_POST['submit']))
{
    //********* Formlulier initialisatie **********
    $_output.= 
        "<h1>Formulier</h1>
        <hr><form method= post action=$_srv>
        <label>Module</label>
        <input type=text name=nm><br><br>
        <label>Begindatum</label>
        <input type=date name=bd placeholder=dd-mm-jjjj><br><br>
        <label>Einddatum</label>
        <input type=date name=ed placeholder=dd-mm-jjjj><br><br>
        <input type=submit name=submit>
        </form></hr>";
} else 

{
//********* Formulier verwerking **********

    $_modNaam= $_POST["nm"]; 

    $_beginDatum= $_POST["bd"];
    
    $_eindDatum= $_POST["ed"];
        
        
//standaard datum-notatie naar individuele variable    
list($_bJaar,$_bMaand,$_bDag) = explode("-",$_beginDatum,3);
    
list($_eJaar,$_eMaand,$_eDag) = explode("-",$_eindDatum,3);

$_beginDatum= strftime("%A %d %B %Y", mktime(0,0,0,$_bMaand, $_bDag, $_bJaar));
$_eindDatum= strftime("%A %d %B %Y", mktime(0,0,0,$_eMaand, $_eDag, $_eJaar));
    
    
//********* gegevens verwerking **********
 
//-----voorbereiding  wegschrijven gegevens------  
  /*
  we kunnen enkel 'arrays' wegschrijven naar een csv daarom kopiëren we hieronder de losse variabelen naar de array $_gegevens*/

$_gegevens[0]= $_modNaam;
$_gegevens[1]= $_beginDatum;
$_gegevens[2]= $_eindDatum;
     
    
//------wegschrijven gegevens---------
// open file 
$_pointer = fopen("modules.csv","a+b")
                 or die ('file kan niet geopend worden');
// schrijf info naar file
fputcsv($_pointer, $_gegevens);
//sluit file
fclose($_pointer);
    
//-----voorbereiding output --> boodschap naar gebruiker
    $_output.="<p>Module $_modNaam werd opgeslagen.";
//  link om de volgende in te geven
    $_output.="&nbsp;&nbsp;&nbsp;&nbsp;<a href=$_srv>&lt;volgende&gt;</a></p>";
}

//link naat het output-script
$_output.="<hr><a href=modOutput.php>&lt;toon alle&gt</a></hr>";

/*****************
 *   output      *
 *****************/


echo($_output);
?>