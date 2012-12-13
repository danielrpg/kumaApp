<?php
	ob_start();
if (!isset ($_SESSION)){
	session_start();
	}
require('configuracion.php');
    require('funciones.php');
	require('funciones2.php');
	$tc_ctb  = $_SESSION['TC_CONTAB'];
	$fec = leer_param_gral();
 $logi = $_SESSION['login']; 	
?>
<html>
<head>
<link href="css/imprimir.css" rel="stylesheet" type="text/css" media="print" />
<link href="css/no_imprimir.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
	    <a href='solic_mante.php'>Salir</a>
  </div>
<?php	
	
	//Datos empresa		  
		
?>
<br>
<strong> 
<?php
if(isset($_SESSION['fec_proc'])){ 
  $fec_p = $_SESSION['fec_proc']; 
  }
if(isset($_SESSION['login'])){   
   $log_usr = $_SESSION['login']; 
   }
//$nope = $_SESSION['nope'];
$total = 0;
$f_tra = cambiaf_a_mysql_2($fec_p);
//echo $fec_p, $f_tra;
$_SESSION['msg_err'] = " ";
//$log_usr = $_SESSION['login'];
$error_d = 0;
//$nro_ord = $_SESSION['cod_ord'];

//echo "Fecha".encadenar(2).$_SESSION['fec_ord'].encadenar(70)."ORDEN DE TRABAJO".encadenar(70);

?>
<br><br>


 
	  
 <?php
