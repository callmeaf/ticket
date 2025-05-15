<?php

namespace Callmeaf\Ticket\App\Exports\Web\V1;

use Callmeaf\Ticket\App\Models\Ticket;
use Callmeaf\Ticket\App\Repo\Contracts\TicketRepoInterface;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomChunkSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Excel;

class TicketsExport implements FromCollection,WithHeadings,Responsable,WithMapping,WithCustomChunkSize
{
    use Exportable;

    /**
     * It's required to define the fileName within
     * the export class when making use of Responsable.
     */
    private $fileName = '';

    /**
     * Optional Writer Type
     */
    private $writerType = Excel::XLSX;

    /**
     * Optional headers
     */
    private $headers = [
        'Content-Type' => 'text/csv',
    ];

    private TicketRepoInterface $ticketRepo;
    public function __construct()
    {
        $this->ticketRepo = app(TicketRepoInterface::class);
        $this->fileName = $this->fileName ?: \Base::exportFileName(model: $this->ticketRepo->getModel()::class,extension: $this->writerType);
    }

    public function collection()
    {
        if(\Base::getTrashedData()) {
            $this->ticketRepo->trashed();
        }

        $this->ticketRepo->latest()->search();

        if(\Base::getAllPagesData()) {
            return $this->ticketRepo->lazy();
        }

        return $this->ticketRepo->paginate();
    }

    public function headings(): array
    {
        return [
           // 'status',
        ];
    }

    /**
     * @param Ticket $row
     * @return array
     */
    public function map($row): array
    {
        return [
            // $row->status?->value,
        ];
    }

    public function chunkSize(): int
    {
        return \Base::config('export_chunk_size');
    }
}
