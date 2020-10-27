<?php
   include_once('grid_relatorio_emprestimo_session.php');
   session_start();
    if (!function_exists("NM_is_utf8"))
    {
        include_once("../_lib/lib/php/nm_utf8.php");
    }
    $Sel_Cmp = new grid_relatorio_emprestimo_sel_cmp(); 
    $Sel_Cmp->Sel_cmp_init();
   
class grid_relatorio_emprestimo_sel_cmp
{
function Sel_cmp_init()
{
   global $tab_ger_campos, $tab_blk_campos, $_POST, $_GET;
   $this->proc_ajax = false;
   if (isset($_POST['script_case_init']))
   {
       $this->sc_init     = $_POST['script_case_init'];
       $this->path_img    = $_POST['path_img'];
       $this->path_btn    = $_POST['path_btn'];
       $this->path_fields = $_POST['path_fields'];
       $this->embbed      = isset($_POST['embbed_groupby']) && 'Y' == $_POST['embbed_groupby'];
       $this->tbar_pos    = isset($_POST['toolbar_pos']) ? $_POST['toolbar_pos'] : '';
   }
   elseif (isset($_GET['script_case_init']))
   {
       $this->sc_init     = $_GET['script_case_init'];
       $this->path_img    = $_GET['path_img'];
       $this->path_btn    = $_GET['path_btn'];
       $this->path_fields = $_GET['path_fields'];
       $this->embbed      = isset($_GET['embbed_groupby']) && 'Y' == $_GET['embbed_groupby'];
       $this->tbar_pos    = isset($_GET['toolbar_pos']) ? $_GET['toolbar_pos'] : '';
   }
   if (isset($_POST['ajax_ctrl']) && $_POST['ajax_ctrl'] == "proc_ajax")
   {
       $this->proc_ajax = true;
   }
   $this->curr_fields = "";
   $this->ajax_return = array();
   $this->campos_sel  = isset($_POST['campos_sel']) ? $_POST['campos_sel'] : array();
   
   $tab_ger_campos = array();
   $tab_blk_campos = array();
   $tab_ger_campos['e_data_entrega'] = "on";
   $tab_ger_campos['e_data_devolucao'] = "on";
   $tab_ger_campos['e_status'] = "on";
   $tab_ger_campos['sc_field_1'] = "on";
   $tab_blk_campos[] = "sc_field_1";
   
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_relatorio_emprestimo']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_relatorio_emprestimo']['field_display']))
   {
       foreach ($_SESSION['scriptcase']['sc_apl_conf']['grid_relatorio_emprestimo']['field_display'] as $NM_cada_field => $NM_cada_opc)
       {
           if ($NM_cada_opc == "off")
           {
              $tab_ger_campos[$NM_cada_field] = "none";
           }
       }
   }
   if (isset($_SESSION['sc_session'][$this->sc_init]['grid_relatorio_emprestimo']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->sc_init]['grid_relatorio_emprestimo']['php_cmp_sel']))
   {
       foreach ($_SESSION['sc_session'][$this->sc_init]['grid_relatorio_emprestimo']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
       {
           if ($NM_cada_opc == "off")
           {
              $tab_ger_campos[$NM_cada_field] = "none";
           }
       }
   }
   
   if (isset($_SESSION['sc_session'][$this->sc_init]['grid_relatorio_emprestimo']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->sc_init]['grid_relatorio_emprestimo']['usr_cmp_sel']))
   {
       foreach ($_SESSION['sc_session'][$this->sc_init]['grid_relatorio_emprestimo']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
       {
           $tab_ger_campos[$NM_cada_field] = $NM_cada_opc;
       }
   }
   
   if (isset($_POST['fsel_ok']) && $_POST['fsel_ok'] == "OK" && !empty($this->campos_sel))
   {
       $this->Sel_processa_out();
   }
   else
   {
       if ($this->embbed)
       {
           ob_start();
           $this->Sel_processa_form();
           $Temp = ob_get_clean();
           echo NM_charset_to_utf8($Temp);
       }
       else
       {
           $this->Sel_processa_form();
       }
   }
   exit;
   
}

