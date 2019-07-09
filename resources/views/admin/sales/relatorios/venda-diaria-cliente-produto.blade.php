@extends('app')
@section('content')
@if (empty($sales))
    <div class="container-fluid">


        <h4>Vendas: Cliente - Produto</h4>
        <br />
        <form class="clearfix" id="expressao-form" action="{{ route('admin.sales.relatorios.venda-diaria-cliente-produto') }}" method="get">
            <div class="form-group col-sm-2">
                <label for="date1">Data inicial</label>
                <input type="text" class="form-control date" id="date1" name="date1" value="{{ $data['date1'] }}" >
            </div>
            <div class="form-group col-sm-2">
                <label for="date2">Data final</label>
                <input type="text" class="form-control date" id="date2" name="date2" value="{{ $data['date2'] }}" >
            </div>
            <div class="form-group col-sm-2">
                <label for="branch_id">Filial:</label>

                {!! Form::select('branch_id', $branches, null, ['class' => 'form-control']) !!}

            </div>
            <div class="form-group col-sm-2">
                <label for="client_id">Cliente:</label>

                {!! Form::select('client_id', $clients, null, ['class' => 'form-control']) !!}

            </div>
            <div class="form-group col-sm-2">
                <br />
                <button type="submit" class="btn btn-default">Listar</button>
            </div>
        </form>
    </div>
