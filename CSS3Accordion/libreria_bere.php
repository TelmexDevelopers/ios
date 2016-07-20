<?php 
function ImprimeCombo($numero, $valor_seleccion)//
{
	if ($numero)
	{
		$SQL = "SELECT * FROM ";
		switch($numero){
		
			case 1:
				$tabla = "cat_fase_ios_bere";
				$id='id_Fase_IOS';
				$string = 'str_Fase_IOS';
				$id_nombre_combo = 'fase_ios';
				$moo = 'class="mootools combos_referencia"';
				$campo = 1;
			break;
			case 2:
				$tabla = "cat_document";
				$id='id_document';
				$string = 'documento';
				$id_nombre_combo = 'document';
				$moo = 'class="mootools combos_referencia"';	
				$campo = 1;
			break;
			case 3:
				$tabla = "cat_motivo_ppu";	
				$id='id_motivo_ppu';
				$string = 'motivo_ppu';
				$id_nombre_combo = 'motivo_ppu';
				$moo = 'class="mootools combos_referencia"';	
				$campo =1;
			break;
			case 4:
				$tabla = "cat_con_ot";
				$id='idcat_con_OT';
				$string = 'str_conOT';
				$id_nombre_combo = 'con_ot';
				$moo = 'class="mootools combos_referencia"';	
				$campo =1;
			break;
			case 5:
				$tabla = "cat_proy_complet";
				$id='id_proy_complet';
				$string = 'proyecto';
				$id_nombre_combo = 'proyecto_completo';
				$moo = 'class="mootools combos_referencia"';	
				$campo =1;
			break;
			case 6:
				$tabla = "cat_medio_transmision";
				$id='id_medio_transmision';
				$string = 'str_medio_transmision';
				$id_nombre_combo = 'medio_transmision';
				$moo = 'class="mootools combos_referencia"';	
				$campo =1;
			break;
			case 7:
				$tabla = "cat_Filial";	
				$id='id_Filial';
				$string = 'str_Filial';
				$id_nombre_combo = 'filial';
				$moo = 'class="mootools combos_referencia"';	
				$campo =1;
			break;
			
			default:
				$tabla = "cat_con_ot";	
			break;
			}
		$SQL .= $tabla." ORDER BY ".$string;
		//echo $SQL;
		$html = "";
		$html .= '<select name="'.$id_nombre_combo.'" id="'.$id_nombre_combo.'" '.$moo.'>';
        $html .= '<option value="">Selecciona una opci&oacute;n</option>';
		$RS = TraeRecordset($SQL);
		if (!$RS) die("No Recordset");
		while(!$RS->EOF)
		{
			$html .= '<option value="'.$RS->fields(0).'"';
			if($valor_seleccion == $RS->fields(0))
			{
				$html .= ' selected="selected"';	
			}
			
			$html .= '>'.$RS->fields($campo).'</option>';
			$RS->MoveNext();
		}
		$html .= '</select>';
	}
	return strval($html);	
}
?>