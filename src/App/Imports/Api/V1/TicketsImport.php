<?php

namespace Callmeaf\Ticket\App\Imports\Api\V1;

use Callmeaf\Base\App\Services\Importer;
use Callmeaf\Ticket\App\Enums\TicketStatus;
use Callmeaf\Ticket\App\Repo\Contracts\TicketRepoInterface;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class TicketsImport extends Importer implements ToCollection,WithChunkReading,WithStartRow,SkipsEmptyRows,WithValidation,WithHeadingRow
{
    private TicketRepoInterface $ticketRepo;

    public function __construct()
    {
        $this->ticketRepo = app(TicketRepoInterface::class);
    }

    public function collection(Collection $collection)
    {
        $this->total = $collection->count();

        foreach ($collection as $row) {
            $this->ticketRepo->freshQuery()->create([
                // 'status' => $row['status'],
            ]);
            ++$this->success;
        }
    }

    public function chunkSize(): int
    {
        return \Base::config('import_chunk_size');
    }

    public function startRow(): int
    {
        return 2;
    }

    public function rules(): array
    {
        $table = $this->ticketRepo->getTable();
        return [
            // 'status' => ['required',Rule::enum(TicketStatus::class)],
        ];
    }

}
