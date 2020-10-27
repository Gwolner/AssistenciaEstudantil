<?php
//--- 
class grid_relatorio_emprestimo_det
{
   var $Ini;
   var $Erro;
   var $Db;
   var $nm_data;
   var $NM_raiz_img; 
   var $nmgp_botoes; 
   var $nm_location;
   var $e_data_entrega;
   var $e_data_devolucao;
   var $e_status;
   var $sc_field_1;
   var $sc_field_0;
 function monta_det()
 {
    global 
           $nm_saida, $nm_lang, $nmgp_cor_print, $nmgp_tipo_pdf;
    $this->nmgp_botoes['det_pdf'] = "on";
    $this->nmgp_botoes['det_print'] = "on";
    $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
    if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_relatorio_emprestimo']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_relatorio_emprestimo']['btn_display']))
    {
        foreach ($_SESSION['scriptcase']['sc_apl_conf']['grid_relatorio_emprestimo']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
        {
            $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
        }
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_relatorio_emprestimo']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_relatorio_emprestimo']['campos_busca']))
    { 
        $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_relatorio_emprestimo']['campos_busca'];
        if ($_SESSION['scriptcase']['charset'] != "UTF-8")
        {
            $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
        }
        $this->e_data_entrega = $Busca_temp['e_data_entrega']; 
        $tmp_pos = strpos($this->e_data_entrega, "##@@");
        if ($tmp_pos !== false)
        {
            $this->e_data_entrega = substr($this->e_data_entrega, 0, $tmp_pos);
        }
        $this->e_data_entrega_2 = $Busca_temp['e_data_entrega_input_2']; 
        $this->e_data_devolucao = $Busca_temp['e_data_devolucao']; 
        $tmp_pos = strpos($this->e_data_devolucao, "##@@");
        if ($tmp_pos !== false)
        {
            $this->e_data_devolucao = substr($this->e_data_devolucao, 0, $tmp_pos);
        }
        $this->e_data_devolucao_2 = $Busca_temp['e_data_devolucao_input_2']; 
        $this->e_status = $Busca_temp['e_status']; 
        $tmp_pos = strpos($this->e_status, "##@@");
        if ($tmp_pos !== false)
        {
            $this->e_status = substr($this->e_status, 0, $tmp_pos);
        }
    } 
    else 
    { 
        $this->e_data_entrega_2 = ""; 
        $this->e_data_devolucao_2 = ""; 
    } 
    $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_relatorio_emprestimo']['where_orig'];
    $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_relatorio_emprestimo']['where_pesq'];
    $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_relatorio_emprestimo']['where_pesq_filtro'];
    $this->nm_field_dinamico = array();
    $this->nm_order_dinamico = array();
    $this->nm_data = new nm_data("pt_br");
    $this->NM_raiz_img  = ""; 
    $this->sc_proc_grid = false; 
    include($this->Ini->path_btn . $this->Ini->Str_btn_grid);
    $_SESSION['sc_session'][$this->Ini->sc_page]['grid_relatorio_emprestimo']['seq_dir'] = 0; 
    $_SESSION['sc_session'][$this->Ini->sc_page]['grid_relatorio_emprestimo']['sub_dir'] = array(); 
   $Str_date = strtolower($_SESSION['scriptcase']['reg_conf']['date_format']);
   $Lim   = strlen($Str_date);
   $Ult   = "";
   $Arr_D = array();
   for ($I = 0; $I < $Lim; $I++)
   {
       $Char = substr($Str_date, $I, 1);
       if ($Char != $Ult)
       {
           $Arr_D[] = $Char;
       }
       $Ult = $Char;
   }
   $Prim = true;
   $Str  = "";
   foreach ($Arr_D as $Cada_d)
   {
       $Str .= (!$Prim) ? $_SESSION['scriptcase']['reg_conf']['date_sep'] : "";
       $Str .= $Cada_d;
       $Prim = false;
   }
   $Str = str_replace("a", "Y", $Str);
   $Str = str_replace("y", "Y", $Str);
   $nm_data_fixa = date($Str); 
   $this->nm_data->SetaData(date("Y/m/d H:i:s"), "YYYY/MM/DD HH:II:SS"); 
   $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_edit.php", "F", "nmgp_Form_Num_Val") ; 
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase)) 
   { 
       $nmgp_select = "SELECT str_replace (convert(char(10),e.data_entrega,102), '.', '-') + ' ' + convert(char(8),e.data_entrega,20), str_replace (convert(char(10),e.data_devolucao,102), '.', '-') + ' ' + convert(char(8),e.data_devolucao,20), concat(a.nome_aluno,' ',a.matricula) as sc_field_0, CASE
       WHEN es.materia = 'paradidatico' THEN es.titulo
       ELSE es.materia
   END as sc_field_1 from " . $this->Ini->nm_tabela; 
   } 
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql)) 
   { 
       $nmgp_select = "SELECT convert(char(23),e.data_entrega,121), convert(char(23),e.data_devolucao,121), concat(a.nome_aluno,' ',a.matricula) as sc_field_0, CASE
       WHEN es.materia = 'paradidatico' THEN es.titulo
       ELSE es.materia
   END as sc_field_1 from " . $this->Ini->nm_tabela; 
   } 
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle)) 
   { 
       $nmgp_select = "SELECT e.data_entrega as e_data_entrega, e.data_devolucao as e_data_devolucao, concat(a.nome_aluno,' ',a.matricula) as sc_field_0, CASE
       WHEN es.materia = 'paradidatico' THEN es.titulo
       ELSE es.materia
   END as sc_field_1 from " . $this->Ini->nm_tabela; 
   } 
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix)) 
   { 
       $nmgp_select = "SELECT EXTEND(e.data_entrega, YEAR TO DAY), EXTEND(e.data_devolucao, YEAR TO DAY), concat(a.nome_aluno,' ',a.matricula) as sc_field_0, CASE
       WHEN es.materia = 'paradidatico' THEN es.titulo
       ELSE es.materia
   END as sc_field_1 from " . $this->Ini->nm_tabela; 
   } 
   else 
   { 
       $nmgp_select = "SELECT e.data_entrega as e_data_entrega, e.data_devolucao as e_data_devolucao, concat(a.nome_aluno,' ',a.matricula) as sc_field_0, CASE
       WHEN es.materia = 'paradidatico' THEN es.titulo
       ELSE es.materia
   END as sc_field_1 from " . $this->Ini->nm_tabela; 
   } 
   $parms_det = explode("*PDet*", $_SESSION['sc_session'][$this->Ini->sc_page]['grid_relatorio_emprestimo']['chave_det']) ; 
   foreach ($parms_det as $key => $cada_par)
   {
       $parms_det[$key] = $this->Db->qstr($parms_det[$key]);
       $parms_det[$key] = substr($parms_det[$key], 1, strlen($parms_det[$key]) - 2);
   } 
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
   {
       $nmgp_select .= " where  e.status = '$parms_det[0]' and CASE
       WHEN es.materia = 'paradidatico' THEN es.titulo
       ELSE es.materia
   END = '$parms_det[1]' and concat(a.nome_aluno,' ',a.matricula) = '$parms_det[2]'" ;  
   } 
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
   {
       $nmgp_select .= " where  e.status = '$parms_det[0]' and CASE
       WHEN es.materia = 'paradidatico' THEN es.titulo
       ELSE es.materia
   END = '$parms_det[1]' and concat(a.nome_aluno,' ',a.matricula) = '$parms_det[2]'" ;  
   } 
   else 
   { 
       $nmgp_select .= " where  e.status = '$parms_det[0]' and CASE
       WHEN es.materia = 'paradidatico' THEN es.titulo
       ELSE es.materia
   END = '$parms_det[1]' and concat(a.nome_aluno,' ',a.matricula) = '$parms_det[2]'" ;  
   } 
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
   $rs = $this->Db->Execute($nmgp_select) ; 
   if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
   { 
       $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit ; 
   }  
   $this->e_data_entrega = $rs->fields[0] ;  
   $this->e_data_devolucao = $rs->fields[1] ;  
   $this->sc_field_0 = $rs->fields[2] ;  
   $this->sc_field_1 = $rs->fields[3] ;  
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_relatorio_emprestimo']['cmp_acum']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_relatorio_emprestimo']['cmp_acum']))
   {
       $parms_acum = explode(";", $_SESSION['sc_session'][$this->Ini->sc_page]['grid_relatorio_emprestimo']['cmp_acum']);
       foreach ($parms_acum as $cada_par)
       {
          $cada_val = explode("=", $cada_par);
          $this->$cada_val[0] = $cada_val[1];
       }
   }
