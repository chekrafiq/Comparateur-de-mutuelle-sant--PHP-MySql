<?php

function getFileList( $dirname ) 
{
     $dir = opendir( $dirname );
     if ( ! $dir ) 
     { 
	  return null; 
     }
     while( $file = readdir( $dir ) ) 
     {
	  if (ereg( "^\.$",$file) || ereg("^\.\.$", $file) || is_dir("$dirname/$file")) 
	  {
//	    print("pb->$file<br>");
	    continue;
	  }
	  $files[] = $file;
     }
     closedir($dir);
     return $files;
}

function getDirList($dirname,$path) 
{
  global $tab_dir;
  error_log($dirname);

  $dir = opendir( $dirname );
  if (!$dir) 
  { 
    return null; 
  }
  while( $file = readdir( $dir ) ) 
  {
    if (ereg( "^\.$",$file) || ereg("^\.\.$", $file) || !is_dir("$dirname/$file")) 
    {
      continue;
    }
    $files[] = $file;
    $tab_dir[] = "$path$file";
    getDirList("$dirname/$file","$path$file/"); 
  }
  closedir($dir);
  return 1;
//  return $files;
}

?>
