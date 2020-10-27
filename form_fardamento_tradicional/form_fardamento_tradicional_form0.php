<?php

if (!isset($this->NM_ajax_info['param']['buffer_output']) || !$this->NM_ajax_info['param']['buffer_output'])
{
    $sOBContents = ob_get_contents();
    ob_end_clean();
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">

<html<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php if ('novo' == $this->nmgp_opcao) { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmi_titl'] . " - fardamento"); } else { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmu_titl'] . " - fardamento"); } ?></TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT"/>
 <META http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?> GMT"/>
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate"/>
 <META http-equiv="Cache-Control" content="post-check=0, pre-check=0"/>
 <META http-equiv="Pragma" content="no-cache"/>
<?php
header("X-XSS-Protection: 0");
?>
<?php

if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'])
{
?>
 <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
}

?>
 <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/thickbox.css" type="text/css" media="screen" />
 <SCRIPT type="text/javascript">
  var sc_pathToTB = '<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/';
  var sc_blockCol = '<?php echo $this->Ini->Block_img_col; ?>';
  var sc_blockExp = '<?php echo $this->Ini->Block_img_exp; ?>';
  var sc_ajaxBg = '<?php echo $this->Ini->Color_bg_ajax; ?>';
  var sc_ajaxBordC = '<?php echo $this->Ini->Border_c_ajax; ?>';
  var sc_ajaxBordS = '<?php echo $this->Ini->Border_s_ajax; ?>';
  var sc_ajaxBordW = '<?php echo $this->Ini->Border_w_ajax; ?>';
  var sc_ajaxMsgTime = 2;
  var sc_img_status_ok = '<?php echo $this->Ini->path_icones; ?>/<?php echo $this->Ini->Img_status_ok; ?>';
  var sc_img_status_err = '<?php echo $this->Ini->path_icones; ?>/<?php echo $this->Ini->Img_status_err; ?>';
  var sc_css_status = '<?php echo $this->Ini->Css_status; ?>';
 </SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery/js/jquery.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery/js/jquery-ui.js"></SCRIPT>
 <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery/css/smoothness/jquery-ui.css" type="text/css" media="screen" />
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.iframe-transport.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.fileupload.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/malsup-blockui/jquery.blockUI.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/thickbox/thickbox-compressed.js"></SCRIPT>
 <style type="text/css">
  .fileinput-button-padding {
   padding: 3px 10px !important;
  }
  .fileinput-button {
   position: relative;
   overflow: hidden;
   float: left;
   margin-right: 4px;
  }
  .fileinput-button input {
   position: absolute;
   top: 0;
   right: 0;
   margin: 0;
   border: solid transparent;
   border-width: 0 0 100px 200px;
   opacity: 0;
   filter: alpha(opacity=0);
   -moz-transform: translate(-300px, 0) scale(4);
   direction: ltr;
   cursor: pointer;
  }
 </style>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.scInput.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.fieldSelection.js"></SCRIPT>
 <?php
 if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['embutida_pdf']))
 {
 ?>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_form.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_form<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_tab.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_tab<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/buttons/<?php echo $this->Ini->Str_btn_form . '/' . $this->Ini->Str_btn_form ?>.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_calendar.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_calendar<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
<?php
   include_once("../_lib/css/" . $this->Ini->str_schema_all . "_tab.php");
 }
?>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>form_fardamento_tradicional/form_fardamento_tradicional_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />

<script>
var scFocusFirstErrorField = false;
var scFocusFirstErrorName  = "<?php echo $this->scFormFocusErrorName; ?>";
</script>

<?php
include_once("form_fardamento_tradicional_sajax_js.php");
?>
<script type="text/javascript">
if (document.getElementById("id_error_display_fixed"))
{
 scCenterFixedElement("id_error_display_fixed");
}
var posDispLeft = 0;
var posDispTop = 0;
var Nm_Proc_Atualiz = false;
function findPos(obj)
{
 var posCurLeft = posCurTop = 0;
 if (obj.offsetParent)
 {
  posCurLeft = obj.offsetLeft
  posCurTop = obj.offsetTop
  while (obj = obj.offsetParent)
  {
   posCurLeft += obj.offsetLeft
   posCurTop += obj.offsetTop
  }
 }
 posDispLeft = posCurLeft - 10;
 posDispTop = posCurTop + 30;
}
var Nav_permite_ret = "<?php if ($this->Nav_permite_ret) { echo 'S'; } else { echo 'N'; } ?>";
var Nav_permite_ava = "<?php if ($this->Nav_permite_ava) { echo 'S'; } else { echo 'N'; } ?>";
var Nav_binicio     = "<?php echo $this->arr_buttons['binicio']['type']; ?>";
var Nav_binicio_off = "<?php echo $this->arr_buttons['binicio_off']['type']; ?>";
var Nav_bavanca     = "<?php echo $this->arr_buttons['bavanca']['type']; ?>";
var Nav_bavanca_off = "<?php echo $this->arr_buttons['bavanca_off']['type']; ?>";
var Nav_bretorna    = "<?php echo $this->arr_buttons['bretorna']['type']; ?>";
var Nav_bretorna_off = "<?php echo $this->arr_buttons['bretorna_off']['type']; ?>";
var Nav_bfinal      = "<?php echo $this->arr_buttons['bfinal']['type']; ?>";
var Nav_bfinal_off  = "<?php echo $this->arr_buttons['bfinal_off']['type']; ?>";
function nav_atualiza(str_ret, str_ava, str_pos)
{
<?php
 if (isset($this->NM_btn_navega) && 'N' == $this->NM_btn_navega)
 {
     echo " return;";
 }
 else
 {
?>
 if ('S' == str_ret)
 {
<?php
    if ($this->nmgp_botoes['first'] == "on")
    {
?>
       $("#sc_b_ini_" + str_pos).show();
       $("#sc_b_ini_off_" + str_pos).hide().prop("disabled", false);
       $("#gbl_sc_b_ini_" + str_pos).show();
       $("#gbl_sc_b_ini_off_" + str_pos).hide();
<?php
    }
    if ($this->nmgp_botoes['back'] == "on")
    {
?>
       $("#sc_b_ret_" + str_pos).show();
       $("#sc_b_ret_off_" + str_pos).hide().prop("disabled", false);
       $("#gbl_sc_b_ret_" + str_pos).show();
       $("#gbl_sc_b_ret_off_" + str_pos).hide();
<?php
    }
?>
 }
 else
 {
<?php
    if ($this->nmgp_botoes['first'] == "on")
    {
?>
       $("#sc_b_ini_" + str_pos).hide();
       $("#sc_b_ini_off_" + str_pos).prop("disabled", true).show();
       $("#gbl_sc_b_ini_" + str_pos).hide();
       $("#gbl_sc_b_ini_off_" + str_pos).show();
<?php
    }
    if ($this->nmgp_botoes['back'] == "on")
    {
?>
       $("#sc_b_ret_" + str_pos).hide();
       $("#sc_b_ret_off_" + str_pos).prop("disabled", true).show();
       $("#gbl_sc_b_ret_" + str_pos).hide();
       $("#gbl_sc_b_ret_off_" + str_pos).show();
<?php
    }
?>
 }
 if ('S' == str_ava)
 {
<?php
    if ($this->nmgp_botoes['last'] == "on")
    {
?>
       $("#sc_b_fim_" + str_pos).show();
       $("#sc_b_fim_off_" + str_pos).hide().prop("disabled", false);
       $("#gbl_sc_b_fim_" + str_pos).show();
       $("#gbl_sc_b_fim_off_" + str_pos).hide();
<?php
    }
    if ($this->nmgp_botoes['forward'] == "on")
    {
?>
       $("#sc_b_avc_" + str_pos).show();
       $("#sc_b_avc_off_" + str_pos).hide().prop("disabled", false);
       $("#gbl_sc_b_avc_" + str_pos).show();
       $("#gbl_sc_b_avc_off_" + str_pos).hide();
<?php
    }
?>
 }
 else
 {
<?php
    if ($this->nmgp_botoes['last'] == "on")
    {
?>
       $("#sc_b_fim_" + str_pos).hide();
       $("#sc_b_fim_off_" + str_pos).prop("disabled", true).show();
       $("#gbl_sc_b_fim_" + str_pos).hide();
       $("#gbl_sc_b_fim_off_" + str_pos).show();
<?php
    }
    if ($this->nmgp_botoes['forward'] == "on")
    {
?>
       $("#sc_b_avc_" + str_pos).hide();
       $("#sc_b_avc_off_" + str_pos).prop("disabled", true).show();
       $("#gbl_sc_b_avc_" + str_pos).hide();
       $("#gbl_sc_b_avc_off_" + str_pos).show();
<?php
    }
?>
 }
<?php
  }
?>
}
function nav_liga_img()
{
 sExt = sImg.substr(sImg.length - 4);
 sImg = sImg.substr(0, sImg.length - 4);
 if ('_off' == sImg.substr(sImg.length - 4))
 {
  sImg = sImg.substr(0, sImg.length - 4);
 }
 sImg += sExt;
}
function nav_desliga_img()
{
 sExt = sImg.substr(sImg.length - 4);
 sImg = sImg.substr(0, sImg.length - 4);
 if ('_off' != sImg.substr(sImg.length - 4))
 {
  sImg += '_off';
 }
 sImg += sExt;
}
<?php

