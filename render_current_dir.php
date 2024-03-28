<?php

$path_to_blender = ""; // for MacOS the following should work (depending on the location of you blender executable) "/Applications/Blender/blender.app/Contents/MacOS/blender"

function extention($filename){
	if(strrpos($filename, ".")!==false){
		return substr($filename, strrpos($filename, "."));
	}else{
		return "";
	}
}
/* list al the files & folders in a given directory */
//----------------------------------------------------
function list_directory($directory, $onlyfiles = false, $onlydirs = false, $fillupkeys = false, $appendtovals = "", $restrictextention = null){
	$results = array();
	if(! file_exists($directory)){
		return $results;
	}
	if(! is_dir($directory)){
		return $results;
	}
	$handler = opendir($directory);
	while($file = readdir($handler)){
		$ext = extention($file);
		if($file!='.' && $file!='..' && substr($file, 0, 1)!="." && (($onlyfiles && is_file($directory.'/'.$file)) || ! $onlyfiles) && (($onlydirs && is_dir($directory.'/'.$file)) || ! $onlydirs) && (! $restrictextention || ($ext==$restrictextention))){
			$point = strrpos($file, '.');
			if($fillupkeys){
				$results[$file.$appendtovals] = $file.$appendtovals;
			}else{
				$results[] = $file.$appendtovals;
			}
		}
	}
	closedir($handler);
	return $results;
}


$files = list_directory(getcwd(),true,false,false,"",'.blend');

$lastdir = getcwd();
$lastdir = explode('/', $lastdir);
$lastdir = end($lastdir);

foreach($files as $file){
	
	if($path_to_blender){
		$blenderexec = $path_to_blender;
	}else{
		$blenderexec = "blender";
	}
    
	$string = $blenderexec.' -b '.$file.' -x 1 -a';
	$out[] = $string;
}

echo "\n\n"."Copy and paste the following into the terminal and hit enter:"."\n".implode(' && ',$out)."\n\n";