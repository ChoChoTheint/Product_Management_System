<?php

namespace App\Exports;

use App\Model\Item;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
/**
 * Item download Sheet Design
 *
 * @author Cho Cho Theint
 *
 * @create date 23-06-2023
 *
 */
class ExcelDownloadExport implements FromCollection, WithTitle, WithHeadings, WithStyles, WithColumnWidths
{
    protected $items;

    public function __construct($items)
    {
        $this->items = $items;
    }
    /**
     * Define the data of the sheet
     *
     * @author Cho Cho Theint
     *
     * @create date 30-06-2023
     *
     */
    public function collection()
    {
        return $this->items;
    }
    /**
     * Title name of sheet
     *
     * @author Cho Cho Theint
     *
     * @create date 23-06-2023
     *
     */
    public function title(): string
    {
        return 'Item';
    }
    /**
     * Heading name of sheet
     *
     * @author Cho Cho Theint
     *
     * @create date 23-06-2023
     *
     */
    public function headings(): array
    {
        return ['Item ID', 'Item Code', 'Item Name', 'Category Name', 'Safety Stock','Received Date','Description'];
    }
    /**
     * Sheet style
     *
     * @author Cho Cho Theint
     *
     * @create date 23-06-2023
     *
     */
    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:G1')->applyFromArray([
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'color' => ['rgb' => '00A36C'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);
        $sheet->getStyle('G' . ($this->items->count() + 1))
        ->getAlignment()
        ->setWrapText(true);

        $sheet
            ->getStyle('A1:G1')
            ->getFont()
            ->setBold(true);
        $sheet
            ->getStyle('A1:G1')
            ->getFont()
            ->setSize(12);
        $sheet->getRowDimension(1)->setRowHeight(25);
        $sheet
            ->getStyle('A1:G1')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);
    }
    /**
     * cloumn width sheet
     *
     * @author Cho Cho Theint
     *
     * @create date 23-06-2023
     *
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
            'G' => 20,
        ];
    }
}
