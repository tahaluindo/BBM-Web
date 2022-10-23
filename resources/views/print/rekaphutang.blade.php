<html>

    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <title>Rekap Akhir Hutang</title>
    </head>

    <style>
        .mytable>tbody>tr>td, .mytable>tbody>tr>th, .mytable>tfoot>tr>td, .mytable>tfoot>tr>th, .mytable>thead>tr>td, .mytable>thead>tr>th {
            padding: 5px;
            vertical-align: middle;
        }
        *{
            font-size:13px;
        }
        @page{
            margin: 0.3in 0.3in 0.2in 0.3in;
        }
        body{
            margin:0;
        }
        .page_break { 
            page-break-before: always; 
        }
        .tdhead{
            font-weight: bold;
        }
    </style>

    <body>
        
        <h4 style="text-align:center">REKAP AKHIR HUTANG</h4>
        <h4 style="text-align:center">PT. BINTANG BETON MANDALA</h4></h4>
        <h5 style="margin-bottom: 3rem;text-align:center">Periode : {{ date_format(date_create($tgl_awal),'d/M/Y').' - '.date_format(date_create($tgl_akhir),'d/M/Y') }}</h5>
        @if (count($data) > 0)
        <table class="table table-striped table-bordered mytable">
            <tr>
                <td class="tdhead">No</td>
                <td class="tdhead">Nama Supplier</td>
                <td class="tdhead">Saldo Awal</td>
                <td class="tdhead">Debet</td>
                <td class="tdhead">Kredit</td>
                <td class="tdhead">Saldo</td>
            </tr>
            
            @php
                $totalsaldoawal = 0;
                $totalsaldodebet = 0;
                $totalsaldokredit = 0;
                $totalsaldo = 0;
            @endphp
            @foreach($data as $index => $item)
            <tr>
                <td>{{ ++$index }}</td>
                <td>{{ $item->nama_supplier }}</td>
                <td class="text-right">{{ number_format($item->saldo_awal,2,'.',',') }}</td>
                <td class="text-right">{{ number_format($item->debet,2,'.',',') }}</td>
                <td class="text-right">{{ number_format($item->kredit,2,'.',',') }}</td>
                <td class="text-right">{{ number_format($item->saldo_awal - ($item->debet - $item->kredit),2,'.',',') }}</td>
            </tr>
                @php
                    $totalsaldoawal = $totalsaldoawal + $item->saldo_awal;
                    $totalsaldodebet = $totalsaldodebet + $item->debet;
                    $totalsaldokredit = $totalsaldokredit + $item->kredit;
                    $totalsaldo = $totalsaldo + $item->saldo_awal - ($item->debet - $item->kredit);
                @endphp
            @endforeach 
            <tr>
                <td colspan="2" style="font-weight:bold">Total</td>
                <td class="text-right" style="font-weight:bold">{{ number_format($totalsaldoawal,2,',','.') }}</td>
                <td class="text-right" style="font-weight:bold">{{ number_format($totalsaldodebet,2,',','.') }}</td>
                <td class="text-right" style="font-weight:bold">{{ number_format($totalsaldokredit,2,',','.') }}</td>
                <td class="text-right" style="font-weight:bold">{{ number_format($totalsaldo,2,',','.') }}</td>
            </tr>
        </table>
        @endif
    </body>

</html>