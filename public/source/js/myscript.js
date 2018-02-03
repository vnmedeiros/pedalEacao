//escrito por vinicius nunes mederios
//email vnicius.nm.ba@gmail.com
//para o site pedaleacao.com.br
/*************************************************
**************************************************
**************************************************
**************************************************
**************************************************
**************************************************
**************************************************
**************************************************
**************************************************
**************************************************
**************************************************/
$(function() {
    $( "#slider-range" ).slider({
      range: true,
      min: 0,
      max: 1000000,
      values: [ 500000, 1000000 ],
      slide: function( event, ui ) {
        $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
      }
    });
    $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
      " - $" + $( "#slider-range" ).slider( "values", 1 ) );
  });

	var container = $('.grid').isotope({
		itemSelector: '.col-xs-12',
		getSortData: {
			name: '.name',
			price: '.price parseInt'
		}
	});
	$('.alphSort').on('click', function(e){
		e.preventDefault();
		container.isotope({ sortBy: 'name'});
	});
	$('.prcBtnH').on('click', function(e){
		e.preventDefault();
		container.isotope({ sortBy: 'price', sortAscending: false});
	});
	$('.prcBtnL').on('click', function(e){
		e.preventDefault();
		container.isotope({ sortBy: 'price', sortAscending: true});
	});
	$('.prcBtnR').on('click',function(e){
		e.preventDefault();
		container.isotope({sortBy:'random'});
	});
	$('.prcBtnO').on('click',function(e){
		e.preventDefault();
		container.isotope({sortBy:'original-order'});
	});

$('#btnRM').click(function(){
    $('#readmore').animate({height:'322px'}, 500);
});
$('#btnRL').click(function(){
	$('#readmore').animate({height:'0px'}, 500);
});
$('#btnRM2').click(function(){
    $('#readmore2').animate({height:'322px'}, 500);
});
$('#btnRL2').click(function(){
	$('#readmore2').animate({height:'0px'}, 500);
});

	$(function () {
  $("#mydd a").on('click',function (e) {
  	e.preventDefault();
    $("#dropdownMenu1").html($(this).html() + ' <span class="downicon"></span>');
  });
});

$(function () {
  $("#mydd2 a").on('click',function (e) {
  	e.preventDefault();
    $("#dropdownMenu2").html($(this).html() + ' <span class="downicon"></span>');
  });
});
$(function () {
  $("#mydd3 a").on('click',function (e) {
  	e.preventDefault();
    $("#dropdownMenu3").html($(this).html() + ' <span class="downicon"></span>');
  });
});