// echo $_POST['hra_61'];
if(isset($_POST['hra_61'])){ 
    $hra_61 = $_POST['hra_61'];
	}else{
	$hra_61 = "";
}
if(isset($_POST['hra_62'])){ 
    $hra_62 = $_POST['hra_62'];
	}else{
	$hra_62 = "";
}	
if(isset($_POST['hra_63'])){ 
    $hra_63 = $_POST['hra_63'];
	}else{
	$hra_63 = "";
}
if(isset($_POST['hra_64'])){ 
    $hra_64 = $_POST['hra_64'];
	}else{
	$hra_64 = "";
}
if(isset($_POST['hra_65'])){ 
    $hra_65 = $_POST['hra_65'];
	}else{
	$hra_65 = "";
}
if(isset($_POST['hra_66'])){ 
    $hra_66 = $_POST['hra_66'];
	}else{
	$hra_66 = "";
}
if(isset($_POST['hra_67'])){ 
    $hra_67 = $_POST['hra_67'];
	}else{
	$hra_67 = "";
}
if(isset($_POST['hra_71'])){ 
    $hra_71 = $_POST['hra_71'];
	}else{
	$hra_71 = "";
}
if(isset($_POST['hra_72'])){ 
    $hra_72 = $_POST['hra_72'];
	}else{
	$hra_72 = "";
}	
if(isset($_POST['hra_73'])){ 
    $hra_73 = $_POST['hra_73'];
	}else{
	$hra_73 = "";
}
if(isset($_POST['hra_74'])){ 
    $hra_74 = $_POST['hra_74'];
	}else{
	$hra_74 = "";
}
if(isset($_POST['hra_75'])){ 
    $hra_75 = $_POST['hra_75'];
	}else{
	$hra_75 = "";
}
if(isset($_POST['hra_76'])){ 
    $hra_76 = $_POST['hra_76'];
	}else{
	$hra_76 = "";
}
if(isset($_POST['hra_77'])){ 
    $hra_77 = $_POST['hra_77'];
	}else{
	$hra_77 = "";
}
if(isset($_POST['hra_81'])){ 
    $hra_81 = $_POST['hra_81'];
	}else{
	$hra_81 = "";
}
if(isset($_POST['hra_82'])){ 
    $hra_82 = $_POST['hra_82'];
	}else{
	$hra_82 = "";
}
if(isset($_POST['hra_83'])){ 
    $hra_83 = $_POST['hra_83'];
	}else{
	$hra_83 = "";
}
if(isset($_POST['hra_84'])){ 
    $hra_84 = $_POST['hra_84'];
	}else{
	$hra_84 = "";
}
if(isset($_POST['hra_85'])){ 
    $hra_85 = $_POST['hra_85'];
	}else{
	$hra_85 = "";
}
if(isset($_POST['hra_86'])){ 
    $hra_86 = $_POST['hra_86'];
	}else{
	$hra_86 = "";
}
if(isset($_POST['hra_87'])){ 
    $hra_87 = $_POST['hra_87'];
	}else{
	$hra_87 = "";
}
if(isset($_POST['hra_91'])){ 
    $hra_91 = $_POST['hra_91'];
	}else{
	$hra_91 = "";
}
if(isset($_POST['hra_92'])){ 
    $hra_92 = $_POST['hra_92'];
	}else{
	$hra_92 = "";
}
if(isset($_POST['hra_93'])){ 
    $hra_93 = $_POST['hra_93'];
	}else{
	$hra_93 = "";
}
if(isset($_POST['hra_94'])){ 
    $hra_94 = $_POST['hra_94'];
	}else{
	$hra_94 = "";
}
if(isset($_POST['hra_95'])){ 
    $hra_95 = $_POST['hra_95'];
	}else{
	$hra_95 = "";
}
if(isset($_POST['hra_96'])){ 
    $hra_96 = $_POST['hra_96'];
	}else{
	$hra_96 = "";
}
if(isset($_POST['hra_97'])){ 
    $hra_97 = $_POST['hra_97'];
	}else{
	$hra_97 = "";
}
if(isset($_POST['hra_101'])){ 
    $hra_101 = $_POST['hra_101'];
	}else{
	$hra_101 = "";
}
if(isset($_POST['hra_102'])){ 
    $hra_102 = $_POST['hra_102'];
	}else{
	$hra_102 = "";
}
if(isset($_POST['hra_103'])){ 
    $hra_103 = $_POST['hra_103'];
	}else{
	$hra_103 = "";
}
if(isset($_POST['hra_104'])){ 
    $hra_104 = $_POST['hra_104'];
	}else{
	$hra_104 = "";
}
if(isset($_POST['hra_105'])){ 
    $hra_105 = $_POST['hra_105'];
	}else{
	$hra_105 = "";
}
if(isset($_POST['hra_106'])){ 
    $hra_106 = $_POST['hra_106'];
	}else{
	$hra_106 = "";
}
if(isset($_POST['hra_107'])){ 
    $hra_107 = $_POST['hra_107'];
	}else{
	$hra_107 = "";
}
if(isset($_POST['hra_111'])){ 
    $hra_111 = $_POST['hra_111'];
	}else{
	$hra_111 = "";
}
if(isset($_POST['hra_112'])){ 
    $hra_112 = $_POST['hra_112'];
	}else{
	$hra_112 = "";
}
if(isset($_POST['hra_113'])){ 
    $hra_113 = $_POST['hra_113'];
	}else{
	$hra_113 = "";
}
if(isset($_POST['hra_114'])){ 
    $hra_114 = $_POST['hra_114'];
	}else{
	$hra_114 = "";
}
if(isset($_POST['hra_115'])){ 
    $hra_115 = $_POST['hra_115'];
	}else{
	$hra_115 = "";
}
if(isset($_POST['hra_116'])){ 
    $hra_116 = $_POST['hra_116'];
	}else{
	$hra_116 = "";
}
if(isset($_POST['hra_117'])){ 
    $hra_117 = $_POST['hra_117'];
	}else{
	$hra_117 = "";
}
if(isset($_POST['hra_121'])){ 
    $hra_121 = $_POST['hra_121'];
	}else{
	$hra_121 = "";
}
if(isset($_POST['hra_122'])){ 
    $hra_122 = $_POST['hra_122'];
	}else{
	$hra_122 = "";
}
if(isset($_POST['hra_123'])){ 
    $hra_123 = $_POST['hra_123'];
	}else{
	$hra_123 = "";
}
if(isset($_POST['hra_124'])){ 
    $hra_124 = $_POST['hra_124'];
	}else{
	$hra_124 = "";
}
if(isset($_POST['hra_125'])){ 
    $hra_125 = $_POST['hra_125'];
	}else{
	$hra_125 = "";
}

