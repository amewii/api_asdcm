<?php

	include "vendor/autoload.php";
	use Hrmisapi\Hrmisapi;

	$url ="https://perkongsiandata.eghrmis.gov.my/wsintegrasi/dataservice.asmx";
	$username ="761114145723";
	$password ="safian@123";
	$hrmis = new Hrmisapi($url, $username, $password);
	$respon = $hrmis->GetDataXMLByIC(['icno'=>$_REQUEST['ic'],'datatypes'=>['NamaAgensi'=>'INTAN']])->arr();

	$data = $respon['soap:Envelope']['soap:Body']['GetDataXMLbyICResponse']['GetDataXMLbyICResult']['diffgr:diffgram']['NewDataSet'];


	if($data)
	{		
		$value = array();
		$a = count($data['Table']);
	 	
	 	if(in_array($a, array(15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30))) // maksudnya data staff baru
	 	{
	 		$value = $data['Table'];
	 	}
	 	else // maksudnya data staff lama (ada 2 noic)
	 	{ 
			$datatable = $data['Table'][0];
			if ($datatable['JenisNoKP'] == "Baru")
			{
				$value = $datatable;
			}
			else {
				$value = $data['Table'][1];
			}
		
		}
	}

	public function checkEZXS($ic)
	{
		$url = "http://10.1.3.152/ezxs_webservice/index.php?ic=".$ic;
		$data= json_decode(file_get_contents($url), true);
	}
?>