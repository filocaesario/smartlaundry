<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Pesanan - {{ $order->nomor_resi }}</title>
    <style>
        @page { size: 100mm 150mm; margin: 10mm; background-color: #fafafa; }
        body { font-family: 'Courier New', Courier, monospace; color: #000; font-size: 12px; margin: 0; padding: 0; }
        .brand { text-align: center; font-weight: bold; font-size: 18px; margin-bottom: 5px; }
        .address { text-align: center; font-size: 10px; margin-bottom: 20px; border-bottom: 1px dashed #000; padding-bottom: 10px; }
        .info { margin-bottom: 15px; line-height: 1.5; }
        .item-row { display: table; width: 100%; margin-bottom: 5px; }
        .item-name { display: table-cell; text-align: left; }
        .item-price { display: table-cell; text-align: right; }
        .line { border-top: 1px dashed #000; margin: 10px 0; }
        .total-row { display: table; width: 100%; font-weight: bold; font-size: 14px; margin-top: 10px; }
        .total-label { display: table-cell; text-align: left; }
        .total-value { display: table-cell; text-align: right; }
        .footer { text-align: center; margin-top: 30px; font-style: italic; font-size: 10px; }
    </style>
</head>
<body>
    <div class="brand">SMART LAUNDRY</div>
    <div class="address">
        Jl. Raya Software PPLG No. 25<br>
        WhatsApp: 0812-3456-7890
    </div>

    <div class="info">
        <div>No. Resi: <strong>{{ $order->nomor_resi }}</strong></div>
        <div>Tanggal : {{ $order->created_at->format('d/m/Y H:i') }}</div>
        <div>Nama    : {{ $order->nama_pelanggan }}</div>
    </div>

    <div class="line"></div>

    <div class="item-row">
        <div class="item-name">{{ $order->service->nama_layanan }} ({{ $order->jumlah_berat }} {{ $order->service->satuan }})</div>
        <div class="item-price">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</div>
    </div>

    <div class="line"></div>

    <div class="total-row">
        <div class="total-label">TOTAL</div>
        <div class="total-value">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</div>
    </div>

    <div class="footer">
        Terima kasih atas kepercayaan Anda!<br>
        Cucian bersih, hati pun senang.
    </div>
</body>
</html>