include_once('form_fardamento_tradicional_jquery.php');

?>

 var scQSInit = true;
 var scQSPos  = {};
 var Dyn_Ini  = true;
 $(function() {

  scJQElementsAdd('');

  scJQGeneralAdd();

  $(document).bind('drop dragover', function (e) {
      e.preventDefault();
  });

  var i, iTestWidth, iMaxLabelWidth = 0, $labelList = $(".scUiLabelWidthFix");
  for (i = 0; i < $labelList.length; i++) {
    iTestWidth = $($labelList[i]).width();
    sTestWidth = iTestWidth + "";
    if ("" == iTestWidth) {
      iTestWidth = 0;
    }
    else if ("px" == sTestWidth.substr(sTestWidth.length - 2)) {
      iTestWidth = parseInt(sTestWidth.substr(0, sTestWidth.length - 2));
    }
    iMaxLabelWidth = Math.max(iMaxLabelWidth, iTestWidth);
  }
  if (0 < iMaxLabelWidth) {
    $(".scUiLabelWidthFix").css("width", iMaxLabelWidth + "px");
  }
<?php
if (!$this->NM_ajax_flag && isset($this->NM_non_ajax_info['ajaxJavascript']) && !empty($this->NM_non_ajax_info['ajaxJavascript']))
{
    foreach ($this->NM_non_ajax_info['ajaxJavascript'] as $aFnData)
    {
?>
  <?php echo $aFnData[0]; ?>(<?php echo implode(', ', $aFnData[1]); ?>);

<?php
    }
}
?>
 });

   $(window).load(function() {
   });
 if($(".sc-ui-block-control").length) {
  preloadBlock = new Image();
  preloadBlock.src = "<?php echo $this->Ini->path_icones; ?>/" + sc_blockExp;
 }

 var show_block = {
  
 };

 function toggleBlock(e) {
  var block = e.data.block,
      block_id = $(block).attr("id");
      block_img = $("#" + block_id + " .sc-ui-block-control");

  if (1 >= block.rows.length) {
   return;
  }

  show_block[block_id] = !show_block[block_id];

  if (show_block[block_id]) {
    $(block).css("height", "100%");
    if (block_img.length) block_img.attr("src", changeImgName(block_img.attr("src"), sc_blockCol));
  }
  else {
    $(block).css("height", "");
    if (block_img.length) block_img.attr("src", changeImgName(block_img.attr("src"), sc_blockExp));
  }

  for (var i = 1; i < block.rows.length; i++) {
   if (show_block[block_id])
    $(block.rows[i]).show();
   else
    $(block.rows[i]).hide();
  }

  if (show_block[block_id]) {
  }
 }

 function changeImgName(imgOld, imgNew) {
   var aOld = imgOld.split("/");
   aOld.pop();
   aOld.push(imgNew);
   return aOld.join("/");
 }

</script>
</HEAD>
<?php
$str_iframe_body = ('F' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['run_iframe'] || 'R' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['run_iframe']) ? 'margin: 2px;' : '';
 if (isset($_SESSION['nm_aba_bg_color']))
 {
     $this->Ini->cor_bg_grid = $_SESSION['nm_aba_bg_color'];
     $this->Ini->img_fun_pag = $_SESSION['nm_aba_bg_img'];
 }
if ($GLOBALS["erro_incl"] == 1)
{
    $this->nmgp_opcao = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['opc_ant'] = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['recarga'] = "novo";
}
if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['recarga']))
{
    $opcao_botoes = $this->nmgp_opcao;
}
else
{
    $opcao_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['recarga'];
}
?>
<body class="scFormPage" style="<?php echo $str_iframe_body; ?>">
<?php

if (!isset($this->NM_ajax_info['param']['buffer_output']) || !$this->NM_ajax_info['param']['buffer_output'])
{
    echo $sOBContents;
}

