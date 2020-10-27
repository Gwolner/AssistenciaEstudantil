<?php
include_once('menu_principal_session.php');
session_start();
if (!function_exists("sc_check_mobile"))
{
    include_once("../_lib/lib/php/nm_check_mobile.php");
}
$_SESSION['scriptcase']['device_mobile'] = sc_check_mobile();
if ($_SESSION['scriptcase']['device_mobile'])
{
    if (!isset($_SESSION['scriptcase']['display_mobile']))
    {
        $_SESSION['scriptcase']['display_mobile'] = true;
    }
    if ($_SESSION['scriptcase']['display_mobile'] && isset($_POST['_sc_force_mobile']) && 'out' == $_POST['_sc_force_mobile'])
    {
        $_SESSION['scriptcase']['display_mobile'] = false;
    }
    elseif (!$_SESSION['scriptcase']['display_mobile'] && isset($_POST['_sc_force_mobile']) && 'in' == $_POST['_sc_force_mobile'])
    {
        $_SESSION['scriptcase']['display_mobile'] = true;
    }
}
else
{
    $_SESSION['scriptcase']['display_mobile'] = false;
}
    $_SESSION['scriptcase']['menu_principal']['glo_nm_path_prod'] = "";
    $_SESSION['scriptcase']['menu_principal']['glo_nm_perfil']    = "";
    $_SESSION['scriptcase']['menu_principal']['glo_nm_usa_grupo'] = "";

ob_start();

class menu_principal_class
{
  var $Db;

 function sc_Include($path, $tp, $name)
 {
     if ((empty($tp) && empty($name)) || ($tp == "F" && !function_exists($name)) || ($tp == "C" && !class_exists($name)))
     {
         include_once($path);
     }
 } // sc_Include

