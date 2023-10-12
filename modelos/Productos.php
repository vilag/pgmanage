<?php

//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Productos
{
	public function __construct()
	{

	}

	public function listar_productos()
	{

		$sql="SELECT p.idproducto,m.nombre as tipo,p.codigo,p.nombre,p.color,p.medida,p.precio_total FROM productos p INNER JOIN muebles_fam m ON p.idmuebles_fam=m.idmuebles_fam ORDER BY m.nombre ASC LIMIT 5";
		return ejecutarConsulta($sql);			
	}

	public function ver_detalle_prod($idproducto)
	{


		$sql="SELECT pc.idproductos_clasif,(SELECT nombre FROM prod_tipo WHERE idprod_tipo = pc.idtipo) as tipo, pc.codigo_match, pc.descripcion as nombre,(SELECT nombre FROM prod_color WHERE idprod_color = pc.idcolor) as color, (SELECT nombre FROM prod_tamano WHERE idprod_tamano=pc.idtamano) as nom_tamano,(SELECT precio_total FROM productos WHERE idproducto=pc.idproductos) as precio_total FROM productos_clasif pc WHERE pc.idproductos_clasif='$idproducto' ";

		return ejecutarConsultaSimpleFila($sql);			
	}

	public function buscar_texto_tbl($id)
	{

		$sql="SELECT pc.idproductos_clasif, pc.idproductos as idproducto,(SELECT precio_total FROM productos WHERE idproducto=pc.idproductos) as precio_total, pc.codigo_match, pc.descripcion, (SELECT nombre FROM prod_tamano WHERE idprod_tamano=pc.idtamano) as nom_tamano, (SELECT nombre FROM prod_color WHERE idprod_color = pc.idcolor) as color FROM productos_clasif pc WHERE pc.descripcion LIKE '%".$id."%' OR pc.codigo_match LIKE '%".$id."%' ORDER BY pc.idproductos_clasif asc";
		return ejecutarConsulta($sql);			
	}

	/*public function actualizar_producto($idproducto,$codigo,$nombre,$color,$medidas,$precio)
	{

		$sql="UPDATE productos SET codigo='$codigo',nombre='$nombre',color='$color',medida='$medidas',precio_total='$precio' WHERE idproducto='$idproducto'";
		return ejecutarConsulta($sql);			
	}*/

	public function listar_productos_resul_tipo($id)
	{
		$sql="SELECT pc.estatus, pc.idproductos_clasif, pc.idproductos as idproducto,(SELECT precio_total FROM productos WHERE idproducto=pc.idproductos) as precio_total, pc.codigo_match, pc.descripcion, (SELECT nombre FROM prod_modelo WHERE idprod_modelo=pc.idmodelo) as nom_modelo, (SELECT nombre FROM prod_modelo2 WHERE idprod_modelo2=pc.idmodelo2) as nom_modelo2, (SELECT nombre FROM prod_tamano WHERE idprod_tamano=pc.idtamano) as nom_tamano, pc.esp 
		FROM productos_clasif pc WHERE pc.idtipo='$id' ORDER BY pc.idproductos_clasif ASC";
		return ejecutarConsulta($sql);
	}

	public function listar_productos_resul_tipo_sub($id,$id2)
	{
		$sql="SELECT pc.idproductos_clasif, pc.idproductos as idproducto,(SELECT precio_total FROM productos WHERE idproducto=pc.idproductos) as precio_total, pc.codigo_match, pc.descripcion, (SELECT nombre FROM prod_modelo WHERE idprod_modelo=pc.idmodelo) as nom_modelo, (SELECT nombre FROM prod_modelo2 WHERE idprod_modelo2=pc.idmodelo2) as nom_modelo2, (SELECT nombre FROM prod_tamano WHERE idprod_tamano=pc.idtamano) as nom_tamano FROM productos_clasif pc WHERE pc.idtipo='$id' AND pc.idtipo2=(SELECT idprod_tipo2 FROM prod_tipo2 WHERE nombre='$id2') ORDER BY pc.idproductos_clasif ASC";
		return ejecutarConsulta($sql);
	}

	public function listar_productos_resul_modelo($id,$id2)
	{
		$sql="SELECT pc.estatus, pc.idproductos_clasif, pc.idproductos as idproducto,(SELECT precio_total FROM productos WHERE idproducto=pc.idproductos) as precio_total, pc.codigo_match, pc.descripcion, (SELECT nombre FROM prod_modelo WHERE idprod_modelo=pc.idmodelo) as nom_modelo, (SELECT nombre FROM prod_modelo2 WHERE idprod_modelo2=pc.idmodelo2) as nom_modelo2, (SELECT nombre FROM prod_tamano WHERE idprod_tamano=pc.idtamano) as nom_tamano, pc.esp FROM productos_clasif pc WHERE pc.idtipo='$id' AND pc.idmodelo=(SELECT idprod_modelo FROM prod_modelo WHERE nombre='$id2') ORDER BY pc.idproductos_clasif ASC";
		return ejecutarConsulta($sql);
	}

	public function listar_productos_resul_modelo2($id,$id2,$id3)
	{
		$sql="SELECT pc.idproductos_clasif, pc.idproductos as idproducto,(SELECT precio_total FROM productos WHERE idproducto=pc.idproductos) as precio_total, pc.codigo_match, pc.descripcion, (SELECT nombre FROM prod_modelo WHERE idprod_modelo=pc.idmodelo) as nom_modelo, (SELECT nombre FROM prod_modelo2 WHERE idprod_modelo2=pc.idmodelo2) as nom_modelo2, (SELECT nombre FROM prod_tamano WHERE idprod_tamano=pc.idtamano) as nom_tamano FROM productos_clasif pc WHERE pc.idtipo='$id' AND pc.idtipo2=(SELECT idprod_tipo2 FROM prod_tipo2 WHERE nombre='$id3') AND pc.idmodelo=(SELECT idprod_modelo FROM prod_modelo WHERE nombre='$id2') ORDER BY pc.idproductos_clasif ASC";
		return ejecutarConsulta($sql);
	}

	public function listar_productos_resul_submodelo($id,$id2,$id3)
	{
		$sql="SELECT pc.idproductos_clasif, pc.idproductos as idproducto,(SELECT precio_total FROM productos WHERE idproducto=pc.idproductos) as precio_total, pc.codigo_match, pc.descripcion, (SELECT nombre FROM prod_modelo WHERE idprod_modelo=pc.idmodelo) as nom_modelo, (SELECT nombre FROM prod_modelo2 WHERE idprod_modelo2=pc.idmodelo2) as nom_modelo2, (SELECT nombre FROM prod_tamano WHERE idprod_tamano=pc.idtamano) as nom_tamano FROM productos_clasif pc WHERE pc.idtipo='$id' AND pc.idmodelo=(SELECT idprod_modelo FROM prod_modelo WHERE nombre='$id2') AND pc.idmodelo2=(SELECT idprod_modelo2 FROM prod_modelo2 WHERE nombre='$id3') ORDER BY pc.idproductos_clasif ASC";
		return ejecutarConsulta($sql);
	}

	public function listar_productos_resul_submodelo2($id,$id2,$id3,$id4)
	{
		$sql="SELECT pc.idproductos_clasif, pc.idproductos as idproducto,(SELECT precio_total FROM productos WHERE idproducto=pc.idproductos) as precio_total, pc.codigo_match, pc.descripcion, (SELECT nombre FROM prod_modelo WHERE idprod_modelo=pc.idmodelo) as nom_modelo, (SELECT nombre FROM prod_modelo2 WHERE idprod_modelo2=pc.idmodelo2) as nom_modelo2, (SELECT nombre FROM prod_tamano WHERE idprod_tamano=pc.idtamano) as nom_tamano FROM productos_clasif pc WHERE pc.idtipo='$id' AND pc.idtipo2=(SELECT idprod_tipo2 FROM prod_tipo2 WHERE nombre='$id4') AND pc.idmodelo=(SELECT idprod_modelo FROM prod_modelo WHERE nombre='$id2') AND pc.idmodelo2=(SELECT idprod_modelo2 FROM prod_modelo2 WHERE nombre='$id3') ORDER BY pc.idproductos_clasif ASC";
		return ejecutarConsulta($sql);
	}


	public function listar_productos_resul($id,$id2,$id3)
	{
		$sql="SELECT pc.estatus, pc.idproductos_clasif, pc.idproductos as idproducto,(SELECT precio_total FROM productos WHERE idproducto=pc.idproductos) as precio_total, pc.codigo_match, pc.descripcion, (SELECT nombre FROM prod_modelo WHERE idprod_modelo=pc.idmodelo) as nom_modelo, (SELECT nombre FROM prod_modelo2 WHERE idprod_modelo2=pc.idmodelo2) as nom_modelo2, (SELECT nombre FROM prod_tamano WHERE idprod_tamano=pc.idtamano) as nom_tamano, pc.esp FROM productos_clasif pc WHERE idtipo='$id' AND idmodelo=(SELECT idprod_modelo FROM prod_modelo WHERE nombre='$id2') AND idtamano=(SELECT idprod_tamano FROM prod_tamano WHERE nombre='$id3') ORDER BY pc.idproductos_clasif ASC";
		return ejecutarConsulta($sql);
	}

	public function listar_productos_resul2($id,$id2,$id3,$id4)
	{
		$sql="SELECT pc.idproductos_clasif, pc.idproductos as idproducto,(SELECT precio_total FROM productos WHERE idproducto=pc.idproductos) as precio_total, pc.codigo_match, pc.descripcion, (SELECT nombre FROM prod_modelo WHERE idprod_modelo=pc.idmodelo) as nom_modelo, (SELECT nombre FROM prod_modelo2 WHERE idprod_modelo2=pc.idmodelo2) as nom_modelo2, (SELECT nombre FROM prod_tamano WHERE idprod_tamano=pc.idtamano) as nom_tamano FROM productos_clasif pc WHERE idtipo='$id' AND idmodelo=(SELECT idprod_modelo FROM prod_modelo WHERE nombre='$id2') AND pc.idmodelo2=(SELECT idprod_modelo2 FROM prod_modelo2 WHERE nombre='$id4') AND idtamano=(SELECT idprod_tamano FROM prod_tamano WHERE nombre='$id3') ORDER BY pc.idproductos_clasif ASC";
		return ejecutarConsulta($sql);
	}

	public function listar_productos_resul3($id,$id2,$id3,$id4)
	{
		$sql="SELECT pc.idproductos_clasif, pc.idproductos as idproducto,(SELECT precio_total FROM productos WHERE idproducto=pc.idproductos) as precio_total, pc.codigo_match, pc.descripcion, (SELECT nombre FROM prod_modelo WHERE idprod_modelo=pc.idmodelo) as nom_modelo, (SELECT nombre FROM prod_modelo2 WHERE idprod_modelo2=pc.idmodelo2) as nom_modelo2, (SELECT nombre FROM prod_tamano WHERE idprod_tamano=pc.idtamano) as nom_tamano FROM productos_clasif pc WHERE idtipo='$id' AND pc.idtipo2=(SELECT idprod_tipo2 FROM prod_tipo2 WHERE nombre='$id4') AND idmodelo=(SELECT idprod_modelo FROM prod_modelo WHERE nombre='$id2') AND idtamano=(SELECT idprod_tamano FROM prod_tamano WHERE nombre='$id3') ORDER BY pc.idproductos_clasif ASC";
		return ejecutarConsulta($sql);
	}

	public function listar_productos_resul4($id,$id2,$id3,$id4,$id5)
	{
		$sql="SELECT pc.idproductos_clasif, pc.idproductos as idproducto,(SELECT precio_total FROM productos WHERE idproducto=pc.idproductos) as precio_total, pc.codigo_match, pc.descripcion, (SELECT nombre FROM prod_modelo WHERE idprod_modelo=pc.idmodelo) as nom_modelo, (SELECT nombre FROM prod_modelo2 WHERE idprod_modelo2=pc.idmodelo2) as nom_modelo2, (SELECT nombre FROM prod_tamano WHERE idprod_tamano=pc.idtamano) as nom_tamano FROM productos_clasif pc WHERE idtipo='$id' AND pc.idtipo2=(SELECT idprod_tipo2 FROM prod_tipo2 WHERE nombre='$id4') AND idmodelo=(SELECT idprod_modelo FROM prod_modelo WHERE nombre='$id2') AND pc.idmodelo2=(SELECT idprod_modelo2 FROM prod_modelo2 WHERE nombre='$id5') AND idtamano=(SELECT idprod_tamano FROM prod_tamano WHERE nombre='$id3') ORDER BY pc.idproductos_clasif ASC";
		return ejecutarConsulta($sql);
	}

	public function listar_productos_busqueda($id)
	{
		$sql="SELECT pc.estatus, pc.idproductos_clasif, pc.idproductos as idproducto,(SELECT precio_total FROM productos WHERE idproducto=pc.idproductos) as precio_total, pc.codigo_match, pc.descripcion, (SELECT nombre FROM prod_tamano WHERE idprod_tamano=pc.idtamano) as nom_tamano, pc.esp  FROM productos_clasif pc WHERE pc.descripcion LIKE '%".$id."%' OR pc.codigo_match LIKE '%".$id."%' ORDER BY pc.descripcion asc";
		return ejecutarConsulta($sql);
	}

	public function consul_prod_update($id,$id2)
	{

		while ($id <= $id2) {
				
				$sql="SELECT id FROM productos_update WHERE idproductos_clasif='$id'";
				$resul = ejecutarConsultaSimpleFila($sql);

				if ($resul>0) {

					$sql="UPDATE productos_clasif SET idgroup = (SELECT idgroup FROM productos_update WHERE idproductos_clasif = '$id'), act=1 WHERE idproductos_clasif='$id'";
					ejecutarConsulta($sql);
					# code...
				}

				$id=$id+1;

				if ($id>$id2) {
					return;
				}
			}	


	}

	public function listar_prod_clasif()
	{
		$sql="SELECT pc.idproductos_clasif,pc.codigo_match,pc.descripcion,pc.idproductos,
		(SELECT nombre FROM prod_tipo WHERE idprod_tipo = pc.idtipo) as tipo,
		(SELECT nombre FROM prod_tipo2 WHERE idprod_tipo2 = pc.idtipo2) as tipo2,
		(SELECT nombre FROM prod_modelo WHERE idprod_modelo = pc.idmodelo) as modelo,
		(SELECT nombre FROM prod_modelo2 WHERE idprod_modelo2 = pc.idmodelo2) as modelo2,
		(SELECT nombre FROM prod_tamano WHERE idprod_tamano = pc.idtamano) as tamano,
		(SELECT nombre FROM prod_color WHERE idprod_color = pc.idcolor) as color,
		(SELECT precio_total FROM productos WHERE idproducto = pc.idproductos) as precio
		 FROM productos_clasif pc";
		return ejecutarConsulta($sql);
	}

	public function listar_productos_fabricados()
	{
				$sql="

                    SELECT YEAR(oap.fecha_hora) as anio,MONTH(oap.fecha_hora) as mes,SUM(oap.avance) as cantidad_total,
                    (SELECT idproducto FROM pg_detped WHERE idpg_detped=odp.idpg_detped) as idproducto,
                    (SELECT codigo FROM productos WHERE idproducto=(SELECT idproducto FROM pg_detped WHERE idpg_detped=odp.idpg_detped)) as codigo,
                    (SELECT nombre FROM productos WHERE idproducto=(SELECT idproducto FROM pg_detped WHERE idpg_detped=odp.idpg_detped)) as descripcion,
                    (SELECT nombre FROM muebles_fam WHERE idmuebles_fam=(SELECT idmuebles_fam FROM productos WHERE idproducto=(SELECT idproducto FROM pg_detped WHERE idpg_detped=odp.idpg_detped))) as tipo,

                    (SELECT idtipo2 FROM productos_clasif WHERE idproductos=(SELECT idproducto FROM pg_detped WHERE idpg_detped=odp.idpg_detped)) as idtipo2,
                    (SELECT nombre FROM prod_tipo2 WHERE idprod_tipo2=(SELECT idtipo2 FROM productos_clasif WHERE idproductos=(SELECT idproducto FROM pg_detped WHERE idpg_detped=odp.idpg_detped))) as tipo2,
                    (SELECT idmodelo FROM productos_clasif WHERE idproductos=(SELECT idproducto FROM pg_detped WHERE idpg_detped=odp.idpg_detped)) as idmodelo,
                    (SELECT idtamano FROM productos_clasif WHERE idproductos=(SELECT idproducto FROM pg_detped WHERE idpg_detped=odp.idpg_detped)) as idtamano,
                    (SELECT idpaleta FROM productos_clasif WHERE idproductos=(SELECT idproducto FROM pg_detped WHERE idpg_detped=odp.idpg_detped)) as idpaleta
                    FROM op_avance_prod oap INNER JOIN op_detalle_prod odp ON oap.idop_detalle_prod=odp.idop_detalle_prod 
                    WHERE oap.area=1 AND oap.avance = odp.cant_tot 
                    GROUP BY YEAR(oap.fecha_hora), MONTH(oap.fecha_hora), (SELECT idproducto FROM pg_detped WHERE idpg_detped=odp.idpg_detped)

                  ";

                return ejecutarConsulta($sql);
	}


	public function listar_vendidos($fecha_pedido1,$fecha_pedido2)
    {
        $sql="SELECT p.no_control,p.fecha_pedido,pdp.codigo,pdp.descripcion,pdp.medida,pdp.color,pdp.precio,pdp.cantidad FROM pg_detalle_pedidos pdp INNER JOIN pg_pedidos p ON pdp.idpg_pedidos=p.idpg_pedidos WHERE DATE(p.fecha_pedido) >= '$fecha_pedido1' AND DATE(p.fecha_pedido) <= '$fecha_pedido2' ORDER BY p.no_control ASC";
        return ejecutarConsulta($sql); 
    }

    public function borrar_prod_consul($idproductos_clasif)
    {
        $sql="DELETE FROM productos_clasif WHERE idproductos_clasif='$idproductos_clasif'";
        return ejecutarConsulta($sql); 
    }

    public function guardar_codigo($id_input_codigo,$idproductos_clasif)
    {
        $sql="UPDATE productos_clasif SET codigo_match='$id_input_codigo' WHERE idproductos_clasif='$idproductos_clasif'";
        return ejecutarConsulta($sql); 
    }

    public function guardar_descrip($id_textarea_descrip,$idproductos_clasif)
    {
        $sql="UPDATE productos_clasif SET descripcion='$id_textarea_descrip' WHERE idproductos_clasif='$idproductos_clasif'";
        return ejecutarConsulta($sql); 
    }

    public function desactivar_producto($idproductos_clasif,$estatus)
    {
    	if ($estatus==0) {

    		$sql="UPDATE productos_clasif SET estatus=1 WHERE idproductos_clasif='$idproductos_clasif'";
       		return ejecutarConsulta($sql);
    		
    	}elseif ($estatus==1) {
    		$sql="UPDATE productos_clasif SET estatus=0 WHERE idproductos_clasif='$idproductos_clasif'";
       		return ejecutarConsulta($sql);
    		// code...
    	}
         
    }


}
?>