?>
<div id="idJSSpecChar" style="display: none;"></div>
<script type="text/javascript">
function NM_tp_critica(TP)
{
    if (TP == 0 || TP == 1 || TP == 2)
    {
        nmdg_tipo_crit = TP;
    }
}
</script> 
<?php
 include_once("form_fardamento_tradicional_js0.php");
?>
<script type="text/javascript"> 
 function setLocale(oSel)
 {
  var sLocale = "";
  if (-1 < oSel.selectedIndex)
  {
   sLocale = oSel.options[oSel.selectedIndex].value;
  }
  document.F1.nmgp_idioma_novo.value = sLocale;
 }
 function setSchema(oSel)
 {
  var sLocale = "";
  if (-1 < oSel.selectedIndex)
  {
   sLocale = oSel.options[oSel.selectedIndex].value;
  }
  document.F1.nmgp_schema_f.value = sLocale;
 }
 </script>
<form name="F1" method="post" 
               action="./" 
               target="_self"> 
<input type="hidden" name="nm_form_submit" value="1">
<input type="hidden" name="nmgp_idioma_novo" value="">
<input type="hidden" name="nmgp_schema_f" value="">
<input type="hidden" name="nmgp_url_saida" value="">
<?php
if ('novo' == $this->nmgp_opcao || 'incluir' == $this->nmgp_opcao)
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['insert_validation'] = md5(time() . rand(1, 99999));
?>
<input type="hidden" name="nmgp_ins_valid" value="<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['insert_validation']; ?>">
<?php
}
?>
<input type="hidden" name="nmgp_opcao" value="">
<input type="hidden" name="nmgp_ancora" value="">
<input type="hidden" name="nmgp_num_form" value="<?php  echo $this->form_encode_input($nmgp_num_form); ?>">
<input type="hidden" name="nmgp_parms" value="">
<input type="hidden" name="script_case_init" value="<?php  echo $this->form_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="script_case_session" value="<?php  echo $this->form_encode_input(session_id()); ?>"> 
<input type="hidden" name="NM_cancel_return_new" value="<?php echo $this->NM_cancel_return_new ?>"> 
<input type="hidden" name="csrf_token" value="<?php echo $this->scCsrfGetToken() ?>" /> 
<input type="hidden" name="_sc_force_mobile" id="sc-id-mobile-control" value="" />
<?php
$_SESSION['scriptcase']['error_span_title']['form_fardamento_tradicional'] = $this->Ini->Error_icon_span;
$_SESSION['scriptcase']['error_icon_title']['form_fardamento_tradicional'] = '' != $this->Ini->Err_ico_title ? $this->Ini->path_icones . '/' . $this->Ini->Err_ico_title : '';
?>
<div style="display: none; position: absolute; z-index: 1000" id="id_error_display_table_frame">
<table class="scFormErrorTable">
<tr><?php if ($this->Ini->Error_icon_span && '' != $this->Ini->Err_ico_title) { ?><td style="padding: 0px" rowspan="2"><img src="<?php echo $this->Ini->path_icones; ?>/<?php echo $this->Ini->Err_ico_title; ?>" style="border-width: 0px" align="top"></td><?php } ?><td class="scFormErrorTitle"><table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormErrorTitleFont" style="padding: 0px; vertical-align: top; width: 100%"><?php if (!$this->Ini->Error_icon_span && '' != $this->Ini->Err_ico_title) { ?><img src="<?php echo $this->Ini->path_icones; ?>/<?php echo $this->Ini->Err_ico_title; ?>" style="border-width: 0px" align="top">&nbsp;<?php } ?><?php echo $this->Ini->Nm_lang['lang_errm_errt'] ?></td><td style="padding: 0px; vertical-align: top"><?php echo nmButtonOutput($this->arr_buttons, "berrm_clse", "scAjaxHideErrorDisplay('table')", "scAjaxHideErrorDisplay('table')", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
</td></tr></table></td></tr>
<tr><td class="scFormErrorMessage"><span id="id_error_display_table_text"></span></td></tr>
</table>
</div>
<div style="display: none; position: absolute; z-index: 1000" id="id_message_display_frame">
 <table class="scFormMessageTable" id="id_message_display_content" style="width: 100%">
  <tr id="id_message_display_title_line">
   <td class="scFormMessageTitle" style="height: 20px"><?php
