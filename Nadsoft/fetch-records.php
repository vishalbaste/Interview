<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Origin: *");

$responce = [
    'status'    =>  false,
    'data'      =>  [],
    'massage'   =>  'Data fetching was unsuccessful.',
];

try
{
    require('db.php');

    $data = $db->select("SELECT `id`,`Name`,`ParentId` FROM `tbl_members`");

    if($data !== false && !empty($data))
    {
        $responce = [
            'status'    =>  true,
            'data'      =>  $data,
            'massage'   =>  'Data fetching was successful.',
        ];
    }

    echo json_encode($responce);
}
catch(Exception | Error $e)
{
    echo json_encode($responce);
}