<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Tabulador
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	

	//Función para verificar el acceso al sistema
	public function listar_material_prod($id)
    {
    	$sql="SELECT mpp.idmateria_prima_prod,mp.descripcion,mp.calibre,mp.pulgadas,mp.tipo,mpp.cantidad,mpp.valor as medidas,mpp.valor2 as medidas2,mpp.unidad,mpp.valor_tramo,mpp.valor_tramo2,mpp.unidad_m,mpp.cortes,mpp.remanente FROM materia_prima_prod mpp INNER JOIN materia_prima mp ON mpp.idmateria_prima=mp.idmateria_prima WHERE mpp.idgroup='$id' ORDER BY mpp.idmateria_prima_prod ASC";
		return ejecutarConsulta($sql);
    }

    //Función para verificar el acceso al sistema
	public function consul_categ($buscar_prod)
    {
    	$sql="SELECT p.idproductos_clasif, p.idgroup, p.codigo_match,p.descripcion,pt.nombre as tipo, pt2.nombre as tipo2, pm.nombre as modelo, pm2.nombre as modelo2, t.nombre as tamano FROM productos_clasif p INNER JOIN prod_tipo pt ON p.idtipo=pt.idprod_tipo INNER JOIN prod_tipo2 pt2 ON p.idtipo2=pt2.idprod_tipo2 INNER JOIN prod_modelo pm ON p.idmodelo=pm.idprod_modelo INNER JOIN prod_modelo2 pm2 ON p.idmodelo2=pm2.idprod_modelo2 INNER JOIN prod_tamano t ON p.idtamano=t.idprod_tamano WHERE p.codigo_match='$buscar_prod'";
		return ejecutarConsultaSimpleFila($sql);

    }

    public function listar_materiales()
    {
    	$sql="SELECT * FROM materia_prima ORDER BY idmateria_prima ASC";
		return ejecutarConsulta($sql);  
    }
    
    public function agregar_a_producto($idmateria_prima,$idgroup)
    {
    	$sql="INSERT INTO materia_prima_prod (idgroup,idmateria_prima,cantidad,valor,unidad,valor_tramo,valor_tramo2,unidad_m) SELECT '$idgroup',idmateria_prima,'0','0','cm',valor_tramo,valor_tramo2,unidad_m FROM materia_prima WHERE idmateria_prima='$idmateria_prima'";
		return ejecutarConsulta($sql);  
    }

    public function actualizar_mat_prod($idmateria_prima_prod,$cantidad)
    {
        $sql="UPDATE materia_prima_prod SET cantidad='$cantidad' WHERE idmateria_prima_prod='$idmateria_prima_prod'";
        return ejecutarConsulta($sql);  
    }

    public function guardar_cortes($idmateria_prima_prod,$cortes,$remanente,$medidas_req,$valor_tramo)
    {
        $sql="UPDATE materia_prima_prod SET cortes='$cortes', remanente='$remanente',valor='$medidas_req',valor_tramo='$valor_tramo' WHERE idmateria_prima_prod='$idmateria_prima_prod'";
        return ejecutarConsulta($sql);  
    }

    public function guardar_cortes2($idmateria_prima_prod,$cortes,$remanente,$medidas_req,$medidas2_req,$valor_tramo,$valor2_tramo)
    {
        $sql="UPDATE materia_prima_prod SET cortes='$cortes', remanente='$remanente',valor='$medidas_req',valor2='$medidas2_req',valor_tramo='$valor_tramo',valor_tramo2='$valor2_tramo' WHERE idmateria_prima_prod='$idmateria_prima_prod'";
        return ejecutarConsulta($sql);  
    }

    public function calcular_cantidad_prod($id)
    {
        $sql="SELECT mpp.idmateria_prima_prod,mp.descripcion,mp.calibre,mp.pulgadas,mp.tipo,mpp.cantidad,mpp.valor as medidas,mpp.valor2 as medidas2,mpp.unidad,mpp.valor_tramo,mpp.valor_tramo2,mpp.unidad_m,mpp.cortes,mpp.remanente FROM materia_prima_prod mpp INNER JOIN materia_prima mp ON mpp.idmateria_prima=mp.idmateria_prima WHERE mpp.idgroup='$id' ORDER BY mpp.idmateria_prima_prod ASC";
        return ejecutarConsulta($sql);  
    }
    
}

?>