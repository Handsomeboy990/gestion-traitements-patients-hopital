<?php
$liste_medicaments = get_liste_medicaments();
?>



<?php if ((isset($liste_medicaments) && !empty($liste_medicaments))) {

    ?>
    <select name="specialite" required="required" title ="Selectionner la spécialité du médecin" class="form-control" placeholder="Selectionner la spécialité du médecin">

        <option   value="Généraliste">Tout</option>
        <?php

            foreach ($liste_medicaments as $medicament) {
        ?>

        <option value="<?= (isset($donnees["nommed"]) && !empty($donnees["nommed"])) ? $donnees["nommed"] : ""; ?><?= $medicament["nommed"]; ?></option>
        
        <?php
        }

        ?>

<?php                    
}
?>
















<label>Veuillez choisir un ou plusieurs animaux :
  <select name="pets" multiple size="4">
    <optgroup label="Animaux à 4-jambes">
      <option value="Chien">Chien</option>
      <option value="chat">Chat</option>
      <option value="hamster" disabled>Hamster</option>
    </optgroup>
    <optgroup label="Animaux volants">
      <option value="perroquet">Perroquet</option>
      <option value="macaw">Macaw</option>
      <option value="albatros">Albatros</option>
    </optgroup>
  </select>
</label>
4










<label for="choix_bieres">Indiquez votre bière préférée :</label>
<input list="bieres" type="text" id="choix_bieres">
<datalist id="bieres">
  <option value="Meteor">
  <option value="Pils">
  <option value="Kronenbourg">
  <option value="Grimbergen">
</datalist>



<p>
  <label for="choix_bieres">Indiquez votre bière préférée :</label>
  <input list="bieres" type="text" id="choix_bieres">
</p>

<p>
  <label for="choix_bieres_ami">Indiquez le choix de votre ami :</label>
  <input list="bieres" type="text" id="choix_bieres_ami">
  <datalist id="bieres">
    <option value="Meteor">
    <option value="Pils">
    <option value="Kronenbourg">
    <option value="Grimbergen">
  </datalist>
</p>






<label for="www">Adresse web</label>
<input id="www" type="url" list="urldata" name="adresseweb">
<datalist id="urldata">
  <label for="adresse">ou sélectionner dans la liste</label>
  <select name="adresse" id="adresse">
    <option value="http://www.alsacreations.com/">http://www.alsacreations.com/</option>
    <option value="http://www.bing.com/">http://www.bing.com/</option>
    <option value="http://www.google.fr/">http://www.google.fr/</option>
    <option value="http://www.yahoo.fr/">http://www.yahoo.fr/</option>
  </select>
</datalist>







<br>



<input type="checkbox" cols="8">
   <nom>langue</nom>
   <libellé>Quelles langues parles-vous ?</libellé>
   <option valeur="fr">Français</option>
   <option valeur="nl">Néerlandais</option>
   <option valeur="en">Anglais</option>
   <option valeur="other">Autre</option>
</input>






<br>


<br>


<br> 
<br>



<select multiple class=form-control>
 <option value=un>Un</option>
 <option value=deux>Deux</option>
 <option value=trois>Trois</option>
</select>





<br>









<?php
    $formated_DATETIME = date('Y-m-d H:i:s');
    echo $formated_DATETIME. "<br>";
    // 2021-10-27 14:02:16
    $formated_DATE = date('Y-m-d');
    echo $formated_DATE. "<br>";
    // 2021-10-27

    $formated_TIME = date('H:i:s');
    echo $formated_TIME. "<br>";
    //14:03:57

    $formated_YEAR = date('Y');
    echo $formated_YEAR. "<br>";
    // 2021

