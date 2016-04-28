       <?php   
    $flag='1';  
    $publish='1';  
    $itemsMenu = null;
    $menu = null;
    $mainmenu = 1;
 
    $menuMain = DB::table('men_menus')->where('active','=',$flag)->where('id_men_type','=',$mainmenu)->orderBy('order_by','DESC')->get();
    $itemsMain = DB::table('men_items')
    ->join('men_menus', 'men_items.id_menu', '=', 'men_menus.id')            
    ->select('men_items.*', 'men_menus.title as menu')        
    ->where('men_items.active','=', $flag)
    ->where('men_items.publish','=',$publish)      
    ->where('men_menus.id_men_type','=',$mainmenu)          
    ->orderBy('men_items.order_by','DESC')->get();

    foreach ($itemsMain as $key => $menM) {
	 echo "<li>";
	 ?>
                  {!!link_to($menM->uri,  $menM->title,array('class'=>'nav-link','target'=>$menM->target)) !!}

     <?php
     $itemsMainMenu = DB::table('men_items')
    ->join('men_menus', 'men_items.id_menu', '=', 'men_menus.id')            
    ->select('men_items.*', 'men_menus.title as menu')        
    ->where('men_items.active','=', $flag)
    ->where('men_items.publish','=',$publish)      
    ->where('men_items.id_parent','=',$menM->id)          
    ->orderBy('men_items.order_by','DESC')->get();
	    foreach ($itemsMainMenu as $keys => $menMM) {
	 echo "<li>";
	 ?>
                  {!!link_to($menMM->uri,  $menMM->title,array('class'=>'nav-link','target'=>$menMM->target)) !!}

     <?php
    	 echo "</li>";
	}

     echo "</li>";
}


 
    ?>