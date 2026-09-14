<?php

namespace App\Exports;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BookingReportExport implements FromQuery, WithHeadings, WithMapping, WithStyles, ShouldAutoSize, WithEvents
{
    /** Jumlah kolom data, dipakai untuk menentukan lebar merge cell header. */
    protected int $columnCount = 8;

    public function __construct(
        protected ?int $month = null,
        protected ?int $year = null,
    ) {}

    public function query(): Builder
    {
        return Booking::query()
            ->with(['user', 'trip'])
            ->where('status', 'completed')
            ->when($this->month, fn($q) => $q->whereMonth('departure_date', $this->month))
            ->when($this->year, fn($q) => $q->whereYear('departure_date', $this->year))
            ->orderByDesc('departure_date');
    }

    public function headings(): array
    {
        return [
            'Kode Booking',
            'Nama Pelanggan',
            'Telepon',
            'Paket Trip',
            'Tanggal Aktivitas',
            'Jumlah Peserta',
            'Total Harga (Rp)',
            'Status Pembayaran',
        ];
    }

    public function map($booking): array
    {
        return [
            $booking->booking_code,
            $booking->user->name,
            $booking->phone,
            $booking->trip->name,
            $booking->departure_date->format('d/m/Y'),
            $booking->participants,
            (float) $booking->total_price,
            ucfirst($booking->payment_status),
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        // Baris heading kolom ada di baris ke-6 setelah 5 baris header custom disisipkan (lihat registerEvents)
        return [
            6 => [
                'font' => ['bold' => true],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F3E8D9'],
                ],
            ],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $lastColumn = Coordinate::stringFromColumnIndex($this->columnCount);

                // Geser heading + data turun 5 baris untuk memberi ruang header default
                $sheet->insertNewRowBefore(1, 5);

                $sheet->setCellValue('A1', 'REKAPITULASI LAPORAN PESANAN SELESAI');
                $sheet->mergeCells("A1:{$lastColumn}1");
                $sheet->getStyle('A1')->getFont('')->setBold(true)->setSize(14);

                $sheet->setCellValue('A2', 'Wisata Budaya Lombok');
                $sheet->mergeCells("A2:{$lastColumn}2");
                $sheet->getStyle('A2')->getFont()->setSize(13)->setColor(new Color('FF8B5E34'));

                $sheet->setCellValue('A3', 'Periode: ' . $this->periodLabel());
                $sheet->mergeCells("A3:{$lastColumn}3");

                $sheet->setCellValue('A4', 'Dicetak pada: ' . now()->translatedFormat('d F Y, H:i') . ' WITA');
                $sheet->mergeCells("A4:{$lastColumn}4");
                $sheet->getStyle('A4')->getFont()->setItalic(true)->setSize(9);

                // Baris 5 sengaja dikosongkan sebagai spacer sebelum tabel data dimulai (baris 6)

                foreach (range(1, 4) as $row) {
                    $sheet->getStyle("A{$row}:{$lastColumn}{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
                }
            },
        ];
    }

    protected function periodLabel(): string
    {
        if (! $this->month && ! $this->year) {
            return 'Semua Periode';
        }

        $months = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        if ($this->month && $this->year) {
            return $months[$this->month] . ' ' . $this->year;
        }

        if ($this->month) {
            return $months[$this->month] . ' (Semua Tahun)';
        }

        return 'Tahun ' . $this->year;
    }
}
