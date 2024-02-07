<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        @page {
            size: A4;
            margin: 0px;
            padding: 0px;
        }
        * {
            margin: 0px;
            padding: 0px;
            font-size: 10px;
            font-family: 'dejavu sans';
        }
        html {
            margin: 15px;
        }
        body {
            margin: 0px 5px;
        }
        table {
            border-collapse: collapse;
        }
        .with_border td {
            border: 1px black solid;
            padding: 3px;
        }
        .with_outside_border {
            border: 1px black solid;
        }
        .with_side_border td {
            border-right: 1px black solid;
            border-left: 1px black solid;
            padding: 3px;
        }
        .border_with_padding {
            padding: 3px;
            /* border: 1px black solid; */
        }
        .td_signature{
            font-size:8px;
        }
    </style>
</head>
<body>
    <div class="border_with_padding">
        <table width="100%">
            <tr>
                <td width="30%" valign="top" align="left" style="font-size: 10px;">
                    OC NRO :
                    {{ $ordencompra->id }}<br>
                    PIZZERIA MATEO    
                </td>
                <td width="40%" valign="top" align="center" style="font-size:20px;">
                    Orden de Compra 
                </td>
                <td width="30%" valign="top" align="right" style="font-size:7px;">
                    <img src="{{ asset('assets/img/pizza.png') }}" height="25"><br>
                    Americo Picco Nro 153 - Villa Elisa<br>
                    Tel: (021) 000 0000
                </td>
            </tr>
        </table>
    </div>    
    <br>
    <br>
    <div class="border_with_padding">
        <table width="100%">
            <tr>
                <td width="50%"><b>Dpto Solicitante:</b> {{$ordencompra->solicitante->cargo->departamento->nombre}}</td>
                <td width="50%"><b>Solicitado por:</b> {{strtoupper($ordencompra->solicitante->fullname)}}</td>
            </tr>
            <tr>               
                <td width="50%"><b>Fecha:</b> {{$ordencompra->fecha}}</td>
                <td width="50%"><b>Forma Pago:</b> {{ config('constants.type_condition.'.$ordencompra->presupuesto_compra->condicion) }} <b>Nro. Cuotas:</b>  {{$ordencompra->presupuesto_compra->nro_cuotas}}</td>
            </tr>
            <tr>
                <td width="50%"><b>Proveedor:</b> {{$ordencompra->presupuesto_compra->proveedor->razon_social}}</td>
                <td width="50%"><b>RUC:</b> {{$ordencompra->presupuesto_compra->proveedor->ruc}}</td>
            </tr>
            <tr>
                <td width="50%"><b>Dirección:</b> {{$ordencompra->presupuesto_compra->proveedor->direccion}}</td>
                <td width="50%"><b>Teléfono:</b> {{$ordencompra->presupuesto_compra->proveedor->telefono}}</td>
            </tr>
        </table>
    </div>    
    <br>
    <br>    
    <table width="100%" style="font-size:10px;">
        <tr class="with_border">
            <td width="5%" align="center"><b>Cód</b></th>
            <td width="45%" align="center"><b>Producto</b></th>
            <td width="15%" align="center"><b>Presentación</b></th>
            <td width="10%" align="center"><b>Cantidad</b></th>
            <td width="10%" align="center"><b>Precio</b></th>
            <td width="15%" align="center"><b>SubTotal</b></th>
        </tr>
        @foreach($ordencompra->details as $details)            
            <tr class="with_side_border">
                <td valign="top">{{ $details->materia_prima_id }}</td>
                <td valign="top">{{ $details->materia_prima->nombre }}</td>
                <td valign="top">{{ $details->materia_prima_id ? $details->materia_prima->unidad_medida->descripcion : '' }}</td>
                <td valign="top" align="right">{{ number_format($details->cantidad, 0, ',', '.') }}</td>
                <td valign="top" align="right">{{ number_format($details->precio_unitario, 0, ',', '.') }}</td>
                <td valign="top" align="right">{{ number_format($details->precio_unitario * $details->cantidad, 0, ',', '.') }}</td>
                {{-- <td valign="top" align="right">{{ $purchases_order->currency_id == 1 ? number_format($details->quantity*$details->amount, 0, ',', '.') :  number_format($details->quantity*$details->amount, 2, ',', '.') }}</td> --}}
            </tr>
        @endforeach
        <tr class="with_border">
            <td colspan="5"><b>TOTAL: </b>guaranies {{numberToWords($ordencompra->getTotalDetalles())}}</td>
            <td align="right">
                {{number_format($ordencompra->getTotalDetalles(), 0, ',', '.')}}
            </td>
        </tr>
    </table>
    <br>
    <br>
    <br>
    <br>    
    @if($ordencompra->observacion)
        <table width="100%" style="font-size:10px;">
            <tr class="">
                <td width="100%"><b>Observación</b></td>
            </tr>
            <tr>
                <td valign="top">{{strtoupper($ordencompra->observacion)}}</td>
            </tr>
        </table>
        <br>
        <br>
        <br>
        <br>
    @endif
    <table width="100%" style="font-size:10px;">
        <tr class="">
            <td class="" width="20%" valign="top" align="right">
                <b>Aprobado por</b><br>{{$ordencompra->autorizador_id ? (strtoupper($ordencompra->autorizador->fullname).' - '.$ordencompra->autorizador->cargo->descripcion.' - '.$ordencompra->autorizador->cargo->departamento->nombre) : ''}}<br>
            </td>
        </tr>
    </table>
</body>
</html>
