// Validade CPF
validateCpf = function (strCPF) {
  strCPF = strCPF.substr(0, 3) + strCPF.substr(4, 3) + strCPF.substr(8, 3) + strCPF.substr(12, 2)

  var Soma
  var Resto
  Soma = 0
  if (strCPF == '00000000000') return false
  if (strCPF == '11111111111') return false
  if (strCPF == '22222222222') return false
  if (strCPF == '33333333333') return false
  if (strCPF == '44444444444') return false
  if (strCPF == '55555555555') return false
  if (strCPF == '66666666666') return false
  if (strCPF == '77777777777') return false
  if (strCPF == '88888888888') return false
  if (strCPF == '99999999999') return false

  for (i = 1; i <= 9; i++) Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (11 - i)
  Resto = (Soma * 10) % 11

  if (Resto == 10 || Resto == 11) Resto = 0
  if (Resto != parseInt(strCPF.substring(9, 10))) return false

  Soma = 0
  for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (12 - i)
  Resto = (Soma * 10) % 11

  if (Resto == 10 || Resto == 11) Resto = 0
  if (Resto != parseInt(strCPF.substring(10, 11))) return false
  return true
}

$(function () {
  // openModalAlert
  openModalAlert = function (title, text) {
    $('#modal_title').html(title)
    $('#modal_text').html(text)
    $('#alert_modal').modal('show')
  }

  // Abre Menus
  openMenu = function (item) {
    // Verifica se está ativo
    if ($(item).hasClass('active')) {
      $(item).toggleClass('active')
      setTimeout(function () {
        $(item).toggleClass('display')
      }, 500)
    } else {
      $(item).toggleClass('display')
      setTimeout(function () {
        $(item).toggleClass('active')
      }, 100)
    }

    // Fecha outros Menus
    if (item !== '.box-user-tooltip') {
      $('.box-user-tooltip').removeClass('active')
      $('.box-user-tooltip').removeClass('display')
    }
    if (item !== '.box-menu-notifications') {
      $('.box-menu-notifications').removeClass('active')
      $('.box-menu-notifications').removeClass('display')
    }
    // if(item !== ".box-menu-tools"){
    //     $(".box-menu-tools").removeClass("active");
    //     $(".box-menu-tools").removeClass("display");
    // }
  }

  // updateStatusTaxes
  updateStatusTaxe = function (taxe_id, status) {
    $.ajax({
      url: '/api/web/client/taxes/' + taxe_id + '/' + status + '/update-status',
      data: '',
      type: 'POST',
      dataType: 'json',
      beforeSend: function () {
        $('.box-loading').show()
      },
      complete: function () {},
      success: function (data) {
        if (data.result.status == 'ok') {
          setTimeout(function () {
            $('.box-loading').hide()
            location.reload()
          }, 1000)
        } else {
          setTimeout(function () {
            $('.box-loading').hide()
          }, 1000)
        }
      },
    })
  }

  // updateStatusTaxes
  updateTerms = function () {
    $.ajax({
      url: '/api/web/client/update-terms',
      data: '',
      type: 'POST',
      dataType: 'json',
      beforeSend: function () {
        $('.box-loading').show()
      },
      complete: function () {},
      success: function (data) {
        if (data.result.status == 'ok') {
          setTimeout(function () {
            $('.box-loading').hide()
            window.location.replace('/client')
          }, 1000)
        } else {
          setTimeout(function () {
            $('.box-loading').hide()
          }, 1000)
        }
      },
    })
  }

  // Send Contact
  sendForm = function (url, form, redirect) {
    if (
      url === '/api/web/client/customers/import' ||
      url === '/api/web/client/providers/import' ||
      url === '/api/web/client/partners/import' ||
      url === '/api/web/client/employees/import'
    ) {
      if (url === '/api/web/client/customers/import') {
        var type_import = 'customers'
      }
      if (url === '/api/web/client/providers/import') {
        var type_import = 'providers'
      }
      if (url === '/api/web/client/partners/import') {
        var type_import = 'partners'
      }
      if (url === '/api/web/client/employees/import') {
        var type_import = 'employees'
      }

      var file_import = $('#file_upload_import_' + type_import).prop('files')[0]

      var form_data = new FormData()
      form_data.append('file_upload_import', file_import)
      form_data.append('file_business_id', $('#file_business_id_' + type_import).val())
      form_data.append('file_import_type', type_import)

      $.ajax({
        url: url,
        type: 'POST',
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        beforeSend: function () {
          $('.box-loading').show()
        },
        complete: function () {},
        success: function (data) {
          if (data.result.status == 'ok') {
            setTimeout(function () {
              location.reload()
            }, 500)
          } else {
            setTimeout(function () {
              $('.box-loading').hide()
            }, 500)
          }
        },
      })
    } else {
      if (url === '/api/web/custom/conciliations/import') {
        var file_import = $('#file_import').prop('files')[0]

        var form_data = new FormData()
        form_data.append('upload_import', file_import)
        form_data.append('business_id', $('#input_import_business_id').val())
        form_data.append('account_id', $('#input_import_account_id').val())

        $.ajax({
          url: url,
          type: 'POST',
          dataType: 'text',
          cache: false,
          contentType: false,
          processData: false,
          data: form_data,
          beforeSend: function () {
            $('.box-loading').show()
          },
          complete: function () {},
          success: function (data) {
            if (data == '{"result":{"status":"ok"}}') {
              setTimeout(function () {
                location.reload()
              }, 500)
            } else {
              setTimeout(function () {
                $('.box-loading').hide()
              }, 500)
            }
          },
        })
      } else {
        if (
          url === '/api/web/client/notes/add' ||
          url === '/api/web/client/extracts/add' ||
          url === '/api/web/client/documents/add' ||
          url === '/api/web/client/documents/add-action' ||
          url === '/api/web/custom/files/add'
        ) {
          var form_data = new FormData($(form)[0])

          $.ajax({
            url: url,
            data: form_data,
            type: 'POST',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
              $('.box-loading').show()
            },
            complete: function () {},
            success: function (data) {
              if (data.result.status == 'ok') {
                setTimeout(function () {
                  $('.box-loading').hide()

                  // Verifica
                  if (redirect !== 'none') {
                    window.location.replace(redirect)
                  } else {
                    location.reload()
                  }
                }, 1500)
              } else {
                openModalAlert('Atenção!', data.result.status)
              }
            },
          })
        } else {
          var form_data = $(form).serialize()

          $.ajax({
            url: url,
            data: form_data,
            type: 'POST',
            dataType: 'json',
            beforeSend: function () {
              $('.box-loading').show()
            },
            complete: function () {},
            success: function (data) {
              if (data.result.status == 'ok') {
                setTimeout(function () {
                  $('.box-loading').hide()

                  // Verifica
                  if (redirect !== 'none') {
                    window.location.replace(redirect)
                  } else {
                    location.reload()
                  }
                }, 1500)
              } else {
                openModalAlert('Atenção!', data.result.status)
              }
            },
          })
        }
      }
    }
  }

  sendFormExpensesReceipt = function (url, form, redirect) {
    if (url === '/api/web/client/expenses-receipt/add') {
      var form_data = new FormData($(form)[0])

      $.ajax({
        url: url,
        data: form_data,
        type: 'POST',
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function () {
          $('.box-loading').show()
        },
        complete: function () {},
        success: function (data) {
          if (data.result.status == 'ok') {
            setTimeout(function () {
              $('.box-loading').hide()

              // Verifica
              if (redirect !== 'none') {
                window.location.replace(redirect)
              } else {
                location.reload()
              }
            }, 1500)
          } else {
            // openModalAlert("Atenção!", data.result.status);
            alert(data.result.status)
          }
        },
      })
    } else {
      var form_data = $(form).serialize()

      $.ajax({
        url: url,
        data: form_data,
        type: 'POST',
        dataType: 'json',
        beforeSend: function () {
          $('.box-loading').show()
        },
        complete: function () {},
        success: function (data) {
          if (data.result.status == 'ok') {
            setTimeout(function () {
              $('.box-loading').hide()

              // Verifica
              if (redirect !== 'none') {
                window.location.replace(redirect)
              } else {
                location.reload()
              }
            }, 1500)
          } else {
            // openModalAlert("Atenção!", data.result.status);
            alert(data.result.status)
          }
        },
      })
    }
  }

  // updateStatusTaxes
  approvedConciliationItem = function (conciliation_id, account_id, category_id) {
    console.log('hahahahahahahahahahahahaha zzzzzzzzzzzzzzzzzzzzzzzzzzzz    ')

    $.ajax({
      url: '/api/web/client/conciliations/' + conciliation_id + '/approve/' + account_id + '/' + category_id,
      data: '',
      type: 'POST',
      dataType: 'json',
      beforeSend: function () {
        // $('.box-loading').show();
      },
      complete: function () {},
      success: function (data) {
        if (data.result.status == 'ok') {
          // setTimeout(function(){
          //     $(".box-loading").hide();
          //     window.location.replace('/client/finances?tab_select=17');
          // }, 1000);
        } else {
          setTimeout(function () {
            $('.box-loading').hide()
          }, 1000)
        }
      },
    })
  }

  // updateStatusTaxes
  removeAllConciliations = function () {
    $.ajax({
      url: '/api/web/client/conciliations/remove-all',
      data: '',
      type: 'POST',
      dataType: 'json',
      beforeSend: function () {
        $('.box-loading').show()
      },
      complete: function () {},
      success: function (data) {
        if (data.result.status == 'ok') {
          setTimeout(function () {
            $('.box-loading').hide()
            window.location.replace('/client/finances?tab_select=17')
          }, 1000)
        } else {
          setTimeout(function () {
            $('.box-loading').hide()
          }, 1000)
        }
      },
    })
  }

  // Add Advisor
  closeTicket = function (ticket_id) {
    $.ajax({
      url: '/api/web/client/tickets/' + ticket_id + '/close',
      type: 'POST',
      dataType: 'json',
      beforeSend: function () {
        $('.box-loading').show()
      },
      complete: function () {},
      success: function (data) {
        if (data.result.status == 'ok') {
          setTimeout(function () {
            $('.box-loading').hide()
            location.reload()
          }, 1000)
        } else {
          setTimeout(function () {
            $('.box-loading').hide()
            alert(data.result.status)
          }, 1000)
        }
      },
    })
  }
})

