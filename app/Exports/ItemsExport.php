<?php

namespace App\Exports;

use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

/**
 * Item Sheet Design
 *
 * @author Cho Cho Theint
 *
 * @create date 23-06-2023
 *
 */
class ItemsExport implements WithTitle, WithHeadings, WithStyles, WithColumnWidths
{
    /**
     * Define the header of the sheet
     *
     * @author Cho Cho Theint
     * @create date 23-06-2023
     * @return string
     *
     */
    public function headings(): array
    {
        return [
            ["The Red Fields can't be empty.  There should be only 100 records.Please Look at the Category Name sheet and enter the category name."], 
            ['Item Code', 'Item Name', 'Category Name', 'Safety Stock', 'Receieved Date', 'Description']];
    }
    /**
     * Define the title of the sheet
     *
     * @author Cho Cho Theint
     * @create date 23-06-2023
     * @return string
     *
     */
    public function title(): string
    {
        return 'ItemRegistration';
    }
    /**
     * Define the style of the sheet
     *
     * @author Cho Cho Theint
     * @create date 23-06-2023
     * @return string
     *
     */
    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A2:E2')->applyFromArray([
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'color' => ['rgb' => 'FF6666'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);
        $sheet->getStyle('F2')->applyFromArray([
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'color' => ['rgb' => '00A36C'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);
        $sheet->mergeCells('A1:F1');
        $sheet->getStyle('A1:F1')->applyFromArray([
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'color' => ['rgb' => 'FF6666'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);
        $sheet
            ->getStyle('A2:F2')
            ->getFont()
            ->setBold(true);
        $sheet
            ->getStyle('A2:F2')
            ->getFont()
            ->setSize(12);
        $sheet->getRowDimension(1)->setRowHeight(25);
        $sheet
            ->getStyle('A2:F2')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);
    }
    /**
     * Define the style of the sheet
     *
     * @author Cho Cho Theint
     * @create date 23-06-2023
     * @return array
     */
    public function columnWidths(): array
    {
        return [
            'A' => 22,
            'B' => 20,
            'C' => 20,
            'D' => 20,
            'E' => 20,
            'F' => 20,
        ];
    }
}
