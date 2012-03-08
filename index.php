<!--  mBlog - Copyright 2012 Lachlan Main <lachlan.main@gmail.com> 
      Licensed under the GPL version 3 "http://www.gnu.org/licenses/gpl-3.0.html" -->

<!doctype html>
<html>
<?php

# Import markdown
require_once("markdown.php");

# Set this to the directory that you have your html files in, must end with a /
$directory = "./docs/";

# Set this to the title of your blog
$title = "mBlog";

# Set to the location of your css file
$css = "style.css";

echo "<head>\n  <title>" . $title . "</title>\n  <link rel=\"stylesheet\" type=\"text/css\" href=\"$css\" />\n</head>\n\n";
echo "<body>\n";
# Place html that you want visible on the top of your blog here

echo <<<EOH
<header>
Just another mBlog
</header>\n\n
EOH;


# DON'T MODIFY ANYTHING BELOW HERE

# printFile processes the file given
function printFile($filename) {

  # Check to see whether to process with markdown or not
  if (preg_match("/\.md$/i", $filename) == 1) {

    # Process with markdown
    echo "<article>\n" . Markdown(file_get_contents($filename));

  } elseif (preg_match("/\.html$/", $filename)) {

    # Print out the entire file
    echo file_get_contents($filename);

  }

  # Print a horizontal line accross the page
  echo "</article>\n";
}

# Get a list all of the files in the directory
$files = scandir($directory);

$i = count($files, 0);
for (; $i > 2; $i--) {

  # Get the name of the file to print out 
  $FileToPrint = $directory . $files[$i - 1];

  # Print the file
  printFile("$FileToPrint");
}   
?>
</body>
</html>
