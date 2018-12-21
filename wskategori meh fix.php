<?php
	//setting namespace
	$ns = "http://".$_SERVER['HTTP_HOST']."/wsperpus/wskategori.php";
	require_once 'lib/nusoap.php';
	$server = new soap_server;
	//create soap server object
	$server->configureWSDL("WEB SERVICE MENGGUNAKAN SOAP WSDL", $ns);//wsdl configuration
	$server->wsdl->schemaTargetNamespace = $ns; //server namespace
	
	########Kategori BUKU##
	//Complex Array Keya and Type kategori Buku+++++++
	$server->wsdl->addComplexType("kategoriData","complexType","struct","all","",
		array(
		"id_kategori_buku"=>array("name"=>"id_kategori_buku","type"=>"xsd:int"),
		"kategori_buku"=>array("name"=>"kategori_buku","type"=>"xsd:string")
		)
	);
	
	//complex array kategori Buku
	$server->wsdl->addComplexType("kategoriArray","complexType","array","","SOAP-ENC:Array",
		array(),
		array(
			array (
				"ref"=>"SOAP-ENC:arrayType",
				"wsdl:arrayType"=>"tns:kategoriData[]"
			)	
		),
		"kategoriData"
	);
	
	//create kategori buku 
	$input_create = array('kategori_buku' => "xsd:string");
	//parameter create kategori
	$return_create = array("return"=>"xsd:string");
	$server->register('create',
		$input_create,
		$return_create,
		$ns,
		"urn:".$ns."/create",
		"rpc",
		"encoded",
		"Menyimpan Kategori Buku Baru");
	//end create Kategori buku 
	//readbyid kategori buku 
	$input_readbyid = array('id_kategori_buku' => "xsd:string");
	//parameter readbyid kategori
	$return_readbyid = array("return"=>"tns:kategoriArray");
	$server->register('readbyid',
		$input_readbyid,
		$return_readbyid,
		$ns,
		"urn:".$ns."/readbyid",
		"rpc",
		"encoded",
		"Mengambil kategori Buku by id_kategori_buku");
	//end readbyid Kategori buku 
	//update kategori buku 
	$input_update = array('id_kategori_buku' => "xsd:string",
						"kategori_buku"=>"xsd:string");
	//parameter update kategori
	$return_update = array("return"=>"xsd:string");
	$server->register('updatebyid',
		$input_update,
		$return_update,
		$ns,
		"urn:".$ns."/updatebyid",
		"rpc",
		"encoded",
		"Mengapdet kategori by id_kategori_buku");
	//end update Kategori buku 
	//delete kategori buku 
	$input_delete = array('id_kategori_buku' => "xsd:string");
	//parameter delete kategori
	$return_delete = array("return"=>"xsd:string");
	$server->register('deletebyid',
		$input_delete,
		$return_delete,
		$ns,
		"urn:".$ns."/deletebyid",
		"rpc",
		"encoded",
		"Menghapus kategori by id_kategori_buku");
	//end delete Kategori buku
	//Ambil semua data kategori buku 
	$input_readall = array();//parameter ambil data kategori
	$return_readall = array("return"=>"tnd:kategoriArray");
	$server->register('readall',
		$input_readall,
		$return_readall,
		$ns,
		"urn:".$ns."/readall",
		"rpc",
		"encoded",
		"Mengambil semua data kategori by id_kategori_buku");
	// ambil semua Kategori buku
	
	#FUNTION KATEGORI BUKU 
	function create($kategori_buku){
		require_once 'classDb/Classkategori.php';
		$kategori = new Classkategori;
		if ($kategori->create($kategori_buku)){
			$respon = "sukses";
		}else{
			$respon = "error";
		}
		return $respon;
	}
	function readbyid($id_kategori_buku){
		require_once 'classDb/Classkategori.php';
		$kategori = new Classkategori;
		$hasil = $kategori->readbyid($id_kategori_buku);
		$daftar = array();
		while ($item = $hasil->fetch_assoc()) {
			array_push($daftar,array('id_kategori_buku'=>$item['id_kategori_buku'],
										'kategori_buku'=>$item['kategori_buku']));
		}
		return $daftar;
	}
	function readAll(){
		require_once 'classDb/Classkategori.php';
		$kategori = new Classkategori;
		$hasil = $kategori->readAll();
		$daftar = array();
		while ($item = $hasil->fetch_assoc()) {
			array_push($daftar,array('id_kategori_buku'=>$item['id_kategori_buku'],
										'kategori_buku'=>$item['kategori_buku']));
		}
		return $daftar;
	}
	function updatebyid($id_kategori_buku,$kategori_buku){
		require_once 'classDb/Classkategori.php';
		$kategori = new Classkategori;
		if ($kategori->updatebyid($id_kategori_buku,$kategori_buku)){
			$respon = "sukses";
		}else{
			$respon = "error";
		}
		return $respon;
	}
		function deletebyid($id_kategori_buku){
		require_once 'classDb/Classkategori.php';
		$kategori = new Classkategori;
		if ($kategori->deletebyid($id_kategori_buku)){
			$respon = "sukses";
		}else{
			$respon = "error";
		}
		return $respon;
	}
	
	$server->service(file_get_contents("php://input"));
?>