
 {!!Form::open(['route'=>['coment.coment.store'],'method'=>'[POST]'])!!} 
        
            <div class="col-md-11 colorForm">
            @if($band!=null)
              <input type="hidden" name="id_doment" value="<?php echo $coment->id?>"> 
            @else
                <input type="hidden" name="id_doment" value="0"> 
            @endif
            <input type="hidden" name="id_doc" value="<?php echo $Doc->id?>">
             <input type="hidden" name="uri" value="<?php echo $Doc->uri?>">
            <h4>Escribe un comentario</h4>
             {!!Form::email('mail',null,['class'=>'form-control','placeholder'=>'Email','required'])!!}
            <br>
            
            {!!Form::textarea('content',null,['class'=>'form-control','placeholder'=>'Introduce tu comentario', 'id'=>'inputEmail','rows'=>'4', 'data-error'=>'Bruh, that email address is invalid', 'required'])!!}  <br>  
            {!!Form::submit( 'Comentar',['class'=>'btn btn-primary'])!!}

            </div>
            
         {!!Form::close()!!} 

	
