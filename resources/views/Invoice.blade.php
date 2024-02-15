<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Invoice</title>
<style>
    body {
        font-family: Arial, sans-serif;
    }

    .container-invoice{
        height: 100vh;
        width: 100%;
    }
    .scrollable-column {
        max-height: 200px;
        overflow-y: auto;
    }

    .scrollable-column span {
        display: block;
        margin-bottom: 5px;
    }
    .invoice {
        width: 80%;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
    }
    .invoice-header {
        text-align: center;
        margin-bottom: 20px;
    }
    .invoice-table {
        width: 100%;
        border-collapse: collapse;
    }
    .invoice-table th,
    .invoice-table td {
        border: 1px solid #ddd;
        padding: 8px;
    }
    .invoice-table th {
        background-color: #f2f2f2;
        text-align: left;
    }
    .invoice-total {
        margin-top: 20px;
        text-align: right;
    }
</style>
</head>
<body>
<div class="container-invoice">
    <div class="invoice">
        <div class="invoice-header">
            <h2>Invoice</h2>
        </div>
        <table class="invoice-table">
            <thead>
                <tr>
                    <th>ID Invoice</th>
                    <th>Admin</th>
                    <th>Pasien</th>
                    <th>Jenis Pasien</th>
                    <th>Tindakan</th>
                    <th>Dokter</th>
                    <th>Mode Pembayaran</th>
                    <th>Total Harga</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $invoice->id_invoice }}</td>
                    <td>{{ $invoice->admin }}</td>
                    <td>{{ $invoice->pasien }}</td>
                    <td>{{ $invoice->jenis_pasien }}</td>
                    @php
                        $tindakanArray = json_decode($invoice->tindakan, true);
                    @endphp
                    <td>
                        @if (count($tindakanArray) == 1)
                            {{ $tindakanArray[0] }}
                        @else
                            <div class="scrollable-column">
                                @foreach ($tindakanArray as $allTindakan)
                                    <span>{{ $allTindakan }}</span>
                                @endforeach
                            </div>
                        @endif
                    </td>
                    <td>{{ $invoice->dokter }}</td>
                    <td>{{ $invoice->modepembayaran }}</td>
                    <td>Rp. {{ number_format($invoice->totalharga, 0, ',', '.') }}</td>
                    <td>{{ $invoice->tanggal }}</td>
                </tr>
            </tbody>
        </table>
        <div class="invoice-total">
            <strong>Total Harga:</strong> Rp. {{ number_format($invoice->totalharga, 0, ',', '.') }}
        </div>
    </div>
</div>
</body>
</html>