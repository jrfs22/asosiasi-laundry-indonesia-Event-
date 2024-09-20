<?php

namespace App\Exports;

use App\Models\ParticipantsModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;

class AbsensiExport implements FromCollection, WithHeadings, WithStyles, WithMapping
{
    public function headings(): array
    {
        return [
            'Nama',
            'No HP',
            'Serifikat',
        ];
    }

    public function collection()
    {
        return ParticipantsModel::with('attendances')
        ->has('attendances')
        ->get();
    }

    public function map($participant): array
    {
        return [
            $participant->name,
            $participant->phone_number,
            $participant->certificate_name,
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
