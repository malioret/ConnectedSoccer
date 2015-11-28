<?php
  
    unset($_GET);
    /*$_POST['nom']='toto';
    $_POST['date']='toto';
    $_POST['lieu']='toto';*/
    if( isset($_POST['nom']) && isset($_POST['date']) &&  isset($_POST['lieu']) ) {
      
        if (!@mysql_connect('mysql-pwm1cl.alwaysdata.net', 'pwm1cl', 'pwm1cl')) { error(1); }

	    if (!mysql_select_db('pwm1cl_footdb')) { error(2); }

        if(get_magic_quotes_gpc()) {
            $nom = stripslashes($_POST['nom']);
            $date  = stripslashes($_POST['date']);
            $lieu  = stripslashes($_POST['lieu']);
        } 
        else {
            $nom = $_POST['nom'];
            $date  = $_POST['date'];
            $lieu  = $_POST['lieu'];
        }

        unset($_POST);

        $result = insert_Evenement($nom, $date,$lieu);
        if($result == -1) {
            error(3);
        } else {
            //print_r($result);
        }

    }

    function error($ec) {
        printf('    <error value="%d"/>'."\n".'</login>',$ec);
        die();
    }

    function insert_Evenement($nom, $date,$lieu) {
        
	    $insert = "INSERT INTO `Event2`(`Nom`, `Lieu`, `Date`) VALUES ('".$nom."','".$lieu."','".$date."')";
	
        $result = mysql_query($insert);
       
        /*if(mysql_num_rows($result) != 1) { return -1; }
       
        $row = mysql_fetch_row($result);
         return $row;*/
         
    }
?>
