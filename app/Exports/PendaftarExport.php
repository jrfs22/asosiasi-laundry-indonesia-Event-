<?php

namespace App\Exports;

use App\Models\RegistrationModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;

class PendaftarExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    public function collection()
    {
        return RegistrationModel::where('payment_status', 'lunas')->get();
    }

    public function map($register): array
    {
        return [
            $register->name,
            $register->phone_number,
            $register->tickets,
            $register->discount_percentage,
            idrFormat($register->discount_total),
            idrFormat($register->amount + $register->discount_total),
            asset('storage/' . $register->bukti_pembayaran)
        ];
    }

    public function headings(): array
    {
        return [
            'Pemesan',
            'Nomor HP/Wa',
            'Jumlah tiket',
            'Total Diskon (%)',
            'Total Diskon (Rp)',
            'Total Pembayaran',
            'Bukti Pembayaran'
        ];
    }

    public function styles(\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $sheet)
    {
        return [
            1 => ['font' =>
                [
                    'bold' => true,
                    'size' => 12,
                    'color' => ['argb' => 'FF000000']
                ]
            ]
        ];
    }
}