function Sel_processa_out()
{
   global $tab_ger_campos;
   $arr_temp = array();
   if (!isset($_SESSION['sc_session'][$this->sc_init]['grid_relatorio_emprestimo']['usr_cmp_sel']))
   {
       $_SESSION['sc_session'][$this->sc_init]['grid_relatorio_emprestimo']['usr_cmp_sel'] = array();
   }
   $arr_order = $_SESSION['sc_session'][$this->sc_init]['grid_relatorio_emprestimo']['field_order'];
   $_SESSION['sc_session'][$this->sc_init]['grid_relatorio_emprestimo']['field_order'] = array();
   $campos_sel = explode("@?@", $this->campos_sel);
   foreach ($campos_sel as $campo_order)
   {
       if (isset($tab_ger_campos[$campo_order]))
       {
           $_SESSION['sc_session'][$this->sc_init]['grid_relatorio_emprestimo']['field_order'][] = $campo_order;
       }
   }
   foreach ($arr_order as $campo_order)
   {
       if (!in_array($campo_order, $_SESSION['sc_session'][$this->sc_init]['grid_relatorio_emprestimo']['field_order']))
       {
           $_SESSION['sc_session'][$this->sc_init]['grid_relatorio_emprestimo']['field_order'][] = $campo_order;
       }
   }
   foreach ($tab_ger_campos as $campo_cons => $opc)
   {
       if (!in_array($campo_cons, $campos_sel) && $opc != "none")
       {
           $arr_temp[$campo_cons] = "off";
       }
   }
   $_SESSION['sc_session'][$this->sc_init]['grid_relatorio_emprestimo']['usr_cmp_sel'] = $arr_temp;
?>
    <script language="javascript"> 
<?php
   if (!$this->embbed)
   {
?>
      self.parent.tb_remove(); 
<?php
   }
?>
<?php
   $sParent = $this->embbed ? '' : 'parent.';
   echo $sParent . "nm_gp_submit_ajax('igual', '')"; 
?>
   </script>
<?php
}
   
function Sel_processa_form()
{
   global $tab_ger_campos, $tab_blk_campos;
   if ($this->proc_ajax)
   {
       ob_start();
   }
   $size = 10;
   $STR_lang    = (isset($_SESSION['scriptcase']['str_lang']) && !empty($_SESSION['scriptcase']['str_lang'])) ? $_SESSION['scriptcase']['str_lang'] : "pt_br";
   $NM_arq_lang = "../_lib/lang/" . $STR_lang . ".lang.php";
   $this->Nm_lang = array();
   if (is_file($NM_arq_lang))
   {
       include_once($NM_arq_lang);
   }
   $_SESSION['scriptcase']['charset']  = (isset($this->Nm_lang['Nm_charset']) && !empty($this->Nm_lang['Nm_charset'])) ? $this->Nm_lang['Nm_charset'] : "ISO-8859-1";
   foreach ($this->Nm_lang as $ind => $dados)
   {
      if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($ind))
      {
          $ind = sc_convert_encoding($ind, $_SESSION['scriptcase']['charset'], "UTF-8");
          $this->Nm_lang[$ind] = $dados;
      }
      if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($dados))
      {
          $this->Nm_lang[$ind] = sc_convert_encoding($dados, $_SESSION['scriptcase']['charset'], "UTF-8");
      }
   }
   $str_schema_all = (isset($_SESSION['scriptcase']['str_schema_all']) && !empty($_SESSION['scriptcase']['str_schema_all'])) ? $_SESSION['scriptcase']['str_schema_all'] : "numeracao_tema/numeracao_tema";
   include("../_lib/css/" . $str_schema_all . "_grid.php");
   $Str_btn_grid = trim($str_button) . "/" . trim($str_button) . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".php";
   include("../_lib/buttons/" . $Str_btn_grid);
   if (!function_exists("nmButtonOutput"))
   {
       include_once("../_lib/lib/php/nm_gp_config_btn.php");
   }
   if (!$this->embbed)
   {
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo $this->Nm_lang['lang_othr_grid_titl'] ?> - </TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php
if ($_SESSION['scriptcase']['proc_mobile'])
{
?>
   <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<?php
}
?>
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT"/>
 <META http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?> GMT"/>
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate"/>
 <META http-equiv="Cache-Control" content="post-check=0, pre-check=0"/>
 <META http-equiv="Pragma" content="no-cache"/>
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $_SESSION['scriptcase']['css_popup'] ?>" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $_SESSION['scriptcase']['css_popup_dir'] ?>" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $_SESSION['scriptcase']['css_popup_div'] ?>" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $_SESSION['scriptcase']['css_popup_div_dir'] ?>" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/buttons/<?php echo $_SESSION['scriptcase']['css_btn_popup'] ?>" /> 
</HEAD>
<BODY class="scGridPage" style="margin: 0px; overflow-x: hidden">
<script language="javascript" type="text/javascript" src="<?php echo $_SESSION['sc_session']['path_third'] ?>/jquery/js/jquery.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $_SESSION['sc_session']['path_third'] ?>/jquery/js/jquery-ui.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $_SESSION['sc_session']['path_third'] ?>/jquery_plugin/touch_punch/jquery.ui.touch-punch.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $_SESSION['sc_session']['path_third'] ?>/tigra_color_picker/picker.js"></script>
<?php
   }
