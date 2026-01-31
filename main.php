

<?php
// Author Ali Abdulhameed 31.01.2026
// Inegration between Ninox and Mysql database
// Dummy code, only for training

error_reporting(E_ERROR | E_PARSE);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');
header('Access-Control-Allow-Headers: append,delete,entries,foreach,get,has,keys,set,values,Authorization,Content-Type');
header('Content-Type: text/html; charset=UTF-8');
header("Access-Control-Max-Age: 3600"); 
setlocale(LC_ALL, 'de_DE');
set_time_limit(0);

require "./config/bootstrap.php";
use Automattic\WooCommerce\HttpClient\HttpClientException;

class testClass {

 public $client;
 public $sqlConn;
 public $imgUrl=__DIR__ ."/../../imgs";
 public $open=true;
 public $collector=array();



 public function __construct() {
	
	//Ninox connection setting
	$api_key = "";
	$team_id = "";
	$db_id = "";
	$Url= "";

   $this->client=new Ninox($api_key, $team_id, $db_id, $Url);
 	if(is_null($this->client)){
		echo "Faild to connect to Ninox dataBase\n\n";
		exit();
		}else
		echo "Success connect to Ninox dataBase\n\n";

    //Mysql connection setting
    $servername = "localhost";
	$username = "";
	$password = "";
	$dbname = "";

	// Create mysqli connection
	$this->sqlConn = new mysqli($servername, $username, $password, $dbname);
	mysqli_set_charset('utf8',$this->sqlConn);
	// Check connection
	if ($this->sqlConn->connect_error) {
	  die("Connection failed to Mysql DB: " . $this->sqlConn->connect_error);
	}


	}


	function getProduct($productId,&$product){
		//get data from x table
		$product=$this->client->getData("/tables/x/records/".$productId);
		$fields=$product['fields'];

        $nxproduct = [
				'name' => $fields['Artikelname'],
				'type' => $fields['Artikeltyp'],
				'regular_price' =>$fields['Preis'] ?? 0,
			];


		return $nxproduct;
	}
}//END OF CLASS




//Creat object from Class
$obj=new testClass();

//take und print data
$id=10;
$nxPrdct=$obj>getProduct($id);
$result="The Product "+ $id +" with Katigorie:"+$product['fields']['Artikelkategorie']+" ist: " + $nxPrdct;
print_r($result);


		