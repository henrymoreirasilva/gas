	<div class="form-group">
		{!! Form::label('branch_id', 'Filial:', ['class' => 'col-sm-2']) !!}
		<div class="col-sm-10">
		{!! Form::select('branch_id', $branches, null, ['class' => 'form-control']) !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('client_id', 'Cliente:', ['class' => 'col-sm-2']) !!}
		<div class="col-sm-10">
		{!! Form::select('client_id', $clients, null, ['class' => 'form-control']) !!}
		</div>
	</div>
		<div class="form-group">
		{!! Form::label('seller_id', 'Vendedor:', ['class' => 'col-sm-2']) !!}
		<div class="col-sm-10">
		{!! Form::select('seller_id', $sellers, null, ['class' => 'form-control']) !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('sale_date', 'Data da venda:', ['class' => 'col-sm-2']) !!}
		<div class="col-sm-4">
		{!! Form::text('sale_date', null, ['class' => 'form-control date']) !!}
		</div>
	</div>

	<div class="form-group ">
		{!! Form::label('payment_form', 'Forma de pagamento:', ['class' => 'col-sm-2']) !!}
		<div class="col-sm-10">
		{!! Form::text('payment_form', null, ['class' => 'form-control']) !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('plots', 'Parcelas:', ['class' => 'col-sm-2']) !!}
		<div class="col-sm-2">
		{!! Form::text('plots', null, ['class' => 'form-control money']) !!}
		</div>
	</div>
	
	<div class="form-group">
		{!! Form::label('situation', 'Situação:', ['class' => 'col-sm-2']) !!}
		<div class="col-sm-4">
		{!! Form::select('situation', [1=>'Ativo',  0 => 'Cancelado'], null, ['class' => 'form-control']) !!}
		</div>
	</div>
	<p></p>
	<h4>ITENS</h4>
	<div class="form-group">
    	<label for="product_id" class="col-sm-2">Itens:</label>
    	<div class="col-sm-6">
    		<select class="form-control" id="product_id" name="product_id" onchange="itemSelected()">
    			<option value="" selected="selected">***</option>
    			@foreach ($products as $product)

    			<option value="{{ $product->id }}" data-price="{{ $product->sale_price }}" data-unidade="{{ $product->unidade }}">{{ $product->name }}</option>
    			@endforeach
    		</select>
    	</div>
	</div>
	<div class="form-group">
    	<label for="pesquisa-quantidade" class="col-sm-2" >Quantidade:</label>
    	<div class="col-sm-4">
    		<input class="form-control number" value="" id="pesquisa-quantidade" />
    		</div>
	</div>
	<div class="form-group">
    	<label for="pesquisa-quantidade" class="col-sm-2">Preço:</label>
    	<div class="col-sm-4">
    		<input class="form-control " value="" id="pesquisa-preco" />
    		</div>
		<button class="btn btn-primary" type="button" id="bt-add-item" onclick="addItem()">Adicionar</button>
	</div>
	<table class="table">
		<thead>
			<tr><th>Item</th><th>Qtd.</th><th>Preço</th><th>Valor</th><th>&nbsp;</th></tr>
		</thead>
		<tbody id="items-list">
			<?php 
			$index = 1;
			$totalPedido = .0;
			if (isset($items)) {
    			foreach ($items as $item) {
    			    echo '<tr id="tr-'. $index. '">
                				<td class="col-sm-4">'. $item->product->name. '<input type="hidden" name="item['. $index. '][id-item]" value="'. $item->product_id. '" /></td>
                                <td><input type="text" id="qtd-'. $index. '" value="'. (int)$item->quantity. '" class="form-control number" name="item['. $index. '][qtd-item]" onchange="calcPreco('. $index. ')"  /></td>
                                <td><input type="text" id="price-'. $index. '" value="'. number_format($item->price, 2, '.', ','). '" class="form-control money" name="item['. $index. '][price-item]" onchange="calcPreco('. $index. ')" /></td>
                                <td class="item-total money col-sm-3" id="total-'. $index. '">'. number_format($item->quantity * $item->price, 2, '.', ','). '</td><td><button type="button" class="btn btn-danger btn-sm" onclick="removeItem('. $index. ')">X</button></td>
                			</tr>';
    			    $index++;
    			    $totalPedido += ($item->quantity * $item->price);
    			}
			}
			?>

		</tbody>
		<tfoot>
			<tr><td colspan="3"><h4>TOTAL</h4></td><td  colspan="2" ><h4 id="td-total" class="money"><?=number_format($totalPedido, 2, '.', ',')?></h4></td></tr>
		</tfoot>
	</table>
	
	<div>
		{!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
		<a href="javascript:history.back()" class="btn btn-default">Voltar</a>
	</div>
	<p></p>
	<script>
		var index = <?=$index++?>;
		function itemSelected() {
			var price = $('#product_id option:selected').data('price');
			$('#pesquisa-preco').val(price.toFixed(2));
		}
		function addItem() {
			//var index = $('#items-list tr').length + 1;
			var id = $('#product_id').val();
			var qt = Number($('#pesquisa-quantidade').val());
			var vl = Number($('#pesquisa-preco').val());

			var html = '<tr id="tr-' + index + '">';
			html += '<td class="col-sm-4">' + $('#product_id option:selected').text() + '<input type="hidden" name="item[' + index + '][id-item]" value="' + id + '" /></td>';
			html += '<td><input size="5" type="text" id="qtd-' + index + '" value="' + qt + '" class="form-control number" name="item[' + index + '][qtd-item]" onchange="calcPreco(' + index + ')"  /></td>';
			html += '<td><input type="text" id="price-' + index + '" value="' + vl.toFixed(2) + '" class="form-control money" name="item[' + index + '][price-item]" onchange="calcPreco(' + index + ')" /></td>';
			html += '<td class="item-total money col-sm-3" id="total-' + index + '">' + (qt * vl).toFixed(2) + '</td><td><button type="button" class="btn btn-danger btn-sm" onclick="removeItem(' + index + ')">X</button></td></tr>';

			$('#items-list').append(html);

			calcTotal();

			index++;
			
		}
		function calcPreco(i) {


				var trQtd = $('#qtd-' + i).val();
				var trPr = $('#price-' + i).val();
				trPr = trPr.replace(".", "");
				trPr = trPr.replace(",", ".");
				
				$('#total-' + i).text((trQtd * trPr).toFixed(2));

				calcTotal();

		}
		function calcTotal() {
			var valorTotalPedido = 0;
			$('.item-total').each(function() {
				var totalProduto = $(this).text();
				console.log(totalProduto);

				if (totalProduto.indexOf(",") != -1) {
    				totalProduto = totalProduto.replace(".", "");
    				totalProduto = totalProduto.replace(",", ".");
				}

				valorTotalPedido += Number(totalProduto);
			});
			$('#td-total').text(valorTotalPedido.toFixed(2));
		}
		function removeItem(i) {
			$('#tr-' + i).remove();
			calcTotal();
		}
		
	</script>