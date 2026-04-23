<html>
<head>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { bg-color: #f2f2f2; }
        .header { text-align: center; margin-bottom: 30px; }
        .total { margin-top: 20px; font-weight: bold; font-size: 18px; color: #4f46e5; }
    </style>
</head>
<body>
    <div class="header">
        <h2>LAPORAN PENDAPATAN SMARTLAUNDRY</h2>
        <p>Periode: {{ $bulan }} / {{ $tahun }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Resi</th>
                <th>Tanggal</th>
                <th>Layanan</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->nomor_resi }}</td>
                <td>{{ $order->created_at->format('d/m/Y') }}</td>
                <td>{{ $order->service->nama_layanan }}</td>
                <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        Total Pendapatan: Rp {{ number_format($total_pendapatan, 0, ',', '.') }}
    </div>
</body>
</html>
