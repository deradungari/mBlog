<!--  mBlog - Copyright 2012 Lachlan Main <lachlan.main@gmail.com> 
      Licensed under the GPL version 3 "http://www.gnu.org/licenses/gpl-3.0.html" -->

<html>
  <head>
    <title>mBlog</title>
  <head>
<body>

<?php

# Import markdown
require_once("markdown.php");

# Set this to the directory that you have your html files in
$directory = "./blog_files/";

# Set this to the title of your blog
$title = "mBlog";

# Place html that you want visible on the top of you blog here

echo "<head><title><h1>" . $title . "</h1></title></head>";


# DON'T MODIFY ANYTHING BELOW HERE

# printFile processes the file given
function printFile($file) {

  # Check to see whether to process with markdown or not
  if (preg_match("\.md$") == 1) {

    # Process with markdown
    echo Markdown(file_get_contents($file));

  } else if (preg_match("\.html$", $fileName) {

    # Print out the entire file
    echo file_get_contents($filename);

  }

  # Print a horizontal line accross the page
  echo "<hr>";
}


# Get a list all of the files in the directory
$files = scandir($directory);

while ($i = count($files, 0); $i > 2; i--) {

  # Get the name of the file to print out 
  $FileToPrint = $directory . $files["$number"];

  # Print the name of the file
  echo $FileToPrint . "<br>";

  # Print the file
  printFile("$FileToPrint");
}   
?>  

</body>
</html>
