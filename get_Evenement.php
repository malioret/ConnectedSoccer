
<?php
    unset($_GET);
    /*$_POST['nom']='toto';
    $_POST['date']='toto';
    $_POST['lieu']='toto';*/
      
        if (!@mysql_connect('mysql-pwm1cl.alwaysdata.net', 'pwm1cl', 'pwm1cl')) { error(1); }

	    if (!mysql_select_db('pwm1cl_footdb')) { error(2); }

        unset($_POST);

        $result = get_Evenement($nom, $date,$lieu);
        if($result == -1) {
            error(3);
        } else {
            //print_r($result);
            echo json_encode($result);
        }
        

    function error($ec) {
        printf('    <error value="%d"/>'."\n".'</login>',$ec);
        die();
    }

    function get_Evenement($nom, $date,$lieu) {
        $params=" WHERE ";
        $cpt=0;
        if(!empty($nom) && isset($_POST['nom']) )
        {
            if(get_magic_quotes_gpc()) 
            {
                $nom = stripslashes($_POST['nom']);
            }
            else
            {
                $nom = $_POST['nom'];
            }
            
            $params+=" `Nom`='".$nom."'";
            $cpt++;
        }
        if(!empty($date) && isset($_POST['date']) )
        {
            if(get_magic_quotes_gpc()) 
            {
                $date  = stripslashes($_POST['date']);
            }
            else
            {
                $date  = $_POST['date'];
            }
            
            $params+=" `Date`='".$date."'";
            if($cpt>0)
            {
                $params+=" AND ";
            }
        }
        if(!empty($lieu) && isset($_POST['lieu']) )
        {
            if(get_magic_quotes_gpc()) 
            {
                $lieu  = stripslashes($_POST['lieu']);
            } 
            else 
            {
                $lieu  = $_POST['lieu'];
            }
            
            $params+=" `Lieu`='".$lieu."'";
        }
        
        if($cpt>0)
        {
	        $get = "SELECT * FROM `Event2` "+$params;;
        }
        else
        {
            $get = "SELECT * FROM `Event2` ";
        }
	
        $result = mysql_query($get);
       
        if(mysql_num_rows($result) != 1) { return -1; }
       
        $row = mysql_fetch_row($result);
         return $row;
         
    }
?>
