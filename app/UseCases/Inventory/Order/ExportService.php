<?php

namespace App\UseCases\Inventory\Order;

use App\Models\Inventory\Order\Order;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportService
{
    private $filename = 'Заказ расходников.xlsx';

    public function download(Order $order)
    {
        putenv('TMPDIR=' . public_path('/templates'));
        return Excel::create($this->filename, function($excel) use ($order) {

            $excel->sheet('Список для заказа', function($sheet) use ($order) {

                $sheet->setHeight([1 => 45]);
                $sheet->setBorder('A1:E1', 'thin');
                $sheet->cells('A1:E1', function($cells) {
                    $cells->setFont([
                        'bold'   => true
                    ]);
                });

                $sheet->setCellValue('A1', '#');
                $sheet->setCellValue('B1', 'Модель расходника');
                $sheet->setCellValue('C1', 'Цвет');
                $sheet->setCellValue('D1', 'Модели совместимых принтеров');
                $sheet->setCellValue('E1', 'Количество');

                $sheet->cells('A1:E50', function($cells) {
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });

                $row = 2;
                $num = 1;
                foreach ($order->items as $item) {
                    $sheet->setCellValue('A' . $row, $num++);
                    $sheet->setCellValue('B' . $row, $item->consumable->name);
                    $sheet->setCellValue('C' . $row, $item->consumable->color->name);
                    $sheet->setCellValue('D' . $row, implode(PHP_EOL, $item->consumable->printers()->pluck('name')->toArray()));
                    $sheet->setCellValue('E' . $row, $item->count);
                    $sheet->getRowDimension($row++)->setRowHeight(-1);
                }

                $sheet->setBorder('A1:E' . --$row, 'thin');

                $sheet->setCellValue('B' . ($row + 2), 'Заказал');
                $sheet->setCellValue('B' . ($row + 3), 'Дата заказа');
                $sheet->setCellValue('B' . ($row + 4), 'Объект');
                $sheet->setCellValue('B' . ($row + 5), 'Ответственное лицо');
                $sheet->setCellValue('C' . ($row + 2), $order->user ? $order->user->name : '-');
                $sheet->setCellValue('C' . ($row + 3), $order->created_at->format('d.m.y H:i'));
                $sheet->setCellValue('C' . ($row + 4), $order->object->getFullName());
                $sheet->setCellValue('C' . ($row + 5), $order->responsible);

                $sheet->getStyle('A1:E' . $row)->getAlignment()->setWrapText(true);
                $sheet->getStyle('A1');
            });

        })->export('xls');
    }
}
