function simulation(type) {

    var form_custo, form_socios, form_funcionarios, form_faturamento, form_software, form_package, prices = {
        mei : 350.00,
        empregado : 350.00,
        liberal : 499.00,
        simples_s : 499.99,
        simples_c : 720.99,
        simples_sc : 998.99,
        simples_ind : 998.99,
    
        lucro_s : 998.99,
        lucro_c : 998.99,
        lucro_sc : 998.99,
        lucro_ind : 998.99,
    
        inativa: 350.00
    },
        total_pessoal = 0,
        total_extra = 0,
        software = 0,
        mensalidade = 0,
        custo = 0,
        custo_elink = 0,
        economia = 0,
        result_percent = 0;

        
        total_extra_socios = 0,
        total_extra_func = 0,
        total_extra = 0,
        form_custo = 0,
        form_package = $("#form-package").val(),
        // form_custo = $("#form-custo").val(),
        form_socios = $("#form-socios").val(),
        form_funcionarios = $("#form-funcionarios").val(),
        form_faturamento = $("#form-faturamento").val(),
        // form_software = $("#form-software").val(),
        // form_custo = form_custo.substr(2, 99),
        // form_custo = form_custo.replace(".", ""),
        // form_custo = eval(form_custo.replace(",", ".")),
        // form_software = form_software.substr(2, 99),
        // form_software = form_software.replace(".", ""),
        // form_software = eval(form_software.replace(",", ".")),
        total_pessoal_socios = eval(form_socios),
        total_pessoal_func = eval(form_funcionarios),
    
        total_pessoal = total_pessoal_socios + total_pessoal_func,
    
        total_pessoal > 5 && (
            total_extra = 60 * (total_pessoal - 5)
        ),
    
        // total_pessoal_socios > 2 && (
        //   total_extra_socios = 60 * (total_pessoal_socios - 2)
        // ),
        // total_pessoal_func > 6 && (
        //   total_extra_func = 60 * (total_pessoal_func - 6)
        // ),
    
        // total_extra = total_extra_func + total_extra_socios,
    
        form_package === "premium" && (
          total_extra = total_extra + 150
        ),
        "1" === form_faturamento ? (
          mensalidade = prices[type] + total_extra, mensalidade = mensalidade.toFixed(2)
        ) :
          (
            mensalidade = prices[type] + 200 * (eval(form_faturamento) - 1) + total_extra,
            mensalidade = mensalidade.toFixed(2)
          ),
    
        // custo = 12 * form_custo + 12 * form_software,
        // custo = custo.toFixed(2),
        custo_elink = 12 * mensalidade,
        custo_elink = custo_elink.toFixed(2),
        // custo_mensal = form_custo + form_software,
        // custo_mensal = custo_mensal.toFixed(2),
        economia = custo - eval(12 * mensalidade),
        economia = economia.toFixed(2),
        result_percent = economia / custo * 100,
        mensalidade = mensalidade.replace(".", ","),
        // custo = custo.replace(".", ","),
        custo_elink = custo_elink.replace(".", ","),
        // custo_mensal = custo_mensal.replace(".", ","),
        economia = economia.replace(".", ","),
        $("#result-economia").html("R$ " + economia),
        $("#result-mensalidade").html("R$ " + mensalidade),
        $("#result-percent").html(result_percent.toFixed(0) + "%"),
        $("#result-custo").html("R$ " + custo_elink),
        // $("#result-custo-mensal").html("R$ " + custo_mensal),
    
        "0,00" !== form_custo && 0 !== form_custo && void 0 !== form_custo || (
          $("#result-economia").html("R$ 0,00"),
          $("#result-custo-mensal").html("R$ 0,00"),
          $("#result-percent").html("0%")
        ),
    
        form_custo = form_custo.toFixed(2),
        form_custo = form_custo.replace(".", ","),
        $("#compare-anual").html("R$ " + custo)
    }
    searchCitys = function() {
        $.ajax({
            url: "/api/contract/search-citys",
            data: $("#simulation-abertura").serialize(),
            type: "POST",
            dataType: "json",
            beforeSend: function() {},
            complete: function() {},
            success: function(o) {
                if ("ok" == o.result.status) {
                    $("#abertura-cidade").find("option").remove();
                    var a = o.result.citys;
                    for (i = 0; i < a.length; i++) $("#abertura-cidade").append('<option value="' + a[i].id + '">' + a[i].titulo + "</option>");
                    setTimeout(function() {
                        searchAbertura()
                    }, 1e3)
                }
            }
        })
    }, searchAbertura = function() {
        $.ajax({
            url: "/api/contract/search-abertura",
            data: $("#simulation-abertura").serialize(),
            type: "POST",
            dataType: "json",
            beforeSend: function() {},
            complete: function() {},
            success: function(o) {
                if ("ok" == o.result.status) {
                    if(o.result.receita > 0){
                        $("#taxa-receita").html("R$ " + o.result.receita.toFixed(2).replace(".", ","));
                    }else{
                        $("#taxa-receita").html("-");
                        $("#modal-alert-taxas").modal('show');
                        // alert("OPs! Esse estado ainda não está sendo atendido pela Juscontábil, deixe seu e-mail que nossos especialistas entrarão em contato em breve.");
                    }
    
                    if(o.result.prefeitura > 0){
                        $("#taxa-prefeitura").html("R$ " + o.result.prefeitura.toFixed(2).replace(".", ","));
                    }else{
                        $("#taxa-prefeitura").html("-");
                    }
                }
            }
        })
    }, $(function() {
        //searchAbertura(), 
        $("#abertura-estado").change(function() {
            searchCitys()
        }), $("#abertura-cidade, #abertura-socios").change(function() {
            searchAbertura()
        }), "mei" === $("#form-type").val() || "liberal" === $("#form-type").val() || "empregado" === $("#form-type").val() || "inativa" === $("#form-type").val() ? simulation($("#form-type").val()) : simulation("simples_" + $("#form-type").val()), $("#form-custo").maskMoney({
            prefix: "R$ ",
            allowNegative: !0,
            thousands: ".",
            decimal: ",",
            affixesStay: !0
        }), $("#form-software").maskMoney({
            prefix: "R$ ",
            allowNegative: !0,
            thousands: ".",
            decimal: ",",
            affixesStay: !0
        }), $(".simulation .box-simulation .type").click(function() {
            $(".simulation .box-simulation .type").removeClass("active"),
            $(this).addClass("active"),
            "real" === $(this).data("type") ? ($("#result-mensalidade").html("Sob consulta"), $("#text-month").css("visibility", "hidden")) : (simulation($(this).data("type") + "_" + $("#form-type").val()), $("#area-simulation").css("display", "block"), $("#area-lucro-real").css("display", "none"));
        }), $("#form-socios, #form-funcionarios, #form-faturamento").change(function() {
            var o = "";
            if("real" === $(".simulation .box-simulation .active").data("type")) { 
                ($("#result-mensalidade").html("Sob consulta"), $("#text-month").css("visibility", "hidden")) 
            }else{
                "mei" === $("#form-type").val() || "liberal" === $("#form-type").val() || "empregado" === $("#form-type").val() || "inativa" === $("#form-type").val() ? o = $("#form-type").val() : $(".box-simulation .type").each(function() {
                    $(this).hasClass("active") && (o = $(this).data("type") + "_" + $("#form-type").val())
                }), simulation(o)
            }

            }), $("#form-custo, #form-software").bind("keyup", function(o) {
            var a = "";
            "mei" === $("#form-type").val() || "liberal" === $("#form-type").val() || "empregado" === $("#form-type").val() ? a = $("#form-type").val() : $(".box-simulation .type").each(function() {
                $(this).hasClass("active") && (a = $(this).data("type") + "_" + $("#form-type").val())
                if("real" === $(".simulation .box-simulation .active").data("type")) { ($("#result-mensalidade").html("Sob consulta"), $("#text-month").css("visibility", "hidden")) }
            }), simulation(a)
        }), $("#form-type").change(function() {
            "mei" === $(this).val() || "liberal" === $(this).val() || "empregado" === $(this).val() || "inativa" === $(this).val() ? ($("#form-socios").css("display", "none"), $("#text-socios").css("display", "none"), $("#form-funcionarios").css("display", "block"), $("#text-funcionarios").css("display", "block"), $("#form-funcionarios").val("0"), $("#form-funcionarios").attr("max", "1"), "mei" === $(this).val() || "empregado" === $(this).val() ? ($(".type").css("display", "none"), $("#form-funcionarios").css("display", "none"), $("#text-funcionarios").css("display", "none"), $("#form-funcionarios").val("0"), $("#text-faturamento-5k").css("display", "block"), $("#form-faturamento").css("display", "none"), $("#form-faturamento").val("1"), simulation($(this).val())) : ($(".type").css("display", "none"), $("#text-faturamento-5k").css("display", "none"), $("#form-faturamento").css("display", "block"), simulation($(this).val())), "mei" === $(this).val() && ($("#form-funcionarios").css("display", "block"), $("#text-funcionarios").css("display", "block"), $("#form-funcionarios").attr("max", "1")), "liberal" === $(this).val() && ($("#form-funcionarios").css("display", "block"), $("#text-funcionarios").css("display", "block"), $("#form-funcionarios").attr("max", "999"))) : ($("#text-socios").css("display", "block"), $("#form-socios").css("display", "block"), $("#text-funcionarios").css("display", "block"), $("#form-funcionarios").css("display", "block"), $("#form-funcionarios").val("0"), $("#form-funcionarios").attr("max", "999"), $(".type").css("display", "block"), $("#text-faturamento-5k").css("display", "none"), $("#form-faturamento").css("display", "block"), simulation("simples_" + $(this).val()))
            if("real" === $(".simulation .box-simulation .active").data("type")) { ($("#result-mensalidade").html("Sob consulta"), $("#text-month").css("visibility", "hidden")) }
        }), $("#form-package").change(function() {
            var a = "";
            "mei" === $("#form-type").val() || "liberal" === $("#form-type").val() || "empregado" === $("#form-type").val() ? a = $("#form-type").val() : $(".box-simulation .type").each(function() {
                $(this).hasClass("active") && (a = $(this).data("type") + "_" + $("#form-type").val())
                if("real" === $(".simulation .box-simulation .active").data("type")) { ($("#result-mensalidade").html("Sob consulta"), $("#text-month").css("visibility", "hidden")) }
            }), simulation(a)
        })
    });

    
