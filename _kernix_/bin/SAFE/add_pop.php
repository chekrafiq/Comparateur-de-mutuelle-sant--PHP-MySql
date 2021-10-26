<?php

// php  -c /etc/kernix  -q add_pop.php

function genpass($n=8)
{
  $out = '';
  for ($i=1;$i<=$n;$i++)
    $out .= seedchar();
  return $out;
}

mt_srand((double)microtime()*1000000);

function seedchar()
{
  $str  = 'abcdefghijklmnopqrstuvwxyz';
  $str .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $str .= '0123456789';
  return $str[mt_rand(0,61)];
}

$tab[] = "ad.david,adpassword";
$tab[] = "ad.katty,adpassword";
$tab[] = "ad.carine,adpassword";
$tab[] = "ad.documentation,adpassword";
$tab[] = "ad.valerie,adpassword";
$tab[] = "ad.thierry,adpassword";
$tab[] = "ad.benjamin,adpassword";
$tab[] = "ad.euro,adpassword";
$tab[] = "ad.emmanuel,adpassword";

foreach ($tab as $tmp)
{
  list ($login, $password) = split(',', $tmp);
  if (empty($password)) $password = genpass();
  $str .= "$login:$password\n";
  $cpassword = crypt($password, seedchar().seedchar());
  echo "useradd -g popusers -s /dev/null -p $cpassword -d /home/pop/$login $login\n";
}

echo "\n\n$str\n";

?>
