<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Invoice {{ $booking->booking_code }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #333;
            font-size: 14px;
            line-height: 1.5;
            margin: 0;
            padding: 20px;
        }

        .header {
            border-bottom: 2px solid #c1440e;
            padding-bottom: 15px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
            color: #1f1209;
            margin: 0;
        }

        .subtitle {
            font-size: 12px;
            color: #666;
            margin-top: 4px;
        }

        .badge {
            display: inline-block;
            padding: 4px 10px;
            font-size: 11px;
            font-weight: bold;
            border-radius: 4px;
            text-transform: uppercase;
        }

        .badge-paid {
            background: #d1fae5;
            color: #065f46;
        }

        .badge-unpaid {
            background: #fef3c7;
            color: #92400e;
        }

        .section-title {
            font-size: 15px;
            font-weight: bold;
            color: #c1440e;
            margin-bottom: 8px;
            border-bottom: 1px solid #eee;
            padding-bottom: 4px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #f0f0f0;
            font-size: 13px;
        }

        th {
            background: #fbf3e7;
            color: #1f1209;
        }

        .total-row {
            font-size: 16px;
            font-weight: bold;
            color: #1f1209;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 11px;
            color: #888;
            border-top: 1px solid #eee;
            pt: 10px;
        }
    </style>
</head>

<body>

    <div class="header">
        <div>
            <div class="title">Wisata Budaya Lombok</div>
            <div class="subtitle">Bukti Pemesanan Resmi / Invoice Trip Sasak</div>
        </div>
        <div style="text-align: right;">
            <strong>Kode: {{ $booking->booking_code }}</strong><br>
            <span style="font-size: 12px; color: #666;">Tanggal:
                {{ $booking->created_at->translatedFormat('d M Y') }}</span>
        </div>
    </div>

    <div style="margin-bottom: 20px;">
        <span class="section-title">Informasi Pelanggan</span>
        <p style="margin: 4px 0;"><strong>Nama:</strong> {{ $booking->user->name }}</p>
        <p style="margin: 4px 0;"><strong>Email:</strong> {{ $booking->user->email }}</p>
        <p style="margin: 4px 0;"><strong>No. WhatsApp:</strong> {{ $booking->phone }}</p>
    </div>

    <div style="margin-bottom: 20px;">
        <span class="section-title">Rincian Perjalanan</span>
        <table>
            <thead>
                <tr>
                    <th>Paket Trip</th>
                    <th>Keberangkatan</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>{{ $booking->trip->name }}</strong></td>
                    <td>{{ $booking->departure_date->translatedFormat('d M Y') }}</td>
                    <td>{{ $booking->participants }} Orang</td>
                    <td>Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div style="margin-bottom: 20px; text-align: right;">
        <p style="margin: 4px 0;">Status Pembayaran:
            <span class="badge {{ $booking->payment_status === 'paid' ? 'badge-paid' : 'badge-unpaid' }}">
                {{ ucfirst($booking->payment_status) }}
            </span>
        </p>
        <p class="total-row" style="margin: 8px 0;">Total Tagihan: Rp
            {{ number_format($booking->total_price, 0, ',', '.') }}</p>
    </div>

    @if ($booking->notes)
        <div style="margin-bottom: 20px; background: #fbf3e7; padding: 10px; border-radius: 6px;">
            <strong>Catatan Pemesan:</strong>
            <p style="margin: 4px 0 0 0; font-size: 12px;">{{ $booking->notes }}</p>
        </div>
    @endif

    <div class="footer">
        <p>Terima kasih telah memesan melalui Wisata Budaya Lombok. Simpan dokumen ini sebagai bukti pemesanan yang sah.
        </p>
    </div>

</body>

</html>
