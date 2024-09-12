<?php

namespace App\Exports;

use App\Models\ParticipantsModel;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStyles;

class PesertaExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    public function collection()
    {
        return ParticipantsModel::where('qrcode', '!=', null)->get();
    }

    public function map($participant): array
    {
        return [
            $participant->name,
            $participant->phone_number,
            $participant->laundry_name,
            $participant->certificate_name,
            $participant->type,
        ];
    }

    public function headings(): array
    {
        return [
            'Name',
            'Nomer HP/WA',
            'Nama Laundry',
            'Sertifikat',
            'Member'
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
