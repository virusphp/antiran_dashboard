<?php
return [
	'api' => [
		'endpoint'  => env('API_BPJS','ENDPOINT-KAMU'),
		'aplicare' => env('API_APLICARE', 'ENDPOINT-KAMU'),
		'consid'  => env('CONS_ID','API-KAMU'),
		'seckey' => env('SECRET_ID', 'API-KAMU'),
	]
];