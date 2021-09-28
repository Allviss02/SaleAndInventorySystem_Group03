<?php
//before we store information of our member, we need to start first the session
	
	session_start();
	
	
            #2. Check session 

            if(!isset($_SESSION["Staff_ID"])):
                header("location: login.php");
            endif;
        
?>