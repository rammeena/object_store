<?php

error_reporting(E_ALL);
ini_set('display_errors', true);
date_default_timezone_set('America/New_York');

require '../vendor/autoload.php';
use Aws\S3\S3Client;

//use Aws\Credentials\CredentialProvider;
$Config['OsRegion'] = '';
$Config['OsVersion'] = '2006-03-01';
$Config['OsEndpoint'] = 'https://s3.virtualstacks.com/';
$Config['use_path_style_endpoint'] = true;
$Config['OsKey'] = 'LWMLPTG9YDFA3TUYAYDI';
$Config['OsSecret'] ='BbdbD0OrVY9Tr17V6tWavbQvTmxIpyS8kmGMiFvt';

// Pass the provider to the client.
$Connection = new S3Client([
   'region'=>$Config['OsRegion'],
    'version'     => $Config['OsVersion'],
    'endpoint' => $Config['OsEndpoint'],
    'use_path_style_endpoint' => true,
    'credentials' => [
        'key'    => $Config['OsKey'],
        'secret' => $Config['OsSecret']
    ],
]);

$bucket ='https-bucket-1';
/**********create bucket***********/
 $info = $Connection->doesBucketExist($bucket);
if(empty($info)) {
	$Result = $Connection->createBucket(['Bucket' => $bucket,'ACL' => 'public-read']);
	echo $Result['statusCode'];die('Bucket Created Succesfully');

}else{
	echo "Bucket already exsist on server.";die;
}
/********************************/

/**********list bucket**********/
$buckets = $Connection->listBuckets();
foreach ($buckets['Buckets'] as $bucket){
    echo $bucket['Name']."<br>";
}
/*******************************/
/**********Upload a file**********
$filepath  = "/var/www/html/object/sdk/SKU423.jpg";
$arrayimage = array(
    'Bucket'       => $bucket,
    'Key'          => 'SKU423.jpg',
    'SourceFile'   => $filepath,
    'ACL'          => 'public-read',

);
$result = $Connection->putObject($arrayimage);

echo $result['ObjectURL']; 

********************************/