@endif
@if (!empty($sales))

    <style>
        #area-print * {font-family: monospace; font-size: 11px}
        #area-print hr {border:none;border-bottom: 1px dotted #ccc;margin:0;padding:0;width:100%;height:1px}
        #area-print div {line-height: 18px}
        #area-print .money {text-align: right}
        @media print {
            .new-page {page-break-before: always;}
            .no-print {display: none}
          }

    </style>
    <div class="container-fluid" >
    <nav class="panel no-print ">
        <button onclick="window.print()" class="btn btn-primary btn-sm">Imprimir</button>
        <a href="javascript:history.back()" class="btn btn-default btn-sm">Voltar</a>
    </nav>
    <br class="no-print " />
    <?php 
    $totalPeriodo = .0; 
    $totalCliente = .0;
    $totalFilial = .0;
    $clienteAtual = 0;
    $clienteAtualNome = '';
    $diaAtual = '';
    $filialAtual = 0;

    $pagina = 0;
    $linhas = 60;
    $html = '';

    foreach($sales as $sale) {
        
        if ($linhas > 55) {
            $pagina++;

            $html .= '  
                        <div class="row"><hr class="new-page" /><hr>
                            <div class="col-xs-2"><img src="/imagens/logo-gavagas.jpg" width="60" height="auto"/></div>
                            <div class="col-xs-7 text-center">VENDAS CLIENTE-PRODUTO :: De: '. $data['date1'] . ' até '. $data['date2'] . '</div>
                            <div class="col-xs-3 text-right">Página: '. $pagina. '/$$</div>
                        <hr /></div>
                        
                        <div class="row">
                            <div class="col-xs-2 col-xs-offset-2">PRODUTO</div>
                            <div class="col-xs-2 text-right">QUANTIDADE</div>
                            <div class="col-xs-2 text-right">PREÇO MÉDIO</div>
                            <div class="col-xs-2 text-right">TOTAL</div>
                        <hr /></div>
                        ';
            
            $linhas = 8;
        }
               
        if ($clienteAtual != $sale->client_id) {
            if ($clienteAtual != 0) {
                if ($linhas == 8) {
                    $html .= '<div class="row">'
                            . '<div class="col-xs-8 col-offset-2">CLIENTE: '. $clienteAtual. '-'. $clienteAtualNome. '</div>'
                            . '<hr></div>';
                    $linhas++;
                }
                $html .= '  <div class="row">

                                <div class="col-xs-6 col-xs-offset-2">TOTAL CLIENTE: </div>
                                <div class="col-xs-4 money">'. number_format($totalCliente, 2, ',', '.').'</div>
                            </div>';

                $linhas++;
            }
            
            if ($filialAtual != $sale->branch_id) {
                if ($filialAtual != 0) {
                    $html .= '  <div class="row">

                        <div class="col-xs-6 col-xs-offset-2">TOTAL FILIAL: </div>
                        <div class="col-xs-4 money">'. number_format($totalFilial, 2, ',', '.').'</div><hr/>
                    </div>';
                    $totalFilial = .0;
                }
                $html .= '<div class="row"><hr/><div class="col-xs-11 col-offset-1">FILIAL: '. $sale->branch_id. '-'. $sale->branch_name. '</div><hr></div>';
                $linhas++;

                $filialAtual = $sale->branch_id;
            }
            
            $html .= '<div class="row"><hr><div class="col-xs-8 col-offset-3">CLIENTE: '. $sale->client_id. '-'. $sale->client_name. '-'. $sale->client_company_name. '</div></div>';
            $linhas++;
            
            $totalCliente = .0;

            $clienteAtual = $sale->client_id;
            $clienteAtualNome = $sale->client_name;

            
            $diaAtual = '';
            
        } 
        
        /*if ($diaAtual != $sale->sale_date) {
            $html .= '  <div class="row">
                <div class="col-xs-2 col-xs-offset-1">'. $sale->sale_date. '</div>
            </div>';
            $linhas++;
            
            $diaAtual = $sale->sale_date;
        }*/



//        $html .= '  <div class="row">
//                        <div class="col-xs-1 col-xs-offset-1">'. $sale->sale_date. '</div>
//                        <div class="col-xs-3">'. $sale->product_id. '-'. $sale->product_name. '-'. $sale->unidade. '</div>
//                        <div class="col-xs-2 money">'. number_format($sale->sum_item_quantity, 2, ',', '.').'</div>
//                        <div class="col-xs-2 money">'. number_format($sale->avg_item_price, 2, ',', '.').'</div>
//                        <div class="col-xs-2 money">'. number_format($sale->sum_total, 2, ',', '.').'</div>
//                    </div>';
        $html .= '  <div class="row">
                        <div class="col-xs-1 col-xs-offset-1">'. $sale->sale_date. '</div>
                        <div class="col-xs-3">'. $sale->product_id. '-'. $sale->product_name. '-'. $sale->unidade. '</div>
                        <div class="col-xs-2 money">'. number_format($sale->sum_item_quantity, 2, ',', '.').'</div>
                        <div class="col-xs-2 money">'. number_format($sale->sum_total/$sale->sum_item_quantity, 2, ',', '.').'</div>
                        <div class="col-xs-2 money">'. number_format($sale->sum_total, 2, ',', '.').'</div>
                    </div>';
        $totalPeriodo += (float)$sale->sum_total;
        $totalCliente +=  (float)$sale->sum_total;
        $totalFilial +=  (float)$sale->sum_total;

        $linhas++;
    }
    if ($html != '') {
        $html .= '  <div class="row">

                        <div class="col-xs-6 col-xs-offset-2">TOTAL CLIENTE: </div>
                        <div class="col-xs-4 money">'. number_format($totalCliente, 2, ',', '.').'</div>
                    <hr></div>';
                            $html .= '  <div class="row">

                        <div class="col-xs-6 col-xs-offset-2">TOTAL FILIAL: </div>
                        <div class="col-xs-4 money">'. number_format($totalFilial, 2, ',', '.').'</div><hr/>
                    </div>';
        $html .= '  <div class="row">

                <div class="col-xs-6 col-xs-offset-2"><h5>TOTAL GERAL: </h5></div>
                <div class="col-xs-4 money"><h5>'. number_format($totalPeriodo, 2, ',', '.').'</h5></div><hr />
            </div>';
        
        $pagina++;
        
        $html .= '  
                    <div class="row"><hr class="new-page" /><hr>
                        <div class="col-xs-2"><img src="/imagens/logo-gavagas.jpg" width="60" height="auto"/></div>
                        <div class="col-xs-7 text-center">VENDAS DATA-FILIAL-PRODUTO :: De: '. $data['date1'] . ' até '. $data['date2'] . '</div>
                        <div class="col-xs-3 text-right">Página: '. $pagina. '/$$</div>
                    </div>
                    
                    <div class="row"><hr />
                        <div class="col-xs-2 col-xs-offset-2">PRODUTO</div>
                        <div class="col-xs-2 text-right">QUANTIDADE</div>
                        <div class="col-xs-2 text-right">PREÇO MÉDIO</div>
                        <div class="col-xs-2 text-right">TOTAL</div>
                    <hr /><hr></div>
                    ';
        $totalPeriodo = 0;
        foreach ($items as $item) {
            $html .= '<div class="row">
                            <div class="col-xs-2 col-xs-offset-2">'. $item->name. ' - '. $item->unidade. '</div>
                            <div class="col-xs-2 text-right">'. number_format($item->sum_item_quantity, 2, ',', '.'). '</div>
                            <div class="col-xs-2 text-right">'. number_format($item->sum_total/$item->sum_item_quantity, 2, ',', '.'). '</div>
                            <div class="col-xs-2 text-right">'. number_format($item->sum_total, 2, ',', '.'). '</div>
                        </div>';
            $totalPeriodo += (float)$item->sum_total;
        }
        $html .= '<div class="row"><hr />
            <div class="col-xs-4 col-xs-offset-2">TOTAL DOS ITENS</div>
            <div class="col-xs-4 text-right">'. number_format($totalPeriodo, 2, ',', '.'). '</div>
        <hr /></div>';

    }
    $html =  str_replace('$$', $pagina, $html);
    echo '<div id="area-print">'. $html . '</div>'
    ?>
    </div>
@endif


@endsection()