// Carrega página
$(document).ready(function () {
  // Open Loading Page
  setTimeout(function () {
    $('.loading-page').fadeOut('slow')
  }, 500)

  // Href
  $(document).on('click', 'a[href^="#"]', function (event) {
    event.preventDefault()

    $('html, body').animate(
      {
        scrollTop: $($.attr(this, 'href')).offset().top - 50,
      },
      500
    )
  })

  // tooltip
  $('[data-toggle="tooltip"]').tooltip({
    animation: false,
  })

  // tooltip
  $('[data-tool="tooltip"]').tooltip({
    animation: false,
  })

  // Aplica mascaras
  $('.mask-date').mask('00/00/0000')
  $('.mask-dd-yy').mask('00/00')
  $('.mask-dd-yyyy').mask('00/0000')
  $('.mask-time').mask('00:00:00')
  $('.mask-date_time').mask('00/00/0000 00:00:00')
  $('.mask-cep').mask('00000-000')
  $('.mask-phonefixed').mask('(00) 0000-0000')
  $('.mask-phone').mask('(00) 00000-0000')
  $('.mask-mixed').mask('AAA 000-S0S')
  $('.mask-cpf').mask('000.000.000-00', { reverse: true })
  $('.mask-cnpj').mask('00.000.000/0000-00', { reverse: true })
  $('.mask-money').mask('000.000.000.000.000,00', { reverse: true })
  $('.money2').mask('#.##0,00', { reverse: true })
  $('.mask-creditcard').mask('0000 0000 0000 0000')

  // Datepicker
  $('.datepicker').datepicker({
    language: 'pt-BR',
    todayHighlight: true,
    format: 'yyyy-mm-dd',
  })

  $('.datepicker1').datepicker({
    language: 'pt-BR',
    todayHighlight: true,
    format: 'yyyy-mm-dd',
  })

  // Option Date
  $('.input-date').click(function (event) {
    $('.box-datepicker').toggleClass('display')

    setTimeout(function () {
      $('.box-datepicker').toggleClass('active')
    }, 100)
  })

  $('.input-date1').click(function (event) {
    $('.box-datepicker1').toggleClass('display')

    setTimeout(function () {
      $('.box-datepicker1').toggleClass('active')
    }, 100)
  })

  // Change Date picker
  $('.input-date .datepicker').on('changeDate', function () {
    var date = $(this).datepicker('getFormattedDate')
    var new_date = date.substr(8, 2) + '/' + date.substr(5, 2) + '/' + date.substr(0, 4)

    $($(this).data('id')).val(new_date)

    $('.box-datepicker').removeClass('active')
    $('.box-datepicker').removeClass('display')
  })

  $('.input-date1 .datepicker1').on('changeDate', function () {
    var date = $(this).datepicker('getFormattedDate')
    var new_date = date.substr(8, 2) + '/' + date.substr(5, 2) + '/' + date.substr(0, 4)

    $($(this).data('id')).val(new_date)

    $('.box-datepicker1').removeClass('active')
    $('.box-datepicker1').removeClass('display')
  })

  // Scrollbar
  $('.scroll-active').perfectScrollbar({
    wheelSpeed: 0.3,
  })

  // OPEN MENU COLLAPSE
  $('.content-admin').click(function () {
    $('.main-menu').removeClass('active')
  })

  // OPEN MENU COLLAPSE
  $('#btn-open-menu-mobile').click(function () {
    $('.main-menu').toggleClass('active')
  })

  $('.btn-close-mobile').click(function () {
    $('.main-menu').removeClass('active')
    $('.sub-menu').removeClass('active')
  })

  // Open Menu Profile
  $('.menu-top .box-user, .menu-top .name-advisor').click(function (event) {
    event.stopPropagation()
    $('.box-notifications-tooltip').removeClass('active')
    $('.box-notifications-tooltip').removeClass('display')
    openMenu('.box-user-tooltip')
  })

  // Show video
  $('.btn-video, .box-shadow-video, .btn-close-video').click(function () {
    $('.box-video').toggleClass('active')
    $('.box-shadow-video').toggleClass('active')
  })

  // Open Menu Notification
  $('.menu-top .box-notification').click(function (event) {
    event.stopPropagation()
    openMenu('.box-notifications-tooltip')
  })

  // Ocultar sub menu
  $('.content-admin, .menu-top').click(function () {
    // $('.main-menu .item').removeClass("active");
    $('.sub-menu').removeClass('active')
    $('.sub-menu .list').css('display', 'none')
    $('.sub-menu .list').removeClass('active')

    if ($('.box-user-tooltip').hasClass('active')) {
      openMenu('.box-user-tooltip')
    }

    if ($('.box-notifications-tooltip').hasClass('active')) {
      openMenu('.box-notifications-tooltip')
    }
  })

  // Open Import Files
  $('.btn-open-taxes').click(function () {
    $('#open_taxe_client').modal('show')
    $('.item-taxes').css('display', 'none')

    var item_open = $(this).data('id')
    $('#item-taxes-' + item_open).css('display', 'block')
  })

  // Open Import Files
  $('.btn-open-notes').click(function () {
    $('#open_note_client').modal('show')
    $('.item-notes').css('display', 'none')

    var item_open = $(this).data('id')
    $('#item-notes-' + item_open).css('display', 'block')
  })

  // Open Import Files
  $('.btn-open-extracts').click(function () {
    $('#open_extract_client').modal('show')
    $('.item-extracts').css('display', 'none')

    var item_open = $(this).data('id')
    $('#item-extracts-' + item_open).css('display', 'block')
  })

  $('#btn-add-document').click(function (event) {
    event.preventDefault()
    addItemDoc()
  })

  $('.btn-open-documents').click(function () {
    $('#open_document_client').modal('show')
    $('.item-documents').css('display', 'none')

    var item_open = $(this).data('id')
    $('#item-documents-' + item_open).css('display', 'block')
  })

  $('.btn-open-expenses-receipt').click(function () {
    $('#open_expenses_receipt_client').modal('show')
    $('.item-documents').css('display', 'none')

    var item_open = $(this).data('id')
    $('#item-documents-' + item_open).css('display', 'block')
  })

  // btn-update-status-taxes
  $('.btn-update-status-taxe').click(function () {
    updateStatusTaxe($(this).data('id'), $(this).data('status'))
  })

  // Submit Contact
  $('.btn_send_form').click(function () {
    var url = $(this).data('url')
    var form = $(this).data('form')
    var redirect = $(this).data('redirect')
    var errors = 0

    $(form + ' .required').each(function () {
      if ($(this).val() === '') {
        errors++
        $(this).addClass('input-error')
      } else {
        $(this).removeClass('input-error')
      }
    })

    if (errors > 0) {
      openModalAlert('Atenção!', 'Preencha todos os campos corretamente.')
    } else {
      sendForm(url, form, redirect)
    }
  })

  $('.btn_send_form_expenses_receipt').click(function () {
    var url = $(this).data('url')
    var form = $(this).data('form')
    var redirect = $(this).data('redirect')
    var errors = 0

    $(form + ' .required').each(function () {
      if ($(this).val() === '') {
        errors++
        $(this).addClass('input-error')
      } else {
        $(this).removeClass('input-error')
      }
    })

    if (errors > 0) {
      openModalAlert('Atenção!', 'Preencha todos os campos corretamente.')
      // alert("Preencha todos os campos corretamente.");
    } else {
      sendFormExpensesReceipt(url, form, redirect)
    }
  })

  //add itens na receita ou despesas
  $('#btn-add-expenses-receipt').click(function (event) {
    event.preventDefault()
    addItem()
  })

  //add itens na receita ou despesas
  $('#btn-sign-terms').click(function () {
    updateTerms()
  })

  // ADD ITENS

  $('#input_payment_type').change(function () {
    console.log($(this).val())

    if ($(this).val() === 'customer') {
      $('#text_payment_type').css('display', 'block')
      $('#select_payment_customer').css('display', 'block')

      $('#select_payment_provider').css('display', 'none')
      $('#select_payment_employee').css('display', 'none')
      $('#select_payment_partner').css('display', 'none')
    }

    if ($(this).val() === 'provider') {
      $('#text_payment_type').css('display', 'block')
      $('#select_payment_provider').css('display', 'block')

      $('#select_payment_customer').css('display', 'none')
      $('#select_payment_employee').css('display', 'none')
      $('#select_payment_partner').css('display', 'none')
    }

    if ($(this).val() === 'employee') {
      $('#text_payment_type').css('display', 'block')
      $('#select_payment_employee').css('display', 'block')

      $('#select_payment_customer').css('display', 'none')
      $('#select_payment_provider').css('display', 'none')
      $('#select_payment_partner').css('display', 'none')
    }

    if ($(this).val() === 'partner') {
      $('#text_payment_type').css('display', 'block')
      $('#select_payment_partner').css('display', 'block')

      $('#select_payment_customer').css('display', 'none')
      $('#select_payment_provider').css('display', 'none')
      $('#select_payment_employee').css('display', 'none')
    }

    if ($(this).val() === 'none') {
      $('#text_payment_type').css('display', 'none')
      $('#select_payment_partner').css('display', 'none')
      $('#select_payment_customer').css('display', 'none')
      $('#select_payment_provider').css('display', 'none')
      $('#select_payment_employee').css('display', 'none')
    }
  })

  $('#input_receipt_type').change(function () {
    if ($(this).val() === 'customer') {
      $('#text_receipt_type').css('display', 'block')
      $('#select_receipt_customer').css('display', 'block')

      $('#select_receipt_provider').css('display', 'none')
      $('#select_receipt_employee').css('display', 'none')
      $('#select_receipt_partner').css('display', 'none')
    }

    if ($(this).val() === 'provider') {
      $('#text_receipt_type').css('display', 'block')
      $('#select_receipt_provider').css('display', 'block')

      $('#select_receipt_customer').css('display', 'none')
      $('#select_receipt_employee').css('display', 'none')
      $('#select_receipt_partner').css('display', 'none')
    }

    if ($(this).val() === 'employee') {
      $('#text_receipt_type').css('display', 'block')
      $('#select_receipt_employee').css('display', 'block')

      $('#select_receipt_customer').css('display', 'none')
      $('#select_receipt_provider').css('display', 'none')
      $('#select_receipt_partner').css('display', 'none')
    }

    if ($(this).val() === 'partner') {
      $('#text_receipt_type').css('display', 'block')
      $('#select_receipt_partner').css('display', 'block')

      $('#select_receipt_customer').css('display', 'none')
      $('#select_receipt_provider').css('display', 'none')
      $('#select_receipt_employee').css('display', 'none')
    }

    if ($(this).val() === 'none') {
      $('#text_receipt_type').css('display', 'none')
      $('#select_receipt_partner').css('display', 'none')
      $('#select_receipt_customer').css('display', 'none')
      $('#select_receipt_provider').css('display', 'none')
      $('#select_receipt_employee').css('display', 'none')
    }
  })

  $('#input_customer_type, #input_employee_type, #input_partner_type, #input_provider_type').change(
    function () {
      var input_type = $(this).data('type')

      if ($(this).val() === 'pf') {
        $('#area_' + input_type + '_pf').css('display', 'block')
        $('#area_' + input_type + '_pj').css('display', 'none')
      }

      if ($(this).val() === 'pj') {
        $('#area_' + input_type + '_pf').css('display', 'none')
        $('#area_' + input_type + '_pj').css('display', 'block')
      }
    }
  )

  $(
    '#input_customer_type_update, #input_employee_type_update, #input_partner_type_update, #input_provider_type_update'
  ).change(function () {
    var input_type = $(this).data('type')

    if ($(this).val() === 'pf') {
      $('#area_' + input_type + '_pf_update').css('display', 'block')
      $('#area_' + input_type + '_pj_update').css('display', 'none')
    }

    if ($(this).val() === 'pj') {
      $('#area_' + input_type + '_pf_update').css('display', 'none')
      $('#area_' + input_type + '_pj_update').css('display', 'block')
    }
  })

  // UPDATE ITENS

  $('#input_update_payment_type').change(function () {
    if ($(this).val() === 'customer') {
      $('#text_update_payment_type').css('display', 'block')
      $('#text_update_payment_type').html('Cliente')
      $('#select_update_payment_customer').css('display', 'block')

      $('#select_update_payment_provider').css('display', 'none')
      $('#select_update_payment_employee').css('display', 'none')
      $('#select_update_payment_partner').css('display', 'none')
    }

    if ($(this).val() === 'provider') {
      $('#text_update_payment_type').css('display', 'block')
      $('#text_update_payment_type').html('Fornecedor')
      $('#select_update_payment_provider').css('display', 'block')

      $('#select_update_payment_customer').css('display', 'none')
      $('#select_update_payment_employee').css('display', 'none')
      $('#select_update_payment_partner').css('display', 'none')
    }

    if ($(this).val() === 'employee') {
      $('#text_update_payment_type').css('display', 'block')
      $('#text_update_payment_type').html('Funcionário')
      $('#select_update_payment_employee').css('display', 'block')

      $('#select_update_payment_customer').css('display', 'none')
      $('#select_update_payment_provider').css('display', 'none')
      $('#select_update_payment_partner').css('display', 'none')
    }

    if ($(this).val() === 'partner') {
      $('#text_update_payment_type').css('display', 'block')
      $('#text_update_payment_type').html('Sócio')
      $('#select_update_payment_partner').css('display', 'block')

      $('#select_update_payment_customer').css('display', 'none')
      $('#select_update_payment_provider').css('display', 'none')
      $('#select_update_payment_employee').css('display', 'none')
    }

    if ($(this).val() === 'none') {
      $('#text_update_payment_type').css('display', 'none')
      $('#text_update_payment_type').html('')
      $('#select_update_payment_partner').css('display', 'none')
      $('#select_update_payment_customer').css('display', 'none')
      $('#select_update_payment_provider').css('display', 'none')
      $('#select_update_payment_employee').css('display', 'none')
    }
  })

  $('#input_update_receipt_type').change(function () {
    if ($(this).val() === 'customer') {
      $('#text_update_receipt_type').css('display', 'block')
      $('#text_update_receipt_type').html('Cliente')
      $('#select_update_receipt_customer').css('display', 'block')

      $('#select_update_receipt_provider').css('display', 'none')
      $('#select_update_receipt_employee').css('display', 'none')
      $('#select_update_receipt_partner').css('display', 'none')
    }

    if ($(this).val() === 'provider') {
      $('#text_update_receipt_type').css('display', 'block')
      $('#text_update_receipt_type').html('Fornecedor')
      $('#select_update_receipt_provider').css('display', 'block')

      $('#select_update_receipt_customer').css('display', 'none')
      $('#select_update_receipt_employee').css('display', 'none')
      $('#select_update_receipt_partner').css('display', 'none')
    }

    if ($(this).val() === 'employee') {
      $('#text_update_receipt_type').css('display', 'block')
      $('#text_update_receipt_type').html('Funcionário')
      $('#select_update_receipt_employee').css('display', 'block')

      $('#select_update_receipt_customer').css('display', 'none')
      $('#select_update_receipt_provider').css('display', 'none')
      $('#select_update_receipt_partner').css('display', 'none')
    }

    if ($(this).val() === 'partner') {
      $('#text_update_receipt_type').css('display', 'block')
      $('#text_update_receipt_type').html('Sócio')
      $('#select_update_receipt_partner').css('display', 'block')

      $('#select_update_receipt_customer').css('display', 'none')
      $('#select_update_receipt_provider').css('display', 'none')
      $('#select_update_receipt_employee').css('display', 'none')
    }

    if ($(this).val() === 'none') {
      $('#text_update_receipt_type').css('display', 'none')
      $('#text_update_receipt_type').html('')
      $('#select_update_receipt_partner').css('display', 'none')
      $('#select_update_receipt_customer').css('display', 'none')
      $('#select_update_receipt_provider').css('display', 'none')
      $('#select_update_receipt_employee').css('display', 'none')
    }
  })

  // TABS

  $('.box-tabs.no-link .tab-item').click(function () {
    var tab_open = $(this).data('open')
    var tab_type = $(this).data('type')

    $('.box-tabs.no-link .tab-item').removeClass('active')
    $(this).addClass('active')

    $('#tab_content_' + tab_type + '_1').removeClass('active')
    $('#tab_content_' + tab_type + '_2').removeClass('active')
    $('#tab_content_' + tab_type + '_3').removeClass('active')
    $('#tab_content_' + tab_type + '_4').removeClass('active')

    $(tab_open).addClass('active')
  })

  $('.box-tabs.update.no-link .tab-item').click(function () {
    var tab_open = $(this).data('open')
    var tab_type = $(this).data('type')

    $('.box-tabs.update.no-link .tab-item').removeClass('active')
    $(this).addClass('active')

    $('#tab_content_update_' + tab_type + '_1').removeClass('active')
    $('#tab_content_update_' + tab_type + '_2').removeClass('active')
    $('#tab_content_update_' + tab_type + '_3').removeClass('active')
    $('#tab_content_update_' + tab_type + '_4').removeClass('active')

    $(tab_open).addClass('active')
  })

  $('.btn-approve-conciliation').click(function () {
    var item_id = $(this).data('id')
    var conciliation_account_id = $('#conciliation_account_' + $(this).data('id')).val()
    var conciliation_category_id = $('#conciliation_category_' + $(this).data('id')).val()

    approvedConciliationItem(item_id, conciliation_account_id, conciliation_category_id)

    $(this).css('display', 'none')
    $('#icon-approve-conciliation-' + $(this).data('id')).fadeIn('slow')
  })

  $('#btn-remove-all-conciliations').click(function () {
    removeAllConciliations()
  })

  $('.btn-document-send-remove').click(function () {
    alert($(this).data('id'))
  })

  // Busca CNPJ
  $('#input-search-cnpj, #input-search-cnpj-update').on('blur', function (e) {
    var cnpj = $(this).val()
    var type = $(this).data('type')

    if (cnpj.length == 18) {
      cnpj = cnpj.replace('.', '')
      cnpj = cnpj.replace('.', '')
      cnpj = cnpj.replace('-', '')
      cnpj = cnpj.replace('/', '')

      $.ajax({
        url: '/api/web/client/' + cnpj + '/search-cnpj',
        data: '',
        type: 'POST',
        dataType: 'json',
        beforeSend: function () {
          $('.box-loading').show()
        },
        complete: function () {},
        success: function (data) {
          if (data.result.status == 'ok') {
            setTimeout(function () {
              // window.location.reload();
              $('.box-loading').hide()

              if (type === 'modal') {
                $('#input-cnpj-razao').val(data.result.razao)
                $('#input-cnpj-fantasia').val(data.result.fantasia)
                $('#input-cnpj-logradouro').val(data.result.logradouro)
                $('#input-cnpj-numero').val(data.result.numero)
                $('#input-cnpj-cep').val(data.result.cep)
                $('#input-cnpj-municipio').val(data.result.municipio)
                $('#input-cnpj-bairro').val(data.result.bairro)
                $('#input-cnpj-complemento').val(data.result.complemento)
                $('#input-cnpj-uf').val(data.result.uf)
                $('#input-cnpj-telefone').val(data.result.telefone)
                $('#input-cnpj-email').val(data.result.email)
                $('#input-cnpj-pais').val('Brasil')
              } else {
                $('#input-cnpj-razao-update').val(data.result.razao)
                $('#input-cnpj-fantasia-update').val(data.result.fantasia)
                $('#input-cnpj-logradouro-update').val(data.result.logradouro)
                $('#input-cnpj-numero-update').val(data.result.numero)
                $('#input-cnpj-cep-update').val(data.result.cep)
                $('#input-cnpj-municipio-update').val(data.result.municipio)
                $('#input-cnpj-bairro-update').val(data.result.bairro)
                $('#input-cnpj-complemento-update').val(data.result.complemento)
                $('#input-cnpj-uf-update').val(data.result.uf)
                $('#input-cnpj-telefone-update').val(data.result.telefone)
                $('#input-cnpj-email-update').val(data.result.email)
                $('#input-cnpj-pais-update').val('Brasil')
              }
            }, 1500)
          } else {
            $('.box-loading').hide()
            openModalAlert('Atenção!', data.result.status)
          }
        },
      })
    }
  })

  // Validate CPF
  $('#input-cpf').keyup(function () {
    var char = $(this).val()

    if (validateCpf(char) === false) {
      $(this).addClass('input-error')
      $(this).parent().find('p').html('CPF Inválido')
      $(this).parent().find('p').css('color', '#e70e55')
    } else {
      $(this).removeClass('input-error')
      $(this).css('border', '1px solid #00c221')
      $(this).parent().find('p').html('CPF válido')
      $(this).parent().find('p').css('color', '#00c221')
    }
  })

  $('#btnCloseTicket').click(function () {
    closeTicket($(this).data('ticket'))
  })

  // btn-open-payment
  $('.btn-open-payment').click(function () {
    $('#input_update_payment_id').val($(this).data('id'))
    $('#input_update_payment_title').val($(this).data('title'))
    $('#input_update_payment_value').val($(this).data('value'))
    $('#input_update_payment_status').val($(this).data('status'))
    $('#input_update_payment_account').val($(this).data('account'))
    $('#input_update_payment_category').val($(this).data('category'))
    $('#input_update_payment_type').val($(this).data('type'))
    $('#input_update_payment_division').val($(this).data('division'))
    $('#input_update_payment_maturity').val($(this).data('maturity'))
    $('#input_update_payment_recurrent').val($(this).data('recurrent'))

    $('#input_update_payment_fees').val($(this).data('fees'))
    $('#input_update_payment_fine').val($(this).data('fine'))

    if ($(this).data('type') === 'customer') {
      $('#select_update_payment_customer').val($(this).data('type_id'))
    }

    if ($(this).data('type') === 'provider') {
      $('#select_update_payment_provider').val($(this).data('type_id'))
    }

    if ($(this).data('type') === 'employee') {
      $('#select_update_payment_employee').val($(this).data('type_id'))
    }

    if ($(this).data('type') === 'partner') {
      $('#select_update_payment_partner').val($(this).data('type_id'))
    }

    if (!$('#select_update_payment_provider').value) {
      $('#select_update_payment_customer').val($(this).data('type_id'))
    }

    if ($(this).data('type') == 'customer') {
      $('#text_update_payment_type').css('display', 'block')
      $('#text_update_payment_type').html('Cliente')
      $('#select_update_payment_customer').css('display', 'block')

      $('#select_update_payment_provider').css('display', 'none')
      $('#select_update_payment_employee').css('display', 'none')
      $('#select_update_payment_partner').css('display', 'none')
    }

    if ($(this).data('type') == 'provider') {
      $('#text_update_payment_type').css('display', 'block')
      $('#text_update_payment_type').html('Fornecedor')
      $('#select_update_payment_provider').css('display', 'block')

      $('#select_update_payment_customer').css('display', 'none')
      $('#select_update_payment_employee').css('display', 'none')
      $('#select_update_payment_partner').css('display', 'none')
    }

    if ($(this).data('type') == 'employee') {
      $('#text_update_payment_type').css('display', 'block')
      $('#text_update_payment_type').html('Funcionário')
      $('#select_update_payment_employee').css('display', 'block')

      $('#select_update_payment_customer').css('display', 'none')
      $('#select_update_payment_provider').css('display', 'none')
      $('#select_update_payment_partner').css('display', 'none')
    }

    if ($(this).data('type') == 'partner') {
      $('#text_update_payment_type').css('display', 'block')
      $('#text_update_payment_type').html('Sócio')
      $('#select_update_payment_partner').css('display', 'block')

      $('#select_update_payment_customer').css('display', 'none')
      $('#select_update_payment_provider').css('display', 'none')
      $('#select_update_payment_employee').css('display', 'none')
    }

    if ($(this).data('type') == 'none') {
      $('#text_update_payment_type').css('display', 'none')
      $('#text_update_payment_type').html('')
      $('#select_update_payment_partner').css('display', 'none')
      $('#select_update_payment_customer').css('display', 'none')
      $('#select_update_payment_provider').css('display', 'none')
      $('#select_update_payment_employee').css('display', 'none')
    }
  })

  // btn-open-receipt
  $('.btn-open-receipt').click(function () {
    $('#input_update_receipt_id').val($(this).data('id'))
    $('#input_update_receipt_title').val($(this).data('title'))
    $('#input_update_receipt_value').val($(this).data('value'))
    $('#input_update_receipt_status').val($(this).data('status'))
    $('#input_update_receipt_account').val($(this).data('account'))
    $('#input_update_receipt_category').val($(this).data('category'))
    $('#input_update_receipt_type').val($(this).data('type'))
    $('#input_update_receipt_division').val($(this).data('division'))
    $('#input_update_receipt_maturity').val($(this).data('maturity'))
    $('#input_update_receipt_recurrent').val($(this).data('recurrent'))

    $('#input_update_receipt_fees').val($(this).data('fees'))
    $('#input_update_receipt_fine').val($(this).data('fine'))

    if ($(this).data('type') === 'customer') {
      $('#select_update_receipt_customer').val($(this).data('type_id'))
    }

    if ($(this).data('type') === 'provider') {
      $('#select_update_receipt_provider').val($(this).data('type_id'))
    }

    if ($(this).data('type') === 'employee') {
      $('#select_update_receipt_employee').val($(this).data('type_id'))
    }

    if ($(this).data('type') === 'partner') {
      $('#select_update_receipt_partner').val($(this).data('type_id'))
    }

    if ($(this).data('type') == 'customer') {
      $('#text_update_receipt_type').css('display', 'block')
      $('#text_update_receipt_type').html('Cliente')
      $('#select_update_receipt_customer').css('display', 'block')

      $('#select_update_receipt_provider').css('display', 'none')
      $('#select_update_receipt_employee').css('display', 'none')
      $('#select_update_receipt_partner').css('display', 'none')
    }

    if ($(this).data('type') == 'provider') {
      $('#text_update_receipt_type').css('display', 'block')
      $('#text_update_receipt_type').html('Fornecedor')
      $('#select_update_receipt_provider').css('display', 'block')

      $('#select_update_receipt_customer').css('display', 'none')
      $('#select_update_receipt_employee').css('display', 'none')
      $('#select_update_receipt_partner').css('display', 'none')
    }

    if ($(this).data('type') == 'employee') {
      $('#text_update_receipt_type').css('display', 'block')
      $('#text_update_receipt_type').html('Funcionário')
      $('#select_update_receipt_employee').css('display', 'block')

      $('#select_update_receipt_customer').css('display', 'none')
      $('#select_update_receipt_provider').css('display', 'none')
      $('#select_update_receipt_partner').css('display', 'none')
    }

    if ($(this).data('type') == 'partner') {
      $('#text_update_receipt_type').css('display', 'block')
      $('#text_update_receipt_type').html('Sócio')
      $('#select_update_receipt_partner').css('display', 'block')

      $('#select_update_receipt_customer').css('display', 'none')
      $('#select_update_receipt_provider').css('display', 'none')
      $('#select_update_receipt_employee').css('display', 'none')
    }

    if ($(this).data('type') == 'none') {
      $('#text_update_receipt_type').css('display', 'none')
      $('#text_update_receipt_type').html('')
      $('#select_update_receipt_partner').css('display', 'none')
      $('#select_update_receipt_customer').css('display', 'none')
      $('#select_update_receipt_provider').css('display', 'none')
      $('#select_update_receipt_employee').css('display', 'none')
    }
  })

  // UPDATE REPORT REVIEW 1

  $('#input-filter-report-review-1').change(function () {
    $('#form-update-report-review-1').submit()
  })

  $('.btn-expand-menu-finances').click(function () {
    $(this).removeClass('pulse')

    $('.box-menu-itens').toggleClass('open')
    $(this).toggleClass('open')
  })

  // TYPE NF

  $('#input_nf_type').change(function () {
    if ($(this).val() === 'nfs-e') {
      $('#area-nf-produtos').css('display', 'none')
      $('#area-nf-servicos').css('display', 'block')
    }

    if ($(this).val() === 'nf-e' || $(this).val() === 'nfc-e') {
      $('#area-nf-produtos').css('display', 'block')
      $('#area-nf-servicos').css('display', 'none')
    }
  })

  // CLIENT NF

  $('#input_nf_client_type').change(function () {
    if ($(this).val() === 'customer') {
      $('#text_nf_type').css('display', 'block')
      $('#select_nf_customer').css('display', 'block')

      $('#select_nf_provider').css('display', 'none')
      $('#select_nf_employee').css('display', 'none')
      $('#select_nf_partner').css('display', 'none')
    }

    if ($(this).val() === 'provider') {
      $('#text_nf_type').css('display', 'block')
      $('#select_nf_provider').css('display', 'block')

      $('#select_nf_customer').css('display', 'none')
      $('#select_nf_employee').css('display', 'none')
      $('#select_nf_partner').css('display', 'none')
    }

    if ($(this).val() === 'employee') {
      $('#text_nf_type').css('display', 'block')
      $('#select_nf_employee').css('display', 'block')

      $('#select_nf_customer').css('display', 'none')
      $('#select_nf_provider').css('display', 'none')
      $('#select_nf_partner').css('display', 'none')
    }

    if ($(this).val() === 'partner') {
      $('#text_nf_type').css('display', 'block')
      $('#select_nf_partner').css('display', 'block')

      $('#select_nf_customer').css('display', 'none')
      $('#select_nf_provider').css('display', 'none')
      $('#select_nf_employee').css('display', 'none')
    }

    if ($(this).val() === 'none') {
      $('#text_nf_type').css('display', 'none')
      $('#select_nf_partner').css('display', 'none')
      $('#select_nf_customer').css('display', 'none')
      $('#select_nf_provider').css('display', 'none')
      $('#select_nf_employee').css('display', 'none')
    }
  })
})

