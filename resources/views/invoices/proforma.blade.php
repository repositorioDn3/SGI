<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="css/styles.css">
    <title>Fatura Proforma</title>


    <style>

        /* Cabecalho do documento  */
        .header{
            width: 100%;
            height: auto;
            font-size: 12px;
        }
        .header > .item{
            height: 5rem;
            width: 25rem;
        }
        .item-1{
            float: left;
            width: 10%
        }
        .item-2{
            float: left;
            margin-left: -19.5rem;
            margin-top: -.1rem;
        }
        .company_name{
            font-size: 14px
        }
        .item-3{
            float: right;
            margin-right: -9rem;

        }
        .item-3  .refe_proforma{
           margin-left: 12.5rem;
           font-weight: bold;
        }
        .item-3 .proforma_word,.date-01{
           margin-left: 14.2rem;
        }
        .date-01{
           margin-left: 13.3rem;
        }
        .date-02{
           margin-left: 8.2rem;
        }
        .date-03{
           margin-left: 3.1rem;
        }
        #logo{
            width: 5rem;
            height: 5rem;
            border-radius: .4rem;
        }

        /* Dados do cliente */

        .nif_user{
            width: 100%;
            height: auto;
        }
        .nif_user > p{
            height: 5rem;
            width: 30rem;
            font-size: 10px;
        }
        .nif{

            float: left;
        }
        .user{
            float: right;
            margin-right: -18.8rem;
        }

        .table_products,.table_bank_account{
            width:45.2rem;
            font-size: 12px;
            border-collapse: collapse;
            text-align: center;
        }
            /* Tabela de Contas bancarias e totais */
            .data_money{
                width: 100%;
                height: auto;
            }
            section > .table2{
                height: 5rem;
                font-size: 12px;
                margin-top: 20rem;
            }
            .table_bank_account{
                border-collapse: collapse;
                float: left;
                width: 60%;
            }
            .container_account{
                border: 1px solid black;
                padding: .1rem;
                width: 30%;
                float: right;
                margin-left: 1rem;
            }
            .total{
                font-weight: bolder;
            }
            .notfound{
                background-color: #cfe2ff;
            }
    </style>
</head>
<body>
        <header class="header">
            <div class="item-1 item">
                <img id="logo" src="storage/logotipo/{{$empresa->logotipo}}" alt="logo">
            </div>
            <div class="item-2 item">
                <span class="company_name" style="font-weight: bold">{{$empresa->nome}}</span><br><br>
                <span>Tel: {{$empresa->telefone}}{{' / '.$empresa->telefone_alternativo}}</span><br>
                <span>{{$empresa->provincia, $empresa->municipio}} <br />{{$empresa->detalhes_localizacao}}</span>
                <span style="font-weight: bolder; font-size: 14px">NIF: {{$empresa->nif}}</span>
            </div>
            <div class="item-3 item">
                <span class=" proforma_word">Proforma</span><br>
                <span class="refe_proforma">PP FT{{date('Y')}}/{{Str::substr(date('Y'), 2, 3) }}</span><br><br>
                <span class="date-01">ORIGINAL</span><br>
                <span class="date-02">DATA: {{date('d-m-Y H:i:s')}}</span><br>
                <span class="date-03">DATA VENCIMENTO: {{date("d-m-Y H:i:s",strtotime('+7 days'))}}</span><br>
            </div>
        </header>
        <hr style="margin-top: 7rem;width:45rem">
        <div class="client_content">
            <div>
                <span>Nome do cliente</span><br>
                <span style="font-weight: bold">{{$cliente->nome}}</span><br>
                <span>Luanda, Angola, s\n</span><br>
            </div>
            <div class="nif_user">
                <p class="nif" style="font-weight: bolder; font-size: 14px">NIF:{{($cliente->tipo_pessoa === 'FÍSICA') ? '999999999':$cliente->nif}}</p>
                <p class="user" style="font-weight: bolder; font-size: 13px">Utilizador: {{auth()->user()->name ?? 'Não adicionado'}}</p>
            </div>
        </div>

        <hr style="margin-top: 7rem;width:45rem">




        <table border="1" class="table_products">
        <thead>
            <tr>
                <th>CÓDIGO</th>
                <th>DESCRIÇÃO</th>
                <th>PREÇO UN</th>
                <th>QTD.</th>
                <th>DESCONTO</th>
                <th>TOTAL</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total_desconto = 0;
                $total_imposto = 0;
                $total_geral = 0;
           @endphp
            @if ($data->count() > 0)
            @foreach ($data as $item)
            <tr>
                <td>{{ucfirst($item->id)}}</td>
                <td>{{ucfirst($item->imovel)}}</td>
                <td>{{number_format($item->preco,2,',','.')}} AKZ</td>
                <td>{{number_format($item->quantidade,1,',','.')}}</td>
                <td>{{number_format($item->desconto,2,',','.')}} AKZ</td>
                <td>{{number_format(abs($item->subtotal - $item->taxa - $item->desconto),2,',','.')}} AKZ</td>
            </tr>
            @php
                $total_desconto += $item->desconto;
                $total_imposto += $item->taxa;
                $total_geral += $item->subtotal;
            @endphp

            @endforeach
            @else
            <tr>
                <td colspan="7" class="notfound">Nenhum produto foi adicionado a esta proforma.</td>
            </tr>
            @endif
        </tbody>
       </table>

       <section id="data_money">
           <table border="1" class="table_bank_account table2">
            <thead>
                <tr>
                    <th>BANCO</th>
                    <th>CONTA</th>
                    <th>IBAM</th>
                </tr>
                <tbody>

                    @if ($contas->count() > 0)

                    @foreach ($contas as $item)
                   <tr>
                       <td>{{$item->banco}}</td>
                       <td>{{$item->numero}}</td>
                       <td>{{$item->ibam}}</td>
                   </tr>
                    @endforeach
                   @else
                   <tr>
                       <td colspan="3">Contas Bancarias não definidas</td>
                   </tr>
                   @endif

                </tbody>
            </thead>
           </table>
        <div class="container_account table2">
            <p class="total">Total desconto: {{number_format($total_desconto,2,',','.')}} AKZ</p>
            <p class="total">Total imposto: {{number_format($total_imposto,2,',','.')}} AKZ</p>
            <p class="total">Total Geral: {{number_format(abs($total_geral),2,',','.')}} AKZ</p>
        </div>

       </section>
       <div style="clear:both;text-align: center;font-weight: bold">
           <p>Este documento não serve de fatura</p>
       </div>
       <p style="font-size: 10px">Observação:</p>
       <p style="text-align: center; font-weight: bold; font-size: 12px">
        Processado por programa validado nº 00/AGT/2022 Software SIF (1.0), www.sif.co.ao
      </p>



    </body>
</html>