$(document).ready(function () {
    $('.date').mask('00/00/0000');
    $('.cep').mask('00000-000');
    $('.phone').mask('(00) 00000-0009');
    $('.cpf').mask('000.000.000-00', {reverse: true});
    
    //Initialize tooltips
    $('.nav-tabs > li a[title]').tooltip();
    
    //Wizard
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
        var $target = $(e.target);
    
        if ($target.parent().hasClass('disabled')) {
            return false;
        }
    });
    
    $('form[data-async]#form-cadastro').on('submit', function(event) {
        var $form = $(this);
        $(".loading-panel").css('visibility', 'visible');        

        $.ajax({
            type: $form.attr('method'),
            url: $form.attr('action'),
            data: $form.serialize(),

            success: function(data, status) {
				if (data.success) {
					getCategorias(idEvento);
					var $active = $('.wizard .nav-tabs li.active');
					$active.next().removeClass('disabled');
					nextTab($active);
                    $('input#idEvento_cat').val(idEvento);
                    $('input#idCadastro_cat').val(data.cadastro.id);
					$(".loading-panel").css('visibility', 'hidden');
                } else {
					
				}
            }
        });
        event.preventDefault();
    });
    
    $('form[data-async]#form-cadastroCategoria').on('submit', function(event) {
        var $form = $(this);
        $(".loading-panel").css('visibility', 'visible');
        $.ajax({
            type: $form.attr('method'),
            url: $form.attr('action'),
            data: $form.serialize(),

            success: function(data, status) {
				if (data.success) {					
					var $active = $('.wizard .nav-tabs li.active');
					$active.next().removeClass('disabled');
					nextTab($active);
                    preparamentPagSeguro(data);
                    $('#idInscricao').val(data.inscricao.id);					
                } else {
					
				}
            }
        });
        event.preventDefault();
        
    });
    
    $('form[data-async]#form-finalizarIscricao').on('submit', function(event) {
        var $form = $(this);
        $(".loading-panel").css('visibility', 'visible');
        $.ajax({
            type: $form.attr('method'),
            url: $form.attr('action'),
            data: $form.serialize(),
            success: function(data, status) {
				if (data.success) {
                    $('#conteudoFormFinalizarInscricao').empty();
                    
                    //+ data.response.sender.documents.type + ': <b>' + data.response.sender.documents.value + '</b> <br/>' 
                    var op = 'nome: <b>' + data.response.sender.name + '</b> <br />'                              
                             + 'endereço: <br /><b>' 
                                + data.response.shipping.address.street +' <br/>' 
                                + data.response.shipping.address.district + ' <br />' 
                                + data.response.shipping.address.city + " - " + data.response.shipping.address.country + ' <br /> ' 
                                + data.response.shipping.address.postalCode + ' <br /> <br />' 
                                + '</b><a target="_blank" href="'+ data.response.paymentLink +'">Gerar Boloeto</a>';
                    
                    $('#conteudoFormFinalizarInscricao').prepend(op);
                    var $tabs = $('.wizard .nav-tabs li');
                    $tabs.removeClass('active');
                    $tabs.addClass('disabled');
                    $(".loading-panel").css('visibility', 'hidden');
                } else {
					
				}
            }
        });
        event.preventDefault();
    });
    
    $('input#cpf').change(function () {
        $(".loading-panel").css('visibility', 'visible');
		$.ajax({url: "./public/API/cadastros/cpf/" + $(this).val() , success: function(result) {
				result = $.parseJSON(result);
            
                $('#idCadastro').val("");				
				$('#nascimento').val("");
				$('#nome').val("");
				$('#email').val("");
				$('#celular').val("");
				$('#logradouro').val("");
				$('#bairro').val("");
				$('#cep').val("");
				$('#cidade').val("");
				$('#UF').val("");
            
				if ( result.id != -1 && result.id != null ) {
					$('#idCadastro').val(result.id);
					$('#cpf').val(result.CPF);
					$('#nascimento').val(result.nascimento);
					$('#nome').val(result.nome);
					$('#email').val(result.email);
					$('#celular').val(result.celular);
					$('#logradouro').val(result.logradouro);
					$('#bairro').val(result.bairro);
					$('#cep').val(result.cep);
					$('#cidade').val(result.cidade);
					$('#UF').val(result.UF);
				}
				$('#form-cadastro input[disabled]').prop('disabled', function(i, v) { return !v; });
				$('#form-cadastro #UF').prop('disabled', function(i, v) { return !v; });
                $(".loading-panel").css('visibility', 'hidden');
                $('#nascimento').focus();
			}
		});
	});
	

    /*$(".salvarCadastro").click(function (e) {
        var $active = $('.wizard .nav-tabs li.active');
        $active.next().removeClass('disabled');
        nextTab($active);

    });*/
    
    $(".prev-step").click(function (e) {

        var $active = $('.wizard .nav-tabs li.active');
        prevTab($active);

    });
});


function preparamentPagSeguro(data) {
    urlSession = "./public/API/getSessionPagSeguro";    
    $.ajax({
        type: "GET",
        url: urlSession,         
        success: function(result) {
            xmlDoc = $.parseXML( result ), $xml = $(xmlDoc), $idSession = $xml.find( "id" ).text();
            PagSeguroDirectPayment.setSessionId($idSession);            
            $('#SenderHash').val(PagSeguroDirectPayment.getSenderHash());
            PagSeguroDirectPayment.getPaymentMethods({                
                success: function(response) {
                    $('#formaPagamento').empty();
                    var op = '<label><input type="radio" name="boleto" value="boleto" checked="checked"/><img src="https://stc.pagseguro.uol.com.br'+response.paymentMethods.BOLETO.options.BOLETO.images.MEDIUM.path+'"></label>';
                    $('#formaPagamento').prepend(op);
                    $(".loading-panel").css('visibility', 'hidden');
                },
                error: function(response) {
                },
                complete: function(response) {
                }
            });
        }
    });
}

function nextTab(elem) {
    $(elem).next().find('a[data-toggle="tab"]').click();
}
function prevTab(elem) {
    $(elem).prev().find('a[data-toggle="tab"]').click();
}
function getCategorias(idEvento) {
	$.ajax({url: "./public/API/evento/categorias/" + idEvento, success: function(result) {
		//$('#selectCategoria').empty();
        $.each($.parseJSON(result), function(i, item) {            
			$('#selectCategoria').append($('<option>', {
				value: item.id,
				text: item.descricao
			}));
		});        
    }});
}
