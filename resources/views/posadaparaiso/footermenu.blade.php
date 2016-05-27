
<div class="container ">
   <div class="container-fluid">
      
    <div class="row">
       <div class="col-md-6">           
                

                    
       <?php   
    $language=App::getLocale();/*Obtengo el idioma definido en laravel*/
    $id_language=DB::table('cms_language')->where('code','=', $language)->max('id'); 


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
    ->where('men_menus.id_language','=',$id_language)           
    ->orderBy('men_items.order_by','ASC')->get();    
 
echo "<div class='row'>"; 
foreach ($itemsFooter as $key => $menF) {
   echo "<div class='col-sm-3' >";
   ?>
                  {!!link_to($menF->uri, $menF->title,array('style'=>'color:white','target'=>$menF->target)) !!}
     <?php
     echo "</div>";
   }
 echo "</div>";
    ?>

        
         <div class="row "><br>
                    <div class="col-md-8">
                     <b> SAN CRISTOBAL CHIAPAS</b>
                     
                   </div>
          </div>

        </div>

        <div class="col-md-6">
            <center> <br> 
            <ul class="list-inline">
                <li>
                       <a href="#" class="btn-social"><i class=""><img src="../img-moldeando/facebook.png" class="img-responsive"  width="72"></i></a>
                </li>
             </ul>
            </center>
        </div>   

     </div>

   </div>
</div>