if ('' != $this->Ini->Msg_ico_title) {
?>
<img src="<?php echo $this->Ini->path_icones . '/' . $this->Ini->Msg_ico_title; ?>" style="border-width: 0px; vertical-align: middle">&nbsp;<?php
}
?>
<?php echo nmButtonOutput($this->arr_buttons, "bmessageclose", "_scAjaxMessageBtnClose()", "_scAjaxMessageBtnClose()", "id_message_display_close_icon", "", "", "float: right", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<span id="id_message_display_title" style="vertical-align: middle"></span></td>
  </tr>
  <tr>
   <td class="scFormMessageMessage"><?php
if ('' != $this->Ini->Msg_ico_body) {
?>
<img id="id_message_display_body_icon" src="<?php echo $this->Ini->path_icones . '/' . $this->Ini->Msg_ico_body; ?>" style="border-width: 0px; vertical-align: middle">&nbsp;<?php
}
?>
<span id="id_message_display_text"></span><div id="id_message_display_buttond" style="display: none; text-align: center"><br /><input id="id_message_display_buttone" type="button" class="scButton_default" value="Ok" onClick="_scAjaxMessageBtnClick()" ></div></td>
  </tr>
 </table>
</div>
<script type="text/javascript">
var scMsgDefTitle = "<?php echo $this->Ini->Nm_lang['lang_usr_lang_othr_msgs_titl']; ?>";
var scMsgDefButton = "Ok";
var scMsgDefClick = "close";
var scMsgDefScInit = "<?php echo $this->Ini->page; ?>";
</script>
<table id="main_table_form"  align="center" cellpadding=0 cellspacing=0 >
 <tr>
  <td>
  <div class="scFormBorder">
   <table width='100%' cellspacing=0 cellpadding=0>
<tr><td>
<?php
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['run_iframe'] != "R")
{
    $NM_btn = false;
?> 
     </td> 
     <td nowrap align="center" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['new'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bnovo", "nm_move ('novo');", "nm_move ('novo');", "sc_b_new_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!$this->Embutida_call || $this->sc_evento == "novo" || $this->sc_evento == "insert" || $this->sc_evento == "incluir")) {
        $sCondStyle = ($this->nmgp_botoes['insert'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bincluir", "nm_atualiza ('incluir');", "nm_atualiza ('incluir');", "sc_b_ins_t", "", "Entregar", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
?> 
     </td> 
     <td nowrap align="right" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
    if (isset($this->NMSC_modal) && $this->NMSC_modal == "ok") {
        $sCondStyle = '';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bsair", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "sc_b_sai_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['run_iframe'] != "R")
{
?>
   </td></tr> 
   </table> 
   </td></tr></table> 
<?php
}
?>
<?php
if (!$NM_btn && isset($NM_ult_sep))
{
    echo "    <script language=\"javascript\">";
    echo "      document.getElementById('" .  $NM_ult_sep . "').style.display='none';";
    echo "    </script>";
}
unset($NM_ult_sep);
?>
<?php if ('novo' != $this->nmgp_opcao || $this->Embutida_form) { ?><script>nav_atualiza(Nav_permite_ret, Nav_permite_ava, 't');</script><?php } ?>
</td></tr> 
<tr><td>
<?php
       echo "<div id=\"sc-ui-empty-form\" class=\"scFormPageText\" style=\"padding: 10px; text-align: center; font-weight: bold" . ($this->nmgp_form_empty ? '' : '; display: none') . "\">";
       echo $this->Ini->Nm_lang['lang_errm_empt'];
       echo "</div>";
  if ($this->nmgp_form_empty)
  {
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['where_filter']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['empty_filter'] = true;
       }
  }
  else
  {
?>
<?php $sc_hidden_no = 1; $sc_hidden_yes = 0; ?>
   <a name="bloco_0"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_0"><!-- bloco_c -->
<?php
   if (!isset($this->nmgp_cmp_hidden['id_fardamento']))
   {
       $this->nmgp_cmp_hidden['id_fardamento'] = 'off';
   }
   if (!isset($this->nmgp_cmp_hidden['id_situacao']))
   {
       $this->nmgp_cmp_hidden['id_situacao'] = 'off';
   }
?>
<TABLE align="center" id="hidden_bloco_0" class="scFormTable" width="100%" style="height: 100%;"><?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['id_fardamento']))
           {
               $this->nmgp_cmp_readonly['id_fardamento'] = 'on';
           }
?>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['id_fardamento']))
    {
        $this->nm_new_label['id_fardamento'] = "Id Fardamento";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $id_fardamento = $this->id_fardamento;
   if (!isset($this->nmgp_cmp_hidden['id_fardamento']))
   {
       $this->nmgp_cmp_hidden['id_fardamento'] = 'off';
   }
   $sStyleHidden_id_fardamento = '';
   if (isset($this->nmgp_cmp_hidden['id_fardamento']) && $this->nmgp_cmp_hidden['id_fardamento'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['id_fardamento']);
       $sStyleHidden_id_fardamento = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_id_fardamento = 'display: none;';
   $sStyleReadInp_id_fardamento = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["id_fardamento"]) &&  $this->nmgp_cmp_readonly["id_fardamento"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['id_fardamento']);
       $sStyleReadLab_id_fardamento = '';
       $sStyleReadInp_id_fardamento = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['id_fardamento']) && $this->nmgp_cmp_hidden['id_fardamento'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="id_fardamento" value="<?php echo $this->form_encode_input($id_fardamento) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>
<?php if ((isset($this->Embutida_form) && $this->Embutida_form) || ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir")) { ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_id_fardamento_label" id="hidden_field_label_id_fardamento" style="<?php echo $sStyleHidden_id_fardamento; ?>"><span id="id_label_id_fardamento"><?php echo $this->nm_new_label['id_fardamento']; ?></span></TD>
    <TD class="scFormDataOdd css_id_fardamento_line" id="hidden_field_data_id_fardamento" style="<?php echo $sStyleHidden_id_fardamento; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_id_fardamento_line" style="vertical-align: top;padding: 0px"><span id="id_read_on_id_fardamento" class="css_id_fardamento_line" style="<?php echo $sStyleReadLab_id_fardamento; ?>"><?php echo $this->form_encode_input($this->id_fardamento); ?></span><span id="id_read_off_id_fardamento" style="<?php echo $sStyleReadInp_id_fardamento; ?>"><input type="hidden" name="id_fardamento" value="<?php echo $this->form_encode_input($id_fardamento) . "\">"?><span id="id_ajax_label_id_fardamento"><?php echo nl2br($id_fardamento); ?></span>
</span></span></td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_id_fardamento_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_id_fardamento_text"></span></td></tr></table></td></tr></table></TD>
   <?php }
      else
      {
         $sc_hidden_no--;
      }
?>
<?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['aviso']))
    {
        $this->nm_new_label['aviso'] = "Aviso";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $aviso = $this->aviso;
   $sStyleHidden_aviso = '';
   if (isset($this->nmgp_cmp_hidden['aviso']) && $this->nmgp_cmp_hidden['aviso'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['aviso']);
       $sStyleHidden_aviso = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_aviso = 'display: none;';
   $sStyleReadInp_aviso = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['aviso']) && $this->nmgp_cmp_readonly['aviso'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['aviso']);
       $sStyleReadLab_aviso = '';
       $sStyleReadInp_aviso = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['aviso']) && $this->nmgp_cmp_hidden['aviso'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="aviso" value="<?php echo $this->form_encode_input($aviso) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_aviso_label" id="hidden_field_label_aviso" style="<?php echo $sStyleHidden_aviso; ?>"><span id="id_label_aviso"><?php echo $this->nm_new_label['aviso']; ?></span></TD>
    <TD class="scFormDataOdd css_aviso_line" id="hidden_field_data_aviso" style="<?php echo $sStyleHidden_aviso; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_aviso_line" style="vertical-align: top;padding: 0px"><input type="hidden" name="aviso" value="<?php echo $this->form_encode_input($aviso); ?>"><span id="id_ajax_label_aviso"><?php echo nl2br($aviso); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_aviso_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_aviso_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['tamanho_pedido']))
   {
       $this->nm_new_label['tamanho_pedido'] = "Tamanho pedido";
   }
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tamanho_pedido = $this->tamanho_pedido;
   $sStyleHidden_tamanho_pedido = '';
   if (isset($this->nmgp_cmp_hidden['tamanho_pedido']) && $this->nmgp_cmp_hidden['tamanho_pedido'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tamanho_pedido']);
       $sStyleHidden_tamanho_pedido = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tamanho_pedido = 'display: none;';
   $sStyleReadInp_tamanho_pedido = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tamanho_pedido']) && $this->nmgp_cmp_readonly['tamanho_pedido'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tamanho_pedido']);
       $sStyleReadLab_tamanho_pedido = '';
       $sStyleReadInp_tamanho_pedido = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tamanho_pedido']) && $this->nmgp_cmp_hidden['tamanho_pedido'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="tamanho_pedido" value="<?php echo $this->form_encode_input($this->tamanho_pedido) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_tamanho_pedido_label" id="hidden_field_label_tamanho_pedido" style="<?php echo $sStyleHidden_tamanho_pedido; ?>"><span id="id_label_tamanho_pedido"><?php echo $this->nm_new_label['tamanho_pedido']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['php_cmp_required']['tamanho_pedido']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['php_cmp_required']['tamanho_pedido'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_tamanho_pedido_line" id="hidden_field_data_tamanho_pedido" style="<?php echo $sStyleHidden_tamanho_pedido; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tamanho_pedido_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tamanho_pedido"]) &&  $this->nmgp_cmp_readonly["tamanho_pedido"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['Lookup_tamanho_pedido']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['Lookup_tamanho_pedido'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['Lookup_tamanho_pedido']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['Lookup_tamanho_pedido'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['Lookup_tamanho_pedido']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['Lookup_tamanho_pedido'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['Lookup_tamanho_pedido']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['Lookup_tamanho_pedido'] = array(); 
    }

   $old_value_id_fardamento = $this->id_fardamento;
   $old_value_quantidade = $this->quantidade;
   $old_value_data_entregue = $this->data_entregue;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_id_fardamento = $this->id_fardamento;
   $unformatted_value_quantidade = $this->quantidade;
   $unformatted_value_data_entregue = $this->data_entregue;

   $nm_comando = "SELECT id_tamanho, desc_tamanho 
