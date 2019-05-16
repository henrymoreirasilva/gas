@extends('app')
@section('content')
@if (empty($sales))
    <div class="container-fluid">


        <h4>Relatório de vendas diárias</h4>
        <br />
        <form class="clearfix" id="expressao-form" action="{{ route('admin.sales.relatorios.venda-diaria') }}" method="get">
            <div class="form-group col-sm-2">
                <label for="date1">Data inicial</label>
                <input type="text" class="form-control date" id="date1" name="date1" value="{{ $data['date1'] }}" >
            </div>
            <div class="form-group col-sm-2">
                <label for="date2">Data final</label>
                <input type="text" class="form-control date" id="date2" name="date2" value="{{ $data['date2'] }}" >
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
        #area-print * {font-family: monospace; font-size: 9px}
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
    $diaAtual = '';
    $pagina = 0;
    $linhas = 51;
    $html = '';
    foreach($sales as $sale) {

        if ($diaAtual != $sale->sale_date) {

            if ($pagina > 0) {

                $html .= '  <div class="row">

                                <div class="col-xs-4 col-xs-offset-2">TOTAL EM: '. $diaAtual. '</div>
                                <div class="col-xs-4 money">'. number_format($totalDia, 2, ',', '.').'</div>
                            </div>

                            <div class="row"><div class="col-xs-12"><hr>DATA: '. $sale->sale_date. '</div></div>';
                $linhas += 2;
            }

            $totalDia = .0;
            $diaAtual = $sale->sale_date;
        }

        if ($linhas > 45) {
            $pagina++;

            $html .= '  <hr class="new-page" /><hr>
                        <div class="row">
                            <div class="col-xs-3">GAVA GÁS</div>
                            <div class="col-xs-6 text-center">VENDAS POR PERÍODO: '. $data['date1'] . ' até '. $data['date2'] . '</div>
                            <div class="col-xs-3 text-right">Página: '. $pagina. '/$$</div>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="col-xs-4 col-xs-offset-2">FILIAL</div>
                            <div class="col-xs-4 text-right">VALOR DA VENDA</div>
                        </div>
                        <hr /><hr>
                        <div class="row"><div class="col-xs-12">DATA: '. $sale->sale_date. '</div></div>';
            $linhas = 6;
        }


        $html .= '  <div class="row">

                        <div class="col-xs-4 col-xs-offset-2">'. $sale->branch_id. '-'. $sale->branch_name. '</div>
                        <div class="col-xs-4 money">'. number_format($sale->total_sales, 2, ',', '.').'</div>
                    </div>';
        $totalPeriodo += (float)$sale->total_sales;
        $totalDia =  (float)$sale->total_sales + $totalDia;
        //echo $totalDia. ' - ';
        $linhas++;
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

    }
    $html =  str_replace('$$', $pagina, $html);
    echo '<div id="area-print">'. $html . '</div>'
    ?>
    </div>
@endif


@endsection()