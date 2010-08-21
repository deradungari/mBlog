/* mBlog - Copyright 2010 Lachlan Main <lachlan.main@gmail.com> */
/* Licensed under the GPL version 3 "http://www.gnu.org/licenses/gpl-3.0.html" */

<html>
<body>

<?php
/* Set this to the directory that you have your html files in */
$directory = "./blog_files/";

/* Place html that you want visible on the top of you blog here */

<center><h1>Blah Blog</h1></center>

/* DON'T TOUCH ANYTHING BELOW HERE */


function printFile($file) {
  $handle = fopen("$file", "r");
  while (!feof($handle)) {
    echo fgets($handle) . "<br>";
  }
  echo "<hr>";
  fclose($handle);
}
          
         
          
$files = scandir($directory); 
$number = count($files, 0);
while ($number > 2) {
  $number--; 
  $FileToPrint = $directory . $files["$number"];
  echo $FileToPrint . "<br>";
  printFile("$FileToPrint");
}   
?>  

</body>
</html>
