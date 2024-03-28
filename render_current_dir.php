<?php
// USE -r to render directly

// $path_to_blender: leave empty if the blender executable is defined/aliased in your terminal. 
// Else set the correct path.
// for MacOS the following should work "/Applications/Blender/blender.app/Contents/MacOS/blender"
$path_to_blender = ""; 

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
sort($files);

$lastdir = getcwd();
$lastdir = explode('/', $lastdir);
$lastdir = end($lastdir);

foreach($files as $file){
	
	if($path_to_blender){
		$blenderexec = $path_to_blender;
	}else{
		$blenderexec = "blender";
	}
    
	$options = getopt("r::");
	if(isset($options['r'])){
		$string = $blenderexec.' -b '.$file.' -x 1 -a';
		passthru($string);
	}else{
		$string = $blenderexec.' -b '.$file.' -x 1 -a';
		$out[] = $string;
	}
	
}
if(isset($options['r'])){
	echo "\n\n".count($files)." .blend files rendered";
}else{
	echo "\n\n"."Copy and paste the following into the terminal and hit enter:"."\n".implode(' && ',$out)."\n\n";
}