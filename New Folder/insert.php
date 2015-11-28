<?php
  

    unset($_GET);
    
    
    if(isset($_POST)) {


    // connection à la base de données 
        if (!@mysql_connect('mysql-pwm1cl.alwaysdata.net', 'pwm1cl', 'pwm1cl')) { error(1); }

	// database représente le nom d ela base de données
	    if (!mysql_select_db('pwm1cl_footdb')) { error(2); }

    $insert_request = 'INSERT INTO '.$_POST['table'].' VALUES ';
    foreach ($_POST as $key->$value )
    {
        if($key!='table')
       // $insert_request .=   
    }
    

        unset($_POST);

        $kid = login($login, $pass);
        if($kid == -1) {
            error(3);
        } else {
            //printf('    <user id="%d"/>'."\n",$kid);
          //  print_r($kid);
        }

       // echo "</login>";
    }

    function error($ec) {
        printf('    <error value="%d"/>'."\n".'</login>',$ec);
        die();
    }

    function login($login, $pass) {
        $select2 = "
		    SELECT user_id
		    FROM auth_table
		    WHERE username = '%".$login."%'";
		$select_t = "
		    SELECT *
		    FROM auth_table
			";
					$select = "
		INSERT INTO `matable`(`champ`) VALUES ('".$login."')
			";
	
        $result = mysql_query($select);
       
      
    }
?>