addItemDoc = function () {
  var html_itens = ''
  var dateInput = $('#document-date').val()
  var business_id = $('#business_id').val()
  var itens_job = $('#total-itens').val()

  itens_job++

  html_itens += '<div id="area-add-documents-"' + itens_job + '">'
  html_itens +=
    '<p class="text margin-t-40 btn-close" style=" margin-bottom: 10px; color: #969696; font-weight: 600; float: left;">Documento ' +
    itens_job +
    '</p>'
  html_itens +=
    '<button class="text margin-t-40 btn-line-gray" id="remove-' +
    itens_job +
    '"; type="button" style=" margin-bottom: 10px; color: #969696; font-weight: 600; float: right;">X</button>'
  html_itens += '<br />'
  html_itens += '<br />'
  html_itens += '<br />'
  html_itens += '<input type="hidden" name="business_id-' + itens_job + '" value="' + business_id + '">'
  html_itens += '<p class="text" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Título</p>'
  html_itens +=
    '<input type="text" class="form-control accountant required" name="title-' +
    itens_job +
    '" style="font-size: 14px; background-color: #fff;">'
  html_itens +=
    '<p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Descrição</p>'
  html_itens +=
    '<input type="text" class="form-control accountant required" name="description-' +
    itens_job +
    '" style="font-size: 14px; background-color: #fff;">'
  html_itens +=
    '<p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Tipo de Documento</p>'
  html_itens +=
    '<select type="text" class="form-control required" name="type-doc-' +
    itens_job +
    '" style="font-size: 14px; background-color: #fff;">'
  html_itens += '<option value="Fiscal">Fiscal</option>'
  html_itens += '<option value="RH">RH</option>'
  html_itens += '<option value="Contábil">Contábil</option>'
  html_itens += '<option value="Legalização">Legalização</option>'
  html_itens += '<option value="Administrativo">Administrativo</option>'
  html_itens += '<option value="Financeiro">Financeiro</option>'
  html_itens += '<option value="Atendimento">Atendimento</option>'
  html_itens += '<option value="Cadastro">Cadastro</option>'
  html_itens += '<option value="Treinamento">Treinamento</option>'
  html_itens += '<option value="Outros">Outros</option>'
  html_itens += '</select>'
  html_itens +=
    '<p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Data</p>'
  html_itens += '<div class="input-date">'
  html_itens += '<div class="icon ion-android-calendar arrow"></div>'
  html_itens +=
    '<input type="text" class="form-control accountant add-date" name="date-' +
    itens_job +
    '" value="' +
    dateInput +
    '" placeholder="" style="cursor: pointer;" id="document-date">'
  html_itens += '<div class="box-datepicker accountant">'
  html_itens +=
    '<div class="datepicker" data-date="<?= h($date_input); ?>" data-id="#document-date-' +
    itens_job +
    '"></div>'
  html_itens += '</div>'
  html_itens += '</div>'
  html_itens +=
    '<p class="text margin-t-40" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Upload do documento</p>'
  html_itens += '<label class="fileContainer ">'
  html_itens +=
    '<div for="file_document" class="btn btn-line-gray size-sm margin-t-0">SELECIONAR ARQUIVO</div>'
  html_itens +=
    '<input type="file" style="display: none;" id="file-document-' +
    itens_job +
    '" class="form-control-file" name="file-document-' +
    itens_job +
    '" onchange="readURL(this, ' +
    itens_job +
    ');">'
  html_itens += '</label>'
  html_itens +=
    '<label  id="text-file-' +
    itens_job +
    '" style="font-weight: 600; color: #ff3576; margin-left: 10px;"></label>'
  html_itens += '</div>'

  $('#total-itens').val(itens_job)
  var element_itens = $(html_itens)
  $('#area-add-documents').append(element_itens)

  //REMOVE
  $('#remove-' + itens_job + '').on('click', function (e) {
    e.preventDefault()
    $(this).parent().remove()
    itens_job--
    $('#total-itens').val(itens_job)
  })
}

