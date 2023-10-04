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
    if(!empty($_POST['mname']))
    {
        $status = $db->insert("INSERT INTO `tbl_members`(`Name`, `ParentId`) VALUES (:name,:parent)",[
            ':name'     =>  $_POST['mname'],
            ':parent'   =>  !empty($_POST['parent']) ? $_POST['parent'] : null
        ]);

        if($status !== false)
        {
            $responce = [
                'status'    =>  true,
                'data'      =>  [],
                'massage'   =>  'Data fetching was successfully.',
            ];
        }

        echo json_encode($responce);
    }
}
catch(Exception | Error $e)
{
    echo json_encode($responce);
}