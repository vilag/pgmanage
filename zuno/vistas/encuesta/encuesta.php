<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["nombre"]))
{
  header("Location: login.html");
}
else
{
require 'header.php';
if ($_SESSION['administrador']==1 || $_SESSION['agente_ventas1']==1)
{
?>
<!--Contenido-->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                        
                         <input type="hidden" class="form-control" name="f_actual" id="f_actual">
                          <h1 class="box-title">ENCUESTA DE SATISFACCIÓN</h1>
                        <div class="box-tools pull-right">
                        </div>
                        
                        
                    </div>
                    <div class="form-group col-md-12 col-sm-12">  
                      <label>¿Porqué medio se contactó  con nosotros?</label>            
                        <div class="form-group col-md-2 col-sm-2"> 

                           <img src="">                                    
                        </div>                               
                    </div>

                    <div class="form-group col-md-12 col-sm-12">  
                      <label>¿Como considera la atención en general que recibe de nuestra parte?</label>            
                        <div class="form-group col-md-2 col-sm-2"> 

                           <img src="">                                    
                        </div>                               
                    </div>

                    <div class="form-group col-md-12 col-sm-12">  
                      <label>Como califica el tiempo de respuesta brindada por nuestra parte ante sus solicitudes?</label>            
                        <div class="form-group col-md-2 col-sm-2"> 

                           <img src="">                                    
                        </div>                               
                    </div>

                    <div class="form-group col-md-12 col-sm-12">  
                      <label>Como considera la de los productos que requiere?</label>            
                        <div class="form-group col-md-2 col-sm-2"> 

                           <img src="">                                    
                        </div>                               
                    </div>

                    <div class="form-group col-md-12 col-sm-12">  
                      <label>¿Como considera la calidad de nuestros productos?</label>            
                        <div class="form-group col-md-2 col-sm-2"> 

                           <img src="">                                    
                        </div>                               
                    </div>

                    <div class="form-group col-md-12 col-sm-12">  
                      <label>¿Recibió la asesoria tecnica que esperaba?</label>            
                        <div class="form-group col-md-2 col-sm-2"> 

                           <img src="">                                    
                        </div>                               
                    </div>

                    <div class="form-group col-md-12 col-sm-12">  
                      <label>¿Qué opinion tiene sobre nuestros precios?</label>            
                        <div class="form-group col-md-2 col-sm-2"> 

                           <img src="">                                    
                        </div>                               
                    </div>

                    <div class="form-group col-md-12 col-sm-12">  
                      <label>Con el objetivo de seguir mejorando para usted, porfavor dejenos un comentario</label>            
                        <div class="form-group col-md-2 col-sm-2"> 

                           <img src="">                                    
                        </div>                               
                    </div>

                        
                    
                    <!-- /.box-header -->
                    <!-- centro -->
                    
                    
                    
                   
                    
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
 


<?php
}
else
{
  require 'noacceso.php';
}
require 'footer.php';
?>
<script type="text/javascript" src="../../public/js/JsBarcode.all.min.js"></script>
<script type="text/javascript" src="../../public/js/moment.min.js"></script>
<script type="text/javascript" src="../../public/js/jquery.PrintArea.js"></script>
<script type="text/javascript" src="scripts/encuesta.js"></script>
<?php 
}
ob_end_flush();
?>