FROM tamanho 
ORDER BY id_tamanho";

   $this->id_fardamento = $old_value_id_fardamento;
   $this->quantidade = $old_value_quantidade;
   $this->data_entregue = $old_value_data_entregue;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando)) 
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['Lookup_tamanho_pedido'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
   $x = 0; 
   $tamanho_pedido_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->tamanho_pedido_1))
          {
              foreach ($this->tamanho_pedido_1 as $tmp_tamanho_pedido)
              {
                  if (trim($tmp_tamanho_pedido) === trim($cadaselect[1])) { $tamanho_pedido_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->tamanho_pedido) === trim($cadaselect[1])) { $tamanho_pedido_look .= $cadaselect[0]; } 
          $x++; 
   }

?>
<input type="hidden" name="tamanho_pedido" value="<?php echo $this->form_encode_input($tamanho_pedido) . "\">" . $tamanho_pedido_look . ""; ?>
<?php } else { ?>
 
<?php  
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['Lookup_tamanho_pedido']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['Lookup_tamanho_pedido'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['Lookup_tamanho_pedido']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['Lookup_tamanho_pedido'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['Lookup_tamanho_pedido']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['Lookup_tamanho_pedido'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['Lookup_tamanho_pedido']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['Lookup_tamanho_pedido'] = array(); 
    }

   $old_value_id_fardamento = $this->id_fardamento;
   $old_value_quantidade = $this->quantidade;
   $old_value_data_entregue = $this->data_entregue;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_id_fardamento = $this->id_fardamento;
   $unformatted_value_quantidade = $this->quantidade;
   $unformatted_value_data_entregue = $this->data_entregue;

   $nm_comando = "SELECT id_tamanho, desc_tamanho 
FROM tamanho 
ORDER BY id_tamanho";

   $this->id_fardamento = $old_value_id_fardamento;
   $this->quantidade = $old_value_quantidade;
   $this->data_entregue = $old_value_data_entregue;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando)) 
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['Lookup_tamanho_pedido'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
   $x = 0 ; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   $x = 0; 
   $tamanho_pedido_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->tamanho_pedido_1))
          {
              foreach ($this->tamanho_pedido_1 as $tmp_tamanho_pedido)
              {
                  if (trim($tmp_tamanho_pedido) === trim($cadaselect[1])) { $tamanho_pedido_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->tamanho_pedido) === trim($cadaselect[1])) { $tamanho_pedido_look .= $cadaselect[0]; } 
          $x++; 
   }
          if (empty($tamanho_pedido_look))
          {
              $tamanho_pedido_look = $this->tamanho_pedido;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_tamanho_pedido\" class=\"css_tamanho_pedido_line\" style=\"" .  $sStyleReadLab_tamanho_pedido . "\">" . $this->form_encode_input($tamanho_pedido_look) . "</span><span id=\"id_read_off_tamanho_pedido\" style=\"" . $sStyleReadInp_tamanho_pedido . "\">";
   echo " <span id=\"idAjaxSelect_tamanho_pedido\"><select class=\"sc-js-input scFormObjectOdd css_tamanho_pedido_obj\" style=\"\" id=\"id_sc_field_tamanho_pedido\" name=\"tamanho_pedido\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['Lookup_tamanho_pedido'][] = ''; 
   echo "  <option value=\"\">-</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->tamanho_pedido) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->tamanho_pedido)) 
              {
                  echo " selected" ;
              } 
           } 
          echo ">$cadaselect[0] </option>" ; 
          echo "\r" ; 
          $x++ ; 
   }  ; 
   echo " </select></span>" ; 
   echo "\r" ; 
   echo "</span>";
