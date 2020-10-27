<?php
/**
 * $Id: nm_secure_grp_exclui.php,v 1.1.1.1 2011-05-12 20:31:30 diogo Exp $
 */

include_once ("nm_secure_base.php");

if (isset($HTTP_GET_VARS["grupo"]))
{
    $nm_naveg  = "<DIV ALIGN=\"center\">\n";
    $nm_naveg .= "&nbsp;<INPUT TYPE=\"submit\" VALUE=\"Confirmar\" CLASS=\"txt_valor\">&nbsp;";
    $nm_naveg .= "&nbsp;<INPUT TYPE=\"button\" VALUE=\"Cancelar\" CLASS=\"txt_valor\" onClick=\"nm_sair()\">&nbsp;";
    $nm_naveg .= "</DIV>\n";
    $mensagem  = "Voc� est� prestes a excluir o Grupo do sistema.";
    $grp_cod   = $HTTP_GET_VARS["grupo"];
}
elseif (!isset($HTTP_POST_VARS["grupo"]))
{
    header("Location: nm_secure_grp_lista.php");
}
elseif (!isset($HTTP_POST_VARS["nm_opcao"]))
{
    $nm_naveg  = "<DIV ALIGN=\"center\">\n";
    $nm_naveg .= "&nbsp;<INPUT TYPE=\"submit\" VALUE=\"Confirmar\" CLASS=\"txt_valor\">&nbsp;";
    $nm_naveg .= "&nbsp;<INPUT TYPE=\"button\" VALUE=\"Cancelar\" CLASS=\"txt_valor\" onClick=\"nm_sair()\">&nbsp;";
    $nm_naveg .= "</DIV>\n";
    $mensagem  = "Voc� est� prestes a excluir o Grupo do sistema.";
    $grp_cod   = $HTTP_POST_VARS["grupo"];
}
else
{
    $nm_naveg  = "<DIV ALIGN=\"center\">\n";
    $nm_naveg .= "&nbsp;<INPUT TYPE=\"button\" VALUE=\"Ok\" CLASS=\"txt_valor\" onClick=\"nm_sair()\">&nbsp;";
    $nm_naveg .= "</DIV>\n";
    $grp_cod   = $HTTP_POST_VARS["grupo"];
    $resultado = TRUE;
    $delete    =  "DELETE FROM $nm_secure_tbgrp";
    $delete   .= " WHERE Grupo = '" . $grp_cod . "'";
    $rs        = &$db->executeQuery($delete);
    if (!$rs)
    {
        $resultado = FALSE;
    }
    $mensagem = ($resultado) ? "Grupo exclu�do." : "Erro na exclus�o.";
}

?>
<HTML>
<HEAD>
<TITLE>NetMake :: Script Case</TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<STYLE TYPE="text/css">
<!--
.txt_valor { font-family: Tahoma, Arial, sans-serif; font-size: 12px; color: #000000}
-->
</STYLE>
<SCRIPT LANGUAGE="Javascript">
<!--
function nm_sair()
{
  document.nm_form.action = 'nm_secure_grp_lista.php';
  document.nm_form.target = 'nm_secure_bot';
  document.nm_form.submit();
}
-->
</SCRIPT>
</HEAD>
<BODY BGCOLOR="<?php echo $html_cor_fundo_pagina; ?>" MARGINWIDTH="5" LEFTMARGIN="5" MARGINHEIGHT="5" TOPMARGIN="5">
<FORM NAME="nm_form" ACTION="nm_secure_grp_exclui.php" METHOD="POST">
<INPUT TYPE="hidden" NAME="grupo" VALUE="<?php echo $grp_cod; ?>">
<INPUT TYPE="hidden" NAME="nm_opcao" VALUE="excluir">
<BR>
<TABLE ALIGN="center" BORDER="0" CELLSPACING="1" CELLPADDING="2" BGCOLOR="<?php echo $html_cor_fundo_borda; ?>">
  <TR ALIGN="center" BGCOLOR="<?php echo $html_cor_fundo_titulo; ?>">
    <TD><FONT FACE="Verdana, Arial, sans-serif" SIZE="2" COLOR="<?php echo $html_cor_texto_titulo; ?>"><B>Excluir Grupo: <?php echo $grp_cod; ?></B></FONT></TD>
  </TR>
  <TR BGCOLOR="<?php echo $html_cor_fundo_linimp; ?>">
    <TD><FONT FACE="Tahoma, Arial, sans-serif" SIZE="2" COLOR="<?php echo $html_cor_texto_normal; ?>"><?php echo $mensagem; ?></FONT></TD>
  </TR>
</TABLE>
<BR>
<?php echo $nm_naveg; ?>
</FORM>
</BODY>
</HTML>