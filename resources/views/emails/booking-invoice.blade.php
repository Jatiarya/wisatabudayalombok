<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Invoice Pemesanan</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f7f3ed; color: #333; margin: 0; padding: 20px;">
    <div
        style="max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">

        <!-- Header -->
        <div style="background: #1f1209; color: #fbf3e7; padding: 24px; text-align: center;">
            <h1 style="margin: 0; font-size: 20px;">Wisata Budaya Lombok</h1>
            <p style="margin: 5px 0 0 0; font-size: 12px; color: #d9a441;">Pesanan Anda Berhasil Dibuat!</p>
        </div>

        <!-- Content -->
        <div style="padding: 24px;">
            <p>Halo <strong>{{ $booking->user->name }}</strong>,</p>
            <p>Terima kasih telah melakukan pemesanan paket wisata bersama kami. Berikut adalah ringkasan kode *booking*
                Anda:</p>

            <div
                style="background: #fbf3e7; border-left: 4px solid #c1440e; padding: 12px; margin: 20px 0; border-radius: 4px;">
                <p style="margin: 0; font-size: 13px; color: #666;">Kode Booking:</p>
                <p style="margin: 4px 0 0 0; font-size: 18px; font-weight: bold; color: #1f1209;">
                    {{ $booking->booking_code }}</p>
            </div>

            <table style="width: 100%; border-collapse: collapse; font-size: 13px; margin-bottom: 20px;">
                <tr>
                    <td style="padding: 8px 0; color: #666;">Paket Trip</td>
                    <td style="padding: 8px 0; font-weight: bold; text-align: right;">{{ $booking->trip->name }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; color: #666;">Tanggal Keberangkatan</td>
                    <td style="padding: 8px 0; font-weight: bold; text-align: right;">
                        {{ $booking->departure_date->translatedFormat('d F Y') }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; color: #666;">Jumlah Peserta</td>
                    <td style="padding: 8px 0; font-weight: bold; text-align: right;">{{ $booking->participants }} Orang
                    </td>
                </tr>
                <tr style="border-top: 1px solid #eee;">
                    <td style="padding: 12px 0; font-weight: bold; color: #1f1209;">Total Biaya</td>
                    <td style="padding: 12px 0; font-weight: bold; color: #c1440e; text-align: right; font-size: 15px;">
                        Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                </tr>
            </table>

            <p style="font-size: 13px; color: #666; line-height: 1.5;">
                Silakan akses halaman detail pesanan melalui akun Anda untuk menyelesaikan proses pembayaran via
                Midtrans.
            </p>
        </div>

        <!-- Footer -->
        <div style="background: #f7f3ed; padding: 16px; text-align: center; font-size: 11px; color: #888;">
            <p style="margin: 0;">&copy; {{ date('Y') }} Wisata Budaya Lombok. Semua Hak Dilindungi.</p>
        </div>
    </div>
</body>

</html>
