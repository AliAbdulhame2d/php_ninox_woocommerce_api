

<?php

/**.@author Ali Abdulhameed 31.01.2026
 * Inegration between Ninox and Mysql database
 * Dummy code, only for training
 **/

error_reporting(E_ERROR | E_PARSE);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');
header('Access-Control-Allow-Headers: append,delete,entries,foreach,get,has,keys,set,values,Authorization,Content-Type');
header('Content-Type: text/html; charset=UTF-8');
header("Access-Control-Max-Age: 3600"); 
setlocale(LC_ALL, 'de_DE');
set_time_limit(0);


use Automattic\WooCommerce\Client;
use Automattic\WooCommerce\HttpClient\HttpClientException;

require __DIR__ . '/../vendor/autoload.php';
$config = require __DIR__ . '/config.php';

class testClass {

    public $woocommerce;
    public $client;
    public $sqlConn;
    public $imgUrl;
    public $open = true;
    public $collector = [];

    public function __construct($config)
    {
        $this->imgUrl = __DIR__ . "/imgs";

        // WooCommerce
        $this->woocommerce = new Client(
            $config['woo_url'],
            $config['woo_key'],
            $config['woo_secret'],
            [
                'version' => 'wc/v3'
            ]
        );

        // Ninox
        $this->client = new Ninox(
            $config['ninox_key'],
            $config['ninox_team'],
            $config['ninox_db'],
            $config['ninox_url']
        );

        // MySQL
        $this->sqlConn = new mysqli(
            $config['db_host'],
            $config['db_user'],
            $config['db_pass'],
            $config['db_name']
        );

        if ($this->sqlConn->connect_error) {
            throw new \Exception("Mysql connection failed");
        }

        $this->sqlConn->set_charset('utf8');
    }


	
	//get product from Ninox database
	function getNxProduct($productId,&$product){
		//get data from x table
		$product=$this->client->getData("/tables/x/records/".$productId);

		if (!isset($product['fields'])) {
			throw new Exception("Invalid Ninox response");
		}

		$fields=$product['fields'];
		
        $nxproduct = [
				'name' => $fields['Artikelname'],
				'type' => $fields['Artikeltyp'],
				'regular_price' => $fields['Preis'],
			];


		return $nxproduct;
	}

	//insert product in Mysql database
	function addWooProduct($product, $productId){

	$query_result=$this->woocommerce->post('products', $product);

	if(!is_null($query_result)){
					
					echo "\n";
					echo "the product with ID: ".$productId." added. ";
	}

}

}//END OF CLASS




//Creat object from Class
$obj=new testClass($config);

//take the product from Ninox database und print data
$productId=10;
$ninox_prdct=$obj->getNxProduct($productId, $product);
$result="The Product ".$productId." with Katigorie:".$product['fields']['Artikelkategorie']." ist: ".$ninox_prdct;
print_r($result);

//insert Ninox product in Mysql database
$obj->addWooProduct($ninox_prdct, $productId);


		