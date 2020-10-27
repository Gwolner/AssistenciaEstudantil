
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
  scEventControl_data["id_aluno" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["nome_aluno" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["curso" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["turno" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["matricula" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["cpf" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["celular" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["email" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["livros" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["data_entrega" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["data_devolucao" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["emprestimos" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
}

function scEventControl_active(iSeqRow) {
  if (scEventControl_data["id_aluno" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["id_aluno" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["nome_aluno" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["nome_aluno" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["curso" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["curso" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["turno" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["turno" + iSeqRow]["change"]) {
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
  if (scEventControl_data["celular" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["celular" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["email" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["email" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["livros" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["livros" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["data_entrega" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["data_entrega" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["data_devolucao" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["data_devolucao" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["emprestimos" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["emprestimos" + iSeqRow]["change"]) {
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
  $('#id_sc_field_id_aluno' + iSeqRow).bind('blur', function() { sc_form_aluno2_id_aluno_onblur(this, iSeqRow) })
                                      .bind('focus', function() { sc_form_aluno2_id_aluno_onfocus(this, iSeqRow) });
  $('#id_sc_field_nome_aluno' + iSeqRow).bind('blur', function() { sc_form_aluno2_nome_aluno_onblur(this, iSeqRow) })
                                        .bind('focus', function() { sc_form_aluno2_nome_aluno_onfocus(this, iSeqRow) });
  $('#id_sc_field_curso' + iSeqRow).bind('blur', function() { sc_form_aluno2_curso_onblur(this, iSeqRow) })
                                   .bind('focus', function() { sc_form_aluno2_curso_onfocus(this, iSeqRow) });
  $('#id_sc_field_turno' + iSeqRow).bind('blur', function() { sc_form_aluno2_turno_onblur(this, iSeqRow) })
                                   .bind('focus', function() { sc_form_aluno2_turno_onfocus(this, iSeqRow) });
  $('#id_sc_field_matricula' + iSeqRow).bind('blur', function() { sc_form_aluno2_matricula_onblur(this, iSeqRow) })
                                       .bind('focus', function() { sc_form_aluno2_matricula_onfocus(this, iSeqRow) });
  $('#id_sc_field_cpf' + iSeqRow).bind('blur', function() { sc_form_aluno2_cpf_onblur(this, iSeqRow) })
                                 .bind('focus', function() { sc_form_aluno2_cpf_onfocus(this, iSeqRow) });
  $('#id_sc_field_celular' + iSeqRow).bind('blur', function() { sc_form_aluno2_celular_onblur(this, iSeqRow) })
                                     .bind('focus', function() { sc_form_aluno2_celular_onfocus(this, iSeqRow) });
  $('#id_sc_field_email' + iSeqRow).bind('blur', function() { sc_form_aluno2_email_onblur(this, iSeqRow) })
                                   .bind('focus', function() { sc_form_aluno2_email_onfocus(this, iSeqRow) });
  $('#id_sc_field_livros' + iSeqRow).bind('blur', function() { sc_form_aluno2_livros_onblur(this, iSeqRow) })
                                    .bind('focus', function() { sc_form_aluno2_livros_onfocus(this, iSeqRow) });
  $('#id_sc_field_data_entrega' + iSeqRow).bind('blur', function() { sc_form_aluno2_data_entrega_onblur(this, iSeqRow) })
                                          .bind('focus', function() { sc_form_aluno2_data_entrega_onfocus(this, iSeqRow) });
  $('#id_sc_field_data_devolucao' + iSeqRow).bind('blur', function() { sc_form_aluno2_data_devolucao_onblur(this, iSeqRow) })
                                            .bind('focus', function() { sc_form_aluno2_data_devolucao_onfocus(this, iSeqRow) });
  $('#id_sc_field_emprestimos' + iSeqRow).bind('blur', function() { sc_form_aluno2_emprestimos_onblur(this, iSeqRow) })
                                         .bind('focus', function() { sc_form_aluno2_emprestimos_onfocus(this, iSeqRow) });
} // scJQEventsAdd

function sc_form_aluno2_id_aluno_onblur(oThis, iSeqRow) {
  do_ajax_form_aluno2_mob_validate_id_aluno();
  scCssBlur(oThis);
}

function sc_form_aluno2_id_aluno_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aluno2_nome_aluno_onblur(oThis, iSeqRow) {
  do_ajax_form_aluno2_mob_validate_nome_aluno();
  scCssBlur(oThis);
}

function sc_form_aluno2_nome_aluno_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aluno2_curso_onblur(oThis, iSeqRow) {
  do_ajax_form_aluno2_mob_validate_curso();
  scCssBlur(oThis);
}

function sc_form_aluno2_curso_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aluno2_turno_onblur(oThis, iSeqRow) {
  do_ajax_form_aluno2_mob_validate_turno();
  scCssBlur(oThis);
}

function sc_form_aluno2_turno_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aluno2_matricula_onblur(oThis, iSeqRow) {
  do_ajax_form_aluno2_mob_validate_matricula();
  scCssBlur(oThis);
}

function sc_form_aluno2_matricula_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aluno2_cpf_onblur(oThis, iSeqRow) {
  do_ajax_form_aluno2_mob_validate_cpf();
  scCssBlur(oThis);
}

function sc_form_aluno2_cpf_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aluno2_celular_onblur(oThis, iSeqRow) {
  do_ajax_form_aluno2_mob_validate_celular();
  scCssBlur(oThis);
}

function sc_form_aluno2_celular_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aluno2_email_onblur(oThis, iSeqRow) {
  do_ajax_form_aluno2_mob_validate_email();
  scCssBlur(oThis);
}

function sc_form_aluno2_email_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aluno2_livros_onblur(oThis, iSeqRow) {
  do_ajax_form_aluno2_mob_validate_livros();
  scCssBlur(oThis);
}

function sc_form_aluno2_livros_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aluno2_data_entrega_onblur(oThis, iSeqRow) {
  do_ajax_form_aluno2_mob_validate_data_entrega();
  scCssBlur(oThis);
}

function sc_form_aluno2_data_entrega_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aluno2_data_devolucao_onblur(oThis, iSeqRow) {
  do_ajax_form_aluno2_mob_validate_data_devolucao();
  scCssBlur(oThis);
}

function sc_form_aluno2_data_devolucao_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aluno2_emprestimos_onblur(oThis, iSeqRow) {
  do_ajax_form_aluno2_mob_validate_emprestimos();
  scCssBlur(oThis);
}

function sc_form_aluno2_emprestimos_onfocus(oThis, iSeqRow) {
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

var scBtnGrpStatus = {};
function scBtnGrpShow(sGroup) {
  var btnPos = $('#sc_btgp_btn_' + sGroup).offset();
  scBtnGrpStatus[sGroup] = 'open';
  $('#sc_btgp_btn_' + sGroup).mouseout(function() {
    setTimeout(function() {
      scBtnGrpHide(sGroup);
    }, 1000);
  });
  $('#sc_btgp_div_' + sGroup + ' span a').click(function() {
    scBtnGrpStatus[sGroup] = 'out';
    scBtnGrpHide(sGroup);
  });
  $('#sc_btgp_div_' + sGroup).css({
    'left': btnPos.left
  })
  .mouseover(function() {
    scBtnGrpStatus[sGroup] = 'over';
  })
  .mouseleave(function() {
    scBtnGrpStatus[sGroup] = 'out';
    setTimeout(function() {
      scBtnGrpHide(sGroup);
    }, 1000);
  })
  .show('fast');
}
function scBtnGrpHide(sGroup) {
  if ('over' != scBtnGrpStatus[sGroup]) {
    $('#sc_btgp_div_' + sGroup).hide('fast');
  }
}
