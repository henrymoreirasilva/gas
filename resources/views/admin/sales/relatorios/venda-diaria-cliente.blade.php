@extends('app')
@section('content')
@if (empty($sales))
    <div class="container-fluid">


        <h4>Vendas: Data - Filial - Cliente</h4>
        <br />
        <form class="clearfix" id="expressao-form" action="{{ route('admin.sales.relatorios.venda-diaria-cliente') }}" method="get">
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
    $totalDia = .0;
    $totalFilial = .0;
    $diaAtual = '';
    $filialAtual = 0;
    $pagina = 0;
    $linhas = 60;
    $html = '';

    foreach($sales as $sale) {
        
        if ($diaAtual != $sale->sale_date) {

            if ($pagina > 0) {
                $html .= '  <div class="row">

                                <div class="col-xs-4 col-xs-offset-2">TOTAL FILIAL: </div>
                                <div class="col-xs-4 money">'. number_format($totalFilial, 2, ',', '.').'</div>
                            </div>';
                
                $html .= '  <div class="row">

                                <div class="col-xs-4 col-xs-offset-2">TOTAL EM: '. $diaAtual. '</div>
                                <div class="col-xs-4 money">'. number_format($totalDia, 2, ',', '.').'</div>
                            </div>

                            <div class="row"><div class="col-xs-12"><hr>DATA: '. $sale->sale_date. '</div></div>';

                $html .= '  <div class="row"><div class="col-xs-11" col-offset-1>FILIAL: '. $sale->branch_id. '-'. $sale->branch_name. '</div></div>';
                
                $linhas += 4;
            }

            $totalDia = .0;
            $totalFilial = .0;
            $diaAtual = $sale->sale_date;
            $filialAtual = $sale->branch_id;
        } else {
            if ($filialAtual != $sale->branch_id) {
                    $html .= '  <div class="row">

                                    <div class="col-xs-4 col-xs-offset-2">TOTAL FILIAL: </div>
                                    <div class="col-xs-4 money">'. number_format($totalFilial, 2, ',', '.').'</div>
                                </div>';
                    
                    $html .= '  <div class="row"><div class="col-xs-11 col-offset-1">FILIAL: '. $sale->branch_id. '-'. $sale->branch_name. '</div></div>';
                    $linhas += 2;

                    $totalFilial = .0;
                    $filialAtual = $sale->branch_id;
            }
            
        }
        


        if ($linhas > 55) {
            $pagina++;

            $html .= '  <hr class="new-page" /><hr>
                        <div class="row">
                            <div class="col-xs-3">GAVA GÁS</div>
                            <div class="col-xs-6 text-center">VENDAS DATA-FILIAL-CLIENTE :: De: '. $data['date1'] . ' até '. $data['date2'] . '</div>
                            <div class="col-xs-3 text-right">Página: '. $pagina. '/$$</div>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="col-xs-4 col-xs-offset-2">FILIAL</div>
                            <div class="col-xs-4 text-right">VALOR DA VENDA</div>
                        </div>
                        <hr /><hr>
                        <div class="row"><div class="col-xs-12">DATA: '. $sale->sale_date. '</div></div>
                        <div class="row"><div class="col-xs-11 col-offset-1">FILIAL: '. $sale->branch_id. '-'. $sale->branch_name. '</div></div>';
            $linhas = 9;
        }

        $html .= '  <div class="row">

                        <div class="col-xs-4 col-xs-offset-2">'. $sale->client_id. '-'. $sale->client_name. '</div>
                        <div class="col-xs-4 money">'. number_format($sale->amount, 2, ',', '.').'</div>
                    </div>';
        $linhas++;

        $totalPeriodo += (float)$sale->amount;
        $totalDia +=  (float)$sale->amount;
        $totalFilial +=  (float)$sale->amount;
        
    }
    if ($html != '') {
        $html .= '  <div class="row">

                        <div class="col-xs-4 col-xs-offset-2">TOTAL EM: '. $diaAtual. '</div>
                        <div class="col-xs-4 money">'. number_format($totalDia, 2, ',', '.').'</div>
                    </div>
                    <hr />';
        $html .= '  <div class="row">

                <div class="col-xs-4 col-xs-offset-2"><h5>TOTAL GERAL: </h5></div>
                <div class="col-xs-4 money"><h5>'. number_format($totalPeriodo, 2, ',', '.').'</h5></div>
            </div>
            <hr />';
        
            $pagina++;
        
            $html .= '  <hr class="new-page" /><hr>
                        <div class="row">
                            <div class="col-xs-3">GAVA GÁS</div>
                            <div class="col-xs-6 text-center">VENDAS DATA-FILIAL-CLIENTE :: De: '. $data['date1'] . ' até '. $data['date2'] . '</div>
                            <div class="col-xs-3 text-right">Página: '. $pagina. '/$$</div>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="col-xs-2 col-xs-offset-2">PRODUTO</div>
                            <div class="col-xs-2 text-right">QUANTIDADE</div>
                            <div class="col-xs-2 text-right">PREÇO MÉDIO</div>
                            <div class="col-xs-2 text-right">TOTAL</div>
                        </div>
                        <hr /><hr>';
            $totalPeriodo = 0;
            foreach ($items as $item) {
                $html .= '<div class="row">
                                <div class="col-xs-2 col-xs-offset-2">'. $item->name. ' - '. $item->unidade. '</div>
                                <div class="col-xs-2 text-right">'. number_format($item->sum_item_quantity, 2, ',', '.'). '</div>
                                <div class="col-xs-2 text-right">'. number_format($item->avg_item_price, 2, ',', '.'). '</div>
                                <div class="col-xs-2 text-right">'. number_format($item->sum_total, 2, ',', '.'). '</div>
                            </div>';
                $totalPeriodo += (float)$item->sum_total;
            }
            $html .= '<hr /><div class="row">
                <div class="col-xs-4 col-xs-offset-2">TOTAL DOS ITENS</div>
                <div class="col-xs-4 text-right">'. number_format($totalPeriodo, 2, ',', '.'). '</div>
            </div><hr />';

    }
    $html =  str_replace('$$', $pagina, $html);
    echo '<div id="area-print">'. $html . '</div>'
    ?>
    </div>
@endif


@endsection()