?>
<script language="javascript"> 
<?php
if ($this->embbed)
{
?>
  function scSubmitSelCampos(sPos) {
   scPackSelected();
   $.ajax({
    type: "POST",
    url: "grid_relatorio_emprestimo_sel_campos.php",
    data: {
     script_case_init: $("#id_script_case_init_sel_campos").val(),
     script_case_session: $("#id_script_case_session_sel_campos").val(),
     path_img: $("#id_path_img_sel_campos").val(),
     path_btn: $("#id_path_btn_sel_campos").val(),
     path_fields: $("#id_path_fields_sel_campos").val(),
     campos_sel: $("#id_campos_sel_sel_campos").val(),
     fsel_ok: $("#id_fsel_ok_sel_campos").val(),
     embbed_groupby: 'Y'
    }
   }).success(function(data) {
    $("#sc_id_sel_campos_placeholder_" + sPos).find("td").html(data);
    scBtnSelCamposHide(sPos);
   });
  }
<?php
}
?>
 // Submeter o formularior
 //-------------------------------------
 function submit_form_Fsel()
 {
     scPackSelected();
      document.Fsel_campos.submit();
 }
 function scPackSelected() {
  var fieldList, fieldName, i, selectedFields = new Array;
 fieldList = $("#sc_id_fldsel_selected").sortable("toArray");
 for (i = 0; i < fieldList.length; i++) {
  fieldName = fieldList[i].substr(14);
  selectedFields.push(fieldName);
 }
 $("#id_campos_sel_sel_campos").val( selectedFields.join("@?@") );
 }
 </script>
<FORM name="Fsel_campos" method="POST">
  <INPUT type="hidden" name="script_case_init" id="id_script_case_init_sel_campos" value="<?php echo NM_encode_input($this->sc_init); ?>"> 
  <INPUT type="hidden" name="script_case_session" id="id_script_case_session_sel_campos" value="<?php echo NM_encode_input(session_id()); ?>"> 
  <INPUT type="hidden" name="path_img" id="id_path_img_sel_campos" value="<?php echo NM_encode_input($this->path_img); ?>"> 
  <INPUT type="hidden" name="path_btn" id="id_path_btn_sel_campos" value="<?php echo NM_encode_input($this->path_btn); ?>"> 
  <INPUT type="hidden" name="path_fields" id="id_path_fields_sel_campos" value="<?php echo NM_encode_input($this->path_fields); ?>"> 
  <INPUT type="hidden" name="campos_sel" id="id_campos_sel_sel_campos" value="">
  <INPUT type="hidden" name="fsel_ok" id="id_fsel_ok_sel_campos" value="OK"> 