//--- 
   $nm_saida->saida("<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\"\r\n");
   $nm_saida->saida("            \"http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd\">\r\n");
   $nm_saida->saida("<html" . $_SESSION['scriptcase']['reg_conf']['html_dir'] . ">\r\n");
   $nm_saida->saida("<HEAD>\r\n");
   $nm_saida->saida("   <TITLE>" . $this->Ini->Nm_lang['lang_othr_detl_titl'] . " - </TITLE>\r\n");
   $nm_saida->saida(" <META http-equiv=\"Content-Type\" content=\"text/html; charset=" . $_SESSION['scriptcase']['charset_html'] . "\" />\r\n");
   $nm_saida->saida(" <META http-equiv=\"Expires\" content=\"Fri, Jan 01 1900 00:00:00 GMT\"/>\r\n");
   $nm_saida->saida(" <META http-equiv=\"Last-Modified\" content=\"" . gmdate("D, d M Y H:i:s") . " GMT\"/>\r\n");
   $nm_saida->saida(" <META http-equiv=\"Cache-Control\" content=\"no-store, no-cache, must-revalidate\"/>\r\n");
   $nm_saida->saida(" <META http-equiv=\"Cache-Control\" content=\"post-check=0, pre-check=0\"/>\r\n");
   $nm_saida->saida(" <META http-equiv=\"Pragma\" content=\"no-cache\"/>\r\n");
   if ($_SESSION['scriptcase']['proc_mobile'])
   {
       $nm_saida->saida(" <meta name=\"viewport\" content=\"width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;\" />\r\n");
   }

   $nm_saida->saida(" <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery/js/jquery.js\"></script>\r\n");
   $nm_saida->saida(" <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery_plugin/malsup-blockui/jquery.blockUI.js\"></script>\r\n");
   $nm_saida->saida(" <script type=\"text/javascript\">var sc_pathToTB = '" . $this->Ini->path_prod . "/third/jquery_plugin/thickbox/';</script>\r\n");
   $nm_saida->saida(" <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery_plugin/thickbox/thickbox-compressed.js\"></script>\r\n");
   $nm_saida->saida(" <script type=\"text/javascript\" src=\"../_lib/lib/js/jquery.scInput.js\"></script>\r\n");
   $nm_saida->saida(" <link rel=\"stylesheet\" href=\"" . $this->Ini->path_prod . "/third/jquery_plugin/thickbox/thickbox.css\" type=\"text/css\" media=\"screen\" />\r\n");
   if (($_SESSION['sc_session'][$this->Ini->sc_page]['grid_relatorio_emprestimo']['det_print'] == "print" && strtoupper($nmgp_cor_print) == "PB") || $nmgp_tipo_pdf == "pb")
   {
       $nm_saida->saida(" <link rel=\"stylesheet\" type=\"text/css\" href=\"" . $this->Ini->path_link . "_lib/css/" . $this->Ini->str_schema_all . "_grid_bw.css\" /> \r\n");
       $nm_saida->saida(" <link rel=\"stylesheet\" type=\"text/css\" href=\"" . $this->Ini->path_link . "_lib/css/" . $this->Ini->str_schema_all . "_grid_bw" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\" /> \r\n");
   }
   else
   {
       $nm_saida->saida(" <link rel=\"stylesheet\" type=\"text/css\" href=\"" . $this->Ini->path_link . "_lib/css/" . $this->Ini->str_schema_all . "_grid.css\" /> \r\n");
       $nm_saida->saida(" <link rel=\"stylesheet\" type=\"text/css\" href=\"" . $this->Ini->path_link . "_lib/css/" . $this->Ini->str_schema_all . "_grid" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\" /> \r\n");
   }
       $nm_saida->saida(" <link rel=\"stylesheet\" type=\"text/css\" href=\"" . $this->Ini->path_link . "grid_relatorio_emprestimo/grid_relatorio_emprestimo_det_" . strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css\" />\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_relatorio_emprestimo']['pdf_det'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_relatorio_emprestimo']['det_print'] != "print")
   {
       $nm_saida->saida(" <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/buttons/" . $this->Ini->Str_btn_css . "\" /> \r\n");
       $nm_saida->saida(" <link rel=\"stylesheet\" href=\"../_lib/css/" . $_SESSION['scriptcase']['erro']['str_schema'] . "\" type=\"text/css\" media=\"screen\" />\r\n");
       $nm_saida->saida(" <link rel=\"stylesheet\" href=\"../_lib/css/" . $_SESSION['scriptcase']['erro']['str_schema_dir'] . "\" type=\"text/css\" media=\"screen\" />\r\n");
   }
   $nm_saida->saida("</HEAD>\r\n");
   $nm_saida->saida("  <body class=\"scGridPage\">\r\n");
   $nm_saida->saida("  " . $this->Ini->Ajax_result_set . "\r\n");
   $nm_saida->saida("<table border=0 align=\"center\" valign=\"top\" ><tr><td style=\"padding: 0px\"><div class=\"scGridBorder\"><table width='100%' cellspacing=0 cellpadding=0><tr><td>\r\n");
   $nm_saida->saida("<tr><td class=\"scGridTabelaTd\">\r\n");
   $nm_saida->saida("<style>\r\n");
   $nm_saida->saida("#lin1_col1 { padding-left:9px; padding-top:7px;  height:27px; overflow:hidden; text-align:left;}			 \r\n");
   $nm_saida->saida("#lin1_col2 { padding-right:9px; padding-top:7px; height:27px; text-align:right; overflow:hidden;   font-size:12px; font-weight:normal;}\r\n");
   $nm_saida->saida("</style>\r\n");
   $nm_saida->saida("<div style=\"width: 100%\">\r\n");
   $nm_saida->saida(" <div class=\"scGridHeader\" style=\"height:11px; display: block; border-width:0px; \"></div>\r\n");
   $nm_saida->saida(" <div style=\"height:37px; border-width:0px 0px 1px 0px;  border-style: dashed; border-color:#ddd; display: block\">\r\n");
   $nm_saida->saida(" 	<table style=\"width:100%; border-collapse:collapse; padding:0;\">\r\n");
   $nm_saida->saida("    	<tr>\r\n");
   $nm_saida->saida("        	<td id=\"lin1_col1\" class=\"scGridHeaderFont\"><span>" . $this->Ini->Nm_lang['lang_othr_detl_titl'] . " - </span></td>\r\n");
   $nm_saida->saida("            <td id=\"lin1_col2\" class=\"scGridHeaderFont\"><span></span></td>\r\n");
   $nm_saida->saida("        </tr>\r\n");
   $nm_saida->saida("    </table>		 \r\n");
   $nm_saida->saida(" </div>\r\n");
   $nm_saida->saida("</div>\r\n");
   $nm_saida->saida("  </TD>\r\n");
   $nm_saida->saida(" </TR>\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_relatorio_emprestimo']['det_print'] != "print" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_relatorio_emprestimo']['pdf_det']) 
   { 
       $nm_saida->saida("   <tr><td class=\"scGridTabelaTd\">\r\n");
       $nm_saida->saida("    <table width=\"100%\"><tr>\r\n");
       $nm_saida->saida("     <td class=\"scGridToolbar\">\r\n");
       $nm_saida->saida("         </td> \r\n");
       $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"center\" width=\"33%\"> \r\n");
       if ($this->nmgp_botoes['det_pdf'] == "on")
       {
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "bpdf", "", "", "Dpdf_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "grid_relatorio_emprestimo/grid_relatorio_emprestimo_config_pdf.php?nm_opc=pdf_det&nm_target=0&nm_cor=cor&papel=1&orientacao=1&largura=1200&conf_larg=S&conf_fonte=10&language=pt_br&conf_socor=S&KeepThis=false&TB_iframe=true&modal=true", "", "only_text", "text_right", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
       }
       if ($this->nmgp_botoes['det_print'] == "on")
       {
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "bprint", "", "", "Dprint_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "grid_relatorio_emprestimo/grid_relatorio_emprestimo_config_print.php?nm_opc=detalhe&nm_cor=AM&language=pt_br&KeepThis=true&TB_iframe=true&modal=true", "", "only_text", "text_right", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
       }
       $Cod_Btn = nmButtonOutput($this->arr_buttons, "bvoltar", "document.F3.submit()", "document.F3.submit()", "sc_b_sai_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
       $nm_saida->saida("           $Cod_Btn \r\n");
       $nm_saida->saida("         </td> \r\n");
       $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"right\" width=\"33%\"> \r\n");
       $nm_saida->saida("     </td>\r\n");
       $nm_saida->saida("    </tr></table>\r\n");
       $nm_saida->saida("   </td></tr>\r\n");
   } 
   $nm_saida->saida("<tr><td class=\"scGridTabelaTd\">\r\n");
   $nm_saida->saida("<TABLE style=\"padding: 0px; spacing: 0px; border-width: 0px;\"  align=\"center\" valign=\"top\" width=\"100%\">\r\n");
   $nm_saida->saida("  <TR class=\"scGridLabel\">\r\n");
          $SC_Label = (isset($this->New_label['e_data_entrega'])) ? $this->New_label['e_data_entrega'] : "Data Entrega"; 
          $conteudo = trim(NM_encode_input(sc_strip_script($this->e_data_entrega))); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ; 
          } 
          else    
          { 
               $conteudo_x =  $conteudo;
               nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
               if (is_numeric($conteudo_x) && $conteudo_x > 0) 
               { 
                   $this->nm_data->SetaData($conteudo, "YYYY-MM-DD");
                   $conteudo = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
               } 
          } 
   $nm_saida->saida("    <TD class=\"scGridLabelFont css_e_data_entrega_det_label\"  >" . nl2br($SC_Label) . "</TD>\r\n");
   $nm_saida->saida("    <TD class=\"scGridFieldOddVert css_e_data_entrega_det_line\"  NOWRAP ALIGN=\"\" VALIGN=\"\">" . $conteudo . "</TD>\r\n");
   $nm_saida->saida("   \r\n");
   $nm_saida->saida("  </TR>\r\n");
   $nm_saida->saida("  <TR class=\"scGridLabel\">\r\n");
          $SC_Label = (isset($this->New_label['e_data_devolucao'])) ? $this->New_label['e_data_devolucao'] : "Data Devolucao"; 
          $conteudo = trim(NM_encode_input(sc_strip_script($this->e_data_devolucao))); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ; 
          } 
          else    
          { 
               $conteudo_x =  $conteudo;
               nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
               if (is_numeric($conteudo_x) && $conteudo_x > 0) 
               { 
                   $this->nm_data->SetaData($conteudo, "YYYY-MM-DD");
                   $conteudo = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
               } 
          } 
   $nm_saida->saida("    <TD class=\"scGridLabelFont css_e_data_devolucao_det_label\"  >" . nl2br($SC_Label) . "</TD>\r\n");
   $nm_saida->saida("    <TD class=\"scGridFieldEvenVert css_e_data_devolucao_det_line\"  NOWRAP ALIGN=\"\" VALIGN=\"\">" . $conteudo . "</TD>\r\n");
   $nm_saida->saida("   \r\n");
   $nm_saida->saida("  </TR>\r\n");
   $nm_saida->saida("  <TR class=\"scGridLabel\">\r\n");
          $SC_Label = (isset($this->New_label['sc_field_0'])) ? $this->New_label['sc_field_0'] : "Nome e Matrícula"; 
          $conteudo = trim(sc_strip_script($this->sc_field_0)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ; 
          } 
   $nm_saida->saida("    <TD class=\"scGridLabelFont css_sc_field_0_det_label\"  >" . nl2br($SC_Label) . "</TD>\r\n");
   $nm_saida->saida("    <TD class=\"scGridFieldOddVert css_sc_field_0_det_line\"   ALIGN=\"\" VALIGN=\"\">" . $conteudo . "</TD>\r\n");
   $nm_saida->saida("   \r\n");
   $nm_saida->saida("  </TR>\r\n");
   $nm_saida->saida("  <TR class=\"scGridLabel\">\r\n");
          $SC_Label = (isset($this->New_label['sc_field_1'])) ? $this->New_label['sc_field_1'] : "Matéria/Título"; 
          $conteudo = trim(sc_strip_script($this->sc_field_1)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ; 
          } 
   $nm_saida->saida("    <TD class=\"scGridLabelFont css_sc_field_1_det_label\"  >" . nl2br($SC_Label) . "</TD>\r\n");
   $nm_saida->saida("    <TD class=\"scGridFieldEvenVert css_sc_field_1_det_line\"   ALIGN=\"\" VALIGN=\"\">" . $conteudo . "</TD>\r\n");
   $nm_saida->saida("   \r\n");
   $nm_saida->saida("  </TR>\r\n");
   $nm_saida->saida("</TABLE>\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_relatorio_emprestimo']['det_print'] != "print" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_relatorio_emprestimo']['pdf_det']) 
   { 
       $nm_saida->saida("   <tr><td class=\"scGridTabelaTd\">\r\n");
       $nm_saida->saida("    <table width=\"100%\"><tr>\r\n");
       $nm_saida->saida("     <td class=\"scGridToolbar\">\r\n");
       $nm_saida->saida("         </td> \r\n");
       $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"center\" width=\"33%\"> \r\n");
       $nm_saida->saida("         </td> \r\n");
       $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"right\" width=\"33%\"> \r\n");
       $nm_saida->saida("     </td>\r\n");
       $nm_saida->saida("    </tr></table>\r\n");
       $nm_saida->saida("   </td></tr>\r\n");
   } 
   $rs->Close(); 
   $nm_saida->saida("  </td>\r\n");
   $nm_saida->saida(" </tr>\r\n");
   $nm_saida->saida(" </table>\r\n");
   $nm_saida->saida(" </div>\r\n");
   $nm_saida->saida("  </td>\r\n");
   $nm_saida->saida(" </tr>\r\n");
   $nm_saida->saida(" </table>\r\n");
   $nm_saida->saida("  </td>\r\n");
   $nm_saida->saida(" </tr>\r\n");
   $nm_saida->saida(" </table>\r\n");
   $nm_saida->saida(" </div>\r\n");
   $nm_saida->saida("  </td>\r\n");
   $nm_saida->saida(" </tr>\r\n");
   $nm_saida->saida(" </table>\r\n");
