<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

/**
 * Category Sheet Design
 *
 * @author Cho Cho Theint
 *
 * @create date 23-06-2023
 *
 */

class CategoryExport implements FromCollection, WithTitle, WithHeadings, WithStyles, WithColumnWidths
{
    protected $category;

    public function __construct($category)
    {
        $this->category = $category;
    }
    /**
     * Define the data of the sheet
     *
     * @author Cho Cho Theint
     * @create date 23-06-2023
     * @return collection
     *
     */
    public function collection()
    {
        return $this->category;
    }
    /**
     * Define the header of the sheet
     *
     * @author Cho Cho Theint
     * @create date 23-06-2023
     * @return array
     *
     */
    public function headings(): array
    {
        return ['Id', 'Category Name'];
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
        return 'Category Name';
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
        $sheet->getStyle('A1:B1')->applyFromArray([
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'color' => ['rgb' => '00A36C'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);
        $sheet
            ->getStyle('A1:B1')
            ->getFont()
            ->setBold(true);
        $sheet
            ->getStyle('A1:B1')
            ->getFont()
            ->setSize(12);
        $sheet->getRowDimension(1)->setRowHeight(35);
        $sheet
            ->getStyle('A1:B1')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);
    }
      /**
     * cloumn width sheet
     *
     * @author Cho Cho Theint
     * @create date 23-06-2023
     * @return array
     *
     */
    public function columnWidths(): array
    {
        return [
            'A' => 12,
            'B' => 18,
        ];
    }
}