if(isset($_POST['hra_126'])){ 
    $hra_126 = $_POST['hra_126'];
	}else{
	$hra_126 = "";
}
if(isset($_POST['hra_127'])){ 
    $hra_127 = $_POST['hra_127'];
	}else{
	$hra_127 = "";
}
if(isset($_POST['hra_131'])){ 
    $hra_131 = $_POST['hra_131'];
	}else{
	$hra_131 = "";
}
if(isset($_POST['hra_132'])){ 
    $hra_132 = $_POST['hra_132'];
	}else{
	$hra_132 = "";
}
if(isset($_POST['hra_133'])){ 
    $hra_133 = $_POST['hra_133'];
	}else{
	$hra_133 = "";
}
if(isset($_POST['hra_134'])){ 
    $hra_134 = $_POST['hra_134'];
	}else{
	$hra_134 = "";
}
if(isset($_POST['hra_135'])){ 
    $hra_135 = $_POST['hra_135'];
	}else{
	$hra_135 = "";
}
if(isset($_POST['hra_136'])){ 
    $hra_136 = $_POST['hra_136'];
	}else{
	$hra_136 = "";
}
if(isset($_POST['hra_137'])){ 
    $hra_137 = $_POST['hra_137'];
	}else{
	$hra_137 = "";
}
if(isset($_POST['hra_141'])){ 
    $hra_141 = $_POST['hra_141'];
	}else{
	$hra_141 = "";
}
if(isset($_POST['hra_142'])){ 
    $hra_142 = $_POST['hra_142'];
	}else{
	$hra_142 = "";
}
if(isset($_POST['hra_143'])){ 
    $hra_143 = $_POST['hra_143'];
	}else{
	$hra_143 = "";
}
if(isset($_POST['hra_144'])){ 
    $hra_144 = $_POST['hra_144'];
	}else{
	$hra_144 = "";
}
if(isset($_POST['hra_145'])){ 
    $hra_145 = $_POST['hra_145'];
	}else{
	$hra_145 = "";
}
if(isset($_POST['hra_146'])){ 
    $hra_146 = $_POST['hra_146'];
	}else{
	$hra_146 = "";
}
if(isset($_POST['hra_147'])){ 
    $hra_147 = $_POST['hra_147'];
	}else{
	$hra_147 = "";
}
if(isset($_POST['hra_151'])){ 
    $hra_151 = $_POST['hra_151'];
	}else{
	$hra_151 = "";
}
if(isset($_POST['hra_152'])){ 
    $hra_152 = $_POST['hra_152'];
	}else{
	$hra_152 = "";
}
if(isset($_POST['hra_153'])){ 
    $hra_153 = $_POST['hra_153'];
	}else{
	$hra_153 = "";
}
if(isset($_POST['hra_154'])){ 
    $hra_154 = $_POST['hra_154'];
	}else{
	$hra_154 = "";
}
if(isset($_POST['hra_155'])){ 
    $hra_155 = $_POST['hra_155'];
	}else{
	$hra_155 = "";
}
if(isset($_POST['hra_156'])){ 
    $hra_156 = $_POST['hra_156'];
	}else{
	$hra_156 = "";
}
if(isset($_POST['hra_157'])){ 
    $hra_157 = $_POST['hra_157'];
	}else{
	$hra_157 = "";
}
if(isset($_POST['hra_161'])){ 
    $hra_161 = $_POST['hra_161'];
	}else{
	$hra_161 = "";
}
if(isset($_POST['hra_162'])){ 
    $hra_162 = $_POST['hra_162'];
	}else{
	$hra_162 = "";
}
if(isset($_POST['hra_163'])){ 
    $hra_163 = $_POST['hra_163'];
	}else{
	$hra_163 = "";
}
if(isset($_POST['hra_164'])){ 
    $hra_164 = $_POST['hra_164'];
	}else{
	$hra_164 = "";
}
if(isset($_POST['hra_165'])){ 
    $hra_165 = $_POST['hra_165'];
	}else{
	$hra_165 = "";
}
if(isset($_POST['hra_166'])){ 
    $hra_166 = $_POST['hra_166'];
	}else{
	$hra_166 = "";
}
if(isset($_POST['hra_167'])){ 
    $hra_167 = $_POST['hra_167'];
	}else{
	$hra_167 = "";
}
if(isset($_POST['hra_171'])){ 
    $hra_171 = $_POST['hra_171'];
	}else{
	$hra_171 = "";
}
if(isset($_POST['hra_172'])){ 
    $hra_172 = $_POST['hra_172'];
	}else{
	$hra_172 = "";
}
if(isset($_POST['hra_173'])){ 
    $hra_173 = $_POST['hra_173'];
	}else{
	$hra_173 = "";
}
if(isset($_POST['hra_174'])){ 
    $hra_174 = $_POST['hra_174'];
	}else{
	$hra_174 = "";
}
if(isset($_POST['hra_175'])){ 
    $hra_175 = $_POST['hra_175'];
	}else{
	$hra_175 = "";
}
if(isset($_POST['hra_176'])){ 
    $hra_176 = $_POST['hra_176'];
	}else{
	$hra_176 = "";
}
if(isset($_POST['hra_177'])){ 
    $hra_177 = $_POST['hra_177'];
	}else{
	$hra_177 = "";
}
if(isset($_POST['hra_181'])){ 
    $hra_181 = $_POST['hra_181'];
	}else{
	$hra_181 = "";
}
if(isset($_POST['hra_182'])){ 
    $hra_182 = $_POST['hra_182'];
	}else{
	$hra_182 = "";
}
if(isset($_POST['hra_183'])){ 
    $hra_183 = $_POST['hra_183'];
	}else{
	$hra_183 = "";
}
if(isset($_POST['hra_184'])){ 
    $hra_184 = $_POST['hra_184'];
	}else{
	$hra_184 = "";
}
if(isset($_POST['hra_185'])){ 
    $hra_185 = $_POST['hra_185'];
	}else{
	$hra_185 = "";
}
if(isset($_POST['hra_186'])){ 
    $hra_186 = $_POST['hra_186'];
	}else{
	$hra_186 = "";
}
if(isset($_POST['hra_187'])){ 
    $hra_187 = $_POST['hra_187'];
	}else{
	$hra_187 = "";
}
if(isset($_POST['hra_191'])){ 
    $hra_191 = $_POST['hra_191'];
	}else{
	$hra_191 = "";
}
if(isset($_POST['hra_192'])){ 
    $hra_192 = $_POST['hra_192'];
	}else{
	$hra_192 = "";
}
if(isset($_POST['hra_193'])){ 
    $hra_193 = $_POST['hra_193'];
	}else{
	$hra_193 = "";
}
if(isset($_POST['hra_194'])){ 
    $hra_194 = $_POST['hra_194'];
	}else{
	$hra_194 = "";
}
if(isset($_POST['hra_195'])){ 
    $hra_195 = $_POST['hra_195'];
	}else{
	$hra_195 = "";
}
if(isset($_POST['hra_196'])){ 
    $hra_196 = $_POST['hra_196'];
	}else{
	$hra_196 = "";
}
if(isset($_POST['hra_197'])){ 
    $hra_197 = $_POST['hra_197'];
	}else{
	$hra_197 = "";
}
// $nope = $_SESSION['nope'];
 if(isset($_SESSION['fecha'])){
   $fecha = $_SESSION['fecha'];
} 
//$nro_ord = $_SESSION['cod_ord'];
//$hoy = date("Y-m-d H:i:s");

