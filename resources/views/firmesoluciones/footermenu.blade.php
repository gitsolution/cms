       <?php   
    $flag=1;  
    $publish=1;  
    $level=0;
    $itemsMenu = null;
    $menu = null;
    $mainmenu = 1;
 

    $footermenu = 2;
    $menuFooter = DB::table('men_menus')->where('active','=',$flag)->where('id_men_type','=',$footermenu)->orderBy('order_by','ASC')->get();
 
     $itemsFooter = DB::table('men_items')
    ->join('men_menus', 'men_items.id_menu', '=', 'men_menus.id')            
    ->select('men_items.*', 'men_menus.title as menu')        
    ->where('men_items.active','=', $flag)
    ->where('men_items.publish','=',$publish)  
    ->where('men_items.level','=',$level)          
    ->where('men_menus.id_men_type','=',$footermenu)          
    ->orderBy('men_items.order_by','ASC')->get();    
 
foreach ($itemsFooter as $key => $menF) {
	 echo "<li>";
	 ?>
                  {!!link_to($menF->uri, $menF->title,array('class'=>'','target'=>$menF->target)) !!}
     <?php
     echo "</li>";
}
    ?>
 