<?php
if ($this->embbed)
{
    echo "<div class='scAppDivMoldura'>";
    echo "<table id=\"main_table\" style=\"width: 100%\" cellspacing=0 cellpadding=0>";
}
elseif ($_SESSION['scriptcase']['reg_conf']['html_dir'] == " DIR='RTL'")
{
    echo "<table id=\"main_table\" style=\"position: relative; top: 20px; right: 20px\">";
}
else
{
    echo "<table id=\"main_table\" style=\"position: relative; top: 20px; left: 20px\">";
}
?>
<?php
if (!$this->embbed)
{
?>
<tr>
<td>
<div class="scGridBorder">
<table width='100%' cellspacing=0 cellpadding=0>
<?php
}
?>
 <tr>
  <td class="<?php echo ($this->embbed)? 'scAppDivHeader scAppDivHeaderText':'scGridLabelVert'; ?>">
   <?php echo $this->Nm_lang['lang_btns_clmn_hint']; ?>
  </td>
 </tr>
 <script language="javascript" type="text/javascript">
  $(function() {
   $( "#sc_id_fldsel_selected" ).sortable({
     sort: function( event, ui ) {
             if ($(ui.item).hasClass('scAppDivSelectFieldsDisabled')) {
               return false;
             }
           }
   })
   $(".sc_ui_litem").mouseover(function() {
    $(this).css("cursor", "all-scroll");
   });
   $("#sc_id_fldsel_available").sortable({
    connectWith: ".sc_ui_fldsel_selected",
    placeholder: "scAppDivSelectFieldsPlaceholder"
   }).disableSelection();
   $("#sc_id_fldsel_selected").sortable({
    connectWith: ".sc_ui_fldsel_available",
    placeholder: "scAppDivSelectFieldsPlaceholder"
   }).disableSelection();
   scUpdateListHeight();
  });
  function scUpdateListHeight() {
   $("#sc_id_fldsel_available").css("min-height", "<?php echo sizeof($tab_ger_campos) * 29 ?>px");
   $("#sc_id_fldsel_selected").css("min-height", "<?php echo sizeof($tab_ger_campos) * 29 ?>px");
  }
 </script>
 <style type="text/css">
  .sc_ui_sortable {
   list-style-type: none;
   margin: 0;
   min-width: 225px;
  }
  .sc_ui_sortable li {
   margin: 0 3px 3px 3px;
   padding: 3px 3px 3px 15px;
   height: 18px;
  }
  .sc_ui_sortable li span {
   position: absolute;
   margin-left: -1.3em;
  }
 </style>
 <tr>
  <td class="<?php echo ($this->embbed)? 'scAppDivContent css_scAppDivContentText':'scGridTabelaTd'; ?>">
   <table class="<?php echo ($this->embbed)? '':'scGridTabela'; ?>" style="border-width: 0; border-collapse: collapse; width:100%;" cellspacing=0 cellpadding=0>
    <tr class="<?php echo ($this->embbed)? '':'scGridFieldOddVert'; ?>">
     <td style="vertical-align: top">
     <table>
      <tr>
      <td id="select_orig" style="vertical-align: top">
<?php
   if ($this->proc_ajax)
   {
       ob_end_clean();
       ob_start();
   }
?>
    <ul class="sc_ui_sort_groupby sc_ui_sortable sc_ui_fldsel_available scAppDivSelectFields" id="sc_id_fldsel_available">
<?php
   $prep_combo = array();
   foreach ($tab_ger_campos as $NM_cada_field => $NM_cada_opc)
   {
       if ($NM_cada_opc != "none")
       {
           if ($NM_cada_opc != "on")
           {
               $prep_combo[strtolower($NM_cada_field)] = $_SESSION['sc_session'][$this->sc_init]['grid_relatorio_emprestimo']['labels'][$NM_cada_field];
           }
       }
   }
   foreach ($prep_combo as $ind => $cada_field)
   {
?>
     <li class="sc_ui_litem scAppDivSelectFieldsEnabled" id="sc_id_itemsel_<?php echo NM_encode_input($ind); ?>"><?php echo $cada_field; ?></li>
<?php
   }
?>
    </ul>
<?php
   if ($this->proc_ajax)
   {
       $this->ajax_return['setHtml'][] = array('field' => 'select_orig', 'value' => ob_get_contents());
   }
?>
   </td>
   <td style="vertical-align: top" id="select_dest">
<?php
   if ($this->proc_ajax)
   {
       ob_end_clean();
       ob_start();
   }
?>
    <ul class="sc_ui_sort_groupby sc_ui_sortable sc_ui_fldsel_selected scAppDivSelectFields" id="sc_id_fldsel_selected">
<?php
   if (isset($_SESSION['sc_session'][$this->sc_init]['grid_relatorio_emprestimo']['field_order']))
   {
       foreach ($_SESSION['sc_session'][$this->sc_init]['grid_relatorio_emprestimo']['field_order'] as $NM_cada_field)
       {
           if ($tab_ger_campos[$NM_cada_field] == "on")
           {
               if (!in_array($NM_cada_field, $tab_blk_campos))
               {
?>
     <li class="sc_ui_litem scAppDivSelectFieldsEnabled" id="sc_id_itemsel_<?php echo NM_encode_input($NM_cada_field); ?>"><?php echo $_SESSION['sc_session'][$this->sc_init]['grid_relatorio_emprestimo']['labels'][$NM_cada_field]; ?></li>
<?php
               }
               else
               {
?>
     <li class="sc_ui_litem scAppDivSelectFieldsDisabled" id="sc_id_itemsel_<?php echo NM_encode_input($NM_cada_field); ?>"><?php echo $_SESSION['sc_session'][$this->sc_init]['grid_relatorio_emprestimo']['labels'][$NM_cada_field]; ?></li>
<?php
               }
           }
       }
   }
