<?php
//Functions.phpinfo

//clean the form data to prevent injections

/* Built in funcions used
trim()
stripslashes()
htmlspecialchars()
strip_tags()
str_replace()
*/

function validateFormDate($formData){
$formData = trim( stripslashes( htmlspecialchars (strip_tags(str_replace(array(
  '(',')'), '',$formData)), ENT_QUOTES)));
  return $formData;
}

 ?>
