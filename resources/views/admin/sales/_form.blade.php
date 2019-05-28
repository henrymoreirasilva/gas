<div class="form-group ">
    {!! Form::label('client_id', 'Cliente', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-3">
        <div class="input-group">
            {!! Form::text('client_id', null, ['class' => 'form-control number', 'onchange' => 'getClient(this.value)',  'autofocus', 'tabindex' => 1, 'style' => 'z-index:0']) !!}

            <span class="input-group-btn" style="z-index: 0">
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal" data-whatever="clients" id="bt-clients">
                    <span class="ui-icon ui-icon-search"></span>
                    F7
                </button>
            </span>
        </div>
    </div>
    <span class="text-success" id="client_name">{{ $sale->id?$sale->client->company_name:'' }} / {{ $sale->id?$sale->client->name:'' }}</span>

</div>
<div class="form-group ">
    {!! Form::label('branch_id', 'Filial', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-3">
        {!! Form::text('branch_id', null, ['class' => 'form-control number', 'onchange' => 'getBranch(this.value)', 'readonly', 'style' => 'z-index:0']) !!}
    </div>
    <div class="col-sm-6 text-success" id="branch_name">{{ $sale->id?$sale->branch->company_name:'' }}</div>
</div>
<div class="form-group ">
    {!! Form::label('seller_id', 'Vendedor', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-3">
        <div class="input-group">
            {!! Form::text('seller_id', null, ['class' => 'form-control number', 'onchange' => 'getSeller(this.value)', 'tabindex' => 2, 'style' => 'z-index:0']) !!}

            <span class="input-group-btn" style="z-index: 0">
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal" data-whatever="sellers" id="bt-sellers">
                    <span class="ui-icon ui-icon-search"></span>
                    F8
                </button>
            </span>
        </div>
    </div>
    <div class="col-sm-6 text-success" id="seller_name">{{ $sale->id?$sale->seller->name:'' }}</div>

</div>
<div class="form-group">
    {!! Form::label('sale_date', 'Data da venda:', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-4">
        {!! Form::text('sale_date', null, ['class' => 'form-control date', 'tabindex' => 3]) !!}
    </div>
</div>

<h4>ITENS</h4>
<div class="form-group">
    <label for="item_id" class="col-sm-3" >Item:</label>
    <!--div class="col-sm-3">
        <input class="form-control number" value="" id="item_id" onchange="getProduct(this.value)" tabindex="4" />
    </div-->
    
    <div class="col-sm-3">
        <div class="input-group">

            <input class="form-control number" value="" id="item_id" onchange="getProduct(this.value)" tabindex="4"  style="z-index: 0"/>
            <span class="input-group-btn" style="z-index: 0">
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal" data-whatever="products" id="bt-products">
                    <span class="ui-icon ui-icon-search"></span>
                    F9
                </button>
            </span>
        </div>
    </div>
    
    <div class="col-sm-6 text-success" id="item_name"></div>

</div>
<div class="form-group">
    <label for="item_qtd" class="col-sm-3" >Qtd.:</label>
    <div class="col-sm-3">
        <input class="form-control number" value="" id="item_qtd" tabindex="5" />
    </div>

</div>
<div class="form-group">
    <label for="item_price" class="col-sm-3">Preço:</label>
    <div class="col-sm-4">
        <input class="form-control money" value="" id="item_price" tabindex="6" />
    </div>
    <div class="col-sm-5">
        <button class="btn btn-default" type="button" id="bt-add-item" onclick="addItem()" tabindex="7">Adicionar</button>
    </div>
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
                echo '<tr id="tr-' . $index . '">
                				<td class="col-sm-4">' . $item->product->name . '<input type="hidden" name="item[' . $index . '][id-item]" value="' . $item->product_id . '" /></td>
                                <td><input type="text" id="qtd-' . $index . '" value="' . (int) $item->quantity . '" class="form-control number" name="item[' . $index . '][qtd-item]" onchange="calcPreco(' . $index . ')"  /></td>
                                <td><input type="text" id="price-' . $index . '" value="' . number_format($item->price, 2, '.', ',') . '" class="form-control money" name="item[' . $index . '][price-item]" onchange="calcPreco(' . $index . ')" /></td>
                                <td class="item-total money col-sm-3" id="total-' . $index . '">' . number_format($item->quantity * $item->price, 2, '.', ',') . '</td><td><button type="button" class="btn btn-danger btn-sm" onclick="removeItem(' . $index . ')">X</button></td>
                			</tr>';
                $index++;
                $totalPedido += ($item->quantity * $item->price);
            }
        }
        ?>

    </tbody>
    <tfoot>
        <tr><td colspan="3"><h4>TOTAL</h4></td><td  colspan="2" ><h4 id="td-total" class="money"><?= number_format($totalPedido, 2, '.', ',') ?></h4></td></tr>
    </tfoot>
</table>
<hr />
<div class="form-group ">
    {!! Form::label('payment_form', 'Forma de pagamento:', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::text('payment_form', 'DINHEIRO', ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('situation', 'Situação:', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-4">
        {!! Form::select('situation', [1=>'Ativo',  0 => 'Cancelado'], null, ['class' => 'form-control']) !!}
    </div>
</div>
<div>

    {!! Form::submit('Salvar F10', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.sales.index') }}" class="btn btn-default">Voltar</a>
</div>
<p></p>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body">
                <iframe id="modal-content" src=""></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<script>
    var index = <?= $index++ ?>;

    // Recupera informações do item correspondente ao código.
    function getProduct(id) {
        if (id) {
            $.ajax({
                url: "/admin/products/get/" + id,
                success: function (data) {
                    if (data.length == 0) {
                        alert('Item não encontrado.');
                        $('#item_id').focus();
                    } else {
                        var sale_price = data.sale_price.toString();
                        sale_price = sale_price.replace(".", ",");
                        $('#item_name').html(data.name);
                        $('#item_qtd').val('');
                        $('#item_price').val(sale_price);
                        $('#item_qtd').focus();
                    }
                }

            });
        }
    }

    // Recupera informações da filial correspondente ao código.
    function getBranch(id) {
        if (id) {

            $.ajax({
                url: "/admin/branches/show/" + id,
                success: function (data) {
                    if (data.length == 0) {
                        alert('Filial não encontrada.');
                        $('#branch_id').focus();
                    } else {
                        var branch_company_name = data.company_name;
                        $('#branch_name').html(branch_company_name);
                        $('#seller_id').focus();
                    }
                }

            });

        }
    }

    // Recupera informações do cliente correspondente ao código.
    function getClient(id) {
        if (id) {
            $.ajax({
                url: "/admin/clients/show/" + id,
                success: function (data) {

                    var client_company_name = data.company_name;
                    var client_name = data.name;
                    $('#client_name').html(client_company_name + ' / ' + client_name);

                    $('#branch_id').val(data.branch_id);
                    getBranch(data.branch_id);

                },
                error: function () {
                    alert('Cliente não encontrado.');
                    $('#client_id').val('').focus();
                    $('#client_name').empty();
                    $('#branch_id').val('');
                    $('#branch_name').empty();
                }

            });
        }
    }

    // Recupera informações do vendedor correspondente ao código.
    function getSeller(id) {
        console.log('getseller');
        if (id) {
            $.ajax({
                url: "/admin/sellers/show/" + id + '/' + $('#branch_id').val(),
                success: function (data) {
                    if (data.length == 0) {
                        alert('Vendedor não encontrado na filial ' + $('#branch_name').html());
                        $('#seller_id').val('').focus();
                    } else {
                        var name = data[0].name;
                        $('#seller_name').html(name);
                    }
                }

            });
        }
    }

    // Adiciona item à tabela de itens da venda.
    function addItem() {
        var id = Number($('#item_id').val());
        var qt = Number($('#item_qtd').val());
        var vl = $('#item_price').val().replace(".", "");
        vl = vl.replace(",", ".");
        vl = Number(vl);

        if (isNaN(id) || isNaN(qt) || isNaN(vl)) {
            alert('Item inválido.');
            $('#item_id').focus();
            return;
        }
        if (id <= 0 || qt <= 0 || vl <= 0) {
            alert('Item não pode ser incluído.');
            $('#item_id').focus();
            return;
        }


        var html = '<tr id="tr-' + index + '">';
        html += '<td class="col-sm-4">' + $('#item_name').html() + '<input type="hidden" name="item[' + index + '][id-item]" value="' + id + '" /></td>';
        html += '<td><input size="5" type="text" id="qtd-' + index + '" value="' + qt + '" class="form-control number" name="item[' + index + '][qtd-item]" onchange="calcPreco(' + index + ')"  /></td>';
        html += '<td><input type="text" id="price-' + index + '" value="' + vl.toFixed(2) + '" class="form-control money" name="item[' + index + '][price-item]" onchange="calcPreco(' + index + ')" /></td>';
        html += '<td class="item-total money col-sm-3" id="total-' + index + '">' + (qt * vl).toFixed(2) + '</td><td><button type="button" class="btn btn-danger btn-sm" onclick="removeItem(' + index + ')">X</button></td></tr>';

        $('#items-list').append(html);

        calcTotal();

        index++;

        $('#item_name').html('');
        $('#item_qtd').val('');
        $('#item_price').val('');
        $('#item_id').val('').focus();



    }

    // Calcula total de um item.
    function calcPreco(i) {


        var trQtd = $('#qtd-' + i).val();
        var trPr = $('#price-' + i).val();
        trPr = trPr.replace(".", "");
        trPr = trPr.replace(",", ".");

        $('#total-' + i).text((trQtd * trPr).toFixed(2));

        calcTotal();

    }

    // Calcula total da venda.
    function calcTotal() {
        var valorTotalPedido = 0;
        $('.item-total').each(function () {
            var totalProduto = $(this).text();
            console.log(totalProduto);

            if (totalProduto.indexOf(",") != -1) {
                totalProduto = totalProduto.replace(".", "");
                totalProduto = totalProduto.replace(",", ".");
            }

            valorTotalPedido += Number(totalProduto);
        });
        $('#td-total').text(valorTotalPedido.toFixed(2)).mask("#.###,##", {reverse: true});
    }

    // Remove um item da venda.
    function removeItem(i) {
        $('#tr-' + i).remove();
        calcTotal();
    }

    // Valida formulário de venda.
    function valida_sale() {

        if ($('#client_id').val() == '') {
            alert('Escolha o cliente.');
            $('#client_id').focus();
            return false;
        }
        if ($('#branch_id').val() == '') {
            alert('Escolha a filial.');
            $('#branch_id').focus();
            return false;
        }
        if ($('#seller_id').val() == '') {
            alert('Escolha o vendedor.');
            $('#seller_id').focus();
            return false;
        }
        if ($('#sale_date').val() == '') {
            alert('Informe a data da venda.');
            $('#sale_date').focus();
            return false;
        }
        if ($('#payment_form').val() == '') {
            $('#payment_form').val('DINHEIRO');
        }
        if ($('.item-total').length == 0) {
            alert('Escolha os itens da venda.');
            $('#item_id').focus();
            return false;
        }
        return true;
    }
</script>