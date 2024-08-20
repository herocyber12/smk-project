<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class NilaiEksport implements FromArray, WithHeadings
{
    protected $data;
    protected $mapelList;

    public function __construct(array $data, array $mapelList)
    {
        $this->data = $data;
        $this->mapelList = $mapelList;
    }

    public function array(): array
    {
        return $this->data;
    }

    public function headings(): array
    {
        // Buat heading berdasarkan mapel yang ada
        return array_merge(['Nama'], $this->mapelList);
    }
}
