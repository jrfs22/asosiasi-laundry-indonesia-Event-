<?php

namespace App\Exports;

use App\Models\ParticipantsModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;

class ParticipantQrCodeExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    public function collection()
    {
        return ParticipantsModel::all();
    }

    public function map($participant): array
    {
        return [
            $participant->name,
            formatString($participant->name) . '/' . $participant->registration_id,
            route('tickets', [
                'name' => formatString($participant->name),
                'participant_id' => $participant->id
            ])
        ];
    }

    public function headings(): array
    {
        return [
            'Name',
            'QR Code Data',
            'Links'
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
