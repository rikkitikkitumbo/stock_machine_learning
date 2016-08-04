<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: text/event-stream');
// recommended to prevent caching of event data.
header('Cache-Control: no-cache'); 


//----------function to show progress of our download (we are sending a message from our php server so javascript can use it)
function send_message($message) {
    $d = array('message' => $message);
    echo "data: " . json_encode($d) . PHP_EOL;
    echo PHP_EOL;
    ob_flush();
    flush();
}
  


//---------------get our list of stocks that we want to collect data for
$symbol_array = array();
$stockListFile = fopen("stockList.txt", "r");
if ($stockListFile) {
    while (($line = fgets($stockListFile)) !== false) {
        array_push($symbol_array,trim($line));
    }
  fclose($stockListFile);
}


//-------------get the yahoo finance data and parse into its different catagories, and then store into our database (of txt files)
for($j=0;$j<count($symbol_array);$j++)
{
  $symbol = $symbol_array[$j];
  $yahoo_api_data = file_get_contents("http://ichart.finance.yahoo.com/table.csv?s=".$symbol_array[$j]."&a=01&b=01&c=2006");
  $stockFile = fopen('stockData/'.$symbol.'.txt','w') or die('nope');
  fwrite($stockFile,$yahoo_api_data);
  fclose($stockFile);
  send_message('Data stored for '.$symbol);
  send_message(($j/count($symbol_array))*100 . '% done overall');
}

send_message('CLOSE');

?>
