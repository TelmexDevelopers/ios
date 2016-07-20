<?php
	header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
	header('Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT');	
	header('Cache-Control: no-store, no-cache, must-revalidate');
	header('Cache-Control: post-check=0, pre-check=0', false);
	header('Pragma: no-cache');

	include('../../adodb/adodb.inc.php');
	include('connection.php');	
$referencia = $_GET['referencia'];
$ser_n = $_GET['ser_n'];
$num_ot = $_GET['num_ot'];
	
	
	$sql = "
	select 
		str_Num_OT,
		referencia, 
		str_Num_OT, 
		CLIENTE, 
		cto_manto_A,
		cto_manto_B, 
		-- dt_Fecha_Terminacion_Real, 
		Subgerente,         
		Supervisor,           
		str_telefono_fijo_sup

	from vw_ot 
				WHERE referencia ='".$referencia."' AND ser_n = '".$ser_n."' AND str_Num_OT = '".$num_OT."' LIMIT 1";
	
	
	  		
	//realiza una consulta para poder mostrar el resultado con una variable y pintarlo str_replace en un html
	$RS =  TraeRecordset($sql);
	//echo ($sql);
	if (!$RS) die("No Recordset");
			


while (!$RS->EOF)
	{
	//	$referencia           = $referencia;
	
		$str_Num_OT = 			$RS->fields(0);
		$referencia = 			$RS->fields(1);
		$str_Num_OT = 			$RS->fields(2);
		$CLIENTE  = 			$RS->fields(3);
		$cto_manto_A = 			$RS->fields(4);
		$cto_manto_B =  			$RS->fields(5);
		$dt_Fecha_Terminacion_Real =$RS->fields(6);
		$Subgerente            = $RS->fields(7);
		$Supervisor            = $RS->fields(8);
		$str_telefono_fijo_sup = $RS->fields(9);
		
		$RS->MoveNext();
		}
		
		if($RS)
		{
			$sql_ref_ot = "SELECT * FROM tb_referencias_ot WHERE referencia_principal = '".$referencia."' AND ser_n = '".$ser_n."' AND str_OT = '".$num_OT."'";
			$RS_ref_ot = TraeRecordset($sql_ref_ot);
			//echo $sql_ref_ot;
			if (!$RS_ref_ot) die("No Recordset");
			$contador = 0;
			$cuantos = $RS_ref_ot->RecordCount();
			
			if ($cuantos > 0)
			{
			$tabla_ref .= '<table width="800" border="0" >';
				while(!$RS_ref_ot->EOF)
				{
					if ($contador == 0)
					{
						$tabla_ref .= '<tr>';
					}
						if ($RS_ref_ot->fields(0) != "")
						{
							$tabla_ref .= '<td align="left"><b>'.$RS_ref_ot->fields(1).'</b></td>';
						} else {
							$tabla_ref .= '<td>&nbsp;</td>';
						}
					if ($contador == 3)
					{
						$tabla_ref .= '</tr>';
						$contador == 0;
					}
					$contador++;
					$RS_ref_ot->MoveNext();
				}
			$tabla_ref .= '</table>';
			} else {
				$tabla_ref .= '&nbsp;
				';
			}
			
		$RS_ref_ot->Close();
		$RS_ref_ot = NULL;
			
		}
		$RS->Close();
		$RS = NULL;
	
	$html = file_get_contents('formato_2.html');	
	
	
	$html = str_replace('<#REF1_OT>',		     $referencia,$html);
	$html = str_replace('<#REFERENCIAS_OT>',     $tabla_ref,$html);
	$html = str_replace('<#NUM_OT>',		     $str_Num_OT,$html);
	$html = str_replace('<#dt_Fecha_Terminacion_Real>',	     $dt_Fecha_Terminacion_Real,$html);
	$html = str_replace('<#CLIENTE>',	       	 $CLIENTE,$html);
	$html = str_replace('<#CNTRL_OT>',	         $cto_manto_A,$html);
	$html = str_replace('<#CNTRALB_OT>',         $cto_manto_B,$html);
	$html = str_replace('<#str_telefono_fijo_sup>',	         $str_telefono_fijo_sup,$html);
	$html = str_replace('<#SUPERVISOR_1>',	     $Supervisor,$html);

echo $html;

//echo '<script>print();<script>';

//$yay = str_ireplace($find, $replace , $html); 
?>