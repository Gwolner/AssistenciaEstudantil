
function scJQGeneralAdd() {
  $('input:text.sc-js-input').listen();
  $('input:password.sc-js-input').listen();
  $('input:checkbox.sc-js-input').listen();
  $('input:radio.sc-js-input').listen();
  $('select.sc-js-input').listen();
  $('textarea.sc-js-input').listen();

} // scJQGeneralAdd

function scFocusField(sField) {
  var $oField = $('#id_sc_field_' + sField);

  if (0 == $oField.length) {
    $oField = $('input[name=' + sField + ']');
  }

  if (0 == $oField.length && document.F1.elements[sField]) {
    $oField = $(document.F1.elements[sField]);
  }

  if (false == scSetFocusOnField($oField) && $("#id_ac_" + sField).length > 0) {
    if (false == scSetFocusOnField($("#id_ac_" + sField))) {
      setTimeout(function () { scSetFocusOnField($("#id_ac_" + sField)); }, 500);
    }
  }
  else {
    setTimeout(function() { scSetFocusOnField($oField); }, 500);
  }
} // scFocusField

function scSetFocusOnField($oField) {
  if ($oField.length > 0 && $oField[0].offsetHeight > 0 && $oField[0].offsetWidth > 0 && !$oField[0].disabled) {
    $oField[0].focus();
    return true;
  }
  return false;
} // scSetFocusOnField

