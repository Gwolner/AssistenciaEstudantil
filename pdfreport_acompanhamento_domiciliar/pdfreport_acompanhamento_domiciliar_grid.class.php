<?php
class pdfreport_acompanhamento_domiciliar_grid
{
   var $Ini;
   var $Erro;
   var $Pdf;
   var $Db;
   var $rs_grid;
   var $nm_grid_sem_reg;
   var $SC_seq_register;
   var $nm_location;
   var $nm_data;
   var $nm_cod_barra;
   var $sc_proc_grid; 
   var $nmgp_botoes = array();
   var $Campos_Mens_erro;
   var $NM_raiz_img; 
   var $Font_ttf; 
   var $nome = array();
   var $matricula = array();
   var $periodo = array();
   var $data = array();
   var $motivo = array();
   var $id_aluno = array();
//--- 
 function monta_grid($linhas = 0)
 {

   clearstatcache();
   $this->inicializa();
   $this->grid();
 }
//--- 
 function inicializa()
 {
   global $nm_saida, 
   $rec, $nmgp_chave, $nmgp_opcao, $nmgp_ordem, $nmgp_chave_det, 
   $nmgp_quant_linhas, $nmgp_quant_colunas, $nmgp_url_saida, $nmgp_parms;
//
   $this->nm_data = new nm_data("pt_br");
   include_once("../_lib/lib/php/nm_font_tcpdf.php");
   $this->default_font = '';
   $this->default_font_sr  = '';
   $this->default_style    = '';
   $this->default_style_sr = 'B';
   $Tp_papel = "A4";
   $old_dir = getcwd();
   $File_font_ttf     = "";
   $temp_font_ttf     = "";
   $this->Font_ttf    = false;
   $this->Font_ttf_sr = false;
   if (empty($this->default_font) && isset($arr_font_tcpdf[$this->Ini->str_lang]))
   {
       $this->default_font = $arr_font_tcpdf[$this->Ini->str_lang];
   }
   elseif (empty($this->default_font))
   {
       $this->default_font = "Times";
   }
   if (empty($this->default_font_sr) && isset($arr_font_tcpdf[$this->Ini->str_lang]))
   {
       $this->default_font_sr = $arr_font_tcpdf[$this->Ini->str_lang];
   }
   elseif (empty($this->default_font_sr))
   {
       $this->default_font_sr = "Times";
   }
   $_SESSION['scriptcase']['pdfreport_acompanhamento_domiciliar']['default_font'] = $this->default_font;
   chdir($this->Ini->path_third . "/tcpdf/");
   include_once("tcpdf.php");
   chdir($old_dir);
   $this->Pdf = new TCPDF('P', 'mm', $Tp_papel, true, 'UTF-8', false);
   $this->Pdf->setPrintHeader(false);
   $this->Pdf->setPrintFooter(false);
   if (!empty($File_font_ttf))
   {
       $this->Pdf->addTTFfont($File_font_ttf, "", "", 32, $_SESSION['scriptcase']['dir_temp'] . "/");
   }
   $this->Pdf->SetDisplayMode('real');
   $this->aba_iframe = false;
   if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
   {
       foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
       {
           if (in_array("pdfreport_acompanhamento_domiciliar", $apls_aba))
           {
               $this->aba_iframe = true;
               break;
           }
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_acompanhamento_domiciliar']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
   {
       $this->aba_iframe = true;
   }
   $this->nmgp_botoes['exit'] = "on";
   $this->sc_proc_grid = false; 
   $this->NM_raiz_img = $this->Ini->root;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   $this->nm_where_dinamico = "";
   $this->nm_grid_colunas = 0;
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_acompanhamento_domiciliar']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_acompanhamento_domiciliar']['campos_busca']))
   { 
       $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_acompanhamento_domiciliar']['campos_busca'];
       if ($_SESSION['scriptcase']['charset'] != "UTF-8")
       {
           $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
       }
       $this->id_aluno[0] = $Busca_temp['id_aluno']; 
       $tmp_pos = strpos($this->id_aluno[0], "##@@");
       if ($tmp_pos !== false)
       {
           $this->id_aluno[0] = substr($this->id_aluno[0], 0, $tmp_pos);
       }
       $id_aluno_2 = $Busca_temp['id_aluno_input_2']; 
       $this->id_aluno_2 = $Busca_temp['id_aluno_input_2']; 
       $this->nome[0] = $Busca_temp['nome']; 
       $tmp_pos = strpos($this->nome[0], "##@@");
       if ($tmp_pos !== false)
       {
           $this->nome[0] = substr($this->nome[0], 0, $tmp_pos);
       }
       $this->matricula[0] = $Busca_temp['matricula']; 
       $tmp_pos = strpos($this->matricula[0], "##@@");
       if ($tmp_pos !== false)
       {
           $this->matricula[0] = substr($this->matricula[0], 0, $tmp_pos);
       }
       $this->periodo[0] = $Busca_temp['periodo']; 
       $tmp_pos = strpos($this->periodo[0], "##@@");
       if ($tmp_pos !== false)
       {
           $this->periodo[0] = substr($this->periodo[0], 0, $tmp_pos);
       }
   } 
   $this->nm_field_dinamico = array();
   $this->nm_order_dinamico = array();
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_acompanhamento_domiciliar']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_acompanhamento_domiciliar']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_acompanhamento_domiciliar']['where_pesq_filtro'];
   $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
   $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
   $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
   $_SESSION['scriptcase']['contr_link_emb'] = $this->nm_location;
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_acompanhamento_domiciliar']['qt_col_grid'] = 1 ;  
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['pdfreport_acompanhamento_domiciliar']['cols']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['pdfreport_acompanhamento_domiciliar']['cols']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_acompanhamento_domiciliar']['qt_col_grid'] = $_SESSION['scriptcase']['sc_apl_conf']['pdfreport_acompanhamento_domiciliar']['cols'];  
       unset($_SESSION['scriptcase']['sc_apl_conf']['pdfreport_acompanhamento_domiciliar']['cols']);
   }
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_acompanhamento_domiciliar']['ordem_select']))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_acompanhamento_domiciliar']['ordem_select'] = array(); 
   } 
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_acompanhamento_domiciliar']['ordem_quebra']))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_acompanhamento_domiciliar']['ordem_grid'] = "" ; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_acompanhamento_domiciliar']['ordem_ant']  = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_acompanhamento_domiciliar']['ordem_desc'] = "" ; 
   }   
   if (!empty($nmgp_parms) && $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_acompanhamento_domiciliar']['opcao'] != "pdf")   
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_acompanhamento_domiciliar']['opcao'] = "igual";
       $rec = "ini";
   }
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_acompanhamento_domiciliar']['where_orig']) || $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_acompanhamento_domiciliar']['prim_cons'] || !empty($nmgp_parms))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_acompanhamento_domiciliar']['prim_cons'] = false;  
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_acompanhamento_domiciliar']['where_orig'] = "";  
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_acompanhamento_domiciliar']['where_pesq']        = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_acompanhamento_domiciliar']['where_orig'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_acompanhamento_domiciliar']['where_pesq_ant']    = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_acompanhamento_domiciliar']['where_orig'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_acompanhamento_domiciliar']['cond_pesq']         = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_acompanhamento_domiciliar']['where_pesq_filtro'] = "";
   }   
   if  (!empty($this->nm_where_dinamico)) 
   {   
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_acompanhamento_domiciliar']['where_pesq'] .= $this->nm_where_dinamico;
   }   
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_acompanhamento_domiciliar']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_acompanhamento_domiciliar']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_acompanhamento_domiciliar']['where_pesq_filtro'];
//
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_acompanhamento_domiciliar']['tot_geral'][1])) 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_acompanhamento_domiciliar']['sc_total'] = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_acompanhamento_domiciliar']['tot_geral'][1] ;  
   }
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_acompanhamento_domiciliar']['where_pesq_ant'] = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_acompanhamento_domiciliar']['where_pesq'];  
//----- 
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
   { 
       $nmgp_select = "SELECT id_aluno from (SELECT      id_aluno FROM      aluno LIMIT 1) nm_sel_esp"; 
   } 
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
   { 
       $nmgp_select = "SELECT id_aluno from (SELECT      id_aluno FROM      aluno LIMIT 1) nm_sel_esp"; 
   } 
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
   { 
       $nmgp_select = "SELECT id_aluno from (SELECT      id_aluno FROM      aluno LIMIT 1) nm_sel_esp"; 
   } 
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
   { 
       $nmgp_select = "SELECT id_aluno from (SELECT      id_aluno FROM      aluno LIMIT 1) nm_sel_esp"; 
   } 
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
   { 
       $nmgp_select = "SELECT id_aluno from (SELECT      id_aluno FROM      aluno LIMIT 1) nm_sel_esp"; 
   } 
   else 
   { 
       $nmgp_select = "SELECT id_aluno from (SELECT      id_aluno FROM      aluno LIMIT 1) nm_sel_esp"; 
   } 
   $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_acompanhamento_domiciliar']['where_pesq']; 
   $nmgp_order_by = ""; 
   $campos_order_select = "";
   foreach($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_acompanhamento_domiciliar']['ordem_select'] as $campo => $ordem) 
   {
        if ($campo != $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_acompanhamento_domiciliar']['ordem_grid']) 
        {
           if (!empty($campos_order_select)) 
           {
               $campos_order_select .= ", ";
           }
           $campos_order_select .= $campo . " " . $ordem;
        }
   }
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_acompanhamento_domiciliar']['ordem_grid'])) 
   { 
       $nmgp_order_by = " order by " . $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_acompanhamento_domiciliar']['ordem_grid'] . $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_acompanhamento_domiciliar']['ordem_desc']; 
   } 
   if (!empty($campos_order_select)) 
   { 
       if (!empty($nmgp_order_by)) 
       { 
          $nmgp_order_by .= ", " . $campos_order_select; 
       } 
       else 
       { 
          $nmgp_order_by = " order by $campos_order_select"; 
       } 
   } 
   $nmgp_select .= $nmgp_order_by; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_acompanhamento_domiciliar']['order_grid'] = $nmgp_order_by;
   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
   $this->rs_grid = $this->Db->Execute($nmgp_select) ; 
   if ($this->rs_grid === false && !$this->rs_grid->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
   { 
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit ; 
   }  
   if ($this->rs_grid->EOF || ($this->rs_grid === false && $GLOBALS["NM_ERRO_IBASE"] == 1)) 
   { 
       $this->nm_grid_sem_reg = $this->Ini->Nm_lang['lang_errm_empt']; 
   }  
// 
 }  
// 
 function Pdf_init()
 {
     if ($_SESSION['scriptcase']['reg_conf']['css_dir'] == "RTL")
     {
         $this->Pdf->setRTL(true);
     }
     $this->Pdf->setHeaderMargin(0);
     $this->Pdf->setFooterMargin(0);
     if ($this->Font_ttf)
     {
         $this->Pdf->SetFont($this->default_font, $this->default_style, 12, $this->def_TTF);
     }
     else
     {
         $this->Pdf->SetFont($this->default_font, $this->default_style, 12);
     }
     $this->Pdf->SetTextColor(0, 0, 0);
 }
// 
//----- 
 function grid($linhas = 0)
 {
    global 
           $nm_saida, $nm_url_saida;
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_acompanhamento_domiciliar']['labels']['id_aluno'] = "Id Aluno";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_acompanhamento_domiciliar']['labels']['nome'] = "nome";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_acompanhamento_domiciliar']['labels']['matricula'] = "matricula";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_acompanhamento_domiciliar']['labels']['periodo'] = "periodo";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_acompanhamento_domiciliar']['labels']['data'] = "data";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_acompanhamento_domiciliar']['labels']['motivo'] = "motivo";
   $HTTP_REFERER = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : ""; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_acompanhamento_domiciliar']['seq_dir'] = 0; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_acompanhamento_domiciliar']['sub_dir'] = array(); 
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_acompanhamento_domiciliar']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_acompanhamento_domiciliar']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_acompanhamento_domiciliar']['where_pesq_filtro'];
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['pdfreport_acompanhamento_domiciliar']['lig_edit']) && $_SESSION['scriptcase']['sc_apl_conf']['pdfreport_acompanhamento_domiciliar']['lig_edit'] != '')
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_acompanhamento_domiciliar']['mostra_edit'] = $_SESSION['scriptcase']['sc_apl_conf']['pdfreport_acompanhamento_domiciliar']['lig_edit'];
   }
   if (!empty($this->nm_grid_sem_reg))
   {
       $this->Pdf_init();
       $this->Pdf->AddPage();
       if ($this->Font_ttf_sr)
       {
           $this->Pdf->SetFont($this->default_font_sr, 'B', 12, $this->def_TTF);
       }
       else
       {
           $this->Pdf->SetFont($this->default_font_sr, 'B', 12);
       }
       $this->Pdf->SetTextColor(0, 0, 0);
       $this->Pdf->Text(10, 10, html_entity_decode($this->nm_grid_sem_reg, ENT_COMPAT, $_SESSION['scriptcase']['charset']));
       $this->Pdf->Output($this->Ini->root . $this->Ini->nm_path_pdf, 'F');
       return;
   }