//$hora = $_SESSION["hora"];
//echo $hora. "hora";
//if ($hora == 1){
$act_tabla  = "update ord_conograma set ord_cro_6_det = '$hra_61',
                                        ord_cro_7_det = '$hra_71',
										ord_cro_8_det =' $hra_81',
										ord_cro_9_det = '$hra_91',
										 ord_cro_10_det = '$hra_101',
										 ord_cro_11_det = '$hra_111',
										ord_cro_12_det = '$hra_121',
										ord_cro_13_det = '$hra_131',
										ord_cro_14_det = '$hra_141',
										ord_cro_15_det = '$hra_151',
										 ord_cro_16_det = '$hra_161',
										 ord_cro_17_det = '$hra_171',
										ord_cro_18_det =' $hra_181',
										ord_cro_ot_det = '$hra_191'
               where  ord_cro_fecha = '$fecha'
			     and  ord_cro_ope = 1";
$res_tabla = mysql_query($act_tabla) or die
             ('No pudo actualizar ord_cronograma  1: ' . mysql_error());
//}			 
			 
$act_tabla  = "update ord_conograma set ord_cro_6_det = '$hra_62',
                                        ord_cro_7_det = '$hra_72',
										ord_cro_8_det =' $hra_82',
										ord_cro_9_det = '$hra_92',
										 ord_cro_10_det = '$hra_102',
										 ord_cro_11_det = '$hra_112',
										ord_cro_12_det = '$hra_122',
										ord_cro_13_det = '$hra_132',
										ord_cro_14_det = '$hra_142',
										ord_cro_15_det = '$hra_152',
										 ord_cro_16_det = '$hra_162',
										 ord_cro_17_det = '$hra_172',
										ord_cro_18_det =' $hra_182',
										ord_cro_ot_det = '$hra_192'
               where  ord_cro_fecha = '$fecha'
			     and  ord_cro_ope = 2";
$res_tabla = mysql_query($act_tabla) or die
             ('No pudo actualizar ord_cronograma  6: ' . mysql_error());

$act_tabla  = "update ord_conograma set ord_cro_6_det = '$hra_63',
                                        ord_cro_7_det = '$hra_73',
										ord_cro_8_det =' $hra_83',
										ord_cro_9_det = '$hra_93',
										 ord_cro_10_det = '$hra_103',
										 ord_cro_11_det = '$hra_113',
										ord_cro_12_det = '$hra_123',
										ord_cro_13_det = '$hra_133',
										ord_cro_14_det = '$hra_143',
										ord_cro_15_det = '$hra_153',
										 ord_cro_16_det = '$hra_163',
										 ord_cro_17_det = '$hra_173',
										ord_cro_18_det =' $hra_183',
										ord_cro_ot_det = '$hra_193'
               where  ord_cro_fecha = '$fecha'
			     and  ord_cro_ope = 3";
