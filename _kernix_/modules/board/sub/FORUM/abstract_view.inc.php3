<table border=1 width=500>

 <tr>
  <td colspan=2>

<?php

print("$obj->title");
print(" " . show_date($obj->date));

?>

  </td>
 </tr>

 <tr>
  <td colspan=2>

<?php

print("$obj->content");

?>

  </td>
 </tr>

 <tr>
  <td>

<?php

if (!empty($obj->email))
{
  print("<a href=mailto:$obj->email>$obj->content</a>");
}
else
{
  print("$obj->nickname");
}
?>

  </td>
  <td>

<?php

print("$obj->content");

?>

  </td> 
 </tr>

</table>