addItem = function () {
  var html_itens = ''
  var dateInput = $('#document-date').val()
  var itens_job = $('#total-itens').val()

  itens_job++

  html_itens += '<div id="area-add-documents-"' + itens_job + '">'
  html_itens +=
    '<p class="text margin-t-40 btn-close" style=" margin-bottom: 10px; color: #969696; font-weight: 600; float: left;">Item ' +
    itens_job +
    '</p>'
  html_itens +=
    '<button class="text margin-t-40 btn-line-gray" id="remove-' +
    itens_job +
    '"; type="button" style=" margin-bottom: 10px; color: #969696; font-weight: 600; float: right;">X</button>'
  html_itens += '<br />'
  html_itens += '<br />'
  html_itens += '<br />'
  html_itens += '<p class="text" style="margin-bottom: 10px; color: #969696; font-weight: 600;">Nome</p>'
  html_itens +=
    '<input name="name-' +
    itens_job +
    '" type="text" class="form-control required" style="font-size: 14px; background-color: #fff;" >'
  html_itens +=
    '<p class="text margin-t-20" style="margin-bottom: 10px; color: #969696; font-weight: 600;">Valor</p>'
  html_itens +=
    '<input name="value-' +
    itens_job +
    '" min="0" type="number" class="form-control required" style="font-size: 14px; background-color: #fff;" >'
  html_itens +=
    '<p class="text margin-t-20" style="margin-bottom: 10px; color: #969696; font-weight: 600;">Tipo</p>'
  html_itens +=
    '<select class="form-control required" name="type-' +
    itens_job +
    '" style="font-size: 14px; background-color: #fff;">'
  html_itens += '<option></option>'
  html_itens += '<option value="receita">Receita</option>'
  html_itens += '<option value="despesa">Despesa</option>'
  html_itens += '</select>'
  html_itens +=
    '<p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Data</p>'
  html_itens += '<div class="input-date">'
  html_itens += '<div class="icon ion-android-calendar arrow"></div>'
  html_itens +=
    '<input type="text" class="form-control add-date required" name="date-' +
    itens_job +
    '" value="' +
    dateInput +
    '" style="cursor: pointer;">'
  html_itens += '<div class="box-datepicker client">'
  html_itens +=
    '<div class="datepicker" data-date="<?= h($extract-date); ?>" data-id="#document-date-' +
    itens_job +
    '"></div>'
  html_itens += '</div>'
  html_itens += '</div>'
  html_itens += '</div>'

  $('#total-itens').val(itens_job)
  var element_itens = $(html_itens)
  $('#area-add-documents').append(element_itens)

  //REMOVE
  $('#remove-' + itens_job + '').on('click', function (e) {
    e.preventDefault()
    $(this).parent().remove()
    itens_job--
    $('#total-itens').val(itens_job)
  })
}