// 
   $Init_Pdf = true;
   $this->SC_seq_register = 0; 
   while (!$this->rs_grid->EOF) 
   {  
      $this->nm_grid_colunas = 0; 
      $nm_quant_linhas = 0;
      $this->Pdf->setImageScale(1.33);
      $this->Pdf->AddPage();
      $this->Pdf_init();
      while (!$this->rs_grid->EOF && $nm_quant_linhas < $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_acompanhamento_domiciliar']['qt_col_grid']) 
      {  
          $this->sc_proc_grid = true;
          $this->SC_seq_register++; 
          $this->id_aluno[$this->nm_grid_colunas] = $this->rs_grid->fields[0] ;  
          $this->id_aluno[$this->nm_grid_colunas] = (string)$this->id_aluno[$this->nm_grid_colunas];
          $this->nome[$this->nm_grid_colunas] = "";
          $this->matricula[$this->nm_grid_colunas] = "";
          $this->periodo[$this->nm_grid_colunas] = "";
          $this->data[$this->nm_grid_colunas] = "";
          $this->motivo[$this->nm_grid_colunas] = "";
          $_SESSION['scriptcase']['pdfreport_acompanhamento_domiciliar']['contr_erro'] = 'on';
if (!isset($_SESSION['data_af'])) {$_SESSION['data_af'] = "";}
if (!isset($this->sc_temp_data_af)) {$this->sc_temp_data_af = (isset($_SESSION['data_af'])) ? $_SESSION['data_af'] : "";}
if (!isset($_SESSION['motivo_af'])) {$_SESSION['motivo_af'] = "";}
if (!isset($this->sc_temp_motivo_af)) {$this->sc_temp_motivo_af = (isset($_SESSION['motivo_af'])) ? $_SESSION['motivo_af'] : "";}
if (!isset($_SESSION['periodo_af'])) {$_SESSION['periodo_af'] = "";}
if (!isset($this->sc_temp_periodo_af)) {$this->sc_temp_periodo_af = (isset($_SESSION['periodo_af'])) ? $_SESSION['periodo_af'] : "";}
if (!isset($_SESSION['matricula_af'])) {$_SESSION['matricula_af'] = "";}
if (!isset($this->sc_temp_matricula_af)) {$this->sc_temp_matricula_af = (isset($_SESSION['matricula_af'])) ? $_SESSION['matricula_af'] : "";}
if (!isset($_SESSION['nome_af'])) {$_SESSION['nome_af'] = "";}
if (!isset($this->sc_temp_nome_af)) {$this->sc_temp_nome_af = (isset($_SESSION['nome_af'])) ? $_SESSION['nome_af'] : "";}
 $this->nome[$this->nm_grid_colunas]  = $this->sc_temp_nome_af;
$this->matricula[$this->nm_grid_colunas]  = $this->sc_temp_matricula_af;
$this->periodo[$this->nm_grid_colunas]  = $this->sc_temp_periodo_af;
$this->motivo[$this->nm_grid_colunas]  = $this->sc_temp_motivo_af;
$this->data[$this->nm_grid_colunas]  = $this->sc_temp_data_af;
if (isset($this->sc_temp_nome_af)) {$_SESSION['nome_af'] = $this->sc_temp_nome_af;}
if (isset($this->sc_temp_matricula_af)) {$_SESSION['matricula_af'] = $this->sc_temp_matricula_af;}
if (isset($this->sc_temp_periodo_af)) {$_SESSION['periodo_af'] = $this->sc_temp_periodo_af;}
if (isset($this->sc_temp_motivo_af)) {$_SESSION['motivo_af'] = $this->sc_temp_motivo_af;}
if (isset($this->sc_temp_data_af)) {$_SESSION['data_af'] = $this->sc_temp_data_af;}
$_SESSION['scriptcase']['pdfreport_acompanhamento_domiciliar']['contr_erro'] = 'off';
          $this->id_aluno[$this->nm_grid_colunas] = sc_strip_script($this->id_aluno[$this->nm_grid_colunas]);
          if ($this->id_aluno[$this->nm_grid_colunas] === "") 
          { 
              $this->id_aluno[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->id_aluno[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          $this->id_aluno[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->id_aluno[$this->nm_grid_colunas]);
          if ($this->nome[$this->nm_grid_colunas] === "") 
          { 
              $this->nome[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nome[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->nome[$this->nm_grid_colunas]);
          if ($this->matricula[$this->nm_grid_colunas] === "") 
          { 
              $this->matricula[$this->nm_grid_colunas] = "" ;  
          } 
          $this->matricula[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->matricula[$this->nm_grid_colunas]);
          if ($this->periodo[$this->nm_grid_colunas] === "") 
          { 
              $this->periodo[$this->nm_grid_colunas] = "" ;  
          } 
          $this->periodo[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->periodo[$this->nm_grid_colunas]);
          if ($this->data[$this->nm_grid_colunas] === "") 
          { 
              $this->data[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
               $data_x =  $this->data[$this->nm_grid_colunas];
               nm_conv_limpa_dado($data_x, "YYYY-MM-DD");
               if (is_numeric($data_x) && $data_x > 0) 
               { 
                   $this->nm_data->SetaData($this->data[$this->nm_grid_colunas], "YYYY-MM-DD");
                   $this->data[$this->nm_grid_colunas] = html_entity_decode($this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "")), ENT_COMPAT, $_SESSION['scriptcase']['charset']);
               } 
          } 
          $this->data[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->data[$this->nm_grid_colunas]);
          if ($this->motivo[$this->nm_grid_colunas] === "") 
          { 
              $this->motivo[$this->nm_grid_colunas] = "" ;  
          } 
          else   
          { 
              $this->motivo[$this->nm_grid_colunas] = nl2br($this->motivo[$this->nm_grid_colunas]) ; 
              $temp = explode("<br />", $this->motivo[$this->nm_grid_colunas]); 
              if (!isset($temp[1])) 
              { 
                  $temp = explode("<br>", $this->motivo[$this->nm_grid_colunas]); 
              } 
              $this->motivo[$this->nm_grid_colunas] = "" ; 
              $ind_x = 0 ; 
              while (isset($temp[$ind_x])) 
              { 
                 if (!empty($this->motivo[$this->nm_grid_colunas])) 
                 { 
                     $this->motivo[$this->nm_grid_colunas] .= "<br>"; 
                 } 
                 if (strlen($temp[$ind_x]) > 95) 
                 { 
                     $this->motivo[$this->nm_grid_colunas] .= wordwrap($temp[$ind_x], 95, "<br>", true); 
                 } 
                 else 
                 { 
                     $this->motivo[$this->nm_grid_colunas] .= $temp[$ind_x]; 
                 } 
                 $ind_x++; 
              }  
          }  
          $this->motivo[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->motivo[$this->nm_grid_colunas]);
            $cell_nome = array('posx' => 18, 'posy' => 15, 'data' => $this->nome[$this->nm_grid_colunas], 'width'      => 0, 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => 12, 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_matricula = array('posx' => 18, 'posy' => 25, 'data' => $this->matricula[$this->nm_grid_colunas], 'width'      => 0, 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => 12, 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_periodo = array('posx' => 18, 'posy' => 35, 'data' => $this->periodo[$this->nm_grid_colunas], 'width'      => 0, 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => 12, 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_data = array('posx' => 18, 'posy' => 45, 'data' => $this->data[$this->nm_grid_colunas], 'width'      => 0, 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => 12, 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_motivo = array('posx' => 18, 'posy' => 55, 'data' => $this->motivo[$this->nm_grid_colunas], 'width'      => 0, 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => 12, 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);


            $this->Pdf->SetFont($cell_nome['font_type'], $cell_nome['font_style'], $cell_nome['font_size']);
            $this->pdf_text_color($cell_nome['data'], $cell_nome['color_r'], $cell_nome['color_g'], $cell_nome['color_b']);
            if (!empty($cell_nome['posx']) && !empty($cell_nome['posy']))
            {
                $this->Pdf->SetXY($cell_nome['posx'], $cell_nome['posy']);
            }
            elseif (!empty($cell_nome['posx']))
            {
                $this->Pdf->SetX($cell_nome['posx']);
            }
            elseif (!empty($cell_nome['posy']))
            {
                $this->Pdf->SetY($cell_nome['posy']);
            }
            $this->Pdf->Cell($cell_nome['width'], 0, $cell_nome['data'], 0, 0, $cell_nome['align']);

            $this->Pdf->SetFont($cell_matricula['font_type'], $cell_matricula['font_style'], $cell_matricula['font_size']);
            $this->pdf_text_color($cell_matricula['data'], $cell_matricula['color_r'], $cell_matricula['color_g'], $cell_matricula['color_b']);
            if (!empty($cell_matricula['posx']) && !empty($cell_matricula['posy']))
            {
                $this->Pdf->SetXY($cell_matricula['posx'], $cell_matricula['posy']);
            }
            elseif (!empty($cell_matricula['posx']))
            {
                $this->Pdf->SetX($cell_matricula['posx']);
            }
            elseif (!empty($cell_matricula['posy']))
            {
                $this->Pdf->SetY($cell_matricula['posy']);
            }
            $this->Pdf->Cell($cell_matricula['width'], 0, $cell_matricula['data'], 0, 0, $cell_matricula['align']);

            $this->Pdf->SetFont($cell_periodo['font_type'], $cell_periodo['font_style'], $cell_periodo['font_size']);
            $this->pdf_text_color($cell_periodo['data'], $cell_periodo['color_r'], $cell_periodo['color_g'], $cell_periodo['color_b']);
            if (!empty($cell_periodo['posx']) && !empty($cell_periodo['posy']))
            {
                $this->Pdf->SetXY($cell_periodo['posx'], $cell_periodo['posy']);
            }
            elseif (!empty($cell_periodo['posx']))
            {
                $this->Pdf->SetX($cell_periodo['posx']);
            }
            elseif (!empty($cell_periodo['posy']))
            {
                $this->Pdf->SetY($cell_periodo['posy']);
            }
            $this->Pdf->Cell($cell_periodo['width'], 0, $cell_periodo['data'], 0, 0, $cell_periodo['align']);

            $this->Pdf->SetFont($cell_data['font_type'], $cell_data['font_style'], $cell_data['font_size']);
            $this->pdf_text_color($cell_data['data'], $cell_data['color_r'], $cell_data['color_g'], $cell_data['color_b']);
            if (!empty($cell_data['posx']) && !empty($cell_data['posy']))
            {
                $this->Pdf->SetXY($cell_data['posx'], $cell_data['posy']);
            }
            elseif (!empty($cell_data['posx']))
            {
                $this->Pdf->SetX($cell_data['posx']);
            }
            elseif (!empty($cell_data['posy']))
            {
                $this->Pdf->SetY($cell_data['posy']);
            }
            $this->Pdf->Cell($cell_data['width'], 0, $cell_data['data'], 0, 0, $cell_data['align']);

            $this->Pdf->SetFont($cell_motivo['font_type'], $cell_motivo['font_style'], $cell_motivo['font_size']);
            $this->Pdf->SetTextColor($cell_motivo['color_r'], $cell_motivo['color_g'], $cell_motivo['color_b']);
            if (!empty($cell_motivo['posx']) && !empty($cell_motivo['posy']))
            {
                $this->Pdf->SetXY($cell_motivo['posx'], $cell_motivo['posy']);
            }
            elseif (!empty($cell_motivo['posx']))
            {
                $this->Pdf->SetX($cell_motivo['posx']);
            }
            elseif (!empty($cell_motivo['posy']))
            {
                $this->Pdf->SetY($cell_motivo['posy']);
            }
            $NM_partes_val = explode("<br>", $cell_motivo['data']);
            $PosX = $this->Pdf->GetX();
            $Incre = false;
            foreach ($NM_partes_val as $Lines)
            {
                if ($Incre)
                {
                    $this->Pdf->Ln(4.2333333333333);
                }
                $this->Pdf->SetX($PosX);
                $this->Pdf->Cell($cell_motivo['width'], 0, trim($Lines), 0, 0, $cell_motivo['align']);
                $Incre = true;
            }
          $max_Y = 0;
          $this->rs_grid->MoveNext();
          $this->sc_proc_grid = false;
          $nm_quant_linhas++ ;
      }  
   }  
   $this->rs_grid->Close();
   $this->Pdf->Output($this->Ini->root . $this->Ini->nm_path_pdf, 'F');
 }
 function pdf_text_color(&$val, $r, $g, $b)
 {
     $pos = strpos($val, "@SCNEG#");
     if ($pos !== false)
     {
         $cor = trim(substr($val, $pos + 7));
         $val = substr($val, 0, $pos);
         $cor = (substr($cor, 0, 1) == "#") ? substr($cor, 1) : $cor;
         if (strlen($cor) == 6)
         {
             $r = hexdec(substr($cor, 0, 2));
             $g = hexdec(substr($cor, 2, 2));
             $b = hexdec(substr($cor, 4, 2));
         }
     }
     $this->Pdf->SetTextColor($r, $g, $b);
 }
 function SC_conv_utf8($input)
 {
     if ($_SESSION['scriptcase']['charset'] != "UTF-8" && !NM_is_utf8($input))
     {
         $input = sc_convert_encoding($input, "UTF-8", $_SESSION['scriptcase']['charset']);
     }
     return $input;
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
}
?>
