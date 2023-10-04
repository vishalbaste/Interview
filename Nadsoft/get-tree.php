<?php

try
{
    require('db.php');

    $data = $db->select("SELECT `id`,`Name`,`ParentId` FROM `tbl_members`");

    if($data !== false && !empty($data))
    {

        $records=[];

        foreach($data as $id=>$record)
        {

            $records[$record['id']]['name'] = $record['Name'];
            $records[$record['id']]['parent'] = $record['ParentId'];
        }

        function buildView($arr,$parent,$level = 0,$prelevel = -1)
        {
            foreach($arr as $id=>$data)
            {
                if($parent==$data['parent'])
                {
                    if($level>$prelevel)
                    {
                        echo "<ol>";
                    }
                    
                    if($level==$prelevel)
                    {
                        echo "</li>";
                    }
                    
                    echo "<li>".$data['name'];
                    
                    if($level>$prelevel)
                    {
                        $prelevel=$level;
                    }

                    $level++;
                    buildView($arr,$id,$level,$prelevel);
                    $level--;	
                }
            }
            
            if($level==$prelevel)
            {
                echo "</li></ol>";
            }
        }

        buildView($records,0);
    }
}
catch(Exception | Error $e)
{
    echo $e->getMessage();
}