?> 
<?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tamanho_pedido_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tamanho_pedido_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['id_tamanho']))
   {
       $this->nm_new_label['id_tamanho'] = "Tamanho entregue";
   }
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $id_tamanho = $this->id_tamanho;
   $sStyleHidden_id_tamanho = '';
   if (isset($this->nmgp_cmp_hidden['id_tamanho']) && $this->nmgp_cmp_hidden['id_tamanho'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['id_tamanho']);
       $sStyleHidden_id_tamanho = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_id_tamanho = 'display: none;';
   $sStyleReadInp_id_tamanho = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['id_tamanho']) && $this->nmgp_cmp_readonly['id_tamanho'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['id_tamanho']);
       $sStyleReadLab_id_tamanho = '';
       $sStyleReadInp_id_tamanho = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['id_tamanho']) && $this->nmgp_cmp_hidden['id_tamanho'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="id_tamanho" value="<?php echo $this->form_encode_input($this->id_tamanho) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_id_tamanho_label" id="hidden_field_label_id_tamanho" style="<?php echo $sStyleHidden_id_tamanho; ?>"><span id="id_label_id_tamanho"><?php echo $this->nm_new_label['id_tamanho']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['php_cmp_required']['id_tamanho']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['php_cmp_required']['id_tamanho'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_id_tamanho_line" id="hidden_field_data_id_tamanho" style="<?php echo $sStyleHidden_id_tamanho; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_id_tamanho_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["id_tamanho"]) &&  $this->nmgp_cmp_readonly["id_tamanho"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['Lookup_id_tamanho']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['Lookup_id_tamanho'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['Lookup_id_tamanho']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['Lookup_id_tamanho'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['Lookup_id_tamanho']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['Lookup_id_tamanho'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['Lookup_id_tamanho']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['Lookup_id_tamanho'] = array(); 
    }

   $old_value_id_fardamento = $this->id_fardamento;
   $old_value_quantidade = $this->quantidade;
   $old_value_data_entregue = $this->data_entregue;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_id_fardamento = $this->id_fardamento;
   $unformatted_value_quantidade = $this->quantidade;
   $unformatted_value_data_entregue = $this->data_entregue;

   $nm_comando = "SELECT id_tamanho, desc_tamanho 
FROM tamanho 
ORDER BY id_tamanho";

   $this->id_fardamento = $old_value_id_fardamento;
   $this->quantidade = $old_value_quantidade;
   $this->data_entregue = $old_value_data_entregue;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando)) 
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['Lookup_id_tamanho'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
   $x = 0; 
   $id_tamanho_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->id_tamanho_1))
          {
              foreach ($this->id_tamanho_1 as $tmp_id_tamanho)
              {
                  if (trim($tmp_id_tamanho) === trim($cadaselect[1])) { $id_tamanho_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->id_tamanho) === trim($cadaselect[1])) { $id_tamanho_look .= $cadaselect[0]; } 
          $x++; 
   }

?>
<input type="hidden" name="id_tamanho" value="<?php echo $this->form_encode_input($id_tamanho) . "\">" . $id_tamanho_look . ""; ?>
<?php } else { ?>
 
<?php  
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['Lookup_id_tamanho']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['Lookup_id_tamanho'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['Lookup_id_tamanho']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['Lookup_id_tamanho'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['Lookup_id_tamanho']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['Lookup_id_tamanho'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['Lookup_id_tamanho']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['Lookup_id_tamanho'] = array(); 
    }

   $old_value_id_fardamento = $this->id_fardamento;
   $old_value_quantidade = $this->quantidade;
   $old_value_data_entregue = $this->data_entregue;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_id_fardamento = $this->id_fardamento;
   $unformatted_value_quantidade = $this->quantidade;
   $unformatted_value_data_entregue = $this->data_entregue;

   $nm_comando = "SELECT id_tamanho, desc_tamanho 
FROM tamanho 
ORDER BY id_tamanho";

   $this->id_fardamento = $old_value_id_fardamento;
   $this->quantidade = $old_value_quantidade;
   $this->data_entregue = $old_value_data_entregue;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando)) 
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['Lookup_id_tamanho'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
   $x = 0 ; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   $x = 0; 
   $id_tamanho_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->id_tamanho_1))
          {
              foreach ($this->id_tamanho_1 as $tmp_id_tamanho)
              {
                  if (trim($tmp_id_tamanho) === trim($cadaselect[1])) { $id_tamanho_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->id_tamanho) === trim($cadaselect[1])) { $id_tamanho_look .= $cadaselect[0]; } 
          $x++; 
   }
          if (empty($id_tamanho_look))
          {
              $id_tamanho_look = $this->id_tamanho;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_id_tamanho\" class=\"css_id_tamanho_line\" style=\"" .  $sStyleReadLab_id_tamanho . "\">" . $this->form_encode_input($id_tamanho_look) . "</span><span id=\"id_read_off_id_tamanho\" style=\"" . $sStyleReadInp_id_tamanho . "\">";
   echo " <span id=\"idAjaxSelect_id_tamanho\"><select class=\"sc-js-input scFormObjectOdd css_id_tamanho_obj\" style=\"\" id=\"id_sc_field_id_tamanho\" name=\"id_tamanho\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['Lookup_id_tamanho'][] = ''; 
   echo "  <option value=\"\">-</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->id_tamanho) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->id_tamanho)) 
              {
                  echo " selected" ;
              } 
           } 
          echo ">$cadaselect[0] </option>" ; 
          echo "\r" ; 
          $x++ ; 
   }  ; 
   echo " </select></span>" ; 
   echo "\r" ; 
   echo "</span>";
