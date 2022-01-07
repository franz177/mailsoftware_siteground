<?php

namespace App\Exports;

use App\Models\Booking;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Excel;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BookingCustomExport implements FromQuery, Responsable, WithHeadings, ShouldAutoSize, WithStyles
{
    use Exportable;

    protected $column = null;
    protected $year = null;
    protected $house = null;
    protected $bookings_status = null;

    public function __construct($column_default, $column, $year, $house, $bookings_status)
    {
        if ($column_default)
            $this->column = $column_default;

        if ($column)
            $this->column = array_merge($this->column, $column) ;

        if ($year)
            $this->year = implode(',', $year);

        if ($house)
            $this->house = $house;

        if ($bookings_status)
            $this->bookings_status = $bookings_status;

    }

    /**
     * It's required to define the fileName within
     * the export class when making use of Responsable.
     */
    private $fileName = '';

    /**
     * Optional Writer Type
     */
    private $writerType = Excel::XLSX;

    public function setFileName($today)
    {
        $this->fileName = 'bookings_export_'.$today.'.xlsx';
    }

    /**
    * @return \Illuminate\Support\Collection
    */
//    public function collection()
//    {
//        return Booking::all();
//    }

    public function query()
    {
        return Booking::query()
            ->when($this->column, function ($q, $column){
                return $q->select($column);
            })
            ->when($this->year, function ($q, $year){
                return $q->whereRaw('(YEAR(tx_mask_p_data_arrivo) IN ('. $year .') OR YEAR(tx_mask_p_data_partenza) IN ('. $year .'))');
            })
            ->when($this->house, function ($q, $house){
                return $q->whereIn('tx_mask_p_casa', $house);
            })
            ->when($this->bookings_status, function ($q, $bookings_status){
                return $q->whereNotIn('tx_mask_cod_reservation_status', $bookings_status);
            });

    }

    public function headings(): array
    {
        return $this->column;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }
}
