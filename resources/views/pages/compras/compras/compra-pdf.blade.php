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
                <td width="30%" valign="top" align="left" style="font-size: 10px;"></td>
                <td width="40%" valign="top" align="center" style="font-size:20px;">
                    FACTURA COMPRA 
                </td>
                <td width="30%" valign="top" align="right" style="font-size:7px;"></td>
            </tr>
        </table>
    </div>    
    <br>
    <br>
    <div class="border_with_padding">
        <table width="100%">
            <tr>
                <td width="50%" align="center"><b>{{ $compra->proveedor->razon_social }}</b></td>
                <td width="50%" align="center"></td>
                <td width="50%" align="center">Timbrado: {{$compra->timbrado->numero}}</td>
            </tr>
            <tr>
                <td whidth="50%" align="center"></td>
                <td width="50%" align="center"></td>
                <td width="50%" >Inicio: {{$compra->timbrado->fecha_emision}}</td>
            </tr>
            <tr>
                <td whidth="50%"><b>Direccion: </b>{{$compra->proveedor->direccion}}</td>
                <td width="50%" align="center"></td>
                <td width="50%" >Vencimiento: {{$compra->timbrado->fecha_vencimiento}}</td>
            </tr>
            <tr>
                <td whidth="50%"><b>Telefono: </b>{{$compra->proveedor->telefono}}</td>
                <td width="50%" align="center"></td>
            </tr>
            <tr>
                <td width="50%"><b>RUC: </b>{{$compra->proveedor->ruc}}</td>
                <td width="50%" align="center"></td>
                <td width="50%" align="center"><b>Factura Nro.: </b>{{$compra->nro_factura}}</td>
            </tr>
        </table>
    </div>    
    <br>
    <br>    
    <table width="100%" style="font-size:10px;">
        <tr class="with_border">
            <td width="5%" ><b>Fecha:</b> </th>
            <td width="45%" align="center" colspan="2">{{$compra->fecha}}</th>
            <td width="15%" align="center"><b>Contado</b></th>
            <td width="10%" align="center">{{$compra->condicion == 1 ? 'X' : ''}}</th>
            <td width="10%" align="center"><b>Credito</b></th>
            <td width="15%" align="center">{{$compra->condicion == 2 ? 'X' : ''}}</th>
        </tr>
        <tr class="with_border">
            <td width="5%" align="center"><b>Nombre:</b></th>
            <td width="45%" colspan="2">PIZZERIA MATEO S.A.</th>
            <td width="45%" colspan="4" ><b>Cant. Cuotas:</b> {{$compra->condicion == 1 ? '1' : $compra->compra_cuota->count()}}</th>
        </tr>
        <tr class="with_border">
            <td width="5%" align="center"><b>Ruc:</b></th>
            <td width="45%" colspan="6">80013744-2</th>
        </tr>
        <tr class="with_border">
            <td width="5%" align="center"><b>Direccion:</b></th>
            <td width="45%" colspan="6">Dr. Teodoro S. Mongelós c/ Guavirá</th>
        </tr>
    </table>
    <br>
    <br>    
    <table width="100%" style="font-size:10px;">
        <tr class="with_border">
            <td width="5%" align="center"><b>Cód</b></th>
            <td width="45%" align="center"><b>Producto</b></th>
            <td width="15%" align="center"><b>Presentación</b></th>
            <td width="10%" align="center"><b>Cantidad</b></th>
            <td width="10%" align="center"><b>Precio</b></th>
            <td width="10%" align="center"><b>Exentas</b></th>
            <td width="10%" align="center"><b>Iva 5%</b></th>
            <td width="10%" align="center"><b>Iva 10%</b></th>
            <td width="15%" align="center"><b>SubTotal</b></th>
        </tr>
        @foreach($compra->details as $details)            
            <tr class="with_side_border">
                <td valign="top">{{ $details->materia_prima_id }}</td>
                <td valign="top">{{ $details->materia_prima->nombre }}</td>
                <td valign="top">{{ $details->materia_prima_id ? $details->materia_prima->unidad_medida->descripcion : '' }}</td>
                <td valign="top" align="right">{{ number_format($details->cantidad, 0, ',', '.') }}</td>
                <td valign="top" align="right">{{ number_format($details->precio_unitario, 0, ',', '.') }}</td>
                <td valign="top" align="right">{{ number_format($details->exentas, 0, ',', '.') }}</td>
                <td valign="top" align="right">{{ number_format($details->iva5, 0, ',', '.') }}</td>
                <td valign="top" align="right">{{ number_format($details->iva10, 0, ',', '.') }}</td>
                <td valign="top" align="right">{{ number_format($details->precio_unitario * $details->cantidad, 0, ',', '.') }}</td>
                {{-- <td valign="top" align="right">{{ $purchases_order->currency_id == 1 ? number_format($details->quantity*$details->amount, 0, ',', '.') :  number_format($details->quantity*$details->amount, 2, ',', '.') }}</td> --}}
            </tr>
        @endforeach
        <tr class="with_border">
            <td colspan="5"><b>TOTAL: </b>guaranies {{numberToWords($compra->getTotalDetalles())}}</td>
            <td valign="top" align="right">{{ number_format($details->exentas, 0, ',', '.') }}</td>
            <td valign="top" align="right">{{ number_format($details->iva5, 0, ',', '.') }}</td>
            <td valign="top" align="right">{{ number_format($details->iva10, 0, ',', '.') }}</td>
            <td align="right">
                {{number_format($compra->getTotalDetalles(), 0, ',', '.')}}
            </td>
        </tr>
    </table>
</body>
</html>