?> 
<?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_id_tamanho_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_id_tamanho_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['quantidade']))
    {
        $this->nm_new_label['quantidade'] = "Quantidade";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $quantidade = $this->quantidade;
   $sStyleHidden_quantidade = '';
   if (isset($this->nmgp_cmp_hidden['quantidade']) && $this->nmgp_cmp_hidden['quantidade'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['quantidade']);
       $sStyleHidden_quantidade = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_quantidade = 'display: none;';
   $sStyleReadInp_quantidade = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['quantidade']) && $this->nmgp_cmp_readonly['quantidade'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['quantidade']);
       $sStyleReadLab_quantidade = '';
       $sStyleReadInp_quantidade = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['quantidade']) && $this->nmgp_cmp_hidden['quantidade'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="quantidade" value="<?php echo $this->form_encode_input($quantidade) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_quantidade_label" id="hidden_field_label_quantidade" style="<?php echo $sStyleHidden_quantidade; ?>"><span id="id_label_quantidade"><?php echo $this->nm_new_label['quantidade']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['php_cmp_required']['quantidade']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['php_cmp_required']['quantidade'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_quantidade_line" id="hidden_field_data_quantidade" style="<?php echo $sStyleHidden_quantidade; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_quantidade_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["quantidade"]) &&  $this->nmgp_cmp_readonly["quantidade"] == "on") { 

 ?>
<input type="hidden" name="quantidade" value="<?php echo $this->form_encode_input($quantidade) . "\">" . $quantidade . ""; ?>
<?php } else { ?>
<span id="id_read_on_quantidade" class="sc-ui-readonly-quantidade css_quantidade_line" style="<?php echo $sStyleReadLab_quantidade; ?>"><?php echo $this->form_encode_input($this->quantidade); ?></span><span id="id_read_off_quantidade" style="white-space: nowrap;<?php echo $sStyleReadInp_quantidade; ?>">
 <input class="sc-js-input scFormObjectOdd css_quantidade_obj" style="" id="id_sc_field_quantidade" type=text name="quantidade" value="<?php echo $this->form_encode_input($quantidade) ?>"
 size=2 alt="{datatype: 'integer', maxLength: 2, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['quantidade']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['quantidade']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}"></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_quantidade_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_quantidade_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['data_entregue']))
    {
        $this->nm_new_label['data_entregue'] = "Data da entrega";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $data_entregue = $this->data_entregue;
   $sStyleHidden_data_entregue = '';
   if (isset($this->nmgp_cmp_hidden['data_entregue']) && $this->nmgp_cmp_hidden['data_entregue'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['data_entregue']);
       $sStyleHidden_data_entregue = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_data_entregue = 'display: none;';
   $sStyleReadInp_data_entregue = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['data_entregue']) && $this->nmgp_cmp_readonly['data_entregue'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['data_entregue']);
       $sStyleReadLab_data_entregue = '';
       $sStyleReadInp_data_entregue = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['data_entregue']) && $this->nmgp_cmp_hidden['data_entregue'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="data_entregue" value="<?php echo $this->form_encode_input($data_entregue) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_data_entregue_label" id="hidden_field_label_data_entregue" style="<?php echo $sStyleHidden_data_entregue; ?>"><span id="id_label_data_entregue"><?php echo $this->nm_new_label['data_entregue']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['php_cmp_required']['data_entregue']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['php_cmp_required']['data_entregue'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_data_entregue_line" id="hidden_field_data_data_entregue" style="<?php echo $sStyleHidden_data_entregue; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_data_entregue_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["data_entregue"]) &&  $this->nmgp_cmp_readonly["data_entregue"] == "on") { 

 ?>
<input type="hidden" name="data_entregue" value="<?php echo $this->form_encode_input($data_entregue) . "\">" . $data_entregue . ""; ?>
<?php } else { ?>
<span id="id_read_on_data_entregue" class="sc-ui-readonly-data_entregue css_data_entregue_line" style="<?php echo $sStyleReadLab_data_entregue; ?>"><?php echo $this->form_encode_input($data_entregue); ?></span><span id="id_read_off_data_entregue" style="white-space: nowrap;<?php echo $sStyleReadInp_data_entregue; ?>">
 <input class="sc-js-input scFormObjectOdd css_data_entregue_obj" style="" id="id_sc_field_data_entregue" type=text name="data_entregue" value="<?php echo $this->form_encode_input($data_entregue) ?>"
 size=10 alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['data_entregue']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['data_entregue']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}"><?php
$tmp_form_data = $this->field_config['data_entregue']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>
&nbsp;<?php echo $tmp_form_data; ?></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_data_entregue_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_data_entregue_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['id_situacao']))
   {
       $this->nm_new_label['id_situacao'] = "Id Situacao";
   }
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $id_situacao = $this->id_situacao;
   if (!isset($this->nmgp_cmp_hidden['id_situacao']))
   {
       $this->nmgp_cmp_hidden['id_situacao'] = 'off';
   }
   $sStyleHidden_id_situacao = '';
   if (isset($this->nmgp_cmp_hidden['id_situacao']) && $this->nmgp_cmp_hidden['id_situacao'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['id_situacao']);
       $sStyleHidden_id_situacao = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_id_situacao = 'display: none;';
   $sStyleReadInp_id_situacao = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['id_situacao']) && $this->nmgp_cmp_readonly['id_situacao'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['id_situacao']);
       $sStyleReadLab_id_situacao = '';
       $sStyleReadInp_id_situacao = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['id_situacao']) && $this->nmgp_cmp_hidden['id_situacao'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="id_situacao" value="<?php echo $this->form_encode_input($this->id_situacao) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_id_situacao_label" id="hidden_field_label_id_situacao" style="<?php echo $sStyleHidden_id_situacao; ?>"><span id="id_label_id_situacao"><?php echo $this->nm_new_label['id_situacao']; ?></span></TD>
    <TD class="scFormDataOdd css_id_situacao_line" id="hidden_field_data_id_situacao" style="<?php echo $sStyleHidden_id_situacao; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_id_situacao_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["id_situacao"]) &&  $this->nmgp_cmp_readonly["id_situacao"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['Lookup_id_situacao']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['Lookup_id_situacao'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['Lookup_id_situacao']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['Lookup_id_situacao'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['Lookup_id_situacao']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['Lookup_id_situacao'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['Lookup_id_situacao']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['Lookup_id_situacao'] = array(); 
    }

   $old_value_id_fardamento = $this->id_fardamento;
   $old_value_quantidade = $this->quantidade;
   $old_value_data_entregue = $this->data_entregue;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_id_fardamento = $this->id_fardamento;
   $unformatted_value_quantidade = $this->quantidade;
   $unformatted_value_data_entregue = $this->data_entregue;

   $nm_comando = "SELECT id_situacao, desc_situacao 
FROM situacao 
ORDER BY desc_situacao";

   $this->id_fardamento = $old_value_id_fardamento;
   $this->quantidade = $old_value_quantidade;
   $this->data_entregue = $old_value_data_entregue;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando)) 
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['Lookup_id_situacao'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
   $x = 0; 
   $id_situacao_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->id_situacao_1))
          {
              foreach ($this->id_situacao_1 as $tmp_id_situacao)
              {
                  if (trim($tmp_id_situacao) === trim($cadaselect[1])) { $id_situacao_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->id_situacao) === trim($cadaselect[1])) { $id_situacao_look .= $cadaselect[0]; } 
          $x++; 
   }

?>
<input type="hidden" name="id_situacao" value="<?php echo $this->form_encode_input($id_situacao) . "\">" . $id_situacao_look . ""; ?>
<?php } else { ?>
 
<?php  
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['Lookup_id_situacao']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['Lookup_id_situacao'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['Lookup_id_situacao']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['Lookup_id_situacao'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['Lookup_id_situacao']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['Lookup_id_situacao'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['Lookup_id_situacao']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['Lookup_id_situacao'] = array(); 
    }

   $old_value_id_fardamento = $this->id_fardamento;
   $old_value_quantidade = $this->quantidade;
   $old_value_data_entregue = $this->data_entregue;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_id_fardamento = $this->id_fardamento;
   $unformatted_value_quantidade = $this->quantidade;
   $unformatted_value_data_entregue = $this->data_entregue;

   $nm_comando = "SELECT id_situacao, desc_situacao 
FROM situacao 
ORDER BY desc_situacao";

   $this->id_fardamento = $old_value_id_fardamento;
   $this->quantidade = $old_value_quantidade;
   $this->data_entregue = $old_value_data_entregue;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando)) 
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['Lookup_id_situacao'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
   $x = 0 ; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   $x = 0; 
   $id_situacao_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->id_situacao_1))
          {
              foreach ($this->id_situacao_1 as $tmp_id_situacao)
              {
                  if (trim($tmp_id_situacao) === trim($cadaselect[1])) { $id_situacao_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->id_situacao) === trim($cadaselect[1])) { $id_situacao_look .= $cadaselect[0]; } 
          $x++; 
   }
          if (empty($id_situacao_look))
          {
              $id_situacao_look = $this->id_situacao;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_id_situacao\" class=\"css_id_situacao_line\" style=\"" .  $sStyleReadLab_id_situacao . "\">" . $this->form_encode_input($id_situacao_look) . "</span><span id=\"id_read_off_id_situacao\" style=\"" . $sStyleReadInp_id_situacao . "\">";
   echo " <span id=\"idAjaxSelect_id_situacao\"><select class=\"sc-js-input scFormObjectOdd css_id_situacao_obj\" style=\"\" id=\"id_sc_field_id_situacao\" name=\"id_situacao\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->id_situacao) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->id_situacao)) 
              {
                  echo " selected" ;
              } 
           } 
          echo ">$cadaselect[0] </option>" ; 
          echo "\r" ; 
          $x++ ; 
   }  ; 
   echo " </select></span>" ; 
   echo "\r" ; 
   echo "</span>";