 function menu_principal_menu()
 {
    global $menu_principal_menuData;
     if (isset($_POST["nmgp_idioma"]))  
     { 
         $Temp_lang = explode(";" , $_POST["nmgp_idioma"]);  
         if (isset($Temp_lang[0]) && !empty($Temp_lang[0]))  
          { 
             $_SESSION['scriptcase']['str_lang'] = $Temp_lang[0];
         } 
         if (isset($Temp_lang[1]) && !empty($Temp_lang[1])) 
         { 
             $_SESSION['scriptcase']['str_conf_reg'] = $Temp_lang[1];
         } 
     } 
   
     if (isset($_POST["nmgp_schema"]))  
     { 
         $_SESSION['scriptcase']['str_schema_all'] = $_POST["nmgp_schema"] . "/" . $_POST["nmgp_schema"];
     } 
   
           $nm_versao_sc  = "" ; 
           $_SESSION['scriptcase']['menu_principal']['contr_erro'] = 'off';
           $Campos_Mens_erro = "";
           $sc_site_ssl   = (isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on') ? true : false;
           $NM_dir_atual = getcwd();
           if (empty($NM_dir_atual))
           {
               $str_path_sys          = (isset($_SERVER['SCRIPT_FILENAME'])) ? $_SERVER['SCRIPT_FILENAME'] : $_SERVER['ORIG_PATH_TRANSLATED'];
               $str_path_sys          = str_replace("\\", '/', $str_path_sys);
           }
           else
           {
               $sc_nm_arquivo         = explode("/", $_SERVER['PHP_SELF']);
               $str_path_sys          = str_replace("\\", "/", getcwd()) . "/" . $sc_nm_arquivo[count($sc_nm_arquivo)-1];
           }
      //check publication with the prod
      $str_path_apl_url = $_SERVER['PHP_SELF'];
      $str_path_apl_url = str_replace("\\", '/', $str_path_apl_url);
      $str_path_apl_url = substr($str_path_apl_url, 0, strrpos($str_path_apl_url, "/"));
      $str_path_apl_url = substr($str_path_apl_url, 0, strrpos($str_path_apl_url, "/")+1);
      $str_path_apl_dir = substr($str_path_sys, 0, strrpos($str_path_sys, "/"));
      $str_path_apl_dir = substr($str_path_apl_dir, 0, strrpos($str_path_apl_dir, "/")+1);
      //check prod
      if(empty($_SESSION['scriptcase']['menu_principal']['glo_nm_path_prod']))
      {
              /*check prod*/$_SESSION['scriptcase']['menu_principal']['glo_nm_path_prod'] = $str_path_apl_url . "_lib/prod";
      }
$this->sc_charset['UTF-8'] = 'utf-8';
$this->sc_charset['ISO-2022-JP'] = 'iso-2022-jp';
$this->sc_charset['ISO-2022-KR'] = 'iso-2022-kr';
$this->sc_charset['ISO-8859-1'] = 'iso-8859-1';
$this->sc_charset['ISO-8859-2'] = 'iso-8859-2';
$this->sc_charset['ISO-8859-3'] = 'iso-8859-3';
$this->sc_charset['ISO-8859-4'] = 'iso-8859-4';
$this->sc_charset['ISO-8859-5'] = 'iso-8859-5';
$this->sc_charset['ISO-8859-6'] = 'iso-8859-6';
$this->sc_charset['ISO-8859-7'] = 'iso-8859-7';
$this->sc_charset['ISO-8859-8'] = 'iso-8859-8';
$this->sc_charset['ISO-8859-8-I'] = 'iso-8859-8-i';
$this->sc_charset['ISO-8859-9'] = 'iso-8859-9';
$this->sc_charset['ISO-8859-10'] = 'iso-8859-10';
$this->sc_charset['ISO-8859-13'] = 'iso-8859-13';
$this->sc_charset['ISO-8859-14'] = 'iso-8859-14';
$this->sc_charset['ISO-8859-15'] = 'iso-8859-15';
$this->sc_charset['WINDOWS-1250'] = 'windows-1250';
$this->sc_charset['WINDOWS-1251'] = 'windows-1251';
$this->sc_charset['WINDOWS-1252'] = 'windows-1252';
$this->sc_charset['WINDOWS-1253'] = 'windows-1253';
$this->sc_charset['WINDOWS-1254'] = 'windows-1254';
$this->sc_charset['WINDOWS-1255'] = 'windows-1255';
$this->sc_charset['WINDOWS-1256'] = 'windows-1256';
$this->sc_charset['WINDOWS-1257'] = 'windows-1257';
$this->sc_charset['KOI8-R'] = 'koi8-r';
$this->sc_charset['BIG-5'] = 'big5';
$this->sc_charset['EUC-CN'] = 'EUC-CN';
$this->sc_charset['GB18030'] = 'GB18030';
$this->sc_charset['GB2312'] = 'gb2312';
$this->sc_charset['EUC-JP'] = 'euc-jp';
$this->sc_charset['SJIS'] = 'shift-jis';
$this->sc_charset['EUC-KR'] = 'euc-kr';
$_SESSION['scriptcase']['charset_entities']['UTF-8'] = 'UTF-8';
$_SESSION['scriptcase']['charset_entities']['ISO-8859-1'] = 'ISO-8859-1';
$_SESSION['scriptcase']['charset_entities']['ISO-8859-5'] = 'ISO-8859-5';
$_SESSION['scriptcase']['charset_entities']['ISO-8859-15'] = 'ISO-8859-15';
$_SESSION['scriptcase']['charset_entities']['WINDOWS-1251'] = 'cp1251';
$_SESSION['scriptcase']['charset_entities']['WINDOWS-1252'] = 'cp1252';
$_SESSION['scriptcase']['charset_entities']['BIG-5'] = 'BIG5';
$_SESSION['scriptcase']['charset_entities']['EUC-CN'] = 'GB2312';
$_SESSION['scriptcase']['charset_entities']['GB2312'] = 'GB2312';
$_SESSION['scriptcase']['charset_entities']['SJIS'] = 'Shift_JIS';
$_SESSION['scriptcase']['charset_entities']['EUC-JP'] = 'EUC-JP';
$_SESSION['scriptcase']['charset_entities']['KOI8-R'] = 'KOI8-R';
$str_path_web   = $_SERVER['PHP_SELF'];
$str_path_web   = str_replace("\\", '/', $str_path_web);
$str_path_web   = str_replace('//', '/', $str_path_web);
$str_root       = substr($str_path_sys, 0, -1 * strlen($str_path_web));
$path_link      = substr($str_path_web, 0, strrpos($str_path_web, '/'));
$path_link      = substr($path_link, 0, strrpos($path_link, '/')) . '/';
$path_btn       = $str_root . $path_link . "_lib/buttons/";
$path_imag_cab  = $path_link . "_lib/img";
$this->force_mobile = false;
$this->path_botoes    = '../_lib/img';
$this->path_imag_apl  = $str_root . $path_link . "_lib/img";
$path_help      = $path_link . "_lib/webhelp/";
$path_libs      = $str_root . $_SESSION['scriptcase']['menu_principal']['glo_nm_path_prod'] . "/lib/php";
$path_third     = $str_root . $_SESSION['scriptcase']['menu_principal']['glo_nm_path_prod'] . "/third";
$path_adodb     = $str_root . $_SESSION['scriptcase']['menu_principal']['glo_nm_path_prod'] . "/third/adodb";
$path_apls      = $str_root . substr($path_link, 0, strrpos($path_link, '/'));
$path_img_old   = $str_root . $path_link . "menu_principal/img";
$this->path_css = $str_root . $path_link . "_lib/css/";
$this->url_css = "../_lib/css/";
$path_lib_php   = $str_root . $path_link . "_lib/lib/php";
$menu_mobile_hide          = 'N';
$menu_mobile_inicial_state = 'escondido';
$menu_mobile_hide_onclick  = 'S';
$menutree_mobile_float     = 'S';
$menu_mobile_hide_icon     = 'N';
$menu_mobile_hide_icon_menu_position     = 'right';
$mobile_menu_mobile_hide          = 'S';
$mobile_menu_mobile_inicial_state = 'aberto';
$mobile_menu_mobile_hide_onclick  = 'S';
$mobile_menutree_mobile_float     = 'N';
$mobile_menu_mobile_hide_icon     = 'N';
$mobile_menu_mobile_hide_icon_menu_position     = 'right';

$this->sc_Include($path_libs . "/nm_ini_perfil.php", "F", "perfil_lib") ; 
 if(function_exists('set_php_timezone')) set_php_timezone('menu_principal');
if (isset($_SESSION['scriptcase']['user_logout']))
{
    foreach ($_SESSION['scriptcase']['user_logout'] as $ind => $parms)
    {
        if (isset($_SESSION[$parms['V']]) && $_SESSION[$parms['V']] == $parms['U'])
        {
            unset($_SESSION['scriptcase']['user_logout'][$ind]);
            $nm_apl_dest = $parms['R'];
            $dir = explode("/", $nm_apl_dest);
            if (count($dir) == 1)
            {
                $nm_apl_dest = str_replace(".php", "", $nm_apl_dest);
                $nm_apl_dest = $path_link . SC_dir_app_name($nm_apl_dest) . "/";
            }
?>
            <html>
            <body>
            <form name="FRedirect" method="POST" action="<?php echo $nm_apl_dest; ?>" target="<?php echo $parms['T']; ?>">
            </form>
            <script>
             document.FRedirect.submit();
            </script>
            </body>
            </html>
<?php
            exit;
        }
    }
}
if (!defined("SC_ERROR_HANDLER"))
{
    define("SC_ERROR_HANDLER", 1);
    include_once(dirname(__FILE__) . "/menu_principal_erro.php");
}
include_once(dirname(__FILE__) . "/menu_principal_erro.class.php"); 
$this->Erro = new menu_principal_erro();
$str_path = substr($_SESSION['scriptcase']['menu_principal']['glo_nm_path_prod'], 0, strrpos($_SESSION['scriptcase']['menu_principal']['glo_nm_path_prod'], '/') + 1);
if (!is_file($str_root . $str_path . 'devel/class/xmlparser/nmXmlparserIniSys.class.php'))
{
    unset($_SESSION['scriptcase']['nm_sc_retorno']);
    unset($_SESSION['scriptcase']['menu_principal']['glo_nm_conexao']);
}

/* Definição dos Caminhos */
$menu_principal_menuData         = array();
$menu_principal_menuData['path'] = array();
$menu_principal_menuData['url']  = array();
$NM_dir_atual = getcwd();
if (empty($NM_dir_atual))
{
    $menu_principal_menuData['path']['sys'] = (isset($_SERVER['SCRIPT_FILENAME'])) ? $_SERVER['SCRIPT_FILENAME'] : $_SERVER['ORIG_PATH_TRANSLATED'];
    $menu_principal_menuData['path']['sys'] = str_replace("\\", '/', $str_path_sys);
    $menu_principal_menuData['path']['sys'] = str_replace('//', '/', $str_path_sys);
}
else
{
    $sc_nm_arquivo                                   = explode("/", $_SERVER['PHP_SELF']);
    $menu_principal_menuData['path']['sys'] = str_replace("\\", "/", str_replace("\\\\", "\\", getcwd())) . "/" . $sc_nm_arquivo[count($sc_nm_arquivo)-1];
}
$menu_principal_menuData['url']['web']   = $_SERVER['PHP_SELF'];
$menu_principal_menuData['url']['web']   = str_replace("\\", '/', $menu_principal_menuData['url']['web']);
$menu_principal_menuData['path']['root'] = substr($menu_principal_menuData['path']['sys'],  0, -1 * strlen($menu_principal_menuData['url']['web']));
$menu_principal_menuData['path']['app']  = substr($menu_principal_menuData['path']['sys'],  0, strrpos($menu_principal_menuData['path']['sys'],  '/'));
$menu_principal_menuData['path']['link'] = substr($menu_principal_menuData['path']['app'],  0, strrpos($menu_principal_menuData['path']['app'],  '/'));
$menu_principal_menuData['path']['link'] = substr($menu_principal_menuData['path']['link'], 0, strrpos($menu_principal_menuData['path']['link'], '/')) . '/';
$menu_principal_menuData['path']['app'] .= '/';
$menu_principal_menuData['url']['app']   = substr($menu_principal_menuData['url']['web'],  0, strrpos($menu_principal_menuData['url']['web'],  '/'));
$menu_principal_menuData['url']['link']  = substr($menu_principal_menuData['url']['app'],  0, strrpos($menu_principal_menuData['url']['app'],  '/'));
if ($_SESSION['scriptcase']['menu_principal']['glo_nm_usa_grupo'] == "S")
{
    $menu_principal_menuData['url']['link']  = substr($menu_principal_menuData['url']['link'], 0, strrpos($menu_principal_menuData['url']['link'], '/'));
}
$menu_principal_menuData['url']['link']  .= '/';
$menu_principal_menuData['url']['app']   .= '/';

$nm_img_fun_menu = ""; 
if (!isset($_SESSION['scriptcase']['str_lang']) || empty($_SESSION['scriptcase']['str_lang']))
{
    $_SESSION['scriptcase']['str_lang'] = "pt_br";
}
if (!isset($_SESSION['scriptcase']['str_conf_reg']) || empty($_SESSION['scriptcase']['str_conf_reg']))
{
    $_SESSION['scriptcase']['str_conf_reg'] = "pt_br";
}
$this->str_lang        = $_SESSION['scriptcase']['str_lang'];
$this->str_conf_reg    = $_SESSION['scriptcase']['str_conf_reg'];
if (!function_exists("NM_is_utf8"))
{
   include_once("../_lib/lib/php/nm_utf8.php");
}
if (!function_exists("SC_dir_app_ini"))
{
    include_once("../_lib/lib/php/nm_ctrl_app_name.php");
}
SC_dir_app_ini('SAE');
if ($_SESSION['scriptcase']['menu_principal']['glo_nm_usa_grupo'] == "S")
{
    $path_apls     = substr($path_apls, 0, strrpos($path_apls, '/'));
}
$path_apls     .= "/";
$this->str_schema_all = (isset($_SESSION['scriptcase']['str_schema_all']) && !empty($_SESSION['scriptcase']['str_schema_all'])) ? $_SESSION['scriptcase']['str_schema_all'] : "numeracao_tema/numeracao_tema";
include("../_lib/lang/". $this->str_lang .".lang.php");
include("../_lib/css/" . $this->str_schema_all . "_menutab.php");
include("../_lib/css/" . $this->str_schema_all . "_menuH.php");
if(isset($pagina_schemamenu) && !empty($pagina_schemamenu) && is_file("../_lib/menuicons/". $pagina_schemamenu .".php"))
{
    include("../_lib/menuicons/". $pagina_schemamenu .".php");
}
$this->img_sep_toolbar = trim($str_toolbar_separator);
include("../_lib/lang/config_region.php");
include("../_lib/lang/lang_config_region.php");
$this->regionalDefault();
$Str_btn_menu = trim($str_button) . "/" . trim($str_button) . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".php";
$Str_btn_css  = trim($str_button) . "/" . trim($str_button) . ".css";
$this->css_menutab_active_close_icon    = trim($css_menutab_active_close_icon);
$this->css_menutab_inactive_close_icon  = trim($css_menutab_inactive_close_icon);
$this->breadcrumbline_separator  = trim($breadcrumbline_separator);
include($path_btn . $Str_btn_menu);
if (!function_exists("nmButtonOutput"))
{
   include_once("../_lib/lib/php/nm_gp_config_btn.php");
}
asort($this->Nm_lang_conf_region);
$this->sc_Include($path_lib_php . "/nm_data.class.php", "C", "nm_data") ; 
$this->sc_Include($path_lib_php . "/nm_functions.php", "", "") ; 
$this->nm_data = new nm_data("pt_br");
include_once("menu_principal_toolbar.php");

$this->tab_grupo[0] = "SAE/";
if ($_SESSION['scriptcase']['menu_principal']['glo_nm_usa_grupo'] != "S")
{
    $this->tab_grupo[0] = "";
}

     $_SESSION['scriptcase']['menu_atual'] = "menu_principal";
     $_SESSION['scriptcase']['menu_apls']['menu_principal'] = array();
     if (isset($_SESSION['scriptcase']['sc_connection']) && !empty($_SESSION['scriptcase']['sc_connection']))
     {
         foreach ($_SESSION['scriptcase']['sc_connection'] as $NM_con_orig => $NM_con_dest)
         {
             if (isset($_SESSION['scriptcase']['menu_principal']['glo_nm_conexao']) && $_SESSION['scriptcase']['menu_principal']['glo_nm_conexao'] == $NM_con_orig)
             {
/*NM*/           $_SESSION['scriptcase']['menu_principal']['glo_nm_conexao'] = $NM_con_dest;
             }
             if (isset($_SESSION['scriptcase']['menu_principal']['glo_nm_perfil']) && $_SESSION['scriptcase']['menu_principal']['glo_nm_perfil'] == $NM_con_orig)
             {
/*NM*/           $_SESSION['scriptcase']['menu_principal']['glo_nm_perfil'] = $NM_con_dest;
             }
             if (isset($_SESSION['scriptcase']['menu_principal']['glo_con_' . $NM_con_orig]))
             {
                 $_SESSION['scriptcase']['menu_principal']['glo_con_' . $NM_con_orig] = $NM_con_dest;
             }
         }
     }
$_SESSION['scriptcase']['charset'] = (isset($this->Nm_lang['Nm_charset']) && !empty($this->Nm_lang['Nm_charset'])) ? $this->Nm_lang['Nm_charset'] : "ISO-8859-1";
ini_set('default_charset', $_SESSION['scriptcase']['charset']);
$_SESSION['scriptcase']['charset_html']  = (isset($this->sc_charset[$_SESSION['scriptcase']['charset']])) ? $this->sc_charset[$_SESSION['scriptcase']['charset']] : $_SESSION['scriptcase']['charset'];
foreach ($this->Nm_conf_reg[$this->str_conf_reg] as $ind => $dados)
{
    if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($dados))
    {
        $this->Nm_conf_reg[$this->str_conf_reg][$ind] = sc_convert_encoding($dados, $_SESSION['scriptcase']['charset'], "UTF-8");
    }
}
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
if (isset($this->Nm_lang['lang_errm_dbcn_conn']))
{
    $_SESSION['scriptcase']['db_conn_error'] = $this->Nm_lang['lang_errm_dbcn_conn'];
}
$_SESSION['scriptcase']['erro']['str_schema'] = $this->str_schema_all . "_error.css";
$_SESSION['scriptcase']['erro']['str_schema_dir'] = $this->str_schema_all . "_error" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css";
$_SESSION['scriptcase']['erro']['str_lang']   = $this->str_lang;
if (is_dir($path_img_old))
{
    $Res_dir_img = @opendir($path_img_old);
    if ($Res_dir_img)
    {
        while (FALSE !== ($Str_arquivo = @readdir($Res_dir_img))) 
        {
           $Str_arquivo = "/" . $Str_arquivo;
           if (@is_file($path_img_old . $Str_arquivo) && '.' != $Str_arquivo && '..' != $path_img_old . $Str_arquivo)
           {
               @unlink($path_img_old . $Str_arquivo);
           }
        }
    }
    @closedir($Res_dir_img);
    rmdir($path_img_old);
}
//
if (isset($_GET) && !empty($_GET))
{
    foreach ($_GET as $nmgp_var => $nmgp_val)
    {
        if (substr($nmgp_var, 0, 11) == "SC_glo_par_")
        {
            $nmgp_var = substr($nmgp_var, 11);
            $nmgp_val = $_SESSION[$nmgp_val];
        }
        if ($nmgp_var == "nmgp_parms" && substr($nmgp_val, 0, 8) == "@SC_par@")
        {
            $SC_Ind_Val = explode("@SC_par@", $nmgp_val);
            $nmgp_val = $_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['Lig_Md5'][$SC_Ind_Val[3]];
        }
         $$nmgp_var = $nmgp_val;
    }
}
if (isset($_POST) && !empty($_POST))
{
    foreach ($_POST as $nmgp_var => $nmgp_val)
    {
        if (substr($nmgp_var, 0, 11) == "SC_glo_par_")
        {
            $nmgp_var = substr($nmgp_var, 11);
            $nmgp_val = $_SESSION[$nmgp_val];
        }
        if ($nmgp_var == "nmgp_parms" && substr($nmgp_val, 0, 8) == "@SC_par@")
        {
            $SC_Ind_Val = explode("@SC_par@", $nmgp_val);
            $nmgp_val = $_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['Lig_Md5'][$SC_Ind_Val[3]];
        }
         $$nmgp_var = $nmgp_val;
    }
}
if (isset($script_case_init))
{
    $_SESSION['sc_session'][1]['menu_principal']['init'] = $script_case_init;
}
else
if (!isset($_SESSION['sc_session'][1]['menu_principal']['init']))
{
    $_SESSION['sc_session'][1]['menu_principal']['init'] = "";
}
$script_case_init = $_SESSION['sc_session'][1]['menu_principal']['init'];
if (isset($nmgp_parms) && !empty($nmgp_parms)) 
{ 
    $nmgp_parms = str_replace("*scout", "?@?", $nmgp_parms);
    $nmgp_parms = str_replace("*scin", "?#?", $nmgp_parms);
    $todox = str_replace("?#?@?@?", "?#?@ ?@?", $nmgp_parms);
    $todo  = explode("?@?", $todox);
    $ix = 0;
    while (!empty($todo[$ix]))
    {
       $cadapar = explode("?#?", $todo[$ix]);
       if (substr($cadapar[0], 0, 11) == "SC_glo_par_")
       {
           $cadapar[0] = substr($cadapar[0], 11);
           $cadapar[1] = $_SESSION[$cadapar[1]];
       }
        if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
       $$cadapar[0] = $cadapar[1];
       $_SESSION[$cadapar[0]] = $cadapar[1];
       $ix++;
     }
} 
if (isset($_SESSION['sc_session']['SC_parm_violation']))
{
    unset($_SESSION['sc_session']['SC_parm_violation']);
    echo "<html>";
    echo "<body>";
    echo "<table align=\"center\" width=\"50%\" border=1 height=\"50px\">";
    echo "<tr>";
    echo "   <td align=\"center\">";
    echo "       <b><font size=4>" . $this->Nm_lang['lang_errm_ajax_data'] . "</font>";
    echo "   </b></td>";
    echo " </tr>";
    echo "</table>";
    echo "</body>";
    echo "</html>";
    exit;
}
$nm_url_saida = "";
if (isset($nmgp_url_saida))
{
    $nm_url_saida = $nmgp_url_saida;
    if (isset($script_case_init))
    {
        $nm_url_saida .= "?script_case_init=" . NM_encode_input($script_case_init) . "&script_case_session=" . session_id();
    }
}
if (isset($_POST["nmgp_idioma"]) || isset($_POST["nmgp_schema"]))  
{ 
    $nm_url_saida = $_SESSION['scriptcase']['sc_saida_menu_principal'];
}
elseif (!empty($nm_url_saida))
{
    $_SESSION['scriptcase']['sc_url_saida'][$script_case_init]  = $nm_url_saida;
    $_SESSION['scriptcase']['sc_saida_menu_principal'] = $nm_url_saida;
}
else
{
    $_SESSION['scriptcase']['sc_saida_menu_principal'] = (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : "javascript:window.close()";
}
$this->sc_Include($path_libs . "/nm_ini_lib.php", "F", "nm_dir_normaliza") ; 
      $_SESSION['scriptcase']['menu_principal']['contr_erro'] = 'on';
if (!isset($_SESSION['bind'])) {$_SESSION['bind'] = "";}
if (!isset($this->sc_temp_bind)) {$this->sc_temp_bind = (isset($_SESSION['bind'])) ? $_SESSION['bind'] : "";}
   if(!$this->sc_temp_bind){
	 if (isset($this->sc_temp_bind)) {$_SESSION['bind'] = $this->sc_temp_bind;}
 if (!isset($Campos_Mens_erro) || empty($Campos_Mens_erro))
 {
$this->nmgp_redireciona_form($menu_principal_menuData['url']['link'] . $this->tab_grupo[0] . "" . SC_dir_app_name('control_login') . "/", "menu_principal.php", "","_self", 440, 630);
 };
}
if (isset($this->sc_temp_bind)) {$_SESSION['bind'] = $this->sc_temp_bind;}
$_SESSION['scriptcase']['menu_principal']['contr_erro'] = 'off';
/* Dados do menu em sessao */
$_SESSION['nm_menu'] = array('prod' => $str_root . $_SESSION['scriptcase']['menu_principal']['glo_nm_path_prod'] . '/third/COOLjsMenu/',
                              'url' => $_SESSION['scriptcase']['menu_principal']['glo_nm_path_prod'] . '/third/COOLjsMenu/');

if ((isset($nmgp_outra_jan) && $nmgp_outra_jan == "true") || (isset($_SESSION['scriptcase']['sc_outra_jan']) && $_SESSION['scriptcase']['sc_outra_jan'] == 'menu_principal'))
{
    $_SESSION['sc_session'][1]['menu_principal']['sc_outra_jan'] = true;
     unset($_SESSION['scriptcase']['sc_outra_jan']);
    $_SESSION['scriptcase']['sc_saida_menu_principal'] = "javascript:window.close()";
}
/* Variáveis de Configuração do Menu */
$menu_principal_menuData['iframe'] = TRUE;

if (!isset($_SESSION['scriptcase']['sc_apl_seg']))
{
    $_SESSION['scriptcase']['sc_apl_seg'] = array();
}
$sc_teste_seg = file($path_apls . $this->tab_grupo[0] . SC_dir_app_name("bg_menu_sae") . "/bg_menu_sae_ini.txt");
if ((!isset($sc_teste_seg[3]) || trim($sc_teste_seg[3]) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
{
    if (!isset($_SESSION['scriptcase']['sc_apl_seg']['bg_menu_sae']))
    {
        $_SESSION['scriptcase']['sc_apl_seg']['bg_menu_sae'] = "on";
    }
}
if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
{ 
    $_SESSION['scriptcase']['sc_apl_seg']['bg_menu_sae'] = "on";
} 
$sc_teste_seg = file($path_apls . $this->tab_grupo[0] . SC_dir_app_name("control_aluno") . "/control_aluno_ini.txt");
if ((!isset($sc_teste_seg[3]) || trim($sc_teste_seg[3]) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
{
    if (!isset($_SESSION['scriptcase']['sc_apl_seg']['control_aluno']))
    {
        $_SESSION['scriptcase']['sc_apl_seg']['control_aluno'] = "on";
    }
}
if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
{ 
    $_SESSION['scriptcase']['sc_apl_seg']['control_aluno'] = "on";
} 
$sc_teste_seg = file($path_apls . $this->tab_grupo[0] . SC_dir_app_name("control_estoque_livro") . "/control_estoque_livro_ini.txt");
if ((!isset($sc_teste_seg[3]) || trim($sc_teste_seg[3]) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
{
    if (!isset($_SESSION['scriptcase']['sc_apl_seg']['control_estoque_livro']))
    {
        $_SESSION['scriptcase']['sc_apl_seg']['control_estoque_livro'] = "on";
    }
}
if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
{ 
    $_SESSION['scriptcase']['sc_apl_seg']['control_estoque_livro'] = "on";
} 
$sc_teste_seg = file($path_apls . $this->tab_grupo[0] . SC_dir_app_name("grid_aluno") . "/grid_aluno_ini.txt");
if ((!isset($sc_teste_seg[3]) || trim($sc_teste_seg[3]) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
{
    if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_aluno']))
    {
        $_SESSION['scriptcase']['sc_apl_seg']['grid_aluno'] = "on";
    }
}
if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
{ 
    $_SESSION['scriptcase']['sc_apl_seg']['grid_aluno'] = "on";
} 
$sc_teste_seg = file($path_apls . $this->tab_grupo[0] . SC_dir_app_name("grid_estoque_livro") . "/grid_estoque_livro_ini.txt");
if ((!isset($sc_teste_seg[3]) || trim($sc_teste_seg[3]) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
{
    if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_estoque_livro']))
    {
        $_SESSION['scriptcase']['sc_apl_seg']['grid_estoque_livro'] = "on";
    }
}
if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
{ 
    $_SESSION['scriptcase']['sc_apl_seg']['grid_estoque_livro'] = "on";
} 
$sc_teste_seg = file($path_apls . $this->tab_grupo[0] . SC_dir_app_name("grid_relatorio_emprestimo") . "/grid_relatorio_emprestimo_ini.txt");
if ((!isset($sc_teste_seg[3]) || trim($sc_teste_seg[3]) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
{
    if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_relatorio_emprestimo']))
    {
        $_SESSION['scriptcase']['sc_apl_seg']['grid_relatorio_emprestimo'] = "on";
    }
}
if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
{ 
    $_SESSION['scriptcase']['sc_apl_seg']['grid_relatorio_emprestimo'] = "on";
} 
$sc_teste_seg = file($path_apls . $this->tab_grupo[0] . SC_dir_app_name("control_login") . "/control_login_ini.txt");
if ((!isset($sc_teste_seg[3]) || trim($sc_teste_seg[3]) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
{
    if (!isset($_SESSION['scriptcase']['sc_apl_seg']['control_login']))
    {
        $_SESSION['scriptcase']['sc_apl_seg']['control_login'] = "on";
    }
}
if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
{ 
    $_SESSION['scriptcase']['sc_apl_seg']['control_login'] = "on";
} 
/* Itens do Menu */
$_SESSION['scriptcase']['menu_principal']['contr_erro'] = 'on';
  $this->background();
$_SESSION['scriptcase']['menu_principal']['contr_erro'] = 'off';

$sOutputBuffer = ob_get_contents();
ob_end_clean();

 $nm_var_lab[0] = "Estudante";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[0]))
{
    $nm_var_lab[0] = sc_convert_encoding($nm_var_lab[0], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[1] = "Estoque ";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[1]))
{
    $nm_var_lab[1] = sc_convert_encoding($nm_var_lab[1], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[2] = "Relat�rio";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[2]))
{
    $nm_var_lab[2] = sc_convert_encoding($nm_var_lab[2], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[3] = "Alunos cadastrados";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[3]))
{
    $nm_var_lab[3] = sc_convert_encoding($nm_var_lab[3], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[4] = "Livros em estoque";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[4]))
{
    $nm_var_lab[4] = sc_convert_encoding($nm_var_lab[4], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[5] = "Livros emprestados";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[5]))
{
    $nm_var_lab[5] = sc_convert_encoding($nm_var_lab[5], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[6] = "Sair";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[6]))
{
    $nm_var_lab[6] = sc_convert_encoding($nm_var_lab[6], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[0] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[0]))
{
    $nm_var_hint[0] = sc_convert_encoding($nm_var_hint[0], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[1] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[1]))
{
    $nm_var_hint[1] = sc_convert_encoding($nm_var_hint[1], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[2] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[2]))
{
    $nm_var_hint[2] = sc_convert_encoding($nm_var_hint[2], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[3] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[3]))
{
    $nm_var_hint[3] = sc_convert_encoding($nm_var_hint[3], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[4] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[4]))
{
    $nm_var_hint[4] = sc_convert_encoding($nm_var_hint[4], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[5] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[5]))
{
    $nm_var_hint[5] = sc_convert_encoding($nm_var_hint[5], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[6] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[6]))
{
    $nm_var_hint[6] = sc_convert_encoding($nm_var_hint[6], $_SESSION['scriptcase']['charset'], "UTF-8");
}
$saida_apl = $_SESSION['scriptcase']['sc_saida_menu_principal'];
if (isset($_SESSION['scriptcase']['sc_apl_seg']['control_aluno']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['control_aluno']) == "on")
{
    $menu_principal_menuData['data'] .= "item_1|.|" . $nm_var_lab[0] . "|menu_principal_form_php.php?sc_item_menu=item_1&sc_apl_menu=control_aluno&sc_apl_link=" . urlencode($menu_principal_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menu_principal']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[0] . "|sys__NM__bg__NM__aluno (1) (1).png|" . $this->menu_principal_target('_self') . "|" . "\n";
}
else
{
    $menu_principal_menuData['data'] .= "item_1|.|" . $nm_var_lab[0] . "|||sys__NM__bg__NM__aluno (1) (1).png|_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['control_estoque_livro']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['control_estoque_livro']) == "on")
{
    $menu_principal_menuData['data'] .= "item_3|.|" . $nm_var_lab[1] . "|menu_principal_form_php.php?sc_item_menu=item_3&sc_apl_menu=control_estoque_livro&sc_apl_link=" . urlencode($menu_principal_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menu_principal']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[1] . "|scriptcase__NM__ico__NM__books_blue_add_32.png|" . $this->menu_principal_target('_self') . "|" . "\n";
}
else
{
    $menu_principal_menuData['data'] .= "item_3|.|" . $nm_var_lab[1] . "|||scriptcase__NM__ico__NM__books_blue_add_32.png|_self|disabled\n";
}
$menu_principal_menuData['data'] .= "item_4|.|" . $nm_var_lab[2] . "||" . $nm_var_hint[2] . "|scriptcase__NM__ico__NM__address_book3_32.png|_self|\n";
if (isset($_SESSION['scriptcase']['sc_apl_seg']['grid_aluno']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_aluno']) == "on")
{
    $menu_principal_menuData['data'] .= "item_7|..|" . $nm_var_lab[3] . "|menu_principal_form_php.php?sc_item_menu=item_7&sc_apl_menu=grid_aluno&sc_apl_link=" . urlencode($menu_principal_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menu_principal']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[3] . "|scriptcase__NM__ico__NM__businesspeople_32.png|" . $this->menu_principal_target('_self') . "|" . "\n";
}
else
{
    $menu_principal_menuData['data'] .= "item_7|..|" . $nm_var_lab[3] . "|||scriptcase__NM__ico__NM__businesspeople_32.png|_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['grid_estoque_livro']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_estoque_livro']) == "on")
{
    $menu_principal_menuData['data'] .= "item_6|..|" . $nm_var_lab[4] . "|menu_principal_form_php.php?sc_item_menu=item_6&sc_apl_menu=grid_estoque_livro&sc_apl_link=" . urlencode($menu_principal_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menu_principal']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[4] . "|scriptcase__NM__ico__NM__books_blue_32.png|" . $this->menu_principal_target('_self') . "|" . "\n";
}
else
{
    $menu_principal_menuData['data'] .= "item_6|..|" . $nm_var_lab[4] . "|||scriptcase__NM__ico__NM__books_blue_32.png|_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['grid_relatorio_emprestimo']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_relatorio_emprestimo']) == "on")
{
    $menu_principal_menuData['data'] .= "item_8|..|" . $nm_var_lab[5] . "|menu_principal_form_php.php?sc_item_menu=item_8&sc_apl_menu=grid_relatorio_emprestimo&sc_apl_link=" . urlencode($menu_principal_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menu_principal']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[5] . "|scriptcase__NM__ico__NM__book_blue_delete_32.png|" . $this->menu_principal_target('_self') . "|" . "\n";
}
else
{
    $menu_principal_menuData['data'] .= "item_8|..|" . $nm_var_lab[5] . "|||scriptcase__NM__ico__NM__book_blue_delete_32.png|_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['control_login']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['control_login']) == "on")
{
    $menu_principal_menuData['data'] .= "item_5|.|" . $nm_var_lab[6] . "|menu_principal_form_php.php?sc_item_menu=item_5&sc_apl_menu=control_login&sc_apl_link=" . urlencode($menu_principal_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menu_principal']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[6] . "|scriptcase__NM__ico__NM__exit_32.png|" . $this->menu_principal_target('_parent') . "|" . "\n";
}
else
{
    $menu_principal_menuData['data'] .= "item_5|.|" . $nm_var_lab[6] . "|||scriptcase__NM__ico__NM__exit_32.png|_parent|disabled\n";
}

$menu_principal_menuData['data'] = array();
$str_disabled = "N";
$str_link = "menu_principal_form_php.php?sc_item_menu=item_1&sc_apl_menu=control_aluno&sc_apl_link=" . urlencode($menu_principal_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menu_principal']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['control_aluno']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['control_aluno']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "sys__NM__bg__NM__aluno (1) (1).png";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['contr']['active']))
    {
        $icon_aba = $arr_menuicons['contr']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['contr']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['contr']['inactive'];
    }
    $menu_principal_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[0] . "",
        'level'    => "0",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[0] . "",
        'id'       => "item_1",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->menu_principal_target('_self') . "\"",
        'sc_id'    => "item_1",
        'disabled' => $str_disabled,
    );
$str_disabled = "N";
$str_link = "menu_principal_form_php.php?sc_item_menu=item_3&sc_apl_menu=control_estoque_livro&sc_apl_link=" . urlencode($menu_principal_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menu_principal']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['control_estoque_livro']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['control_estoque_livro']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "scriptcase__NM__ico__NM__books_blue_add_32.png";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['contr']['active']))
    {
        $icon_aba = $arr_menuicons['contr']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['contr']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['contr']['inactive'];
    }
    $menu_principal_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[1] . "",
        'level'    => "0",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[1] . "",
        'id'       => "item_3",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->menu_principal_target('_self') . "\"",
        'sc_id'    => "item_3",
        'disabled' => $str_disabled,
    );
$str_disabled = "N";
$str_link = "#";
$str_icon = "scriptcase__NM__ico__NM__address_book3_32.png";
$icon_aba = "";
$icon_aba_inactive = "";
if(empty($icon_aba) && isset($arr_menuicons['others']['active']))
{
    $icon_aba = $arr_menuicons['others']['active'];
}
if(empty($icon_aba_inactive) && isset($arr_menuicons['others']['inactive']))
{
    $icon_aba_inactive = $arr_menuicons['others']['inactive'];
}
if($this->force_mobile || ($_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile']))
{
$str_link = "#";
}
$menu_principal_menuData['data'][] = array(
    'label'    => "" . $nm_var_lab[2] . "",
    'level'    => "0",
    'link'     => $str_link,
    'hint'     => "" . $nm_var_hint[2] . "",
    'id'       => "item_4",
    'icon'     => $str_icon,
    'icon_aba' => $icon_aba,
    'icon_aba_inactive' => $icon_aba_inactive,
    'target'   => "",
    'sc_id'    => "item_4",
    'disabled' => $str_disabled,
);
$str_disabled = "N";
$str_link = "menu_principal_form_php.php?sc_item_menu=item_7&sc_apl_menu=grid_aluno&sc_apl_link=" . urlencode($menu_principal_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menu_principal']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_aluno']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_aluno']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "scriptcase__NM__ico__NM__businesspeople_32.png";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $menu_principal_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[3] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[3] . "",
        'id'       => "item_7",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->menu_principal_target('_self') . "\"",
        'sc_id'    => "item_7",
        'disabled' => $str_disabled,
    );
$str_disabled = "N";
$str_link = "menu_principal_form_php.php?sc_item_menu=item_6&sc_apl_menu=grid_estoque_livro&sc_apl_link=" . urlencode($menu_principal_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menu_principal']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_estoque_livro']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_estoque_livro']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "scriptcase__NM__ico__NM__books_blue_32.png";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $menu_principal_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[4] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[4] . "",
        'id'       => "item_6",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->menu_principal_target('_self') . "\"",
        'sc_id'    => "item_6",
        'disabled' => $str_disabled,
    );
$str_disabled = "N";
$str_link = "menu_principal_form_php.php?sc_item_menu=item_8&sc_apl_menu=grid_relatorio_emprestimo&sc_apl_link=" . urlencode($menu_principal_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menu_principal']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_relatorio_emprestimo']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_relatorio_emprestimo']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "scriptcase__NM__ico__NM__book_blue_delete_32.png";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $menu_principal_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[5] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[5] . "",
        'id'       => "item_8",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->menu_principal_target('_self') . "\"",
        'sc_id'    => "item_8",
        'disabled' => $str_disabled,
    );
$str_disabled = "N";
$str_link = "menu_principal_form_php.php?sc_item_menu=item_5&sc_apl_menu=control_login&sc_apl_link=" . urlencode($menu_principal_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menu_principal']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['control_login']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['control_login']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "scriptcase__NM__ico__NM__exit_32.png";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['contr']['active']))
    {
        $icon_aba = $arr_menuicons['contr']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['contr']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['contr']['inactive'];
    }
    $menu_principal_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[6] . "",
        'level'    => "0",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[6] . "",
        'id'       => "item_5",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->menu_principal_target('_parent') . "\"",
        'sc_id'    => "item_5",
        'disabled' => $str_disabled,
    );

if (isset($_SESSION['scriptcase']['sc_def_menu']['menu_principal']))
{
    $arr_menu_usu = $this->nm_arr_menu_recursiv($_SESSION['scriptcase']['sc_def_menu']['menu_principal']);
    $this->nm_gera_menus($str_menu_usu, $arr_menu_usu, 1, 'menu_principal');
    $menu_principal_menuData['data'] = $str_menu_usu;
}
if (is_file("menu_principal_help.txt"))
{
    $Arq_WebHelp = file("menu_principal_help.txt"); 
    if (isset($Arq_WebHelp[0]) && !empty($Arq_WebHelp[0]))
    {
        $Arq_WebHelp[0] = str_replace("\r\n" , "", trim($Arq_WebHelp[0]));
        $Tmp = explode(";", $Arq_WebHelp[0]); 
        foreach ($Tmp as $Cada_help)
        {
            $Tmp1 = explode(":", $Cada_help); 
            if (!empty($Tmp1[0]) && isset($Tmp1[1]) && !empty($Tmp1[1]) && $Tmp1[0] == "menu" && is_file($str_root . $path_help . $Tmp1[1]))
            {
                $str_disabled = "N";
                $str_link = "" . $path_help . $Tmp1[1] . "";
                $str_icon = "";
                $icon_aba = "";
                $icon_aba_inactive = "";
                if(empty($icon_aba) && isset($arr_menuicons['']['active']))
                {
                    $icon_aba = $arr_menuicons['']['active'];
                }
                if(empty($icon_aba_inactive) && isset($arr_menuicons['']['inactive']))
                {
                    $icon_aba_inactive = $arr_menuicons['']['inactive'];
                }
                $menu_principal_menuData['data'][] = array(
                    'label'    => "" . $this->Nm_lang['lang_btns_help_hint'] . "",
                    'level'    => "0",
                    'link'     => $str_link,
                    'hint'     => "" . $this->Nm_lang['lang_btns_help_hint'] . "",
                    'id'       => "item_Help",
                    'icon'     => $str_icon,
                    'icon_aba' => $icon_aba,
                    'icon_aba_inactive' => $icon_aba_inactive,
                    'target'   => "" . $this->menu_principal_target('_blank') . "",
                    'sc_id'    => "item_Help",
                    'disabled' => $str_disabled,
                );
            }
        }
    }
}

if (isset($_SESSION['scriptcase']['sc_menu_del']['menu_principal']) && !empty($_SESSION['scriptcase']['sc_menu_del']['menu_principal']))
{
    $nivel = 0;
    $exclui_menu = false;
    foreach ($menu_principal_menuData['data'] as $i_menu => $cada_menu)
    {
       if (in_array($cada_menu['id'], $_SESSION['scriptcase']['sc_menu_del']['menu_principal']))
       {
          $nivel = $cada_menu['level'];
          $exclui_menu = true;
          unset($menu_principal_menuData['data'][$i_menu]);
       }
       elseif ( empty($cada_menu) || ($exclui_menu && $nivel < $cada_menu['level']))
       {
          unset($menu_principal_menuData['data'][$i_menu]);
       }
       else
       {
          $exclui_menu = false;
       }
    }
    $Temp_menu = array();
    foreach ($menu_principal_menuData['data'] as $i_menu => $cada_menu)
    {
        $Temp_menu[] = $cada_menu;
    }
    $menu_principal_menuData['data'] = $Temp_menu;
}

if (isset($_SESSION['scriptcase']['sc_menu_disable']['menu_principal']) && !empty($_SESSION['scriptcase']['sc_menu_disable']['menu_principal']))
{
    $disable_menu = false;
    foreach ($menu_principal_menuData['data'] as $i_menu => $cada_menu)
    {
       if (in_array($cada_menu['id'], $_SESSION['scriptcase']['sc_menu_disable']['menu_principal']))
       {
          $nivel = $cada_menu['level'];
          $disable_menu = true;
          $menu_principal_menuData['data'][$i_menu]['disabled'] = 'Y';
       }
       elseif (!empty($cada_menu) && $disable_menu && $nivel < $cada_menu['level'])
       { 
          $menu_principal_menuData['data'][$i_menu]['disabled'] = 'Y';
       }
       elseif (!empty($cada_menu))
       {
          $disable_menu = false;
       }
    }
}

/* Cabeçalho HTML */
if ($menu_principal_menuData['iframe'])
{
    $menu_principal_menuData['height'] = '100%';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?> style="height: 100%">
<head>
 <title>menu_principal</title>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
 <?php
 if ($_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'])
 {
  ?>
   <meta name='viewport' content='width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;' />
  <?php
 }
 ?>
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->str_schema_all ?>_btngrp.css<?php if (@is_file($this->path_css . $this->str_schema_all . '_btngrp.css')) { echo '?scp=' . md5($this->path_css . $this->str_schema_all . '_btngrp.css'); } ?>" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->str_schema_all ?>_menutab.css" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->str_schema_all ?>_menutab<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->str_schema_all ?>_menuH<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->str_schema_all ?>_menuH.css<?php if (@is_file($this->path_css . $this->str_schema_all . '_menuH.css')) { echo '?scp=' . md5($this->path_css . $this->str_schema_all . '_menuH.css'); } ?>" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/buttons/<?php echo $Str_btn_css ?>" /> 
<link rel="stylesheet" type="text/css" href="../_lib/css/_menuTheme/sys_Fair_Fair_Blue_byCelso_hor_<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir']; ?>.css<?php if (@is_file($this->path_css . '_menuTheme/' . "sys_Fair_Fair_Blue_byCelso" . '_' . hor . '.css')) { echo '?scp=' . md5($this->path_css . '_menuTheme/' . "sys_Fair_Fair_Blue_byCelso" . '_' . hor . '.css'); } ?>" />
<style>
   .scTabText {
   }</style>
<script>
var is_menu_vertical = false;
</script>
</head>
<body style="height: 100%" scroll="no" class='scMenuHPage'>
<?php

if ('' != $sOutputBuffer)
{
    echo $sOutputBuffer;
}

    $NM_scr_iframe = (isset($_POST['hid_scr_iframe'])) ? $_POST['hid_scr_iframe'] : "";   
}
else
{
    $menu_principal_menuData['height'] = '30px';
}

/* Arquivos JS */
?>
<script type="text/javascript" src="<?php echo $_SESSION['scriptcase']['menu_principal']['glo_nm_path_prod']; ?>/third/jquery/js/jquery.js"></script>
<script  type="text/javascript" src="<?php echo $_SESSION['scriptcase']['menu_principal']['glo_nm_path_prod']; ?>/third/jquery_plugin/contextmenu/jquery.contextmenu.js"></script>
 <link rel="stylesheet" type="text/css" href="<?php echo $_SESSION['scriptcase']['menu_principal']['glo_nm_path_prod']; ?>/third/jquery_plugin/contextmenu/contextmenu.css" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->str_schema_all ?>_contextmenu.css" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->str_schema_all ?>_contextmenu.css<?php if (@is_file($this->path_css . $this->str_schema_all . '_contextmenu.css')) { echo '?scp=' . md5($this->path_css . $this->str_schema_all . '_contextmenu.css'); } ?>" /> 
<?php
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
?>
<?php
$larg_table = "100%";
$col_span   = "";
$strAlign = 'align=\'center\'';
?>
<?php
$str_bmenu = nmButtonOutput($this->arr_buttons, "bmenu", "showMenu();", "showMenu();", "bmenu", "", "" . $this->Nm_lang['lang_btns_menu'] . "", "position:absolute; top:0px; left:0px; z-index:9999;", "absmiddle", "", "0px", $this->path_botoes, "", "" . $this->Nm_lang['lang_btns_menu_hint'] . "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
if($this->force_mobile || ($_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile']))
{
    $menu_mobile_hide          = $mobile_menu_mobile_hide;
    $menu_mobile_inicial_state = $mobile_menu_mobile_inicial_state;
    $menu_mobile_hide_onclick  = $mobile_menu_mobile_hide_onclick;
    $menutree_mobile_float     = $mobile_menutree_mobile_float;
    $menu_mobile_hide_icon     = $mobile_menu_mobile_hide_icon;
    $menu_mobile_hide_icon_menu_position     = $mobile_menu_mobile_hide_icon_menu_position;
}
if($menu_mobile_hide == 'S')
{
    if($menu_mobile_inicial_state =='escondido')
    {
            $str_menu_display="hide";
            $str_btn_display="show";
    }
    else
    {
        $str_menu_display="show";
        $str_btn_display="hide";
    }
    if($menu_mobile_hide_icon != 'S')
    {
        $str_btn_display="show";
    }
?>
<script>
    $( document ).ready(function() {
        $('#bmenu').<?php echo $str_btn_display; ?>();
        $('#idMenuCell').<?php echo $str_menu_display; ?>();
        <?php
        if($menutree_mobile_float != 'S')
        {
        ?>
            $('#id_toolbar').<?php echo $str_menu_display; ?>();
        <?php
        }
        ?>
        if($('.scMenuHHeader').length)
        {
                  $(".scMenuHHeader").css("padding-left", $('#bmenu').outerWidth());
        }
        else if($('.scMenuToolbar').length)
        {
                  $(".scMenuToolbar").css("padding-left", $('#bmenu').outerWidth());
        }
        <?php
                if($menutree_mobile_float == 'S')
                {
                ?>
                    str_html_menu = $('#idMenuCell').html();
                    $('#idMenuCell').remove()
                    $( 'body' ).prepend( "<div id='idMenuCell' style='position:absolute; top:0px; left:0px;display:<?php echo (($menu_mobile_inicial_state =='escondido')?'none':''); ?>'>"+ str_html_menu +"</div>" );
              <?php
              if($menu_mobile_hide_icon != 'S')
              {
                  if($menu_mobile_hide_icon_menu_position == 'right')
                  {
                          ?>
                          $('#idMenuCell').css('left', $('#bmenu').outerWidth());
                          <?php
                      }
                  else
                  {
                          ?>
                          $('#idMenuCell').css('top', $('#bmenu').outerHeight());
                          <?php
                      }
              }
                }
        ?>
    });
    function showMenu()
    {
      <?php
      if($menu_mobile_hide_icon == 'S')
      {
      ?>
                $('#bmenu').hide();
      <?php
      }
      ?>
            $('#idMenuCell').fadeToggle();
      <?php
      if($menutree_mobile_float != 'S')
      {
      ?>
                $('#id_toolbar').fadeToggle();
  setTimeout(function(){ scToggleOverflow(); }, 600);
      <?php
      }
      ?>
    }
    function HideMenu()
    {
      <?php
      if($menu_mobile_hide_icon == 'S')
      {
      ?>
                $('#bmenu').show();
      <?php
      }
      ?>
            $('#idMenuCell').fadeToggle();
      <?php
      if($menutree_mobile_float != 'S')
      {
      ?>
                $('#id_toolbar').fadeToggle();
  setTimeout(function(){ scToggleOverflow(); }, 600);
      <?php
      }
      ?>
    }
</script>
<?php
echo $str_bmenu;
}
?>
<script>
                        $( document ).ready(function() {
                                        $.contextMenu({
                                                        selector:'#contrl_abas > li',
                                                        leftButton: true,
                                                        callback: function(key, options)
                                                        {
                                                                                                        switch(key)
                                                                                                        {
                                                                                                                        case 'close':
                                                                                                                                        contextMenuCloseTab($(this).attr('id'));
                                                                                                                        break;

                                                                                                                        case 'closeall':
                                                                                                                                        contextMenuCloseAllTabs();
                                                                                                                        break;

                                                                                                                        case 'closeothers':
                                                                                                                                        contextMenuCloseOthersTabs($(this).attr('id'));
                                                                                                                        break;

                                                                                                                        case 'closeright':
                                                                                                                                        contextMenuCloseRight($(this).attr('id'));
                                                                                                                        break;

                                                                                                                        case 'closeleft':
                                                                                                                                        contextMenuCloseLeft($(this).attr('id'));
                                                                                                                        break;
                                                                                                        }
                                                                                        },
                                                        items: {
                                                                                                        "close": {name: '<?php echo $this->Nm_lang['lang_othr_contextmenu_close']; ?>'},
                                                                                                        "closeall": {name: '<?php echo $this->Nm_lang['lang_othr_contextmenu_closeall']; ?>'},
                                                                                                        "closeothers" : {name: '<?php echo $this->Nm_lang['lang_othr_contextmenu_closeothers']; ?>'},
                                                                                                        "closeright" : {name: '<?php echo $this->Nm_lang['lang_othr_contextmenu_closeright']; ?>'},
                                                                                                        "closeleft" : {name: '<?php echo $this->Nm_lang['lang_othr_contextmenu_closeleft']; ?>'},
                                                                                        }
                                        });
                        });

                        function contextMenuCloseAllTabs()
                        {
                                        $( "#contrl_abas li" ).each(function( index ) {
                                                        contextMenuCloseTab($( this ).attr('id'));
                                        });
                        }

                        function contextMenuCloseTab(str_id)
                        {
                                        if(str_id.indexOf('aba_td_') >= 0)
                                        {
                                                        str_id = str_id.substr(7);
                                        }
                                        del_aba_td( str_id );
                        }

                        function contextMenuCloseRight(str_id)
                        {
                                        bol_start_del = false;
                                        $( "#contrl_abas li" ).each(function( index ) {

                                                        if(bol_start_del)
                                                        {
                                                                        contextMenuCloseTab($( this ).attr('id'));
                                                        }

                                                        if(str_id == $( this ).attr('id'))
                                                        {
                                                                        bol_start_del = true;
                                                        }
                                        });
                        }


                        function contextMenuCloseLeft(str_id)
                        {
                                        $( "#contrl_abas li" ).each(function( index ) {

                                                        if(str_id == $( this ).attr('id'))
                                                        {
                                                                         return false;
                                                        }
                                                        else
                                                        {
                                                                        contextMenuCloseTab($( this ).attr('id'));
                                                        }
                                        });
                        }

                        function contextMenuCloseOthersTabs(str_id)
                        {
                                        $( "#contrl_abas li" ).each(function( index ) {
                                                        if(str_id != $( this ).attr('id'))
                                                        {
                                                                        contextMenuCloseTab($( this ).attr('id'));
                                                        }
                                        });
                        }
Iframe_atual = "menu_principal_iframe";
function writeFastMenu(arr_link)
{
  return false;
}
function clearFastMenu(arr_link)
{
  return false;
}
Tab_iframes        = new Array();
Tab_labels         = new Array();
Tab_hints          = new Array();
Tab_icons          = new Array();
Tab_icons_inactive = new Array();
Tab_abas           = new Array();
Tab_refresh        = new Array();
var scScrollInterval = divOverflow = false;
Tab_ico_def        = new Array();
Tab_ico_ina_def    = new Array();
<?php
 foreach ($arr_menuicons as $tp => $icon)
 {
    echo "Tab_ico_def['$tp']     = '" . $icon['active'] . "';\r\n";
    echo "Tab_ico_ina_def['$tp'] = '" . $icon['inactive'] . "';\r\n";
 }
?>
Aba_atual    = "";
<?php
 $seq = 0;
echo "Tab_iframes[" . $seq . "] = \"menu_principal\";\r\n";
echo "Tab_labels['menu_principal'] = \"\";\r\n";
echo "Tab_hints['menu_principal'] = \"\";\r\n";
echo "Tab_icons['menu_principal'] = \"scriptcase__NM__ico__NM__sc_menu_home_e.png\";\r\n";
echo "Tab_icons_inactive['menu_principal'] = \"scriptcase__NM__ico__NM__sc_menu_home_d.png\";\r\n";
echo "Tab_abas['menu_principal']   = \"none\";\r\n";
echo "Tab_refresh['menu_principal']   = \"\";\r\n";
         $seq++;
 foreach ($menu_principal_menuData['data'] as $ind => $dados_menu)
 {
     if ($dados_menu['link'] != "#")
     {
         if(empty($dados_menu['hint']))
         {
             $dados_menu['hint'] = $dados_menu['label'];
         }
         echo "Tab_iframes[" . $seq . "] = \"" . $dados_menu['id'] . "\";\r\n";
         echo "Tab_labels['" . $dados_menu['id'] . "'] = \"" . str_replace('"', '\"', $dados_menu['label']) . "\";\r\n";
         echo "Tab_hints['" . $dados_menu['id'] . "'] = \"" . str_replace('"', '\"', $dados_menu['hint']) . "\";\r\n";
         echo "Tab_icons['" . $dados_menu['id'] . "'] = \"" . $dados_menu['icon_aba'] . "\";\r\n";
         echo "Tab_icons_inactive['" . $dados_menu['id'] . "'] = \"" . $dados_menu['icon_aba_inactive'] . "\";\r\n";
         echo "Tab_abas['" . $dados_menu['id'] . "']   = \"none\";\r\n";
         echo "Tab_refresh['" . $dados_menu['id'] . "']   = \"\";\r\n";
         $seq++;
     }
 }
?>
Qtd_apls = <?php echo $seq ?>;
function createIframe(str_id, str_label, str_hint, str_img_on, str_img_off, str_link, tp_apl)
{
    apl_exist = false;
    Tab_icons[str_id] = str_img_on;
    Tab_icons_inactive[str_id] = str_img_off;
    Tab_refresh[str_id] = "";
    if (tp_apl == null || tp_apl == '')
    {
        tp_apl = 'others';
    }
    if (Tab_icons[str_id] == '')
    {
        Tab_icons[str_id] = Tab_ico_def[tp_apl];
    }
    if (Tab_icons_inactive[str_id] == '')
    {
        Tab_icons_inactive[str_id] = Tab_ico_ina_def[tp_apl];
    }
    for (i = 0; i < Qtd_apls; i++)
    {
        if (Tab_iframes[i] == str_id) {
            apl_exist = true;
        }
    }
    if (apl_exist)
    {
        if (Tab_abas[str_id] != 'show') {
            createAba(str_id);
        }
        var iframe = document.getElementById('iframe_' + str_id);
        iframe.src = str_link;
        mudaIframe(str_id);
        return;
    }
    var iframe = document.createElement('iframe');
    iframe.style.display = 'none';
    iframe.id = 'iframe_' + str_id;
    iframe.name = 'menu_principal_' + str_id + '_iframe';
    iframe.src = str_link;
    $('#Iframe_control').append(iframe);
    $('#iframe_' + str_id).addClass( 'scMenuIframe');
    Tab_iframes[Qtd_apls] = str_id;
    Tab_labels[str_id] = str_label;
    Tab_hints[str_id] = str_hint;
    Tab_abas[str_id]   = 'none';
    Qtd_apls++;
    createAba(str_id);
    mudaIframe(str_id);
}
function createAba(str_id)
{
    var tmp = "";
    var html_icon = "";
        html_icon += "<img id='aba_td_" + str_id + "_icon_active' src='<?php echo $this->path_botoes; ?>/"+ (Tab_icons[str_id] != '' ? Tab_icons[str_id] : 'scriptcase__NM__ico__NM__sc_menu_others_e.png') +"' align='absmiddle' class='scTabIcon'>";
        html_icon += "<img id='aba_td_" + str_id + "_icon_inactive' src='<?php echo $this->path_botoes; ?>/"+ (Tab_icons_inactive[str_id] != '' ? Tab_icons_inactive[str_id] : 'scriptcase__NM__ico__NM__sc_menu_others_d.png') +"' align='absmiddle' class='scTabIcon' style='display:none;'>";
    tmp  = "<li id='aba_td_" + str_id + "' style='cursor:pointer' class='lslide scTabActive' title=\"" + Tab_hints[str_id] + "\">";
    tmp += "<div style='display:inline-block;' onclick=\"mudaIframe('" + str_id + "');\">";
    tmp += html_icon;
    tmp += "</div>";
    var home_style="";
    if(str_id === 'menu_principal'){ home_style=";padding-left:4px;min-height:14px;"; }
    tmp += "<div id='aba_td_txt_" + str_id + "' style='display:inline-block;cursor:pointer"+home_style+"' class='scTabText' onclick=\"mudaIframe('" + str_id + "');\">";
    tmp += Tab_labels[str_id];
    tmp += "</div>";
    tmp += "<div id='aba_td_3_" + str_id + "' style='display:none;'>...</div>";
    tmp += "<div style='display:inline-block;'>";
    tmp += "    <img id='aba_td_img_" + str_id + "' src='<?php echo $this->path_botoes . "/" . $this->css_menutab_active_close_icon; ?>' onclick=\"del_aba_td('" + str_id + "');\" align='absmiddle' class='scTabCloseIcon' style='cursor:pointer; z-index:9999;'>";
    tmp += "</div>";
    tmp += "</li>";
    $('#contrl_abas').append(tmp);
    Tab_abas[str_id] = 'show';
}
function mudaIframe(str_id)
{
    $('#iframe_menu_principal').css('display','none');
    if (str_id == "")
    {
        $('#iframe_' + Aba_atual).prop('src', '');
        $('#links_abas').css('display','none');
    }
    else
    {
        $('#aba_td_' + Aba_atual).removeClass( 'scTabActive' );
        $('#aba_td_' + Aba_atual).addClass( 'scTabInactive' );
        $('#aba_td_' + Aba_atual+'_icon_active').hide();
        $('#aba_td_' + Aba_atual+'_icon_inactive').show();
        $('#aba_td_img_' + Aba_atual).prop( 'src', '<?php echo $this->path_botoes . "/" . $this->css_menutab_inactive_close_icon; ?>' );
    }
    for (i = 0; i < Tab_iframes.length; i++) 
    {
        if (Tab_iframes[i] == str_id) 
        {
            $('#iframe_' + Tab_iframes[i]).css('display','');
            Aba_atual    = str_id;
            $('#aba_td_' + Aba_atual).removeClass( 'scTabInactive' );
            $('#aba_td_' + Aba_atual).addClass( 'scTabActive' );
            $('#aba_td_' + Aba_atual+'_icon_active').show();
            $('#aba_td_' + Aba_atual+'_icon_inactive').hide();
            $('#aba_td_img_' + Aba_atual).prop( 'src', '<?php echo $this->path_botoes . "/" . $this->css_menutab_active_close_icon; ?>' );
            Iframe_atual = "menu_principal_" + Tab_iframes[i] + '_iframe';
        } else {
            $('#iframe_' + Tab_iframes[i]).css('display','none');
        }
    }
    if (Tab_refresh[str_id] == 'S' && typeof document.getElementById('iframe_' + str_id).contentWindow.nm_move === 'function')
    {
        Tab_refresh[str_id] = '';
        document.getElementById('iframe_' + str_id).contentWindow.nm_move('igual');
    }
}
function del_aba_td(str_id)
{
    $('#aba_td_' + str_id).remove();
    Tab_abas[str_id] = 'none';
    $('#iframe_' + str_id).prop('src', '');
    if (Aba_atual == str_id)
    {
        str_id = "";
        for (i = 0; i < Tab_iframes.length; i++) 
        {
            if (Tab_abas[Tab_iframes[i]] == 'show' && Tab_refresh[Tab_iframes[i]] == 'S')
            {
                str_id = Tab_iframes[i];
            }
        }
        if (str_id == "")
        {
            for (i = 0; i < Tab_iframes.length; i++) 
            {
                if (Tab_abas[Tab_iframes[i]] == 'show')
                {
                    str_id = Tab_iframes[i];
                }
            }
        }
        if (str_id == "")
        {
            str_id = "menu_principal";
        }
        mudaIframe(str_id);
    }
  scToggleOverflow();
}
$( document ).ready(function() { scToggleOverflow() });
function scToggleOverflow() {
  var width_offset = 0;
  if (is_menu_vertical === true) { width_offset = $('#idDivMenu').parent()[0].offsetWidth + 2; };
  $('.scTabLine').css('width', ($('#main_menu_table')[0].offsetWidth - width_offset) + 'px');
  var hasOverflow, scrollElement;
  scrollElement = $('#div_contrl_abas')[0];
  if (scrollElement.offsetHeight < scrollElement.scrollHeight || scrollElement.offsetWidth < scrollElement.scrollWidth) {
      hasOverflow = true;
  } else {
      hasOverflow = false;
  }
  if (divOverflow === hasOverflow){ return false; }
  if (hasOverflow === true) {
      $('.scTabScroll').show();
      $('#div_contrl_abas').toggleClass('div-overflow');
  } else {
      $('.scTabScroll').hide();
      $('#div_contrl_abas').toggleClass('div-overflow');
  }
  divOverflow = hasOverflow;
}
function scTabScroll(axis) {
  if (axis == 'stop') {
      clearInterval(scScrollInterval);
      return;
  }
  if (axis == 'left') {
      scScrollInterval = setInterval("$('#div_contrl_abas').scrollLeft($('#div_contrl_abas').scrollLeft() - 3)", 2);
  } else {
      scScrollInterval = setInterval("$('#div_contrl_abas').scrollLeft($('#div_contrl_abas').scrollLeft() + 3)", 2);
  }
}
function openMenuItem(str_id)
{
    str_target_sv = "";
    if (str_id != "iframe_menu_principal")
    {
        str_target_sv = str_id + "_iframe";
        str_id        = str_id.replace("menu_principal_","");
    }
    str_link   = $('#' + str_id).attr('item-href');
    str_target = $('#' + str_id).attr('item-target');
    str_id = str_id.replace('iframe_menu_principal', 'menu_principal');
    if (str_target == "menu_principal_iframe" && str_link != '' && str_link != '#' && str_link != 'javascript:')
    {
        str_target = (str_target_sv != "") ? str_target_sv : str_target;
        mudaIframe(str_id);
        if (str_id != "menu_principal")
        {
            $('#links_abas').css('display','');
        }
        if (str_id != "menu_principal" && Tab_abas[str_id] != 'show')
        {
            createAba(str_id);
      scToggleOverflow();
        }
    }
    //test link type
    if (str_link != '' && str_link != '#' && str_link != 'javascript:')
    {
        if (str_link.substring(0, 11) == 'javascript:')
        {
            eval(str_link.substring(11));
        }
        else if (str_link != '#' && str_target != '_parent')
        {
            window.open(str_link, str_target);
        }
        else if (str_link != '#' && str_target == '_parent')
        {
            document.location = str_link;
        }
        <?php
        if ($menu_mobile_hide == 'S' && $menu_mobile_hide_onclick == 'S')
        {
        ?>
            HideMenu();
        <?php
        }
        ?>
    }
}
</script>
<table id="main_menu_table" <?php echo $strAlign; ?> style="border-collapse: collapse; border-width: 0px; height:100%; width: <?php echo $larg_table; ?>" cellpadding=0 cellspacing=0>
  <tr class="scMenuHTableCssAlt" id='idMenuLine'>
      <td <?php echo $strAlign; ?> valign="top" class="scMenuLine" style="width:100%; height:30;padding: 0px;" id='idMenuCell'>
       <table style="border-collapse: collapse; border-width: 0" cellpadding=0 cellspacing=0><tr><td style="padding: 0">
<div id="scScrollFix" style="height: 1px"></div>
<script type="text/javascript">
function fnScrollFix() {
 var txt = document.getElementById("scScrollFix").innerHTML;
 if ("&nbsp;" == txt) { txt = "&nbsp;&nbsp;"; } else { txt = "&nbsp;"; }
 document.getElementById("scScrollFix").innerHTML = txt;
 setTimeout("fnScrollFix()", 500);
}
setTimeout("fnScrollFix()", 500);
</script>
<div id="idDivMenu">
<?php
echo $this->menu_principal_escreveMenu($menu_principal_menuData['data']);
?>
</div>
       </td></tr></table>
<?php
/* Controle de Iframe */
if ($menu_principal_menuData['iframe'])
{
?>
    </td>
  </tr>
<?php echo $this->nm_show_toolbarmenu('', $saida_apl, $menu_principal_menuData, $path_imag_cab); ?><?php echo $this->nm_gera_degrade(1, $bg_line_degrade, $path_imag_cab); ?>  <tr>
        <td id="links_abas" style="display: none;">
          <div class='scTabLine'>
          <?php if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['display_mobile'] === false) { ?>
            <div class='scTabScroll left' style='float:left;display:none;' onmousedown='scTabScroll("left");' onmouseup='scTabScroll("stop");' onmouseout='scTabScroll("stop");'></div>
            <div class='scTabScroll right' style='float:right;display:none;'onmousedown='scTabScroll("right");' onmouseup='scTabScroll("stop");' onmouseout='scTabScroll("stop");'></div>
          <?php } ?>
            <div id='div_contrl_abas' style='overflow:hidden;white-space: nowrap;'>
              <ul id='contrl_abas' style='margin:0px; padding:0px;'></ul>
            </div>
          </div>
        </td>
        </tr><tr>
    <td id="Iframe_control" style="border-width: 1px; height: 100%; padding: 0px;vertical-align:top;text-align:center;">
<?php
$link_default = "";
if (isset($_SESSION['scriptcase']['sc_apl_seg']['bg_menu_sae']) && $_SESSION['scriptcase']['sc_apl_seg']['bg_menu_sae'] == "on") 
{ 
    $SCR  = "";
    $link_default = " onclick=\"openMenuItem('iframe_menu_principal');\" item-href=\"menu_principal_form_php.php?sc_item_menu=menu_principal&sc_apl_menu=bg_menu_sae&sc_apl_link=" . urlencode($menu_principal_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menu_principal']['glo_nm_usa_grupo'] . "\"  item-target=\"menu_principal_iframe\"";
} 
else
{ 
    $SCR  = ($NM_scr_iframe != "" ? $NM_scr_iframe : "menu_principal_pag_ini.php");
} 
?>
      <iframe id="iframe_menu_principal" name="menu_principal_iframe" frameborder="0" class="scMenuIframe" style="width: 100%; height: 100%;"  src="<?php echo $SCR; ?>" <?php echo $link_default ?>></iframe>
<?php
 foreach ($menu_principal_menuData['data'] as $ind => $dados_menu)
 {
     if ($dados_menu['link'] != "#")
     {
         echo "      <iframe id=\"iframe_" . $dados_menu['id'] . "\" name= \"menu_principal_" . $dados_menu['id'] . "_iframe\" frameborder=\"0\" class=\"scMenuIframe\" style=\"display: none;width: 100%; height: 100%;\" src=\"\"></iframe>
";
     }
 }
}
?></td>
  </tr>
</table>
</body>
</html>
<?php

if (isset($link_default) && !empty($link_default))
{
    echo "<script>";
    echo "   document.getElementById('iframe_menu_principal').click()";
    echo "</script>";
}

}

/* Controle de Target */
function menu_principal_escreveMenu($arr_menu)
{
    $last      = '';
    $itemClass = ' topfirst';
    $subSize   = 2;
    $subCount  = array();
    $tabSpace  = 1;
    $intMult   = 2;
    $aMenuItemList = array();
    foreach ($arr_menu as $ind => $resto)
    {
        $aMenuItemList[] = $resto;
    }
?>
<ul id="css3menu1" class="topmenu" style="">
<?php
    for ($i = 0; $i < sizeof($aMenuItemList); $i++) {
        if (0 == $aMenuItemList[$i]['level']) {
            $last = $aMenuItemList[$i]['id'];
        }
    }
    for ($i = 0; $i < sizeof($aMenuItemList); $i++) {
        if ($last == $aMenuItemList[$i]['id']) {
            $itemClass = ' toplast';
        }
        $htmlClass = '';
        if (0 == $aMenuItemList[$i]['level']) {
            $htmlClass = ' class="topmenu' . $itemClass;
            if ($aMenuItemList[$i + 1] && $aMenuItemList[$i]['level'] < $aMenuItemList[$i + 1]['level']) {
                $htmlClass .= ' toproot';
            }
            $htmlClass .= '"';
        }
?>
<?php echo str_repeat(' ', $tabSpace * $intMult); ?><li<?php echo $htmlClass; ?>>
<?php
        $tabSpace++;
        if ('' != $aMenuItemList[$i]['icon'] && file_exists($this->path_imag_apl . "/" . $aMenuItemList[$i]['icon'])) {
            $iconHtml = '<img src="../_lib/img/' . $aMenuItemList[$i]['icon'] . '" border="0" />';
        }
        else {
            $iconHtml = '';
        }
        $sDisabledClass = '';
        if ('Y' == $aMenuItemList[$i]['disabled']) {
            $aMenuItemList[$i]['link']   = '#';
            $aMenuItemList[$i]['target'] = '';
            $sDisabledClass               = 0 == $aMenuItemList[$i]['level'] ? ' class="scdisabledmain"' : ' class="scdisabledsub"';
        }
        if (empty($aMenuItemList[$i]['link'])) {
            $aMenuItemList[$i]['link']   = '#';
        }
        if ($aMenuItemList[$i + 1] && $aMenuItemList[$i]['level'] < $aMenuItemList[$i + 1]['level']) {
?>
<?php echo str_repeat(' ', $tabSpace * $intMult); ?><a href="#" onclick="openMenuItem('menu_principal_<?php echo $aMenuItemList[$i]['id']; ?>');" item-href="<?php echo $aMenuItemList[$i]['link']; ?>" id="<?php echo $aMenuItemList[$i]['id']; ?>" title="<?php echo $aMenuItemList[$i]['hint']; ?>" <?php echo $aMenuItemList[$i]['target']; ?> <?php echo $sDisabledClass; ?>><span><?php echo $iconHtml . $aMenuItemList[$i]['label']; ?></span></a>
<?php
            if (0 != $subSize && 0 < $aMenuItemList[$i + 1]['level']) {
?>
<?php echo str_repeat(' ', $tabSpace * $intMult); ?><!--div class="submenu" abre-->
<?php
                $tabSpace++;
?>
<?php echo str_repeat(' ', $tabSpace * $intMult); ?><!--div class="column" abre-->
<?php
                $tabSpace++;
            }
?>
<?php echo str_repeat(' ', $tabSpace * $intMult); ?><ul>
<?php
            $tabSpace++;
        }
        else {
?>
<?php echo str_repeat(' ', $tabSpace * $intMult); ?><a href="#" onclick="openMenuItem('menu_principal_<?php echo $aMenuItemList[$i]['id']; ?>');" item-href="<?php echo $aMenuItemList[$i]['link']; ?>" id="<?php echo $aMenuItemList[$i]['id']; ?>" title="<?php echo $aMenuItemList[$i]['hint']; ?>"<?php echo $aMenuItemList[$i]['target'] . $sDisabledClass; ?>><?php echo $iconHtml . $aMenuItemList[$i]['label']; ?></a>
<?php
        }
        if (($aMenuItemList[$i + 1] && $aMenuItemList[$i]['level'] == $aMenuItemList[$i + 1]['level']) || 
            ($aMenuItemList[$i + 1] && $aMenuItemList[$i]['level'] > $aMenuItemList[$i + 1]['level']) ||
            (!$aMenuItemList[$i + 1] && $aMenuItemList[$i]['level'] > 0) ||
            (!$aMenuItemList[$i + 1] && $aMenuItemList[$i]['level'] == 0)) {
            $tabSpace--;
?>
<?php echo str_repeat(' ', $tabSpace * $intMult); ?></li>
<?php
            if (0 != $subSize && 0 < $aMenuItemList[$i]['level']) {
                if (!isset($subCount[ $aMenuItemList[$i]['level'] ])) {
                    $subCount[ $aMenuItemList[$i]['level'] ] = 0;
                }
                $subCount[ $aMenuItemList[$i]['level'] ]++;
            }
            if ($aMenuItemList[$i + 1] && $aMenuItemList[$i]['level'] > $aMenuItemList[$i + 1]['level']) {
                for ($j = 0; $j < $aMenuItemList[$i]['level'] - $aMenuItemList[$i + 1]['level']; $j++) {
                    unset($subCount[ $aMenuItemList[$i]['level'] - $j]);
                    $tabSpace--;
?>
<?php echo str_repeat(' ', $tabSpace * $intMult); ?></ul>
<?php
                    if (0 != $subSize && 0 < $aMenuItemList[$i]['level']) {
                        $tabSpace--;
?>
<?php echo str_repeat(' ', $tabSpace * $intMult); ?><!--/div class="column" fecha-->
<?php
                        $tabSpace--;
?>
<?php echo str_repeat(' ', $tabSpace * $intMult); ?><!--/div class="submenu" fecha-->
<?php
                    }
                    $tabSpace--;
?>
<?php echo str_repeat(' ', $tabSpace * $intMult); ?></li>
<?php
                }
            }
            elseif (!$aMenuItemList[$i + 1] && $aMenuItemList[$i]['level'] > 0) {
                for ($j = 0; $j < $aMenuItemList[$i]['level']; $j++) {
                    unset($subCount[ $aMenuItemList[$i]['level'] - $j]);
                    $tabSpace--;
?>
<?php echo str_repeat(' ', $tabSpace * $intMult); ?></ul>
<?php
                    if (0 != $subSize && 0 < $aMenuItemList[$i]['level']) {
                        $tabSpace--;
?>
<?php echo str_repeat(' ', $tabSpace * $intMult); ?><!--/div class="column" fecha-->
<?php
                        $tabSpace--;
?>
<?php echo str_repeat(' ', $tabSpace * $intMult); ?><!--/div class="submenu" fecha-->
<?php
                    }
                    $tabSpace--;
?>
<?php echo str_repeat(' ', $tabSpace * $intMult); ?></li>
<?php
                }
            }
            if ($subSize == $subCount[ $aMenuItemList[$i]['level'] ]) {
                $subCount[ $aMenuItemList[$i]['level'] ] = 0;
?>
<?php echo str_repeat(' ', $tabSpace * $intMult); ?><!--quebra-->
<?php
            }
        }
        $itemClass = '';
    }
?>
</ul>
<?php
}
function menu_principal_target($str_target)
{
    global $menu_principal_menuData;
    if ('_blank' == $str_target)
    {
        return '_blank';
    }
    elseif ('_parent' == $str_target)
    {
        return '_parent';
    }
    elseif ($menu_principal_menuData['iframe'])
    {
        return 'menu_principal_iframe';
    }
    else
    {
        return $str_target;
    }
}

function nm_show_toolbarmenu($col_span, $saida_apl, $menu_principal_menuData, $path_imag_cab)
{
}

   function nm_prot_aspas($str_item)
   {
       return str_replace('"', '\"', $str_item);
   }

   function nm_gera_menus(&$str_line_ret, $arr_menu_usu, $int_level, $nome_aplicacao)
   {
       global $menu_principal_menuData; 
       foreach ($arr_menu_usu as $arr_item)
       {
           $str_line   = array();
           $str_line['label']    = $this->nm_prot_aspas($arr_item['label']);
           $str_line['level']    = $int_level - 1;
           $str_line['link']     = "";
           $nome_apl = $arr_item['link'];
           $pos = strrpos($nome_apl, "/");
           if ($pos !== false)
           {
               $nome_apl = substr($nome_apl, $pos + 1);
           }
           if ('' != $arr_item['link'])
           {
               if ($arr_item['target'] == '_parent')
               {
                    $str_line['link'] = "menu_principal_form_php.php?sc_item_menu=" . $arr_item['id'] . "&sc_apl_menu=" . $nome_apl . "&sc_apl_link=" . urlencode($menu_principal_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menu_principal']['glo_nm_usa_grupo'] . ""; 
               }
               else
               {
                    $str_line['link'] = "menu_principal_form_php.php?sc_item_menu=" . $arr_item['id'] . "&sc_apl_menu=" . $nome_apl . "&sc_apl_link=" . urlencode($menu_principal_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menu_principal']['glo_nm_usa_grupo'] . ""; 
               }
           }
           elseif ($arr_item['target'] == '_parent')
           {
           }
           $str_line['hint']     = ('' != $arr_item['hint']) ? $this->nm_prot_aspas($arr_item['hint']) : '';
           $str_line['id']       = $arr_item['id'];
           $str_line['icon']     = ('' != $arr_item['icon_on']) ? $arr_item['icon_on'] : '';
           $str_line['icon_aba'] = (isset($arr_item['icon_aba']) && '' != $arr_item['icon_aba']) ? $arr_item['icon_aba'] : '';
           $str_line['icon_aba_inactive'] = (isset($arr_item['icon_aba_inactive']) && '' != $arr_item['icon_aba_inactive']) ? $arr_item['icon_aba_inactive'] : '';
           if ('' == $arr_item['link'] && $arr_item['target'] == '_parent')
           {
               $str_line['target'] = '_parent';
           }
           else
           {
                $str_line['target'] = ('' != $arr_item['target'] && '' != $arr_item['link']) ?  $this->menu_principal_target( $arr_item['target']) : "_self"; 
           }
           $str_line['target']   = ' item-target="' . $str_line['target']  . '" ';
           $str_line['sc_id']    = $arr_item['id'];
           $str_line['disabled'] = "N";
           $str_line_ret[] = $str_line;
           if (!empty($arr_item['menu_itens']))
           {
               $this->nm_gera_menus($str_line_ret, $arr_item['menu_itens'], $int_level + 1, $nome_aplicacao);
           }
       }
   }

   function nm_arr_menu_recursiv($arr, $id_pai = '')
   {
         $arr_return = array();
         foreach ($arr as $id_menu => $arr_menu)
         {
             if ($id_pai == $arr_menu['pai']) 
             {
                 $arr_return[] = array('label'      => $arr_menu['label'],
                                        'link'       => $arr_menu['link'],
                                        'target'     => $arr_menu['target'],
                                        'icon_on'    => $arr_menu['icon'],
                                        'icon_aba'   => $arr_menu['icon_aba'],
                                        'icon_aba_inactive'   => $arr_menu['icon_aba_inactive'],
                                        'hint'       => $arr_menu['hint'],
                                        'id'         => $id_menu,
                                        'menu_itens' => $this->nm_arr_menu_recursiv($arr, $id_menu));
             }
         }
         return $arr_return;
   }
   //1 horizontal
   //2 vertical
   function nm_gera_degrade($menu_opc, $bg_line_degrade, $path_imag_cab)
   {
       $str_retorno = "";
       //have bg color degrade
       if(!empty($bg_line_degrade) && count($bg_line_degrade)>0)
       {
           if($menu_opc == 1)
           {
               foreach($bg_line_degrade as $bg_color)
               {
                   if(!empty($bg_color))
                   {
                       $str_retorno .= "<tr style=\"height:1px; padding: 0px;\">\r\n";
                       $str_retorno .= "  <td style=\"height:1px; padding: 0px;\" bgcolor=\"". $bg_color ."\"><img src='". $path_imag_cab ."/transparent.png' border=\"0\" style=\"height:1px;\"></td>\r\n";
                       $str_retorno .= "</tr>\r\n";
                   }
               }
           }
           elseif($menu_opc == 2)
           {
               foreach($bg_line_degrade as $bg_color)
               {
                   if(!empty($bg_color))
                   {
                       $str_retorno .= "<td style=\"width:1px; padding: 0px;\" bgcolor=\"". $bg_color ."\">\r\n";
                       $str_retorno .= "<img src='" . $path_imag_cab . "/transparent.png' border=\"0\" style=\"width:1px;\">\r\n";
                       $str_retorno .= "</td>\r\n";
                   }
               }
           }
       }
       return $str_retorno;
   }
   function Gera_sc_init($apl_menu)
   {
        if (!isset($_SESSION['scriptcase']['menu_principal']['sc_init'][$apl_menu]))
        {
            $_SESSION['scriptcase']['menu_principal']['sc_init'][$apl_menu] = rand(2, 10000);
        }
        $_SESSION['sc_session'][$_SESSION['scriptcase']['menu_principal']['sc_init'][$apl_menu]] = array();
        return  $_SESSION['scriptcase']['menu_principal']['sc_init'][$apl_menu];
   }
function background()
{
$_SESSION['scriptcase']['menu_principal']['contr_erro'] = 'on';
   
print("
<style>

	#bg{
		position: absolute; 		
		top: 0%; 
		left: 0%; 
		width: 100%; 
		height: 100%;
	}
	
	#bg img{
		position: absolute; 
		top: 0; 
		left: 0; 
		right: 0; 
		bottom: 0; 
		margin: auto; 
		min-width: 50%;
		min-height: 50%;
	}
	

		
</style>

"); 


$_SESSION['scriptcase']['menu_principal']['contr_erro'] = 'off';
}
   function nmgp_redireciona_form($nm_apl_dest, $nm_apl_retorno, $nm_apl_parms, $nm_target="", $alt_modal=0, $larg_modal=0)
   {
      global  $menu_principal_menuData;
      if (is_array($nm_apl_parms))
      {
          $tmp_parms = "";
          foreach ($nm_apl_parms as $par => $val)
          {
              $par = trim($par);
              $val = trim($val);
              $tmp_parms .= str_replace(".", "_", $par) . "?#?";
              if (substr($val, 0, 1) == "$")
              {
                  $tmp_parms .= $$val;
              }
              elseif (substr($val, 0, 1) == "{")
              {
                  $val        = substr($val, 1, -1);
                  $tmp_parms .= $this->$val;
              }
              elseif (substr($val, 0, 1) == "[")
              {
                  $tmp_parms .= $_SESSION['sc_session'][1]['menu_principal'][substr($val, 1, -1)];
              }
              else
              {
                  $tmp_parms .= $val;
              }
              $tmp_parms .= "?@?";
          }
          $nm_apl_parms = $tmp_parms;
      }
      $nm_apl_retorno = $_SERVER['PHP_SELF'];
      $nm_apl_retorno = str_replace("\\", '/', $nm_apl_retorno);
      $nm_apl_retorno = str_replace('//', '/', $nm_apl_retorno);
      $nm_target_form = (empty($nm_target)) ? "_self" : $nm_target;
      if (strtolower(substr($nm_apl_dest, 0, 7)) == "http://" || strtolower(substr($nm_apl_dest, 0, 8)) == "https://" || strtolower(substr($nm_apl_dest, 0, 3)) == "../" || strtolower(substr($nm_apl_dest, 0, 1)) == "/")
      {
          echo "<SCRIPT type=\"text/javascript\">";
          if (strtolower($nm_target) == "_blank")
          {
              echo "window.open ('" . $nm_apl_dest . "');";
          }
          else
          {
              echo "window.location='" . $nm_apl_dest . "';";
          }
          echo "</SCRIPT>";
          exit;
      }
      $dir = explode("/", $nm_apl_dest);
      if (count($dir) == 1)
      {
          $nm_apl_dest = str_replace(".php", "", $nm_apl_dest);
          $nm_apl_dest = $menu_principal_menuData['url']['link'] . $this->tab_grupo[0] .$nm_apl_dest . "/" . $nm_apl_dest . ".php";
      }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

      <HTML>
      <HEAD>
       <META http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
       <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT"/>
       <META http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?> GMT"/>
       <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate"/>
       <META http-equiv="Cache-Control" content="post-check=0, pre-check=0"/>
       <META http-equiv="Pragma" content="no-cache"/>
      </HEAD>
      <BODY>
      <form name="Fredir" method="post" 
                            target="_self"> 
        <input type="hidden" name="nmgp_parms" value="<?php echo NM_encode_input($nm_apl_parms) ?>"/>
<?php
   if ($nm_target == "_blank")
   {
?>
         <input type="hidden" name="nmgp_outra_jan" value="true"/> 
<?php
   }
   else
   {
?>
        <input type="hidden" name="nmgp_url_saida" value="<?php echo NM_encode_input($nm_apl_retorno) ?>">
        <input type="hidden" name="script_case_init" value="1"/> 
        <input type=hidden name="script_case_session" value="<?php echo NM_encode_input(session_id()) ?>"> 
<?php
   }
?>
         <SCRIPT type="text/javascript">
          document.Fredir.target = "<?php echo $nm_target_form ?>"; 
          document.Fredir.action = "<?php echo $nm_apl_dest ?>";
          document.Fredir.submit();
      </SCRIPT>
      </BODY>
      </HTML>
<?php
     if ($nm_target != "_blank")
     {
         exit;
     }
   }
   function regionalDefault()
   {
       $_SESSION['scriptcase']['reg_conf']['date_format']   = (isset($this->Nm_conf_reg[$this->str_conf_reg]['data_format']))              ?  $this->Nm_conf_reg[$this->str_conf_reg]['data_format'] : "ddmmyyyy";
       $_SESSION['scriptcase']['reg_conf']['date_sep']      = (isset($this->Nm_conf_reg[$this->str_conf_reg]['data_sep']))                 ?  $this->Nm_conf_reg[$this->str_conf_reg]['data_sep'] : "/";
       $_SESSION['scriptcase']['reg_conf']['date_week_ini'] = (isset($this->Nm_conf_reg[$this->str_conf_reg]['prim_dia_sema']))            ?  $this->Nm_conf_reg[$this->str_conf_reg]['prim_dia_sema'] : "SU";
       $_SESSION['scriptcase']['reg_conf']['time_format']   = (isset($this->Nm_conf_reg[$this->str_conf_reg]['hora_format']))              ?  $this->Nm_conf_reg[$this->str_conf_reg]['hora_format'] : "hhiiss";
       $_SESSION['scriptcase']['reg_conf']['time_sep']      = (isset($this->Nm_conf_reg[$this->str_conf_reg]['hora_sep']))                 ?  $this->Nm_conf_reg[$this->str_conf_reg]['hora_sep'] : ":";
       $_SESSION['scriptcase']['reg_conf']['time_pos_ampm'] = (isset($this->Nm_conf_reg[$this->str_conf_reg]['hora_pos_ampm']))            ?  $this->Nm_conf_reg[$this->str_conf_reg]['hora_pos_ampm'] : "right_without_space";
       $_SESSION['scriptcase']['reg_conf']['time_simb_am']  = (isset($this->Nm_conf_reg[$this->str_conf_reg]['hora_simbolo_am']))          ?  $this->Nm_conf_reg[$this->str_conf_reg]['hora_simbolo_am'] : "am";
       $_SESSION['scriptcase']['reg_conf']['time_simb_pm']  = (isset($this->Nm_conf_reg[$this->str_conf_reg]['hora_simbolo_pm']))          ?  $this->Nm_conf_reg[$this->str_conf_reg]['hora_simbolo_pm'] : "pm";
       $_SESSION['scriptcase']['reg_conf']['simb_neg']      = (isset($this->Nm_conf_reg[$this->str_conf_reg]['num_sinal_neg']))            ?  $this->Nm_conf_reg[$this->str_conf_reg]['num_sinal_neg'] : "-";
       $_SESSION['scriptcase']['reg_conf']['grup_num']      = (isset($this->Nm_conf_reg[$this->str_conf_reg]['num_sep_agr']))              ?  $this->Nm_conf_reg[$this->str_conf_reg]['num_sep_agr'] : ".";
       $_SESSION['scriptcase']['reg_conf']['dec_num']       = (isset($this->Nm_conf_reg[$this->str_conf_reg]['num_sep_dec']))              ?  $this->Nm_conf_reg[$this->str_conf_reg]['num_sep_dec'] : ",";
       $_SESSION['scriptcase']['reg_conf']['neg_num']       = (isset($this->Nm_conf_reg[$this->str_conf_reg]['num_format_num_neg']))       ?  $this->Nm_conf_reg[$this->str_conf_reg]['num_format_num_neg'] : 2;
       $_SESSION['scriptcase']['reg_conf']['monet_simb']    = (isset($this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_simbolo']))        ?  $this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_simbolo'] : "R$";
       $_SESSION['scriptcase']['reg_conf']['monet_f_pos']   = (isset($this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_format_num_pos'])) ?  $this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_format_num_pos'] : 3;
       $_SESSION['scriptcase']['reg_conf']['monet_f_neg']   = (isset($this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_format_num_neg'])) ?  $this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_format_num_neg'] : 13;
       $_SESSION['scriptcase']['reg_conf']['grup_val']      = (isset($this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_sep_agr']))        ?  $this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_sep_agr'] : ".";
       $_SESSION['scriptcase']['reg_conf']['dec_val']       = (isset($this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_sep_dec']))        ?  $this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_sep_dec'] : ",";
       $_SESSION['scriptcase']['reg_conf']['html_dir']      = (isset($this->Nm_conf_reg[$this->str_conf_reg]['ger_ltr_rtl']))              ?  " DIR='" . $this->Nm_conf_reg[$this->str_conf_reg]['ger_ltr_rtl'] . "'" : "";
       $_SESSION['scriptcase']['reg_conf']['css_dir']       = (isset($this->Nm_conf_reg[$this->str_conf_reg]['ger_ltr_rtl']))              ?  $this->Nm_conf_reg[$this->str_conf_reg]['ger_ltr_rtl'] : "LTR";
       $_SESSION['scriptcase']['reg_conf']['html_dir_only'] = (isset($this->Nm_conf_reg[$this->str_conf_reg]['ger_ltr_rtl']))              ?  $this->Nm_conf_reg[$this->str_conf_reg]['ger_ltr_rtl'] : "";
       $_SESSION['scriptcase']['reg_conf']['num_group_digit']       = (isset($this->Nm_conf_reg[$this->str_conf_reg]['num_group_digit']))       ?  $this->Nm_conf_reg[$this->str_conf_reg]['num_group_digit'] : "1";
       $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'] = (isset($this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_group_digit'])) ?  $this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_group_digit'] : "1";
   }

}
if ((isset($_POST['nmgp_opcao']) && $_POST['nmgp_opcao'] == "force_lang") || (isset($_GET['nmgp_opcao']) && $_GET['nmgp_opcao'] == "force_lang"))
{
    if (isset($_POST['nmgp_opcao']) && $_POST['nmgp_opcao'] == "force_lang")
    {
        $nmgp_opcao  = $_POST['nmgp_opcao'];
        $nmgp_idioma = $_POST['nmgp_idioma'];
    }
    else
    {
        $nmgp_opcao  = $_GET['nmgp_opcao'];
        $nmgp_idioma = $_GET['nmgp_idioma'];
    }
    $Temp_lang = explode(";" , $nmgp_idioma);
    if (isset($Temp_lang[0]) && !empty($Temp_lang[0]))
    {
        $_SESSION['scriptcase']['str_lang'] = $Temp_lang[0];
    }
    if (isset($Temp_lang[1]) && !empty($Temp_lang[1]))
    {
        $_SESSION['scriptcase']['str_conf_reg'] = $Temp_lang[1];
    }
}
$contr_menu_principal = new menu_principal_class;
$contr_menu_principal->menu_principal_menu();

?>
