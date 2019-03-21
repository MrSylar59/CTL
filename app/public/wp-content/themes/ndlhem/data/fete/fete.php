<?php
  ///////////////////////////////////////////////////////////////////////////////
  // Fichier: fete.php                                                         //
  // Version: 1.00 - Dernière modification: Samedi 1er Janvier 2005            //
  //                  http://www.jerome-desmoulins.new.fr                      //
  // Auteur:  Jérôme DESMOULINS (http://www.jerome-desmoulins.new.fr)          //
  // Description:                                                              //
  //   Ce script affiche, la fête correspondante à aujourd'hui.                //
  //   Pour l'utiliser il suffit de placer include("fete.php"); dans un script //
  //   Attention: le fichier fete.txt doit se trouver dans le repertoire       //
  ///////////////////////////////////////////////////////////////////////////////

  function get_fete(){
    // Récupération de la date actuelle
    $jour=date("d");
    $mois=date("n");

    // Recherche de cette date dans le fichier de données
    $fp=fopen(get_theme_file_uri("/data/fete/fete.txt"),"r");
    while ( !feof($fp) )
    {
      $ligne=fgets($fp,255);
      // On extrait le prénom fêté
      $pos=strpos($ligne,';');
      $prenom=substr($ligne,0,$pos);
      $ligne=substr($ligne,$pos+1,strlen($ligne)-$pos);
      // Le jour de cette fête
      $pos=strpos($ligne,';');
      $jourtrouve=substr($ligne,0,$pos);
      // Le mois de cette fête
      $moistrouve=substr($ligne,$pos+1,strlen($ligne)-$pos-3);
      $moistrouveBis=substr($ligne,$pos+1,strlen($ligne)-$pos-2);

      // Si on la trouve, on affiche la fête du jour
      if (($jour==$jourtrouve) && ($mois==$moistrouve||$mois==$moistrouveBis))
      {
        return $prenom;
      }
    }
    fclose($fp);
  }
?>