?>
    </ul>
<?php
   if ($this->proc_ajax)
   {
       $this->ajax_return['setHtml'][] = array('field' => 'select_dest', 'value' => ob_get_contents());
   }
?>
   </td></tr>
   </tr>
   </table>
   </td>
   </tr>
   </td></tr></table>
  </td>
  </tr>
   <tr><td class="<?php echo ($this->embbed)? 'scAppDivToolbar':'scGridToolbar'; ?>">
<?php
   if (!$this->embbed)
   {
?>
   <?php echo nmButtonOutput($this->arr_buttons, "bok", "submit_form_Fsel()", "submit_form_Fsel()", "f_sel_sub", "", "", "", "absmiddle", "", "0px", $this->path_btn, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
?>
<?php
   }
   else
   {
?>
   <?php echo nmButtonOutput($this->arr_buttons, "bapply", "scSubmitSelCampos('" . NM_encode_input($this->tbar_pos) . "')", "scSubmitSelCampos('" . NM_encode_input($this->tbar_pos) . "')", "f_sel_sub", "", "", "", "absmiddle", "", "0px", $this->path_btn, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
?>
<?php
   }
?>
  &nbsp;&nbsp;&nbsp
<?php
   if (!$this->embbed)
   {
?>
   <?php echo nmButtonOutput($this->arr_buttons, "bsair", "self.parent.tb_remove()", "self.parent.tb_remove()", "Bsair", "", "", "", "absmiddle", "", "0px", $this->path_btn, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
?>
<?php
   }
   else
   {
?>
   <?php echo nmButtonOutput($this->arr_buttons, "bcancelar", "scBtnSelCamposHide('" . NM_encode_input($this->tbar_pos) . "')", "scBtnSelCamposHide('" . NM_encode_input($this->tbar_pos) . "')", "Bsair", "", "", "", "absmiddle", "", "0px", $this->path_btn, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
?>
<?php
   }
?>
<?php
if (!$this->embbed)
{
?>
 </table>
 </div>
 </td>
 </tr>
<?php
}
?>
 </table>
<?php
if ($this->embbed)
{
?>
    </div>
<?php
}
?>
</FORM>
<?php
   if (!$this->embbed)
   {
?>
<script language="javascript"> 
var bFixed = false;
function ajusta_window_Fsel()
{
  var mt = $(document.getElementById("main_table"));
  if (0 == mt.width() || 0 == mt.height())
  {
    setTimeout("ajusta_window_Fsel()", 50);
    return;
  }
  else if(!bFixed)
  {
    var oOrig = $(document.Fsel_campos.sel_orig),
        oDest = $(document.Fsel_campos.sel_dest),
        mHeight = Math.max(oOrig.height(), oDest.height()),
        mWidth = Math.max(oOrig.width() + 5, oDest.width() + 5);
    oOrig.height(mHeight);
    oOrig.width(mWidth);
    oDest.height(mHeight);
    oDest.width(mWidth);
    bFixed = true;
    if (navigator.userAgent.indexOf("Chrome/") > 0)
    {
      strMaxHeight = Math.min(($(window.parent).height()-80), mt.height());
      self.parent.tb_resize(strMaxHeight + 40, mt.width() + 40);
      setTimeout("ajusta_window_Fsel()", 50);
      return;
    }
  }
  strMaxHeight = Math.min(($(window.parent).height()-80), mt.height());
  self.parent.tb_resize(strMaxHeight + 40, mt.width() + 40);
}
$( document ).ready(function() {
  ajusta_window_Fsel();
});
</script>
<script>
  ajusta_window_Fsel();
</script>
</BODY>
</HTML>
<?php
   }
   if ($this->proc_ajax)
   {
       ob_end_clean();
       $oJson = new Services_JSON();
       echo $oJson->encode($this->ajax_return);
       exit;
   }
}
}
