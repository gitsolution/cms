  <?php 
        $flag='1';  
        $publish='1';  
        $band='0';  

        $items =  DB::table('med_pictures')
            ->join('med_albums', 'med_pictures.id_album', '=', 'med_albums.id')            
            ->select('med_pictures.*', 'med_albums.title as album')        
            ->where('med_albums.active','=', $flag)
            ->where('med_albums.index_page','=', $flag)            
            ->where('med_albums.publish','=', $publish)
            ->where('med_pictures.active','=', $flag)             
            ->where('med_pictures.publish','=',$publish)      
            ->orderBy('med_pictures.order_by','DESC')->paginate(8);
            
           
foreach ($items as $key => $img) {

 echo '<li><a href="'.$img->path.'"><img src="'.$img->path.'"  width="250"  height="150"alt=""></a></li>';
 
 } ?>