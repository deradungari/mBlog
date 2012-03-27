<!doctype html>
<meta charset="UTF-8">

<!--  mBlog v0.3.2 - Copyright 2012 Lachlan Main <lachlan.main@gmail.com> 
      Licensed under the GPL version 3 "http://www.gnu.org/licenses/gpl-3.0.html" -->

<?php

# Import markdown
require_once("markdown.php");

# Set this to the directory that you have your html files in, must end with a /
$directory = "docs/";

# Set this to the title of your blog
$title = "mBlog";

# Set to the location of your css file
$css = "style.css";

# Change this to 1 if you want your posts sorted the other way
$sortOrder = 0;

# Change to the url of this mBlog installation
$url = "http://127.0.0.1/Programming/mBlog/";


# DON'T MODIFY ANYTHING BELOW HERE

function printHeader($dir) {

  global $title, $css;

  echo "<title>" . $title . "</title>\n  <link rel=\"stylesheet\" type=\"text/css\" href=\"$css\">\n";
  echo "<body>\n";

  # Place anything that you want visible on the top of your blog here
  echo "<header>$title/$dir</header>";

}

# printFile processes the file given
function printFile($filename) {

  # Check to see whether to process with markdown or not
  if (preg_match("/\.md$/i", $filename) == 1) {

    # Process with markdown
    echo "<article>\n" . Markdown(file_get_contents($filename)) . "\n</article>\n";

  } elseif (preg_match("/\.html$/", $filename)) {

    # Print out the entire file
    echo "<article>\n" . file_get_contents($filename) . "\n</article>\n";

  }

}

function scanDirectory($directory) {

  global $sortOrder;

  # If the client requested a path with a ".." in it, echo an error message and exit
  if (preg_match("/\.\./", $directory) > 0) {
    echo "<section><article><h1>Woops!</h1><p>403 -- You probably shouldn't have done that</p></article></section>";
    exit(1);
  }

  # Get a list of everything in the given directory
  if (FALSE === ($list = scandir($directory, $sortOrder))) {
    echo "<section><article><h1>Woops!</h1><p>500 -- Error while scanning $directory</p></article></section>";
    exit(1);
  }

  # Get the number of items in $list
  $i = count($list, 0);

  $files = array();
  $dirs = array();

  # Process the directory list
  for (; $i > 0; $i--) {

    # If the current element is a file, add it to $files
    if (is_file($directory . $list[$i - 1])) {
    array_push($files, $directory . $list[$i - 1]);

    # If the current element is a directory, add it to $dirs
    } elseif (is_dir($directory . $list[$i - 1]) && $list[$i - 1] != '.' && $list[$i - 1] != '..') {
      array_push($dirs, $list[$i - 1]);
    }
  }

  return array($files, $dirs);
}

function printMenu($dirs) {

  global $dir;

  echo "<nav><ul>\n<li><a href=\"" . $_SERVER['SCRIPT_NAME'] . "\">~home</a></li>";

  $i = count($dirs, 0);

  # Print out all of the directories
  for (; $i > 0; $i--) {

    # Add the directory to the menu
    echo "  <li><a href=\"" . $_SERVER['SCRIPT_NAME'] . "?dir=" . $dir . $dirs[$i - 1] . "/\">" . $dirs[$i - 1] . "/  </a></li>\n";
  }

  echo "</nav>";

}

function printPosts($filesToPrint) {

  echo "<section>";

  $i = count($filesToPrint, 0);

  # Print out all of the files
  for (; $i > 0; $i--) {

    # Print the files
    printFile($filesToPrint[$i - 1]);

  }

  echo "</section>";

}

$dir = '';

# Get the directory to go into
if (array_key_exists('dir', $_GET)) {
  $dir = $_GET['dir'];
  $directory = $directory . $dir;
}

list($files, $dirs) = scanDirectory($directory);
printHeader($dir);
printMenu($dirs);
printPosts($files);

?>
</body>
</html>
