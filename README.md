# blender-render-directory
This is a commandline tool, written in PHP for rendering multiple Blender (.blend) files in batch.  
It searches the directory it resides in for .blend files and starts rendering them in alphabetical order (when using the -r option)
Or it returns a string that can be copied into your terminal to start the render. 
Basically it just rigs the render command for every .blend file together with "&&".  

This way, you can safely go to bed, while all your .blend files are sequentially rendered.

## Dependencies 
- You need a version of [PHP](https://www.php.com) installed on your system. Versions 5 and up should work.
- PHP needs to be accessible through your terminal (defined in PATH).

- A version of [Blender](https://www.blender.org) needs to be installed on your system.
- Blender needs to be accessed through your terminal:
	- OR define blender in your PATH.  
	More info can be found in [Blenders manual](https://docs.blender.org/manual/en/latest/advanced/command_line/launch/index.html#command-line-launch-index).  
	For MacOS just copy this into your terminal: **echo "alias blender='/Applications/Blender/Blender.app/Contents/MacOS/Blender'"  >> \~/.zshrc && source \~/.zshrc**
	- OR put the path of the blender executable into the the variable **$path_to_blender** at the top of the **render_current_dir.php** script.


## Usage 1: Direct rendering

1. Copy this script into the directory in which your .blend files you want to render are located.
2. Open the terminal at this directory, or navigate to it.
3. In your terminal type:

    > **php render_current_dir.php -r** 
	
4. Rendering starts instantly. 
 
5. (Use ctrl+c to cancel the rendering in case of emergency)

## Usage 2: Copy and paste

1. Copy this script into the directory in which your .blend files you want to render are located.
2. Open the terminal at this directory, or navigate to it.
3. In your terminal type:

	> **php render_current_dir.php** 
	
4. Copy the output back into the terminal an press enter.
 
5. (Use ctrl+c to cancel the rendering in case of emergency)