//--- 
//--- 
   $nm_saida->saida("<form name=\"F3\" method=post\r\n");
   $nm_saida->saida("                  target=\"_self\"\r\n");
   $nm_saida->saida("                  action=\"./\">\r\n");
   $nm_saida->saida("<input type=hidden name=\"nmgp_opcao\" value=\"igual\"/>\r\n");
   $nm_saida->saida("<input type=hidden name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/>\r\n");
   $nm_saida->saida("<input type=hidden name=\"script_case_session\" value=\"" . NM_encode_input(session_id()) . "\"/>\r\n");
   $nm_saida->saida("</form>\r\n");
   $nm_saida->saida("<script language=JavaScript>\r\n");
   $nm_saida->saida("   function nm_mostra_doc(campo1, campo2, campo3)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       NovaJanela = window.open (\"grid_relatorio_emprestimo_doc.php?script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&script_case_session=" . session_id() . "&nm_cod_doc=\" + campo1 + \"&nm_nome_doc=\" + campo2 + \"&nm_cod_apl=\" + campo3, \"ScriptCase\", \"resizable\");\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_gp_move(x, y, z, p, g) \r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("      window.location = \"" . $this->Ini->path_link . "grid_relatorio_emprestimo/index.php?nmgp_opcao=pdf_det&nmgp_tipo_pdf=\" + z + \"&nmgp_parms_pdf=\" + p +  \"&nmgp_graf_pdf=\" + g + \"&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&script_case_session=" . session_id() . "\";\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_gp_print_conf(tp, cor)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       window.open('" . $this->Ini->path_link . "grid_relatorio_emprestimo/grid_relatorio_emprestimo_iframe_prt.php?path_botoes=" . $this->Ini->path_botoes . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&script_case_session=" . session_id() . "&opcao=det_print&cor_print=' + cor,'','location=no,menubar,resizable,scrollbars,status=no,toolbar');\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("</script>\r\n");
   $nm_saida->saida("</body>\r\n");
   $nm_saida->saida("</html>\r\n");
 }
   function nm_gera_mask(&$nm_campo, $nm_mask)
   { 
      $trab_campo = $nm_campo;
      $trab_mask  = $nm_mask;
      $tam_campo  = strlen($nm_campo);
      $trab_saida = "";
      $mask_num = false;
      for ($x=0; $x < strlen($trab_mask); $x++)
      {
          if (substr($trab_mask, $x, 1) == "#")
          {
              $mask_num = true;
              break;
          }
      }
      if ($mask_num )
      {
          $ver_duas = explode(";", $trab_mask);
          if (isset($ver_duas[1]) && !empty($ver_duas[1]))
          {
              $cont1 = count(explode("#", $ver_duas[0])) - 1;
              $cont2 = count(explode("#", $ver_duas[1])) - 1;
              if ($cont2 >= $tam_campo)
              {
                  $trab_mask = $ver_duas[1];
              }
              else
              {
                  $trab_mask = $ver_duas[0];
              }
          }
          $tam_mask = strlen($trab_mask);
          $xdados = 0;
          for ($x=0; $x < $tam_mask; $x++)
          {
              if (substr($trab_mask, $x, 1) == "#" && $xdados < $tam_campo)
              {
                  $trab_saida .= substr($trab_campo, $xdados, 1);
                  $xdados++;
              }
              elseif ($xdados < $tam_campo)
              {
                  $trab_saida .= substr($trab_mask, $x, 1);
              }
          }
          if ($xdados < $tam_campo)
          {
              $trab_saida .= substr($trab_campo, $xdados);
          }
          $nm_campo = $trab_saida;
          return;
      }
      for ($ix = strlen($trab_mask); $ix > 0; $ix--)
      {
           $char_mask = substr($trab_mask, $ix - 1, 1);
           if ($char_mask != "x" && $char_mask != "z")
           {
               $trab_saida = $char_mask . $trab_saida;
           }
           else
           {
               if ($tam_campo != 0)
               {
                   $trab_saida = substr($trab_campo, $tam_campo - 1, 1) . $trab_saida;
                   $tam_campo--;
               }
               else
               {
                   $trab_saida = "0" . $trab_saida;
               }
           }
      }
      if ($tam_campo != 0)
      {
          $trab_saida = substr($trab_campo, 0, $tam_campo) . $trab_saida;
          $trab_mask  = str_repeat("z", $tam_campo) . $trab_mask;
      }
   
      $iz = 0; 
      for ($ix = 0; $ix < strlen($trab_mask); $ix++)
      {
           $char_mask = substr($trab_mask, $ix, 1);
           if ($char_mask != "x" && $char_mask != "z")
           {
               if ($char_mask == "." || $char_mask == ",")
               {
                   $trab_saida = substr($trab_saida, 0, $iz) . substr($trab_saida, $iz + 1);
               }
               else
               {
                   $iz++;
               }
           }
           elseif ($char_mask == "x" || substr($trab_saida, $iz, 1) != "0")
           {
               $ix = strlen($trab_mask) + 1;
           }
           else
           {
               $trab_saida = substr($trab_saida, 0, $iz) . substr($trab_saida, $iz + 1);
           }
      }
      $nm_campo = $trab_saida;
   } 
   function nm_conv_data_db($dt_in, $form_in, $form_out)
   {
       $dt_out = $dt_in;
       if (strtoupper($form_in) == "DB_FORMAT")
       {
           if ($dt_out == "null" || $dt_out == "")
           {
               $dt_out = "";
               return $dt_out;
           }
           $form_in = "AAAA-MM-DD";
       }
       if (strtoupper($form_out) == "DB_FORMAT")
       {
           if (empty($dt_out))
           {
               $dt_out = "null";
               return $dt_out;
           }
           $form_out = "AAAA-MM-DD";
       }
       nm_conv_form_data($dt_out, $form_in, $form_out);
       return $dt_out;
   }
}
