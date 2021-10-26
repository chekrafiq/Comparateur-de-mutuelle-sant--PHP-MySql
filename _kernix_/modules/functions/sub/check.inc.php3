<?php


function is_valid_email ($address) 
{ 
  $rc1 = (ereg('^[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+'. 
	       '@'. 
	       '[-!#$%&\'*+\\/0-9=?A-Z^_`a-z{|}~]+\.'. 
	       '[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+$', 
	       $address)); 
  $rc2 = (preg_match('/.+\.\w\w+$/',$address)); 
  return ($rc1 && $rc2); 
} 


function is_valid_email_old ($address) 
{ 
     return (eregi( 
	  '^[-!#$%&\'*+\\./0-9=?A-Z^_`{|}~]+'.   
	  '@'.                                   
	  '([-0-9A-Z]+\.)+' .                    
	  '([0-9A-Z]){2,4}$',                    
	  $address)); 
} 

?>
