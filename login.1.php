<?php
  
    unset($_GET);
    

    $_POST['username'] = 'toto';
    $_POST['password'] = 'toto';
    
    if( isset($_POST['username']) && isset($_POST['password']) ) {
        
        /*
       echo '<?xml version="1.0"?>'."\n";
       // echo "<login>\n";
       */

    // host doit être remplacé par le serveur de la base de données.
    // user représente le nom d'utilisateur de la base de données.
    // pass est le mot de passe pour accéder à cette base de données avec cette
	// utilisateur.
        if (!@mysql_connect('mysql-pwm1cl.alwaysdata.net', 'pwm1cl', 'pwm1cl')) { error(1); }

	// database représente le nom de la base de données
	    if (!mysql_select_db('pwm1cl_footdb')) { error(2); }

        if(get_magic_quotes_gpc()) {
            $login = stripslashes($_POST['username']);
            $pass  = stripslashes($_POST['password']);
        } else {
            $login = $_POST['username'];
            $pass  = $_POST['password'];
        }

        unset($_POST);

        $kid = login($login, $pass);
        if($kid == -1) {
            error(3);
        } else {
            //printf('    <user id="%d"/>'."\n",$kid);
            print_r($kid);
        }

       // echo "</login>";
    }

    function error($ec) {
        printf('    <error value="%d"/>'."\n".'</login>',$ec);
        die();
    }

    function login($login, $pass) {
        $select2 = "
		    SELECT *
		    FROM auth_table";
		    //WHERE username = '".$login."' AND password='".$pass."'";
	
        $result = mysql_query($select2);
       
        if(mysql_num_rows($result) != 1) { return -1; }
       
        $row = mysql_fetch_row($result);
         return $row;
         
    }
?>
