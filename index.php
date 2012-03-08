<!--  mBlog - Copyright 2012 Lachlan Main <lachlan.main@gmail.com> 
      Licensed under the GPL version 3 "http://www.gnu.org/licenses/gpl-3.0.html" -->

<!doctype html>
<html>
<?php

# Import markdown
require_once("markdown.php");

# Set this to the directory that you have your html files in
$directory = "./docs/";

# Set this to the title of your blog
$title = "mBlog";

# Place html that you want visible on the top of you blog here

echo "<head><title><h1>" . $title . "</h1></title></head>";
echo "<body>";


# DON'T MODIFY ANYTHING BELOW HERE

# printFile processes the file given
function printFile($filename) {

  # Check to see whether to process with markdown or not
  if (preg_match("/\.md$/i", $filename) == 1) {

    # Process with markdown
    echo Markdown(file_get_contents($filename));

  } elseif (preg_match("/\.html$/", $filename)) {

    # Print out the entire file
    echo file_get_contents($filename);

  }

  # Print a horizontal line accross the page
  echo "<hr />";
}

# Get a list all of the files in the directory
$files = scandir($directory);

$i = count($files, 0);
for (; $i > 1; $i--) {

  # Get the name of the file to print out 
  $FileToPrint = $directory . "/" .  $files[$i - 1];

  # Print the name of the file
  echo $FileToPrint . "<br />";

  # Print the file
  printFile("$FileToPrint");
}   
?>  

</body>
</html>
