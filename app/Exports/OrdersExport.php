<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OrdersExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Order::with('user')->get();
    }

    public function headings(): array
    {
        return [
            "Nama Pembeli", "Email Pembeli", "Buku", "Catatan", "Total Bayar", "Tanggal"
        ];
    }

    public function map($item): array
    {
        $dataBuku = '';
        foreach ($item->books as $value) {
            $format = $value["name_book"] . " (qty " . $value['qty'] . " : Rp. " .number_format($value[
                'sub_price']) . "),";
            $dataBuku .= $format;
        }
        return [
            $item->name_customer,
            $item->user->email,
            $dataBuku,
            $item->notes,
            "Rp." . number_format($item->total_price, 0, ',', '.'),
            \Carbon\Carbon::parse($item->created_at)->format('d F Y'),
        ];
    }
}
