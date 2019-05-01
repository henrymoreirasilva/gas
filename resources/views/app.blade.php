<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>GAVA GÁS</title>

<link
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"
	rel="stylesheet">

<!-- Fonts -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,300'
	rel='stylesheet' type='text/css'>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed"
					data-toggle="collapse" data-target="#navbar">
					<span class="sr-only">Alternar navegação</span> <span
						class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">GAVA GÁS</a>
			</div>

			<div class="collapse navbar-collapse" id="navbar">
				@if (Auth::user())
				<ul class="nav navbar-nav">
					<li><a href="{{ route('admin.branches.index') }}">Filiais</a></li>
					<li><a href="{{ route('admin.clients.index') }}">Clientes</a></li>
					<li><a href="{{ route('admin.sellers.index') }}">Vendedores</a></li>
					<li><a href="{{ route('admin.products.index') }}">Produtos</a></li>
					<li><a href="{{ route('admin.sales.index') }}">Vendas</a></li>
					@if (Auth::user()->role == 'admin')
					<li><a href="{{ route('admin.users.index') }}">Usuários</a></li>
					@endif
				</ul>
				@endif
				<ul class="nav navbar-nav navbar-right">
					@if(auth()->guest()) @if(!Request::is('auth/login'))
					<li><a href="{{ url('/auth/login') }}">Login</a></li> @endif
					@if(!Request::is('auth/register'))
					<li><a href="{{ url('/auth/register') }}">Cadastrar</a></li> @endif
					@else
					<li class="dropdown"><a href="#" class="dropdown-toggle"
						data-toggle="dropdown" role="button" aria-expanded="false">{{
							auth()->user()->name }} <span class="caret"></span>
					</a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="{{ url('/auth/logout') }}">Sair</a></li>
						</ul></li> @endif
				</ul>
			</div>
		</div>
	</nav>

	@yield('content')

	<!-- Scripts -->
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
	<script type="text/javascript">
    $(document).ready(function(){
    	
        $('.small-number').mask('0000');
        $('.number').mask('000.000.000', {reverse: true});
        //$('.cpf-cnpj').mask('000.000.000-00', {reverse: true});
        //$('.cnpj').mask('00.000.000/0000-00', {reverse: true});
        $('.money').mask("#.##0,00", {reverse: true});
        $('.zip-code').mask('00000-000');
        $('.date').mask('99/99/9999');
        $('.cnpj').mask('00.000.000/0000-00');
    
        var maskPhone = function (val) {
        	return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
        },
        options = {onKeyPress: function(val, e, field, options) {
        		field.mask(maskPhone.apply({}, arguments), options);
        	}
        };
        $('.phone').mask(maskPhone, options);

        var maskCpfCnpj = function (val) {
        	return val.replace(/\D/g, '').length === 14 ? '00.000.000/0000-00' : '000.000.000-00999';
        },
        optionsCpf = {onKeyPress: function(val, e, field, options) {
        		field.mask(maskCpfCnpj.apply({}, arguments), optionsCpf);
        	}
        };
        $('.cpf-cnpj').mask(maskCpfCnpj, optionsCpf);

        // picture da data no form de vendas
        $( "#sale_date" ).datepicker({ dateFormat: 'dd/mm/yy' });

        // desabilitar ENTER nos forms
        $('form input').keypress(function(e) {
 
            if ((e.keyCode == 10)||(e.keyCode == 13)) {
                e.preventDefault();
            }
        });

		// Autocomplete de clientes
        /*$( "#client_id2" ).autocomplete({
            source: function( request, response ) {
                $.ajax( {
                  url: "/admin/clients/get-clients/" + $('#client_id2').val(),
                  dataType: "jsonp",
                  success: function( data ) {
                    response( data );
                  }
                } );
              },
            minLength: 3,
            select: function( event, ui ) {
              console.log( "Selected: " + ui.item.value + " aka " + ui.item.id );
            }
          });*/

       /*$('#client_id2').typeahead({
    	    source:  function (query, process) {
            return $.get("/admin/clients/get-clients/" + $('#client_id2').val(), function (data) {
            		console.log(data);
            		data = $.parseJSON(data);
    	            return process(data);
    	        });
    	    }
    	});*/

    });

    
    </script>
    <style>
    .money, .number, .small-number {text-align:right}
    </style>
</body>
</html>
