
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
  scEventControl_data["tipo_livro" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["materia" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["titulo" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["autor" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["isbn" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["quantidade_entrada" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["quantidade" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["id_volume" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
}

function scEventControl_active(iSeqRow) {
  if (scEventControl_data["tipo_livro" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tipo_livro" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["materia" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["materia" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["titulo" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["titulo" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["autor" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["autor" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["isbn" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["isbn" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["quantidade_entrada" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["quantidade_entrada" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["quantidade" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["quantidade" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["id_volume" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["id_volume" + iSeqRow]["change"]) {
    return true;
  }
  return false;
} // scEventControl_active

function scEventControl_onFocus(oField, iSeq) {
  var fieldId, fieldName;
  fieldId = $(oField).attr("id");
  fieldName = fieldId.substr(12);
  scEventControl_data[fieldName]["blur"] = true;
  if ("id_volume" + iSeq == fieldName) {
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
  $('#id_sc_field_materia' + iSeqRow).bind('blur', function() { sc_form_estoque_livro_atualizacao_materia_onblur(this, iSeqRow) })
                                     .bind('focus', function() { sc_form_estoque_livro_atualizacao_materia_onfocus(this, iSeqRow) });
  $('#id_sc_field_titulo' + iSeqRow).bind('blur', function() { sc_form_estoque_livro_atualizacao_titulo_onblur(this, iSeqRow) })
                                    .bind('focus', function() { sc_form_estoque_livro_atualizacao_titulo_onfocus(this, iSeqRow) });
  $('#id_sc_field_autor' + iSeqRow).bind('blur', function() { sc_form_estoque_livro_atualizacao_autor_onblur(this, iSeqRow) })
                                   .bind('focus', function() { sc_form_estoque_livro_atualizacao_autor_onfocus(this, iSeqRow) });
  $('#id_sc_field_isbn' + iSeqRow).bind('blur', function() { sc_form_estoque_livro_atualizacao_isbn_onblur(this, iSeqRow) })
                                  .bind('focus', function() { sc_form_estoque_livro_atualizacao_isbn_onfocus(this, iSeqRow) });
  $('#id_sc_field_quantidade' + iSeqRow).bind('blur', function() { sc_form_estoque_livro_atualizacao_quantidade_onblur(this, iSeqRow) })
                                        .bind('focus', function() { sc_form_estoque_livro_atualizacao_quantidade_onfocus(this, iSeqRow) });
  $('#id_sc_field_id_volume' + iSeqRow).bind('blur', function() { sc_form_estoque_livro_atualizacao_id_volume_onblur(this, iSeqRow) })
                                       .bind('focus', function() { sc_form_estoque_livro_atualizacao_id_volume_onfocus(this, iSeqRow) });
  $('#id_sc_field_tipo_livro' + iSeqRow).bind('blur', function() { sc_form_estoque_livro_atualizacao_tipo_livro_onblur(this, iSeqRow) })
                                        .bind('click', function() { sc_form_estoque_livro_atualizacao_tipo_livro_onclick(this, iSeqRow) })
                                        .bind('focus', function() { sc_form_estoque_livro_atualizacao_tipo_livro_onfocus(this, iSeqRow) });
  $('#id_sc_field_quantidade_entrada' + iSeqRow).bind('blur', function() { sc_form_estoque_livro_atualizacao_quantidade_entrada_onblur(this, iSeqRow) })
                                                .bind('focus', function() { sc_form_estoque_livro_atualizacao_quantidade_entrada_onfocus(this, iSeqRow) });
} // scJQEventsAdd

function sc_form_estoque_livro_atualizacao_materia_onblur(oThis, iSeqRow) {
  do_ajax_form_estoque_livro_atualizacao_mob_validate_materia();
  scCssBlur(oThis);
}

function sc_form_estoque_livro_atualizacao_materia_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_estoque_livro_atualizacao_titulo_onblur(oThis, iSeqRow) {
  do_ajax_form_estoque_livro_atualizacao_mob_validate_titulo();
  scCssBlur(oThis);
}

function sc_form_estoque_livro_atualizacao_titulo_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_estoque_livro_atualizacao_autor_onblur(oThis, iSeqRow) {
  do_ajax_form_estoque_livro_atualizacao_mob_validate_autor();
  scCssBlur(oThis);
}

function sc_form_estoque_livro_atualizacao_autor_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_estoque_livro_atualizacao_isbn_onblur(oThis, iSeqRow) {
  do_ajax_form_estoque_livro_atualizacao_mob_validate_isbn();
  scCssBlur(oThis);
}

function sc_form_estoque_livro_atualizacao_isbn_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_estoque_livro_atualizacao_quantidade_onblur(oThis, iSeqRow) {
  do_ajax_form_estoque_livro_atualizacao_mob_validate_quantidade();
  scCssBlur(oThis);
}

function sc_form_estoque_livro_atualizacao_quantidade_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_estoque_livro_atualizacao_id_volume_onblur(oThis, iSeqRow) {
  do_ajax_form_estoque_livro_atualizacao_mob_validate_id_volume();
  scCssBlur(oThis);
}

function sc_form_estoque_livro_atualizacao_id_volume_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_estoque_livro_atualizacao_tipo_livro_onblur(oThis, iSeqRow) {
  do_ajax_form_estoque_livro_atualizacao_mob_validate_tipo_livro();
  scCssBlur(oThis);
}

function sc_form_estoque_livro_atualizacao_tipo_livro_onclick(oThis, iSeqRow) {
  do_ajax_form_estoque_livro_atualizacao_mob_event_tipo_livro_onclick();
}

function sc_form_estoque_livro_atualizacao_tipo_livro_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_estoque_livro_atualizacao_quantidade_entrada_onblur(oThis, iSeqRow) {
  do_ajax_form_estoque_livro_atualizacao_mob_validate_quantidade_entrada();
  scCssBlur(oThis);
}

function sc_form_estoque_livro_atualizacao_quantidade_entrada_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function scJQSpinAdd(iSeqRow) {
  var elHeight = parseInt($("#id_sc_field_quantidade_entrada" + iSeqRow).css("height")) || 0;
  var elWidth = parseInt($("#id_sc_field_quantidade_entrada" + iSeqRow).css("width")) || 0;
  var spinOpt;
  if (0 < elHeight && 0 < elWidth) {
    spinOpt = {stepInc:1,pageInc:5,min:-99999999999999999999,max:99999999999999999999,btnWidth:15,height:parseInt(elHeight),width:parseInt(elWidth), initValue: $("#id_sc_field_quantidade_entrada" + iSeqRow).val()};
  }
  else if (0 < elHeight) {
    spinOpt = {stepInc:1,pageInc:5,min:-99999999999999999999,max:99999999999999999999,btnWidth:15,height:parseInt(elHeight), initValue: $("#id_sc_field_quantidade_entrada" + iSeqRow).val()};
  }
  else if (0 < elWidth) {
    spinOpt = {stepInc:1,pageInc:5,min:-99999999999999999999,max:99999999999999999999,btnWidth:15,width:parseInt(elWidth), initValue: $("#id_sc_field_quantidade_entrada" + iSeqRow).val()};
  }
  else {
    spinOpt = {stepInc:1,pageInc:5,min:-99999999999999999999,max:99999999999999999999,btnWidth:15, initValue: $("#id_sc_field_quantidade_entrada" + iSeqRow).val()};
  }
  $("#id_sc_field_quantidade_entrada" + iSeqRow).css("padding-right", "21px").addClass("smartspinner").spinit(spinOpt);
} // scJQSpinAdd

function scJQUploadAdd(iSeqRow) {
} // scJQUploadAdd


function scJQElementsAdd(iLine) {
  scJQEventsAdd(iLine);
  scEventControl_init(iLine);
  scJQSpinAdd(iLine);
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