$res_tabla = mysql_query($act_tabla) or die
             ('No pudo actualizar ord_cronograma  6: ' . mysql_error());
$act_tabla  = "update ord_conograma set ord_cro_6_det = '$hra_64',
                                        ord_cro_7_det = '$hra_74',
										ord_cro_8_det =' $hra_84',
										ord_cro_9_det = '$hra_94',
										 ord_cro_10_det = '$hra_104',
										 ord_cro_11_det = '$hra_114',
										ord_cro_12_det = '$hra_124',
										ord_cro_13_det = '$hra_134',
										ord_cro_14_det = '$hra_144',
										ord_cro_15_det = '$hra_154',
										 ord_cro_16_det = '$hra_164',
										 ord_cro_17_det = '$hra_174',
										ord_cro_18_det =' $hra_184',
										ord_cro_ot_det = '$hra_194'
               where  ord_cro_fecha = '$fecha'
			     and  ord_cro_ope = 4";
$res_tabla = mysql_query($act_tabla) or die
             ('No pudo actualizar ord_cronograma  6: ' . mysql_error());
$act_tabla  = "update ord_conograma set ord_cro_6_det = '$hra_65',
                                        ord_cro_7_det = '$hra_75',
										ord_cro_8_det =' $hra_85',
										ord_cro_9_det = '$hra_95',
										 ord_cro_10_det = '$hra_105',
										 ord_cro_11_det = '$hra_115',
										ord_cro_12_det = '$hra_125',
										ord_cro_13_det = '$hra_135',
										ord_cro_14_det = '$hra_145',
										ord_cro_15_det = '$hra_155',
										 ord_cro_16_det = '$hra_165',
										 ord_cro_17_det = '$hra_175',
										ord_cro_18_det =' $hra_185',
										ord_cro_ot_det = '$hra_195'
               where  ord_cro_fecha = '$fecha'
			     and  ord_cro_ope = 5";
$res_tabla = mysql_query($act_tabla) or die
             ('No pudo actualizar ord_cronograma  6: ' . mysql_error());
	
$act_tabla  = "update ord_conograma set ord_cro_6_det = '$hra_66',
                                        ord_cro_7_det = '$hra_76',
										ord_cro_8_det =' $hra_86',
										ord_cro_9_det = '$hra_96',
										 ord_cro_10_det = '$hra_106',
										 ord_cro_11_det = '$hra_116',
										ord_cro_12_det = '$hra_126',
										ord_cro_13_det = '$hra_136',
										ord_cro_14_det = '$hra_146',
										ord_cro_15_det = '$hra_156',
										 ord_cro_16_det = '$hra_166',
										 ord_cro_17_det = '$hra_176',
										ord_cro_18_det =' $hra_186',
										ord_cro_ot_det = '$hra_196'
               where  ord_cro_fecha = '$fecha'
			     and  ord_cro_ope = 6";
$res_tabla = mysql_query($act_tabla) or die
             ('No pudo actualizar ord_cronograma  6: ' . mysql_error());	
			 
$act_tabla  = "update ord_conograma set ord_cro_6_det = '$hra_67',
                                        ord_cro_7_det = '$hra_77',
										ord_cro_8_det =' $hra_87',
										ord_cro_9_det = '$hra_97',
										 ord_cro_10_det = '$hra_107',
										 ord_cro_11_det = '$hra_117',
										ord_cro_12_det = '$hra_127',
										ord_cro_13_det = '$hra_137',
										ord_cro_14_det = '$hra_147',
										ord_cro_15_det = '$hra_157',
										 ord_cro_16_det = '$hra_167',
										 ord_cro_17_det = '$hra_177',
										ord_cro_18_det =' $hra_187',
										ord_cro_ot_det = '$hra_197'
               where  ord_cro_fecha = '$fecha'
			     and  ord_cro_ope = 7";
$res_tabla = mysql_query($act_tabla) or die
             ('No pudo actualizar ord_cronograma  7: ' . mysql_error());			 
$_SESSION['dia'] = 5;			 
 $_SESSION['fecha'] = $fecha;
 //echo $_SESSION['fecha']. "=". $fecha;
 header('Location: crono_diario.php');
 //require 'cliente_con_crono.php';

  ?>



<?php
ob_end_flush();
 ?>
 
                      