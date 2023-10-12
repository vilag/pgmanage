<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Welcome
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	

	//Función para verificar el acceso al sistema
	public function listar_pedidos2()
    {
    	$sql="SELECT p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs,p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE p.estatus2='1' AND p.estatus<>'ENTREGADO' AND p.estatus<>'CANCELADO' ORDER BY p.fecha_pedido desc";
		return ejecutarConsulta($sql);  
    }


    public function listar_pedidos($id)
    {
    	/*$sql="SELECT * FROM pg_pedidos WHERE estatus2='1' AND estatus<>'ENTREGADO' AND estatus<>'CANCELADO' ORDER BY fecha_entrega desc";*/

    	/*$sql="SELECT p.idpg_pedidos,p.no_control,IFNULL((SELECT avance FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND area='1' ORDER BY avance DESC LIMIT 1),0) as avance1,IFNULL((SELECT avance FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND area='2' ORDER BY avance DESC LIMIT 1),0) as avance2,IFNULL((SELECT avance FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND area='3' ORDER BY avance DESC LIMIT 1),0) as avance3,IFNULL((SELECT avance FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND area='5' ORDER BY avance DESC LIMIT 1),0) as avance5,IFNULL((SELECT avance FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND area='6' ORDER BY avance DESC LIMIT 1),0) as avance6,IFNULL((SELECT avance FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND area='7' ORDER BY avance DESC LIMIT 1),0) as avance7,IFNULL((SELECT avance FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND area='8' ORDER BY avance DESC LIMIT 1),0) as avance8, (SELECT count(idavance_prod) FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND area='1') as cantidad1 FROM pg_pedidos p WHERE p.estatus2='1' AND p.estatus<>'CANCELADO' AND p.no_control=542 ORDER BY p.no_control desc";*/

        if ($id==1 OR $id==8 OR $id==5 OR $id==14 OR $id==4) {

            $sql="SELECT p.idpg_pedidos,p.no_control,IFNULL((SELECT SUM(avance_he) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos),0) as avance_he,IFNULL((SELECT SUM(avance_pi) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos),0) as avance_pi,IFNULL((SELECT SUM(avance_pl) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos),0) as avance_pl,IFNULL((SELECT SUM(avance_ep) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos),0) as avance_ep,IFNULL((SELECT SUM(avance_ec) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos),0) as avance_ec,IFNULL((SELECT SUM(avance_em) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos),0) as avance_em,IFNULL((SELECT SUM(avance_ho) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos),0) as avance_ho,(SELECT SUM(cantidad) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos) as sum_prod,(SELECT COUNT(idpg_detalle_pedidos) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos) as cantidad FROM pg_pedidos p WHERE p.estatus2='1' ORDER BY p.fecha_pedido DESC LIMIT 10";
                return ejecutarConsulta($sql);

        }elseif ($id<>1 AND $id<>8) {

             $sql="SELECT p.idpg_pedidos,p.no_control,IFNULL((SELECT SUM(avance_he) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos),0) as avance_he,IFNULL((SELECT SUM(avance_pi) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos),0) as avance_pi,IFNULL((SELECT SUM(avance_pl) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos),0) as avance_pl,IFNULL((SELECT SUM(avance_ep) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos),0) as avance_ep,IFNULL((SELECT SUM(avance_ec) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos),0) as avance_ec,IFNULL((SELECT SUM(avance_em) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos),0) as avance_em,IFNULL((SELECT SUM(avance_ho) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos),0) as avance_ho,(SELECT SUM(cantidad) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos) as sum_prod,(SELECT COUNT(idpg_detalle_pedidos) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos) as cantidad FROM pg_pedidos p WHERE p.estatus2='1' AND p.idusuario='$id' ORDER BY p.fecha_pedido DESC LIMIT 10";
                return ejecutarConsulta($sql);
        }




    	/*$sql="SELECT idop_detalle_prod,avance FROM op_avance_prod WHERE idop_detalle_prod='616' ORDER BY avance DESC LIMIT 1";*/
        /*, (SELECT count(idavance_prod) FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND area='2') as cantidad2, (SELECT count(idavance_prod) FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND area='3') as cantidad3, (SELECT count(idavance_prod) FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND area='5') as cantidad5, (SELECT count(idavance_prod) FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND area='6') as cantidad6, (SELECT count(idavance_prod) FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND area='7') as cantidad7*/

    	
		 
    }


    public function listar_prod_detalles($id)
    {
        $sql="SELECT pdp.codigo,pdp.descripcion,pdp.medida,pdp.color,pd.cantidad,pdp.avance_he,pdp.avance_pi,pdp.avance_pl,pdp.avance_em,pdp.avance_ho,pdp.avance_ep,pdp.avance_ec,pd.estatus,pd.lote,pd.op FROM pg_detalle_pedidos pdp INNER JOIN pg_detped pd ON pdp.idpg_detalle_pedidos=pd.iddetalle_pedido WHERE pdp.idpg_pedidos='$id'";
        return ejecutarConsulta($sql); 
    }


    public function buscar_control($id,$control)
    {




            if ($id==1 OR $id==8 OR $id==5 OR $id==14 OR $id==4) {

                $sql="SELECT p.idpg_pedidos,p.no_control,IFNULL((SELECT SUM(avance_he) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos),0) as avance_he,IFNULL((SELECT SUM(avance_pi) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos),0) as avance_pi,IFNULL((SELECT SUM(avance_pl) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos),0) as avance_pl,IFNULL((SELECT SUM(avance_ep) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos),0) as avance_ep,IFNULL((SELECT SUM(avance_ec) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos),0) as avance_ec,IFNULL((SELECT SUM(avance_em) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos),0) as avance_em,IFNULL((SELECT SUM(avance_ho) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos),0) as avance_ho,(SELECT SUM(cantidad) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos) as sum_prod,(SELECT COUNT(idpg_detalle_pedidos) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos) as cantidad FROM pg_pedidos p WHERE p.estatus2='1' AND p.no_control='$control'";
                    return ejecutarConsulta($sql);

            }elseif ($id<>1 AND $id<>8) {

                 $sql="SELECT p.idpg_pedidos,p.no_control,IFNULL((SELECT SUM(avance_he) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos),0) as avance_he,IFNULL((SELECT SUM(avance_pi) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos),0) as avance_pi,IFNULL((SELECT SUM(avance_pl) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos),0) as avance_pl,IFNULL((SELECT SUM(avance_ep) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos),0) as avance_ep,IFNULL((SELECT SUM(avance_ec) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos),0) as avance_ec,IFNULL((SELECT SUM(avance_em) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos),0) as avance_em,IFNULL((SELECT SUM(avance_ho) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos),0) as avance_ho,(SELECT SUM(cantidad) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos) as sum_prod,(SELECT COUNT(idpg_detalle_pedidos) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos) as cantidad FROM pg_pedidos p WHERE p.estatus2='1' AND p.idusuario='$id' AND p.no_control='$control'";
                    return ejecutarConsulta($sql);
            }

       
         
    }

    public function productos()
    {

               /* $sql="SELECT p.fecha_pedido,pdp.idproducto,SUM(pdp.cantidad) as total_prod,
                (SELECT codigo FROM productos WHERE idproducto=pdp.idproducto) as codigo,
                (SELECT nombre FROM productos WHERE idproducto=pdp.idproducto) as descripcion,
                (SELECT medida FROM productos WHERE idproducto=pdp.idproducto) as medida,
                IFNULL((SELECT sum(pd.cantidad) FROM pg_detped pd WHERE pd.idproducto=pdp.idproducto AND pd.estatus='Produccion' AND (SELECT MONTH(fecha_pedido) FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido) = 1 AND (SELECT YEAR(fecha_pedido) FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido) = 2021),'') as Produccion,
                IFNULL((SELECT sum(pd.cantidad) FROM pg_detped pd WHERE pd.idproducto=pdp.idproducto AND pd.estatus='Apartado' AND (SELECT MONTH(fecha_pedido) FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido) = 1 AND (SELECT YEAR(fecha_pedido) FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido) = 2021),'') as Apartado,
                IFNULL((SELECT sum(pd.cantidad) FROM pg_detped pd WHERE pd.idproducto=pdp.idproducto AND pd.estatus='Existencia' AND (SELECT MONTH(fecha_pedido) FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido) = 1 AND (SELECT YEAR(fecha_pedido) FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido) = 2021),'') as Existencia,
                IFNULL((SELECT sum(pd.cantidad) FROM pg_detped pd WHERE pd.idproducto=pdp.idproducto AND pd.estatus='Fabricado' AND (SELECT MONTH(fecha_pedido) FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido) = 1 AND (SELECT YEAR(fecha_pedido) FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido) = 2021),'') as Fabricado 
                FROM pg_detalle_pedidos pdp INNER JOIN pg_pedidos p ON pdp.idpg_pedidos=p.idpg_pedidos INNER JOIN dir_entregas_esp dee ON p.idpg_pedidos=dee.idpedido WHERE p.estatus<>'CANCELADO' AND p.estatus2=1 AND MONTh(p.fecha_pedido)=1 AND YEAR(p.fecha_pedido)=2021 GROUP BY pdp.idproducto";*/


                //Ultimo utilizado
                //Produccion pendiente
                $sql="SELECT YEAR(p.fecha_pedido) AS anio, MONTH(p.fecha_pedido) as mes, pdp.idproducto,SUM(pdp.cantidad) as cant,
                (SELECT codigo FROM productos WHERE idproducto=pdp.idproducto) as codigo,
                (SELECT nombre FROM productos WHERE idproducto=pdp.idproducto) as descripcion,
                (SELECT medida FROM productos WHERE idproducto=pdp.idproducto) as medida               
                FROM pg_detalle_pedidos pdp INNER JOIN pg_pedidos p ON pdp.idpg_pedidos=p.idpg_pedidos INNER JOIN dir_entregas_esp dee ON p.idpg_pedidos=dee.idpedido 
                WHERE p.estatus<>'CANCELADO' AND p.estatus<>'ENTREGADO' AND p.estatus<>'LISTO PARA ENTREGA' AND p.estatus2=1 AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512
                GROUP BY MONTH(p.fecha_pedido), pdp.idproducto ORDER BY YEAR(p.fecha_pedido), MONTH(p.fecha_pedido), (SELECT codigo FROM productos WHERE idproducto=pdp.idproducto)";

                return ejecutarConsulta($sql);

                //Produccion total historica por modelo de producto
                  $sql="

                  SELECT pd.idpg_detped,YEAR(pd.fecha_hora2) as ANIO,MONTH(pd.fecha_hora2) as MES,pd.idproducto, 

                  (SELECT codigo FROM productos WHERE idproducto=pd.idproducto) as codigo,
                  (SELECT nombre FROM productos WHERE idproducto=pd.idproducto) as descripcion,
                  (SELECT color FROM productos WHERE idproducto=pd.idproducto) as color,
                  (SELECT medida FROM productos WHERE idproducto=pd.idproducto) as medidas,
                  sum(pd.cantidad) as cantidad
                  FROM pg_detped pd
                  WHERE pd.estatus='Fabricado' 
                  GROUP BY YEAR(pd.fecha_hora2), MONTH(pd.fecha_hora2), pd.idproducto

                  ";

                return ejecutarConsulta($sql);

                //Produccion en herreria por producto
                  $sql="

                    SELECT YEAR(oap.fecha_hora) as anio,MONTH(oap.fecha_hora) as mes,DAY(oap.fecha_hora) as dia,SUM(oap.avance) as cantidad_total,
                    (SELECT idproducto FROM pg_detped WHERE idpg_detped=odp.idpg_detped) as idproducto,
                    (SELECT codigo FROM productos WHERE idproducto=(SELECT idproducto FROM pg_detped WHERE idpg_detped=odp.idpg_detped)) as codigo,
                    (SELECT nombre FROM productos WHERE idproducto=(SELECT idproducto FROM pg_detped WHERE idpg_detped=odp.idpg_detped)) as descripcion,
                    (SELECT nombre FROM muebles_fam WHERE idmuebles_fam=(SELECT idmuebles_fam FROM productos WHERE idproducto=(SELECT idproducto FROM pg_detped WHERE idpg_detped=odp.idpg_detped))) as tipo,
                    (SELECT idtipo2 FROM productos_clasif WHERE idproductos=(SELECT idproducto FROM pg_detped WHERE idpg_detped=odp.idpg_detped)) as idtipo2,
                    (SELECT idmodelo FROM productos_clasif WHERE idproductos=(SELECT idproducto FROM pg_detped WHERE idpg_detped=odp.idpg_detped)) as idmodelo,
                    (SELECT idtamano FROM productos_clasif WHERE idproductos=(SELECT idproducto FROM pg_detped WHERE idpg_detped=odp.idpg_detped)) as idtamano,
                    (SELECT idpaleta FROM productos_clasif WHERE idproductos=(SELECT idproducto FROM pg_detped WHERE idpg_detped=odp.idpg_detped)) as idpaleta
                    FROM op_avance_prod oap INNER JOIN op_detalle_prod odp ON oap.idop_detalle_prod=odp.idop_detalle_prod 
                    WHERE oap.area=1 AND oap.avance = odp.cant_tot
                    GROUP BY YEAR(oap.fecha_hora), MONTH(oap.fecha_hora), DAY(oap.fecha_hora), (SELECT idproducto FROM pg_detped WHERE idpg_detped=odp.idpg_detped)

                  ";

                return ejecutarConsulta($sql);



                /*$sql="SELECT YEAR(p.fecha_pedido) AS anio, MONTH(p.fecha_pedido) AS mes, pdp.idproducto,SUM(pdp.cantidad) as cant,

                (SELECT codigo FROM productos WHERE idproducto=pdp.idproducto) as codigo,
                (SELECT nombre FROM productos WHERE idproducto=pdp.idproducto) as descripcion,
                (SELECT medida FROM productos WHERE idproducto=pdp.idproducto) as medida               
                FROM pg_detalle_pedidos pdp INNER JOIN pg_pedidos p ON pdp.idpg_pedidos=p.idpg_pedidos INNER JOIN dir_entregas_esp dee ON p.idpg_pedidos=dee.idpedido WHERE (p.estatus<>'CANCELADO' AND p.estatus2=1 AND p.idcliente<>2509) OR (p.estatus<>'CANCELADO' AND p.estatus2=1 AND p.idcliente<>2511) OR (p.estatus<>'CANCELADO' AND p.estatus2=1 AND p.idcliente<>2512) GROUP BY MONTH(p.fecha_pedido), pdp.idproducto ORDER BY MONTH(p.fecha_pedido),(SELECT codigo FROM productos WHERE idproducto=pdp.idproducto)";




                $sql="SELECT pdp.idproducto,SUM(pd.cantidad) as cant,DAY(pd.fecha_hora2) as dia,MONTH(pd.fecha_hora2) as mes, YEAR(pd.fecha_hora2) AS anio,
            (SELECT idmuebles_fam FROM productos WHERE idproducto=pdp.idproducto) as familia, 
            (SELECT codigo FROM productos WHERE idproducto=pdp.idproducto) as codigo,
            (SELECT nombre FROM productos WHERE idproducto=pdp.idproducto) as nombre,
            (SELECT medida FROM productos WHERE idproducto=pdp.idproducto) as medida 
            FROM pg_detped pd INNER JOIN pg_detalle_pedidos pdp ON pd.iddetalle_pedido=pdp.idpg_detalle_pedidos INNER JOIN pg_pedidos p ON pdp.idpg_pedidos=p.idpg_pedidos WHERE pd.estatus='Fabricado' AND p.estatus<>'CANCELADO' GROUP BY pdp.idproducto, DAY(pd.fecha_hora2)";

                return ejecutarConsulta($sql); */
         
    }


    

    public function calc_ind_prod($ultimo_anio,$ultimo_mes)
    {
        $sql="SELECT
        (SELECT count(idpg_pedidos) FROM pg_pedidos p WHERE 
        (YEAR(p.fecha_entrega)='$ultimo_anio' AND MONTH(p.fecha_entrega)='$ultimo_mes' AND p.estatus2 = 1 AND p.estatus<>'CANCELADO' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4 AND (SELECT count(idpg_detped) FROM pg_detped WHERE (idpedido=p.idpg_pedidos AND estatus='Fabricado') OR (idpedido=p.idpg_pedidos AND estatus='Produccion')))) as pedidos_vencim,
        (SELECT count(idpg_pedidos) FROM pg_pedidos p WHERE 
        (YEAR(p.fecha_entrega)='$ultimo_anio' AND MONTH(p.fecha_entrega)='$ultimo_mes' AND p.estatus2 = 1 AND p.estatus<>'CANCELADO' AND p.estatus_vencim = 1 AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4 AND (SELECT count(idpg_detped) FROM pg_detped WHERE (idpedido=p.idpg_pedidos AND estatus='Fabricado') OR (idpedido=p.idpg_pedidos AND estatus='Produccion'))>0)) as en_tiempo
        FROM pg_pedidos p LIMIT 1";
        return ejecutarConsultaSimpleFila($sql); 

        
    }

    /*(SELECT count(pd.estatus) FROM pg_detped pd WHERE pd.estatus='Fabricado' AND (SELECT YEAR(fecha_entrega) FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido) = '$ultimo_anio' AND (SELECT MONTH(fecha_entrega) FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido) = '$ultimo_mes') as num_vencim_fab,
         (SELECT count(pd.estatus) FROM pg_detped pd WHERE pd.estatus='Produccion' AND (SELECT YEAR(fecha_entrega) FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido) = '$ultimo_anio' AND (SELECT MONTH(fecha_entrega) FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido) = '$ultimo_mes') as num_vencim_prod,

         (SELECT count(pd.estatus) FROM pg_detped pd WHERE 
         (pd.estatus='Fabricado' AND (SELECT YEAR(fecha_entrega) FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido) = '$ultimo_anio' AND (SELECT MONTH(fecha_entrega) FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido) = '$ultimo_mes') OR 
         (pd.estatus='Produccion' AND (SELECT YEAR(fecha_entrega) FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido) = '$ultimo_anio' AND (SELECT MONTH(fecha_entrega) FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido) = '$ultimo_mes')) as total_vencim_mes*/

    /*(SELECT count(pd.idpg_detped) FROM pg_detped pd WHERE DATE(pd.fecha_hora2) <= (SELECT DATE(fecha_entrega) FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido) AND YEAR(pd.fecha_hora)='$ultimo_anio' AND MONTH(pd.fecha_hora) = '$ultimo_mes' AND (SELECT estatus FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido)<>'CANCELADO') as ent_en_tiempo,

        (SELECT count(p.idpg_pedidos) FROM pg_pedidos p WHERE p.estatus='ENTREGADO' AND (SELECT DATE(fecha) FROM estatus_pedido_fab WHERE (idpedido=p.idpg_pedidos AND color='0BF6BF') OR (idpedido=p.idpg_pedidos AND color='7E0CA8') ORDER BY fecha DESC LIMIT 1)<=p.fecha_valid_term)*/

    /*(SELECT count(pd.estatus) FROM pg_detped pd WHERE (pd.estatus='Fabricado' AND YEAR(pd.fecha_hora) = '$ultimo_anio' AND MONTH(pd.fecha_hora) = '$ultimo_mes' AND (SELECT estatus FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido)<>'CANCELADO' )) as num_asign_fab,
         (SELECT count(pd.estatus) FROM pg_detped pd WHERE (pd.estatus='Produccion' AND YEAR(pd.fecha_hora) = '$ultimo_anio' AND MONTH(pd.fecha_hora) = '$ultimo_mes' AND (SELECT estatus FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido)<>'CANCELADO' )) as num_asign_prod,*/

    public function llenar_anios()
    {
        $sql="SELECT DISTINCT YEAR(fecha_hora) as anios FROM pg_detped";
        return ejecutarConsulta($sql); 
    }

    public function consul_anio_actual()
    {
        $sql="SELECT YEAR(fecha_hora) as ultimo_anio FROM pg_detped ORDER BY YEAR(fecha_hora) DESC LIMIT 1";
        return ejecutarConsultaSimpleFila($sql); 
    }

    public function llenar_mes($anio)
    {
        $sql="SELECT DISTINCT MONTH(fecha_hora) as meses FROM pg_detped WHERE YEAR(fecha_hora)='$anio'";
        return ejecutarConsulta($sql); 
    }

    public function consul_mes_actual($ultimo_anio)
    {
        $sql="SELECT MONTH(fecha_hora) as ultimo_mes FROM pg_detped WHERE YEAR(fecha_hora) = '$ultimo_anio' ORDER BY MONTH(fecha_hora) DESC LIMIT 1";
        return ejecutarConsultaSimpleFila($sql); 
    }

  

     public function listar_pedidos_ind_prod($anio,$mes,$estat_anios)
    {

        $sql="SELECT p.idpg_pedidos,p.no_control,c.nombre,p.estatus,p.fecha_pedido,p.fecha_entrega,p.fecha_valid_term,date(p.fecha_valid_term) as fecha_valid_term_2, p.coment_vencim FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente=c.idcliente 
        WHERE 
        (YEAR(p.fecha_entrega)='$anio' AND MONTH(p.fecha_entrega)='$mes' AND p.estatus2 = 1 AND p.estatus<>'CANCELADO' AND p.estatus_vencim='$estat_anios' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4 AND (SELECT count(idpg_detped) FROM pg_detped WHERE (idpedido=p.idpg_pedidos AND estatus='Fabricado') OR (idpedido=p.idpg_pedidos AND estatus='Produccion'))>0)
        " ;
        return ejecutarConsulta($sql); 
    }

    public function calc_ind_prod_grafica($ultimo_anio)
    {
        $sql="SELECT
        (SELECT count(idpg_pedidos) FROM pg_pedidos p WHERE 
        (YEAR(p.fecha_entrega)='$ultimo_anio' AND MONTH(p.fecha_entrega)=1 AND p.estatus2 = 1 AND p.estatus<>'CANCELADO' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4 AND (SELECT count(idpg_detped) FROM pg_detped WHERE (idpedido=p.idpg_pedidos AND estatus='Fabricado') OR (idpedido=p.idpg_pedidos AND estatus='Produccion'))>0)) as pedidos_vencim1,
        (SELECT count(idpg_pedidos) FROM pg_pedidos p WHERE 
        (YEAR(p.fecha_entrega)='$ultimo_anio' AND MONTH(p.fecha_entrega)=1 AND p.estatus2 = 1 AND p.estatus<>'CANCELADO' AND p.estatus_vencim = 1 AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4 AND (SELECT count(idpg_detped) FROM pg_detped WHERE (idpedido=p.idpg_pedidos AND estatus='Fabricado') OR (idpedido=p.idpg_pedidos AND estatus='Produccion'))>0)) as en_tiempo1,

        (SELECT count(idpg_pedidos) FROM pg_pedidos p WHERE 
        (YEAR(p.fecha_entrega)='$ultimo_anio' AND MONTH(p.fecha_entrega)=2 AND p.estatus2 = 1 AND p.estatus<>'CANCELADO' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4 AND (SELECT count(idpg_detped) FROM pg_detped WHERE (idpedido=p.idpg_pedidos AND estatus='Fabricado') OR (idpedido=p.idpg_pedidos AND estatus='Produccion'))>0)) as pedidos_vencim2,
        (SELECT count(idpg_pedidos) FROM pg_pedidos p WHERE 
        (YEAR(p.fecha_entrega)='$ultimo_anio' AND MONTH(p.fecha_entrega)=2 AND p.estatus2 = 1 AND p.estatus<>'CANCELADO' AND p.estatus_vencim = 1 AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4 AND (SELECT count(idpg_detped) FROM pg_detped WHERE (idpedido=p.idpg_pedidos AND estatus='Fabricado') OR (idpedido=p.idpg_pedidos AND estatus='Produccion'))>0)) as en_tiempo2,

        (SELECT count(idpg_pedidos) FROM pg_pedidos p WHERE 
        (YEAR(p.fecha_entrega)='$ultimo_anio' AND MONTH(p.fecha_entrega)=3 AND p.estatus2 = 1 AND p.estatus<>'CANCELADO' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4 AND (SELECT count(idpg_detped) FROM pg_detped WHERE (idpedido=p.idpg_pedidos AND estatus='Fabricado') OR (idpedido=p.idpg_pedidos AND estatus='Produccion'))>0)) as pedidos_vencim3,
        (SELECT count(idpg_pedidos) FROM pg_pedidos p WHERE 
        (YEAR(p.fecha_entrega)='$ultimo_anio' AND MONTH(p.fecha_entrega)=3 AND p.estatus2 = 1 AND p.estatus<>'CANCELADO' AND p.estatus_vencim = 1 AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4 AND (SELECT count(idpg_detped) FROM pg_detped WHERE (idpedido=p.idpg_pedidos AND estatus='Fabricado') OR (idpedido=p.idpg_pedidos AND estatus='Produccion'))>0)) as en_tiempo3,

        (SELECT count(idpg_pedidos) FROM pg_pedidos p WHERE 
        (YEAR(p.fecha_entrega)='$ultimo_anio' AND MONTH(p.fecha_entrega)=4 AND p.estatus2 = 1 AND p.estatus<>'CANCELADO' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4 AND (SELECT count(idpg_detped) FROM pg_detped WHERE (idpedido=p.idpg_pedidos AND estatus='Fabricado') OR (idpedido=p.idpg_pedidos AND estatus='Produccion'))>0)) as pedidos_vencim4,
        (SELECT count(idpg_pedidos) FROM pg_pedidos p WHERE 
        (YEAR(p.fecha_entrega)='$ultimo_anio' AND MONTH(p.fecha_entrega)=4 AND p.estatus2 = 1 AND p.estatus<>'CANCELADO' AND p.estatus_vencim = 1 AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4 AND (SELECT count(idpg_detped) FROM pg_detped WHERE (idpedido=p.idpg_pedidos AND estatus='Fabricado') OR (idpedido=p.idpg_pedidos AND estatus='Produccion'))>0)) as en_tiempo4,

        (SELECT count(idpg_pedidos) FROM pg_pedidos p WHERE 
        (YEAR(p.fecha_entrega)='$ultimo_anio' AND MONTH(p.fecha_entrega)=5 AND p.estatus2 = 1 AND p.estatus<>'CANCELADO' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4 AND (SELECT count(idpg_detped) FROM pg_detped WHERE (idpedido=p.idpg_pedidos AND estatus='Fabricado') OR (idpedido=p.idpg_pedidos AND estatus='Produccion'))>0)) as pedidos_vencim5,
        (SELECT count(idpg_pedidos) FROM pg_pedidos p WHERE 
        (YEAR(p.fecha_entrega)='$ultimo_anio' AND MONTH(p.fecha_entrega)=5 AND p.estatus2 = 1 AND p.estatus<>'CANCELADO' AND p.estatus_vencim = 1 AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4 AND (SELECT count(idpg_detped) FROM pg_detped WHERE (idpedido=p.idpg_pedidos AND estatus='Fabricado') OR (idpedido=p.idpg_pedidos AND estatus='Produccion'))>0)) as en_tiempo5,

        (SELECT count(idpg_pedidos) FROM pg_pedidos p WHERE 
        (YEAR(p.fecha_entrega)='$ultimo_anio' AND MONTH(p.fecha_entrega)=6 AND p.estatus2 = 1 AND p.estatus<>'CANCELADO' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4 AND (SELECT count(idpg_detped) FROM pg_detped WHERE (idpedido=p.idpg_pedidos AND estatus='Fabricado') OR (idpedido=p.idpg_pedidos AND estatus='Produccion'))>0)) as pedidos_vencim6,
        (SELECT count(idpg_pedidos) FROM pg_pedidos p WHERE 
        (YEAR(p.fecha_entrega)='$ultimo_anio' AND MONTH(p.fecha_entrega)=6 AND p.estatus2 = 1 AND p.estatus<>'CANCELADO' AND p.estatus_vencim = 1 AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4 AND (SELECT count(idpg_detped) FROM pg_detped WHERE (idpedido=p.idpg_pedidos AND estatus='Fabricado') OR (idpedido=p.idpg_pedidos AND estatus='Produccion'))>0)) as en_tiempo6,

        (SELECT count(idpg_pedidos) FROM pg_pedidos p WHERE 
        (YEAR(p.fecha_entrega)='$ultimo_anio' AND MONTH(p.fecha_entrega)=7 AND p.estatus2 = 1 AND p.estatus<>'CANCELADO' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4 AND (SELECT count(idpg_detped) FROM pg_detped WHERE (idpedido=p.idpg_pedidos AND estatus='Fabricado') OR (idpedido=p.idpg_pedidos AND estatus='Produccion'))>0)) as pedidos_vencim7,
        (SELECT count(idpg_pedidos) FROM pg_pedidos p WHERE 
        (YEAR(p.fecha_entrega)='$ultimo_anio' AND MONTH(p.fecha_entrega)=7 AND p.estatus2 = 1 AND p.estatus<>'CANCELADO' AND p.estatus_vencim = 1 AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4 AND (SELECT count(idpg_detped) FROM pg_detped WHERE (idpedido=p.idpg_pedidos AND estatus='Fabricado') OR (idpedido=p.idpg_pedidos AND estatus='Produccion'))>0)) as en_tiempo7,

        (SELECT count(idpg_pedidos) FROM pg_pedidos p WHERE 
        (YEAR(p.fecha_entrega)='$ultimo_anio' AND MONTH(p.fecha_entrega)=8 AND p.estatus2 = 1 AND p.estatus<>'CANCELADO' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4 AND (SELECT count(idpg_detped) FROM pg_detped WHERE (idpedido=p.idpg_pedidos AND estatus='Fabricado') OR (idpedido=p.idpg_pedidos AND estatus='Produccion'))>0)) as pedidos_vencim8,
        (SELECT count(idpg_pedidos) FROM pg_pedidos p WHERE 
        (YEAR(p.fecha_entrega)='$ultimo_anio' AND MONTH(p.fecha_entrega)=8 AND p.estatus2 = 1 AND p.estatus<>'CANCELADO' AND p.estatus_vencim = 1 AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4 AND (SELECT count(idpg_detped) FROM pg_detped WHERE (idpedido=p.idpg_pedidos AND estatus='Fabricado') OR (idpedido=p.idpg_pedidos AND estatus='Produccion'))>0)) as en_tiempo8,

        (SELECT count(idpg_pedidos) FROM pg_pedidos p WHERE 
        (YEAR(p.fecha_entrega)='$ultimo_anio' AND MONTH(p.fecha_entrega)=9 AND p.estatus2 = 1 AND p.estatus<>'CANCELADO' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4 AND (SELECT count(idpg_detped) FROM pg_detped WHERE (idpedido=p.idpg_pedidos AND estatus='Fabricado') OR (idpedido=p.idpg_pedidos AND estatus='Produccion'))>0)) as pedidos_vencim9,
        (SELECT count(idpg_pedidos) FROM pg_pedidos p WHERE 
        (YEAR(p.fecha_entrega)='$ultimo_anio' AND MONTH(p.fecha_entrega)=9 AND p.estatus2 = 1 AND p.estatus<>'CANCELADO' AND p.estatus_vencim = 1 AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4 AND (SELECT count(idpg_detped) FROM pg_detped WHERE (idpedido=p.idpg_pedidos AND estatus='Fabricado') OR (idpedido=p.idpg_pedidos AND estatus='Produccion'))>0)) as en_tiempo9,

        (SELECT count(idpg_pedidos) FROM pg_pedidos p WHERE 
        (YEAR(p.fecha_entrega)='$ultimo_anio' AND MONTH(p.fecha_entrega)=10 AND p.estatus2 = 1 AND p.estatus<>'CANCELADO' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4 AND (SELECT count(idpg_detped) FROM pg_detped WHERE (idpedido=p.idpg_pedidos AND estatus='Fabricado') OR (idpedido=p.idpg_pedidos AND estatus='Produccion'))>0)) as pedidos_vencim10,
        (SELECT count(idpg_pedidos) FROM pg_pedidos p WHERE 
        (YEAR(p.fecha_entrega)='$ultimo_anio' AND MONTH(p.fecha_entrega)=10 AND p.estatus2 = 1 AND p.estatus<>'CANCELADO' AND p.estatus_vencim = 1 AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4 AND (SELECT count(idpg_detped) FROM pg_detped WHERE (idpedido=p.idpg_pedidos AND estatus='Fabricado') OR (idpedido=p.idpg_pedidos AND estatus='Produccion'))>0)) as en_tiempo10,

        (SELECT count(idpg_pedidos) FROM pg_pedidos p WHERE 
        (YEAR(p.fecha_entrega)='$ultimo_anio' AND MONTH(p.fecha_entrega)=11 AND p.estatus2 = 1 AND p.estatus<>'CANCELADO' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4 AND (SELECT count(idpg_detped) FROM pg_detped WHERE (idpedido=p.idpg_pedidos AND estatus='Fabricado') OR (idpedido=p.idpg_pedidos AND estatus='Produccion'))>0)) as pedidos_vencim11,
        (SELECT count(idpg_pedidos) FROM pg_pedidos p WHERE 
        (YEAR(p.fecha_entrega)='$ultimo_anio' AND MONTH(p.fecha_entrega)=11 AND p.estatus2 = 1 AND p.estatus<>'CANCELADO' AND p.estatus_vencim = 1 AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4 AND (SELECT count(idpg_detped) FROM pg_detped WHERE (idpedido=p.idpg_pedidos AND estatus='Fabricado') OR (idpedido=p.idpg_pedidos AND estatus='Produccion'))>0)) as en_tiempo11,

        (SELECT count(idpg_pedidos) FROM pg_pedidos p WHERE 
        (YEAR(p.fecha_entrega)='$ultimo_anio' AND MONTH(p.fecha_entrega)=12 AND p.estatus2 = 1 AND p.estatus<>'CANCELADO' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4 AND (SELECT count(idpg_detped) FROM pg_detped WHERE (idpedido=p.idpg_pedidos AND estatus='Fabricado') OR (idpedido=p.idpg_pedidos AND estatus='Produccion'))>0)) as pedidos_vencim12,
        (SELECT count(idpg_pedidos) FROM pg_pedidos p WHERE 
        (YEAR(p.fecha_entrega)='$ultimo_anio' AND MONTH(p.fecha_entrega)=12 AND p.estatus2 = 1 AND p.estatus<>'CANCELADO' AND p.estatus_vencim = 1 AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4 AND (SELECT count(idpg_detped) FROM pg_detped WHERE (idpedido=p.idpg_pedidos AND estatus='Fabricado') OR (idpedido=p.idpg_pedidos AND estatus='Produccion'))>0)) as en_tiempo12


        FROM pg_pedidos p LIMIT 1";
        return ejecutarConsultaSimpleFila($sql); 

        
    }


    public function calc_ind_emb($ultimo_anio,$ultimo_mes)
    {
        $sql="SELECT

        (SELECT count(idpg_pedidos) FROM pg_pedidos p  WHERE 
        YEAR(p.fecha_valid_term)='$ultimo_anio' AND MONTH(p.fecha_valid_term)='$ultimo_mes' AND p.estatus2 = 1 AND p.estatus<>'CANCELADO' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4) as pedidos_entregar,

        (SELECT count(idpg_pedidos) FROM pg_pedidos p WHERE
         YEAR(p.fecha_valid_term)='$ultimo_anio' AND MONTH(p.fecha_valid_term)='$ultimo_mes' AND p.estatus2 = 1 AND p.estatus<>'CANCELADO' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4 AND  p.ent_tiempo=1) as pedidos_term_entiempo,
         (SELECT count(idpg_pedidos) FROM pg_pedidos p WHERE
         YEAR(p.fecha_valid_term)='$ultimo_anio' AND MONTH(p.fecha_valid_term)='$ultimo_mes' AND p.estatus2 = 1 AND p.estatus<>'CANCELADO' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4 AND  p.ent_tiempo=0) as pedidos_term_fueratiempo,
         (SELECT count(idpg_pedidos) FROM pg_pedidos p WHERE 
         YEAR(p.fecha_valid_term)='$ultimo_anio' AND MONTH(p.fecha_valid_term)='$ultimo_mes' AND p.coment_entrega_ind<>'') as coment_det_in            
        FROM pg_pedidos p LIMIT 1";

        return ejecutarConsultaSimpleFila($sql);
        
    }

     /* DATEDIFF((SELECT fecha FROM estatus_pedido_fab WHERE (idpedido=p.idpg_pedidos AND color='0BF6BF') OR (idpedido=p.idpg_pedidos AND color='7E0CA8') ORDER BY fecha DESC LIMIT 1),DATE(p.fecha_entr_mas1))<=1*/

    public function listar_pedidos_ind_emb($anio,$mes,$estat_anios)
    {

        $sql="SELECT p.idpg_pedidos,p.coment_vencim,p.coment_entrega_ind,p.no_control,c.nombre,p.estatus,p.fecha_pedido,p.fecha_entrega,p.fecha_valid_term,date(p.fecha_valid_term) as fecha_valid_term_2,(SELECT fecha FROM estatus_pedido_fab WHERE (idpedido=p.idpg_pedidos AND color='0BF6BF') OR (idpedido=p.idpg_pedidos AND color='7E0CA8') ORDER BY fecha DESC LIMIT 1) as fecha_de_entrega, (SELECT comentario FROM estatus_pedido_fab WHERE (idpedido=p.idpg_pedidos AND color='0BF6BF') OR (idpedido=p.idpg_pedidos AND color='7E0CA8') ORDER BY fecha DESC LIMIT 1) as comentario,
        CONCAT(ELT(WEEKDAY(p.fecha_valid_term) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo')) as dia_term,
        CONCAT(ELT(WEEKDAY((SELECT fecha FROM estatus_pedido_fab WHERE (idpedido=p.idpg_pedidos AND color='0BF6BF') OR (idpedido=p.idpg_pedidos AND color='7E0CA8') ORDER BY fecha DESC LIMIT 1)) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo')) as dia_entrega


         FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente=c.idcliente WHERE

         YEAR(p.fecha_valid_term)='$anio' AND MONTH(p.fecha_valid_term)='$mes' AND p.estatus2 = 1 AND p.estatus<>'CANCELADO' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4 AND  p.ent_tiempo='$estat_anios'

        " ;
        return ejecutarConsulta($sql); 
    }


    public function calc_ind_emb_grafica($ultimo_anio)
    {
        $sql="SELECT

        (SELECT count(idpg_pedidos) FROM pg_pedidos p  WHERE 
        YEAR(p.fecha_valid_term)='$ultimo_anio' AND MONTH(p.fecha_valid_term)=1 AND p.estatus2 = 1 AND p.estatus<>'CANCELADO' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4) as pedidos_entregar1,
        ((SELECT count(idpg_pedidos) FROM pg_pedidos p WHERE
         YEAR(p.fecha_valid_term)='$ultimo_anio' AND MONTH(p.fecha_valid_term)=1 AND p.estatus2 = 1 AND p.estatus<>'CANCELADO' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4 AND  p.ent_tiempo=1)+(SELECT count(idpg_pedidos) FROM pg_pedidos p WHERE
         YEAR(p.fecha_valid_term)='$ultimo_anio' AND MONTH(p.fecha_valid_term)=1 AND p.coment_entrega_ind<>'')) as pedidos_term_entiempo1,


         (SELECT count(idpg_pedidos) FROM pg_pedidos p  WHERE 
        YEAR(p.fecha_valid_term)='$ultimo_anio' AND MONTH(p.fecha_valid_term)=2 AND p.estatus2 = 1 AND p.estatus<>'CANCELADO' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4) as pedidos_entregar2,
        ((SELECT count(idpg_pedidos) FROM pg_pedidos p WHERE
         YEAR(p.fecha_valid_term)='$ultimo_anio' AND MONTH(p.fecha_valid_term)=2 AND p.estatus2 = 1 AND p.estatus<>'CANCELADO' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4 AND  p.ent_tiempo=1)+(SELECT count(idpg_pedidos) FROM pg_pedidos p WHERE
         YEAR(p.fecha_valid_term)='$ultimo_anio' AND MONTH(p.fecha_valid_term)=2 AND p.coment_entrega_ind<>'')) as pedidos_term_entiempo2,


         (SELECT count(idpg_pedidos) FROM pg_pedidos p  WHERE 
        YEAR(p.fecha_valid_term)='$ultimo_anio' AND MONTH(p.fecha_valid_term)=3 AND p.estatus2 = 1 AND p.estatus<>'CANCELADO' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4) as pedidos_entregar3,
        ((SELECT count(idpg_pedidos) FROM pg_pedidos p WHERE
         YEAR(p.fecha_valid_term)='$ultimo_anio' AND MONTH(p.fecha_valid_term)=3 AND p.estatus2 = 1 AND p.estatus<>'CANCELADO' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4 AND  p.ent_tiempo=1)+(SELECT count(idpg_pedidos) FROM pg_pedidos p WHERE
         YEAR(p.fecha_valid_term)='$ultimo_anio' AND MONTH(p.fecha_valid_term)=3 AND p.coment_entrega_ind<>'')) as pedidos_term_entiempo3,


         (SELECT count(idpg_pedidos) FROM pg_pedidos p  WHERE 
        YEAR(p.fecha_valid_term)='$ultimo_anio' AND MONTH(p.fecha_valid_term)=4 AND p.estatus2 = 1 AND p.estatus<>'CANCELADO' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4) as pedidos_entregar4,
        ((SELECT count(idpg_pedidos) FROM pg_pedidos p WHERE
         YEAR(p.fecha_valid_term)='$ultimo_anio' AND MONTH(p.fecha_valid_term)=4 AND p.estatus2 = 1 AND p.estatus<>'CANCELADO' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4 AND  p.ent_tiempo=1)+(SELECT count(idpg_pedidos) FROM pg_pedidos p WHERE
         YEAR(p.fecha_valid_term)='$ultimo_anio' AND MONTH(p.fecha_valid_term)=4 AND p.coment_entrega_ind<>'')) as pedidos_term_entiempo4,


         (SELECT count(idpg_pedidos) FROM pg_pedidos p  WHERE 
        YEAR(p.fecha_valid_term)='$ultimo_anio' AND MONTH(p.fecha_valid_term)=5 AND p.estatus2 = 1 AND p.estatus<>'CANCELADO' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4) as pedidos_entregar5,
        ((SELECT count(idpg_pedidos) FROM pg_pedidos p WHERE
         YEAR(p.fecha_valid_term)='$ultimo_anio' AND MONTH(p.fecha_valid_term)=5 AND p.estatus2 = 1 AND p.estatus<>'CANCELADO' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4 AND  p.ent_tiempo=1)+(SELECT count(idpg_pedidos) FROM pg_pedidos p WHERE
         YEAR(p.fecha_valid_term)='$ultimo_anio' AND MONTH(p.fecha_valid_term)=5 AND p.coment_entrega_ind<>'')) as pedidos_term_entiempo5,


         (SELECT count(idpg_pedidos) FROM pg_pedidos p  WHERE 
        YEAR(p.fecha_valid_term)='$ultimo_anio' AND MONTH(p.fecha_valid_term)=6 AND p.estatus2 = 1 AND p.estatus<>'CANCELADO' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4) as pedidos_entregar6,
        ((SELECT count(idpg_pedidos) FROM pg_pedidos p WHERE
         YEAR(p.fecha_valid_term)='$ultimo_anio' AND MONTH(p.fecha_valid_term)=6 AND p.estatus2 = 1 AND p.estatus<>'CANCELADO' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4 AND  p.ent_tiempo=1)+(SELECT count(idpg_pedidos) FROM pg_pedidos p WHERE
         YEAR(p.fecha_valid_term)='$ultimo_anio' AND MONTH(p.fecha_valid_term)=6 AND p.coment_entrega_ind<>'')) as pedidos_term_entiempo6,

         (SELECT count(idpg_pedidos) FROM pg_pedidos p  WHERE 
        YEAR(p.fecha_valid_term)='$ultimo_anio' AND MONTH(p.fecha_valid_term)=7 AND p.estatus2 = 1 AND p.estatus<>'CANCELADO' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4) as pedidos_entregar7,
        ((SELECT count(idpg_pedidos) FROM pg_pedidos p WHERE
         YEAR(p.fecha_valid_term)='$ultimo_anio' AND MONTH(p.fecha_valid_term)=7 AND p.estatus2 = 1 AND p.estatus<>'CANCELADO' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4 AND  p.ent_tiempo=1)+(SELECT count(idpg_pedidos) FROM pg_pedidos p WHERE
         YEAR(p.fecha_valid_term)='$ultimo_anio' AND MONTH(p.fecha_valid_term)=7 AND p.coment_entrega_ind<>'')) as pedidos_term_entiempo7,


         (SELECT count(idpg_pedidos) FROM pg_pedidos p  WHERE 
        YEAR(p.fecha_valid_term)='$ultimo_anio' AND MONTH(p.fecha_valid_term)=8 AND p.estatus2 = 1 AND p.estatus<>'CANCELADO' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4) as pedidos_entregar8,
        ((SELECT count(idpg_pedidos) FROM pg_pedidos p WHERE
         YEAR(p.fecha_valid_term)='$ultimo_anio' AND MONTH(p.fecha_valid_term)=8 AND p.estatus2 = 1 AND p.estatus<>'CANCELADO' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4 AND  p.ent_tiempo=1)+(SELECT count(idpg_pedidos) FROM pg_pedidos p WHERE
         YEAR(p.fecha_valid_term)='$ultimo_anio' AND MONTH(p.fecha_valid_term)=8 AND p.coment_entrega_ind<>'')) as pedidos_term_entiempo8,


         (SELECT count(idpg_pedidos) FROM pg_pedidos p  WHERE 
        YEAR(p.fecha_valid_term)='$ultimo_anio' AND MONTH(p.fecha_valid_term)=9 AND p.estatus2 = 1 AND p.estatus<>'CANCELADO' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4) as pedidos_entregar9,
        ((SELECT count(idpg_pedidos) FROM pg_pedidos p WHERE
         YEAR(p.fecha_valid_term)='$ultimo_anio' AND MONTH(p.fecha_valid_term)=9 AND p.estatus2 = 1 AND p.estatus<>'CANCELADO' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4 AND  p.ent_tiempo=1)+(SELECT count(idpg_pedidos) FROM pg_pedidos p WHERE
         YEAR(p.fecha_valid_term)='$ultimo_anio' AND MONTH(p.fecha_valid_term)=9 AND p.coment_entrega_ind<>'')) as pedidos_term_entiempo9,


        (SELECT count(idpg_pedidos) FROM pg_pedidos p  WHERE 
        YEAR(p.fecha_valid_term)='$ultimo_anio' AND MONTH(p.fecha_valid_term)=10 AND p.estatus2 = 1 AND p.estatus<>'CANCELADO' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4) as pedidos_entregar10,
        ((SELECT count(idpg_pedidos) FROM pg_pedidos p WHERE
         YEAR(p.fecha_valid_term)='$ultimo_anio' AND MONTH(p.fecha_valid_term)=10 AND p.estatus2 = 1 AND p.estatus<>'CANCELADO' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4 AND  p.ent_tiempo=1)+(SELECT count(idpg_pedidos) FROM pg_pedidos p WHERE
         YEAR(p.fecha_valid_term)='$ultimo_anio' AND MONTH(p.fecha_valid_term)=10 AND p.coment_entrega_ind<>'')) as pedidos_term_entiempo10,


         (SELECT count(idpg_pedidos) FROM pg_pedidos p  WHERE 
        YEAR(p.fecha_valid_term)='$ultimo_anio' AND MONTH(p.fecha_valid_term)=11 AND p.estatus2 = 1 AND p.estatus<>'CANCELADO' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4) as pedidos_entregar11,
        ((SELECT count(idpg_pedidos) FROM pg_pedidos p WHERE
         YEAR(p.fecha_valid_term)='$ultimo_anio' AND MONTH(p.fecha_valid_term)=11 AND p.estatus2 = 1 AND p.estatus<>'CANCELADO' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4 AND  p.ent_tiempo=1)+(SELECT count(idpg_pedidos) FROM pg_pedidos p WHERE
         YEAR(p.fecha_valid_term)='$ultimo_anio' AND MONTH(p.fecha_valid_term)=11 AND p.coment_entrega_ind<>'')) as pedidos_term_entiempo11,
         

         (SELECT count(idpg_pedidos) FROM pg_pedidos p  WHERE 
        YEAR(p.fecha_valid_term)='$ultimo_anio' AND MONTH(p.fecha_valid_term)=12 AND p.estatus2 = 1 AND p.estatus<>'CANCELADO' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4) as pedidos_entregar12,
        ((SELECT count(idpg_pedidos) FROM pg_pedidos p WHERE
         YEAR(p.fecha_valid_term)='$ultimo_anio' AND MONTH(p.fecha_valid_term)=12 AND p.estatus2 = 1 AND p.estatus<>'CANCELADO' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4 AND  p.ent_tiempo=1)+(SELECT count(idpg_pedidos) FROM pg_pedidos p WHERE
         YEAR(p.fecha_valid_term)='$ultimo_anio' AND MONTH(p.fecha_valid_term)=12 AND p.coment_entrega_ind<>'')) as pedidos_term_entiempo12


        FROM pg_pedidos p LIMIT 1";
        return ejecutarConsultaSimpleFila($sql); 

        
    }



    public function consul_info_pedidos($anio)
    {
        $sql="SELECT anio,num_pedidos,pedidos_terminados,pedidos_entregados,pedidos_cancelados FROM indicadores WHERE anio='$anio'";

        return ejecutarConsultaSimpleFila($sql);
        
    }


    public function consul_info_grafica1($anio)
    {
        $sql="SELECT 
        ene as ene1,
        feb as feb1,
        mar as mar1,
        abr as abr1,
        may as may1,
        jun as jun1,
        jul as jul1,
        ago as ago1,
        sep as sep1,
        oct as oct1,
        nov as nov1,
        dic as dic1
        FROM ped_lugar_anio WHERE anio='$anio' AND idlugar=1";

        return ejecutarConsultaSimpleFila($sql);
        
    }

    public function consul_info_grafica2($anio)
    {
        $sql="SELECT 
        ene as ene2,
        feb as feb2,
        mar as mar2,
        abr as abr2,
        may as may2,
        jun as jun2,
        jul as jul2,
        ago as ago2,
        sep as sep2,
        oct as oct2,
        nov as nov2,
        dic as dic2
        FROM ped_lugar_anio WHERE anio='$anio' AND idlugar=2";

        return ejecutarConsultaSimpleFila($sql);
        
    }

    public function consul_info_grafica3($anio)
    {
        $sql="SELECT 
        ene as ene3,
        feb as feb3,
        mar as mar3,
        abr as abr3,
        may as may3,
        jun as jun3,
        jul as jul3,
        ago as ago3,
        sep as sep3,
        oct as oct3,
        nov as nov3,
        dic as dic3
        FROM ped_lugar_anio WHERE anio='$anio' AND idlugar=3";

        return ejecutarConsultaSimpleFila($sql);
        
    }

    public function crear_box_grafica($anio)
    {
        $sql="SELECT idpg_pedidos, YEAR(fecha_pedido) as anio FROM pg_pedidos WHERE YEAR(fecha_pedido) = '$anio' LIMIT 1";

        return ejecutarConsulta($sql);
        
    }

    public function listar_cant_prod_com()
    {
       

        $sql="SELECT p.idproductos, p.descripcion,p.codigo_match,
        (SELECT sum(pdp.cantidad) FROM pg_detalle_pedidos pdp WHERE pdp.idproducto=p.idproductos  AND (SELECT tipo FROM pg_pedidos WHERE idpg_pedidos=pdp.idpg_pedidos)=1) as cantidad,
        (SELECT count(pdp.idpg_pedidos) FROM pg_detalle_pedidos pdp WHERE pdp.idproducto=p.idproductos AND (SELECT tipo FROM pg_pedidos WHERE idpg_pedidos=pdp.idpg_pedidos)=1) as num_pedidos
        FROM productos_clasif p WHERE 
        (SELECT count(pdp.idpg_pedidos) FROM pg_detalle_pedidos pdp WHERE pdp.idproducto=p.idproductos AND (SELECT tipo FROM pg_pedidos WHERE idpg_pedidos=pdp.idpg_pedidos)=1)>0 
        AND p.idproductos_clasif<>1159 
        AND p.idproductos_clasif<>1160 
        AND p.idproductos_clasif<>1161 
        AND p.idproductos_clasif<>1162 
        AND p.idproductos_clasif<>1163 
        AND p.idproductos_clasif<>1164 
        AND p.idproductos_clasif<>1165 
        AND p.idproductos_clasif<>1166 
        AND p.idproductos_clasif<>1167 
        AND p.idproductos_clasif<>1168
        GROUP BY p.idproductos ORDER BY
        (SELECT count(pdp.idpg_pedidos) FROM pg_detalle_pedidos pdp WHERE pdp.idproducto=p.idproductos AND (SELECT tipo FROM pg_pedidos WHERE idpg_pedidos=pdp.idpg_pedidos)=1)
        DESC";
        return ejecutarConsulta($sql);
        
    }

    public function listar_cant_prod_lic()
    {
       

        $sql="SELECT p.idproductos, p.descripcion,p.codigo_match,
        (SELECT sum(pdp.cantidad) FROM pg_detalle_pedidos pdp WHERE pdp.idproducto=p.idproductos  AND (SELECT tipo FROM pg_pedidos WHERE idpg_pedidos=pdp.idpg_pedidos)=2) as cantidad,
        (SELECT count(pdp.idpg_pedidos) FROM pg_detalle_pedidos pdp WHERE pdp.idproducto=p.idproductos AND (SELECT tipo FROM pg_pedidos WHERE idpg_pedidos=pdp.idpg_pedidos)=2) as num_pedidos
        FROM productos_clasif p WHERE 
        (SELECT count(pdp.idpg_pedidos) FROM pg_detalle_pedidos pdp WHERE pdp.idproducto=p.idproductos AND (SELECT tipo FROM pg_pedidos WHERE idpg_pedidos=pdp.idpg_pedidos)=2)>0 
        AND p.idproductos_clasif<>1159 
        AND p.idproductos_clasif<>1160 
        AND p.idproductos_clasif<>1161 
        AND p.idproductos_clasif<>1162 
        AND p.idproductos_clasif<>1163 
        AND p.idproductos_clasif<>1164 
        AND p.idproductos_clasif<>1165 
        AND p.idproductos_clasif<>1166 
        AND p.idproductos_clasif<>1167 
        AND p.idproductos_clasif<>1168
        GROUP BY p.idproductos ORDER BY
        (SELECT count(pdp.idpg_pedidos) FROM pg_detalle_pedidos pdp WHERE pdp.idproducto=p.idproductos AND (SELECT tipo FROM pg_pedidos WHERE idpg_pedidos=pdp.idpg_pedidos)=2)
        DESC";
        return ejecutarConsulta($sql);
        
    }

    public function guardar_coment_vencim($idpedido,$det_vencim)
    {
        $sql="UPDATE pg_pedidos SET coment_entrega_ind='$det_vencim' WHERE idpg_pedidos='$idpedido'";

        return ejecutarConsulta($sql);
        
    }

    public function listar_pedido_detalle_term($id)
        {           
             

              $sql="SELECT pdp.idpg_detalle_pedidos,pdp.codigo,pdp.descripcion,pdp.medida,pdp.color,pdp.cantidad,(pdp.cantidad-(SELECT IFNULL(SUM(cantidad),0) FROM salidas_entregas_detalles WHERE idproducto=pdp.idpg_detalle_pedidos)) as pendiente, pdp.check_entrega,pdp.observacion,
                (SELECT IFNULL(sum(cantidad),0) FROM pg_detped WHERE iddetalle_pedido=pdp.idpg_detalle_pedidos AND estatus='Fabricado') as cant_fabricado,
                (SELECT IFNULL(sum(cantidad),0) FROM pg_detped WHERE iddetalle_pedido=pdp.idpg_detalle_pedidos AND estatus='Apartado') as cant_apartado,
                (SELECT IFNULL(sum(cantidad),0) FROM pg_detped WHERE iddetalle_pedido=pdp.idpg_detalle_pedidos AND estatus='Existencia') as cant_existencia,
                (SELECT IFNULL(sum(cantidad),0) FROM pg_detped WHERE iddetalle_pedido=pdp.idpg_detalle_pedidos AND estatus='Produccion') as cant_produccion,
                (SELECT IFNULL(sum(cantidad),0) FROM pg_detped WHERE iddetalle_pedido=pdp.idpg_detalle_pedidos AND estatus='Otro') as cant_otro,
                (SELECT IFNULL(SUM(cantidad),0) FROM salidas_entregas_detalles WHERE idproducto=pdp.idpg_detalle_pedidos) as cantidad_entre
                
              FROM pg_detalle_pedidos pdp  WHERE pdp.idpg_pedidos='$id'";
            return ejecutarConsulta($sql);          
        }


        public function listar_op($idpg_detalle_pedidos)
        {

            $sql="SELECT op FROM pg_detped WHERE iddetalle_pedido='$idpg_detalle_pedidos' AND estatus='Produccion' OR iddetalle_pedido='$idpg_detalle_pedidos' AND estatus='Fabricado'";
            //return ejecutarConsultaSimpleFila($sql);
            return ejecutarConsulta($sql);

        }
      
}
 
?>