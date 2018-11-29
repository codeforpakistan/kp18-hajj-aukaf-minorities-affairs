<?php 
//debug ($sub[0]['type_of_fund']);
$row=array();
 foreach ($sub as $sub): 
                               
array_push($row,$sub);
 endforeach;
 
echo json_encode($row);

?>
                                       
                                            
