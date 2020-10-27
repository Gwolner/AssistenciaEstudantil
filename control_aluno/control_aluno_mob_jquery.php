
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
  scEventControl_data["forma_de_consulta" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["matricula" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["cpf" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
}

function scEventControl_active(iSeqRow) {
  if (scEventControl_data["forma_de_consulta" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["forma_de_consulta" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["matricula" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["matricula" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["cpf" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["cpf" + iSeqRow]["change"]) {
    return true;
  }
  return false;
} // scEventControl_active

function scEventControl_onFocus(oField, iSeq) {
  var fieldId, fieldName;
  fieldId = $(oField).attr("id");
  fieldName = fieldId.substr(12);
  scEventControl_data[fieldName]["blur"] = true;
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
  $('#id_sc_field_matricula' + iSeqRow).bind('blur', function() { sc_control_aluno_matricula_onblur(this, iSeqRow) })
                                       .bind('focus', function() { sc_control_aluno_matricula_onfocus(this, iSeqRow) });
  $('#id_sc_field_cpf' + iSeqRow).bind('blur', function() { sc_control_aluno_cpf_onblur(this, iSeqRow) })
                                 .bind('focus', function() { sc_control_aluno_cpf_onfocus(this, iSeqRow) });
  $('#id_sc_field_forma_de_consulta' + iSeqRow).bind('blur', function() { sc_control_aluno_forma_de_consulta_onblur(this, iSeqRow) })
                                               .bind('click', function() { sc_control_aluno_forma_de_consulta_onclick(this, iSeqRow) })
                                               .bind('focus', function() { sc_control_aluno_forma_de_consulta_onfocus(this, iSeqRow) });
} // scJQEventsAdd

function sc_control_aluno_matricula_onblur(oThis, iSeqRow) {
  do_ajax_control_aluno_mob_validate_matricula();
  scCssBlur(oThis);
}

function sc_control_aluno_matricula_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_control_aluno_cpf_onblur(oThis, iSeqRow) {
  do_ajax_control_aluno_mob_validate_cpf();
  scCssBlur(oThis);
}

function sc_control_aluno_cpf_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_control_aluno_forma_de_consulta_onblur(oThis, iSeqRow) {
  do_ajax_control_aluno_mob_validate_forma_de_consulta();
  scCssBlur(oThis);
}

function sc_control_aluno_forma_de_consulta_onclick(oThis, iSeqRow) {
  do_ajax_control_aluno_mob_event_forma_de_consulta_onclick();
}

function sc_control_aluno_forma_de_consulta_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function scJQUploadAdd(iSeqRow) {
} // scJQUploadAdd


function scJQElementsAdd(iLine) {
  scJQEventsAdd(iLine);
  scEventControl_init(iLine);
  scJQUploadAdd(iLine);
} // scJQElementsAdd