?> 
<?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_id_situacao_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_id_situacao_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 


   </td></tr></table>
   </tr>
</TABLE></div><!-- bloco_f -->
<?php
  }
?>
</td></tr>
<tr><td class="scFormPageText">
<span class="scFormRequiredOddColor">* <?php echo $this->Ini->Nm_lang['lang_othr_reqr']; ?></span>
</td></tr> 
</table> 
</div> 
</td> 
</tr> 
</table> 

<div id="id_debug_window" style="display: none; position: absolute; left: 50px; top: 50px"><table class="scFormMessageTable">
<tr><td class="scFormMessageTitle"><?php echo nmButtonOutput($this->arr_buttons, "berrm_clse", "scAjaxHideDebug()", "scAjaxHideDebug()", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
&nbsp;&nbsp;Output</td></tr>
<tr><td class="scFormMessageMessage" style="padding: 0px; vertical-align: top"><div style="padding: 2px; height: 200px; width: 350px; overflow: auto" id="id_debug_text"></div></td></tr>
</table></div>

</form> 
<script> 
<?php
  $nm_sc_blocos_da_pag = array(0);

  foreach ($this->Ini->nm_hidden_blocos as $bloco => $hidden)
  {
      if ($hidden == "off" && in_array($bloco, $nm_sc_blocos_da_pag))
      {
          echo "document.getElementById('hidden_bloco_" . $bloco . "').style.display = 'none';";
          if (isset($nm_sc_blocos_aba[$bloco]))
          {
               echo "document.getElementById('id_tabs_" . $nm_sc_blocos_aba[$bloco] . "_" . $bloco . "').style.display = 'none';";
          }
      }
  }
?>
</script> 
<script>
<?php
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['masterValue']))
{
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['masterValue'] as $cmp_master => $val_master)
{
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
}
unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['masterValue']);
?>
}
<?php
}
?>
function updateHeaderFooter(sFldName, sFldValue)
{
  if (sFldValue[0] && sFldValue[0]["value"])
  {
    sFldValue = sFldValue[0]["value"];
  }
}
</script>
<?php
if (isset($_POST['master_nav']) && 'on' == $_POST['master_nav'])
{
    $sTamanhoIframe = isset($_POST['sc_ifr_height']) && '' != $_POST['sc_ifr_height'] ? '"' . $_POST['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 parent.scAjaxDetailStatus("form_fardamento_tradicional");
 parent.scAjaxDetailHeight("form_fardamento_tradicional", <?php echo $sTamanhoIframe; ?>);
</script>
<?php
}
elseif (isset($_GET['script_case_detail']) && 'Y' == $_GET['script_case_detail'])
{
    $sTamanhoIframe = isset($_GET['sc_ifr_height']) && '' != $_GET['sc_ifr_height'] ? '"' . $_GET['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 if (0 == <?php echo $sTamanhoIframe; ?>) {
  setTimeout(function() {
   parent.scAjaxDetailHeight("form_fardamento_tradicional", <?php echo $sTamanhoIframe; ?>);
  }, 100);
 }
 else {
  parent.scAjaxDetailHeight("form_fardamento_tradicional", <?php echo $sTamanhoIframe; ?>);
 }
</script>
<?php
}
?>
<?php
if (isset($this->NM_ajax_info['displayMsg']) && $this->NM_ajax_info['displayMsg'])
{
?>
<script type="text/javascript">
_scAjaxShowMessage(scMsgDefTitle, "<?php echo $this->NM_ajax_info['displayMsgTxt']; ?>", false, sc_ajaxMsgTime, false, "Ok", 0, 0, 0, 0, "", "", "", false, true);
</script>
<?php
}
?>
<?php
if ('' != $this->scFormFocusErrorName)
{
?>
<script>
scAjaxFocusError();
</script>
<?php
}
?>
<script>
bLigEditLookupCall = <?php if ($this->lig_edit_lookup_call) { ?>true<?php } else { ?>false<?php } ?>;
function scLigEditLookupCall()
{
<?php
if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_fardamento_tradicional']['sc_modal'])
{
?>
  parent.<?php echo $this->lig_edit_lookup_cb; ?>(<?php echo $this->lig_edit_lookup_row; ?>);
<?php
}
elseif ($this->lig_edit_lookup)
{
?>
  opener.<?php echo $this->lig_edit_lookup_cb; ?>(<?php echo $this->lig_edit_lookup_row; ?>);
<?php
}
?>
}
if (bLigEditLookupCall)
{
  scLigEditLookupCall();
}
<?php
if (isset($this->redir_modal) && !empty($this->redir_modal))
{
    echo $this->redir_modal;
}
?>
</script>
<script type="text/javascript">
$(function() {
 $("#sc-id-mobile-in").mouseover(function() {
  $(this).css("cursor", "pointer");
 }).click(function() {
  scMobileDisplayControl("in");
 });
 $("#sc-id-mobile-out").mouseover(function() {
  $(this).css("cursor", "pointer");
 }).click(function() {
  scMobileDisplayControl("out");
 });
});
function scMobileDisplayControl(sOption) {
 $("#sc-id-mobile-control").val(sOption);
 nm_atualiza("recarga_mobile");
}
</script>
<?php
       if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'])
       {
?>
<span id="sc-id-mobile-in"><?php echo $this->Ini->Nm_lang['lang_version_mobile']; ?></span>
<?php
       }
?>
</body> 
</html> 