$(document).ready(function () {

    $("#calculadora-consultiva").hide();
    $("#calculadora-digital").hide();

    $("#btn-calculadora-consultiva").click(function () {
        $("#calculadora-consultiva").show();
        $("#calculadora-digital").hide();
        $("#result-mensalidade").html("R$ 499,99");
    
    });

    $("#btn-calculadora-digital").click(function () {
        $("#calculadora-digital").show();
        $("#calculadora-consultiva").hide();
        $("#result-mensalidade-digital").html("R$ 450,00");
    });

    function simulationDigital(type) {

        var form_custo, form_socios, form_funcionarios, form_faturamento, form_software, form_package, prices = {
            mei : 350.00,
            empregado : 350.00,
            liberal : 450.00,
            simples_s : 450.00,
            simples_c : 670.00,
            simples_sc : 948.00,
            simples_ind : 998.00,
        
            lucro_s : 948.00,
            lucro_c : 948.00,
            lucro_sc : 948.00,
            lucro_ind : 1045.00,
        
            inativa: 350.00
            },
            total_pessoal = 0,
            total_extra = 0,
            mensalidade = 0,
            custo = 0,
            custo_elink = 0,
            economia = 0,
            result_percent = 0;
    
                
            total_extra_socios = 0,
            total_extra_func = 0,
            total_extra = 0,
            form_custo = 0,
            form_package = $("#form-package-digital").val(),
            form_socios = $("#form-socios-digital").val(),
            form_funcionarios = $("#form-funcionarios-digital").val(),
            form_faturamento = $("#form-faturamento-digital").val(),
            total_pessoal_socios = eval(form_socios),
            total_pessoal_func = eval(form_funcionarios),
        
            total_pessoal = total_pessoal_socios + total_pessoal_func,
        
            total_pessoal > 5 && (
                total_extra = 60 * (total_pessoal - 5)
            ),
        
            form_package === "premium" && (
              total_extra = total_extra + 150
            ),
            "1" === form_faturamento ? ( 
                mensalidade = prices[type] + total_extra, mensalidade = mensalidade.toFixed(2)
            ) :
              (
                mensalidade = prices[type] + 200 * (eval(form_faturamento) - 1) + total_extra,
                mensalidade = mensalidade.toFixed(2)
              ),
            custo_elink = 12 * mensalidade,
            custo_elink = custo_elink.toFixed(2),
            economia = custo - eval(12 * mensalidade),
            economia = economia.toFixed(2),
            result_percent = economia / custo * 100,
            mensalidade = mensalidade.replace(".", ","),
            custo_elink = custo_elink.replace(".", ","),
            economia = economia.replace(".", ","),
            $("#result-economia-digital").html("R$ " + economia),
            $("#result-mensalidade-digital").html("R$ " + mensalidade),
            $("#result-percent-digital").html(result_percent.toFixed(0) + "%"),
            $("#result-custo-digital").html("R$ " + custo_elink),
        
            "0,00" !== form_custo && 0 !== form_custo && void 0 !== form_custo || (
              $("#result-economia-digital").html("R$ 0,00"),
              $("#result-custo-mensal-digital").html("R$ 0,00"),
              $("#result-percent-digital").html("0%")
            ),
        
            form_custo = form_custo.toFixed(2),
            form_custo = form_custo.replace(".", ","),
            $("#compare-anual-digital").html("R$ " + custo)
        } 
        $(function() {
            "mei" === $("#form-type-digital").val() || "liberal" === $("#form-type-digital").val() || "empregado" === $("#form-type-digital").val() || "inativa" === $("#form-type-digital").val() ? simulationDigital($("#form-type-digital").val()) : simulationDigital("simples_" + $("#form-type-digital").val()), $("#form-custo-digital").maskMoney({
                prefix: "R$ ",
                allowNegative: !0,
                thousands: ".",
                decimal: ",",
                affixesStay: !0
            }), 
            $("#form-software-digital").maskMoney({
                prefix: "R$ ",
                allowNegative: !0,
                thousands: ".",
                decimal: ",",
                affixesStay: !0
            }), 
            $(".simulation-digital .box-simulation-digital .type").click(function() {
                $(".simulation-digital .box-simulation-digital .type").removeClass("active"),
                $(this).addClass("active"),
                "real" === $(this).data("type") ? ($("#result-mensalidade-digital").html("Sob consulta"), $("#text-month-digital").css("visibility", "hidden")) : (simulationDigital($(this).data("type") + "_" + $("#form-type-digital").val()), $("#text-month-digital").css("visibility", "visible"));
            }), 
            $("#form-socios-digital, #form-funcionarios-digital, #form-faturamento-digital").change(function() {
                var o = "";
                "mei" === $("#form-type-digital").val() || "liberal" === $("#form-type-digital").val() || "empregado" === $("#form-type-digital").val() || "inativa" === $("#form-type-digital").val() ? o = $("#form-type-digital").val() : $(".box-simulation-digital .type").each(function() {
                    $(this).hasClass("active") && (o = $(this).data("type") + "_" + $("#form-type-digital").val())
                }), simulationDigital(o)
            }), 
            $("#form-custo, #form-software").bind("keyup", function(o) {
                var a = "";
                "mei" === $("#form-type-digital").val() || "liberal" === $("#form-type-digital").val() || "empregado" === $("#form-type-digital").val() ? a = $("#form-type-digital").val() : $(".box-simulation-digital .type").each(function() {
                    $(this).hasClass("active") && (a = $(this).data("type") + "_" + $("#form-type-digital").val())
                }), simulationDigital(a)
            }), $("#form-type-digital").change(function() {
                if("real" === $(".simulation-digital .box-simulation-digital .active").data("type")) {
                    "mei" === $(this).val() || "liberal" === $(this).val() || "empregado" === $(this).val() || "inativa" === $(this).val() ? ($("#form-socios-digital").css("display", "none"), $("#text-socios-digital").css("display", "none"), $("#form-funcionarios-digital").css("display", "block"), $("#text-funcionarios-digital").css("display", "block"), $("#form-funcionarios-digital").val("0"), $("#form-funcionarios-digital").attr("max", "1"), "mei" === $(this).val() || "empregado" === $(this).val() ? ($(".type").css("display", "none"), $("#form-funcionarios-digital").css("display", "none"), $("#text-funcionarios-digital").css("display", "none"), $("#form-funcionarios-digital").val("0"), $("#text-faturamento-5k-digital").css("display", "block"), $("#form-faturamento-digital").css("display", "none"), $("#form-faturamento-digital").val("1"), simulationDigital($(this).val())) : ($(".type").css("display", "none"), $("#text-faturamento-5k-digital").css("display", "none"), $("#form-faturamento-digital").css("display", "block"), simulationDigital($(this).val())), "mei" === $(this).val() && ($("#form-funcionarios-digital").css("display", "block"), $("#text-funcionarios-digital").css("display", "block"), $("#form-funcionarios-digital").attr("max", "1")), "liberal" === $(this).val() && ($("#form-funcionarios-digital").css("display", "block"), $("#text-funcionarios-digital").css("display", "block"), $("#form-funcionarios-digital").attr("max", "999"))) : ($("#text-socios-digital").css("display", "block"), $("#form-socios-digital").css("display", "block"), $("#text-funcionarios-digital").css("display", "block"), $("#form-funcionarios-digital").css("display", "block"), $("#form-funcionarios-digital").val("0"), $("#form-funcionarios-digital").attr("max", "999"), $(".type").css("display", "block"), $("#text-faturamento-5k-digital").css("display", "none"), $("#form-faturamento-digital").css("display", "block"), simulationDigital("simples_" + $(this).val()))
                }
                
                if("real" === $(".simulation-digital .box-simulation-digital .active").data("type")) {
                    $("#result-mensalidade-digital").html("Sob consulta"), $("#text-month-digital").css("visibility", "hidden")
                }
        
            }), $("#form-package-digital").change(function() {
                var a = "";
                "mei" === $("#form-type-digital").val() || "liberal" === $("#form-type-digital").val() || "empregado" === $("#form-type-digital").val() ? a = $("#form-type-digital").val() : $(".box-simulation-digital .type").each(function() {
                    $(this).hasClass("active") && (a = $(this).data("type") + "_" + $("#form-type-digital").val())
                }), simulationDigital(a)
                if("real" === $(".simulation-digital .box-simulation-digital .active").data("type")) {
                    $("#result-mensalidade-digital").html("Sob consulta"), $("#text-month-digital").css("visibility", "hidden")
                }
            })
        
        });
});