<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rujukan Senarai Agihan dan Pengesahan Penerimaan Bahan</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #D8BFD8; /* Light purple/thistle color */
            color: #000000; /* Black text for better readability */
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .footer {
            margin-top: 30px;
            font-size: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>RUJUKAN SENARAI AGIHAN DAN PENGESAHAN PENERIMAAN BAHAN</h2>
        <p>Tarikh: {{ date('d/m/Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Bil.</th>
                <th>Bil. PO</th>
                <th>Pembekal</th>
                <th>Emel Pembekal</th>
                <th>Tarikh</th>
            </tr>
        </thead>
        <tbody>
            @if(count($inventorysebutharga) == 0)
                <tr>
                    <td colspan="5" style="text-align: center;">Tiada rekod dijumpai</td>
                </tr>
            @else
                @foreach($inventorysebutharga as $item)
                <tr>
                    <td>SH{{ $item->id }}</td>
                    <td>{{ $item->bil_po }}</td>
                    <td>{{ $item->pembekal }}</td>
                    <td>{{ $item->emel_pembekal }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}</td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    <div class="footer">
        <p>Dijana pada: {{ \Carbon\Carbon::now()->format('d/m/Y H:i:s') }}</p>
    </div>
</body>
</html>