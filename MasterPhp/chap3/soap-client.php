<?php
include 'ServiceFunctions.php';
$options = array(
  'uri' => 'http://ridz.com:8000/masterphp/chap3/',
  'location' => 'http://ridz.com:8000/masterphp/chap3/soap-server.php',
  'trace' => 1);

  try {
    $client = new SoapClient(NULL, $options);
    echo $client->getDisplayName('Joe', 'Bloggs');    echo $client->getLastRequestHeaders();

} catch (Exception $e) {
    echo $e->getMessage();
$functions = $client->__getFunctions();
var_dump($functions);
}
$xml = "<?xml version='1.0'?>
<methodCall>
  <methodName>flickr.groups.pools.getphotos</methodName>
  <params>
    <param>
      <value>
        <struct>
          <member>
            <name>api_key</name>
            <value>secret-key</value>
          </member>
          <member>
            <name>group_id</name>
            <value>610963@N20</value>
          </member>
          <member>
            <name>per_page</name>
            <value>5</value>
          </member>
        </struct>
      </value>
    </param>
  </params>
</methodCall>";

$url = 'http://api.flickr.com/services/xmlrpc/';
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
$responsexml = new SimpleXMLElement($response);
$photosxml = new SimpleXMLElement(
  (string)$responsexml->params->param->value->string);
print_r($photosxml);