function scEventControl_init(iSeqRow) {
  scEventControl_data["id_fardamento" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["aviso" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["tamanho_pedido" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["id_tamanho" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["quantidade" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["data_entregue" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["id_situacao" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
}

function scEventControl_active(iSeqRow) {
  if (scEventControl_data["id_fardamento" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["id_fardamento" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["aviso" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["aviso" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tamanho_pedido" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tamanho_pedido" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["id_tamanho" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["id_tamanho" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["quantidade" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["quantidade" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["data_entregue" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["data_entregue" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["id_situacao" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["id_situacao" + iSeqRow]["change"]) {
    return true;
  }
  return false;
} // scEventControl_active

function scEventControl_onFocus(oField, iSeq) {
  var fieldId, fieldName;
  fieldId = $(oField).attr("id");
  fieldName = fieldId.substr(12);
  scEventControl_data[fieldName]["blur"] = true;
  if ("tamanho_pedido" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("id_tamanho" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("id_situacao" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("id_aluno" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  scEventControl_data[fieldName]["change"] = false;
} // scEventControl_onFocus

function scEventControl_onBlur(sFieldName) {
  scEventControl_data[sFieldName]["blur"] = false;
  if (scEventControl_data[sFieldName]["change"]) {
        if (scEventControl_data[sFieldName]["original"] == $("#id_sc_field_" + sFieldName).val()) {
          scEventControl_data[sFieldName]["change"] = false;
        }
  }
} // scEventControl_onBlur

function scEventControl_onChange(sFieldName) {
  scEventControl_data[sFieldName]["change"] = false;
} // scEventControl_onChange

function scEventControl_onChange_call(sFieldName, iFieldSeq) {
  var oField, fieldId, fieldName;
  oField = $("#id_sc_field_" + sFieldName + iFieldSeq);
  fieldId = oField.attr("id");
  fieldName = fieldId.substr(12);
} // scEventControl_onChange

function scEventControl_onAutocomp(sFieldName) {
  scEventControl_data[sFieldName]["autocomp"] = false;
} // scEventControl_onChange

var scEventControl_data = {};

function scJQEventsAdd(iSeqRow) {
  $('#id_sc_field_id_fardamento' + iSeqRow).bind('blur', function() { sc_form_fardamento_educacao_fisica_id_fardamento_onblur(this, iSeqRow) })
                                           .bind('focus', function() { sc_form_fardamento_educacao_fisica_id_fardamento_onfocus(this, iSeqRow) });
  $('#id_sc_field_tamanho_pedido' + iSeqRow).bind('blur', function() { sc_form_fardamento_educacao_fisica_tamanho_pedido_onblur(this, iSeqRow) })
                                            .bind('focus', function() { sc_form_fardamento_educacao_fisica_tamanho_pedido_onfocus(this, iSeqRow) });
  $('#id_sc_field_quantidade' + iSeqRow).bind('blur', function() { sc_form_fardamento_educacao_fisica_quantidade_onblur(this, iSeqRow) })
                                        .bind('focus', function() { sc_form_fardamento_educacao_fisica_quantidade_onfocus(this, iSeqRow) });
  $('#id_sc_field_data_entregue' + iSeqRow).bind('blur', function() { sc_form_fardamento_educacao_fisica_data_entregue_onblur(this, iSeqRow) })
                                           .bind('focus', function() { sc_form_fardamento_educacao_fisica_data_entregue_onfocus(this, iSeqRow) });
  $('#id_sc_field_id_tamanho' + iSeqRow).bind('blur', function() { sc_form_fardamento_educacao_fisica_id_tamanho_onblur(this, iSeqRow) })
                                        .bind('focus', function() { sc_form_fardamento_educacao_fisica_id_tamanho_onfocus(this, iSeqRow) });
  $('#id_sc_field_id_situacao' + iSeqRow).bind('blur', function() { sc_form_fardamento_educacao_fisica_id_situacao_onblur(this, iSeqRow) })
                                         .bind('focus', function() { sc_form_fardamento_educacao_fisica_id_situacao_onfocus(this, iSeqRow) });
  $('#id_sc_field_aviso' + iSeqRow).bind('blur', function() { sc_form_fardamento_educacao_fisica_aviso_onblur(this, iSeqRow) })
                                   .bind('focus', function() { sc_form_fardamento_educacao_fisica_aviso_onfocus(this, iSeqRow) });
} // scJQEventsAdd

function sc_form_fardamento_educacao_fisica_id_fardamento_onblur(oThis, iSeqRow) {
  do_ajax_form_fardamento_educacao_fisica_validate_id_fardamento();
  scCssBlur(oThis);
}

function sc_form_fardamento_educacao_fisica_id_fardamento_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_fardamento_educacao_fisica_tamanho_pedido_onblur(oThis, iSeqRow) {
  do_ajax_form_fardamento_educacao_fisica_validate_tamanho_pedido();
  scCssBlur(oThis);
}

function sc_form_fardamento_educacao_fisica_tamanho_pedido_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_fardamento_educacao_fisica_quantidade_onblur(oThis, iSeqRow) {
  do_ajax_form_fardamento_educacao_fisica_validate_quantidade();
  scCssBlur(oThis);
}

function sc_form_fardamento_educacao_fisica_quantidade_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_fardamento_educacao_fisica_data_entregue_onblur(oThis, iSeqRow) {
  do_ajax_form_fardamento_educacao_fisica_validate_data_entregue();
  scCssBlur(oThis);
}

function sc_form_fardamento_educacao_fisica_data_entregue_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_fardamento_educacao_fisica_id_tamanho_onblur(oThis, iSeqRow) {
  do_ajax_form_fardamento_educacao_fisica_validate_id_tamanho();
  scCssBlur(oThis);
}

function sc_form_fardamento_educacao_fisica_id_tamanho_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_fardamento_educacao_fisica_id_situacao_onblur(oThis, iSeqRow) {
  do_ajax_form_fardamento_educacao_fisica_validate_id_situacao();
  scCssBlur(oThis);
}

function sc_form_fardamento_educacao_fisica_id_situacao_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_fardamento_educacao_fisica_aviso_onblur(oThis, iSeqRow) {
  do_ajax_form_fardamento_educacao_fisica_validate_aviso();
  scCssBlur(oThis);
}

function sc_form_fardamento_educacao_fisica_aviso_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

var sc_jq_calendar_value = {};

function scJQCalendarAdd(iSeqRow) {
  $("#id_sc_field_data_entregue" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_data_entregue" + iSeqRow] = $oField.val();
    },
    onClose: function(dateText, inst) {
    },
    showWeek: true,
    numberOfMonths: 1,
    changeMonth: true,
    changeYear: true,
    yearRange: 'c-5:c+5',
    dayNames: ["<?php        echo html_entity_decode($this->Ini->Nm_lang['lang_days_sund'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_mond'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_tued'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_wend'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_thud'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_frid'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_satd'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>"],
    dayNamesMin: ["<?php     echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_sund'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_mond'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_tued'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_wend'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_thud'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_frid'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_satd'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>"],
    monthNamesShort: ["<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_janu'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_febr'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_marc'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_apri'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_mayy'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_june'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_july'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_augu'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_sept'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_octo'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_nove'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_dece'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>"],
    weekHeader: "<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_days_sem'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>",
    firstDay: <?php echo $this->jqueryCalendarWeekInit("" . $_SESSION['scriptcase']['reg_conf']['date_week_ini'] . ""); ?>,
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', $_SESSION['scriptcase']['reg_conf']['date_sep']), array('', 'yyyy', ''), $this->field_config['data_entregue']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
    showOtherMonths: true,
    showOn: "button",
    buttonImage: "<?php echo $this->jqueryIconFile('calendar'); ?>",
    buttonImageOnly: true
  });

} // scJQCalendarAdd

function scJQUploadAdd(iSeqRow) {
} // scJQUploadAdd


function scJQElementsAdd(iLine) {
  scJQEventsAdd(iLine);
  scEventControl_init(iLine);
  scJQCalendarAdd(iLine);
  scJQUploadAdd(iLine);
} // scJQElementsAdd

