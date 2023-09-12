<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

class SampleParticipantExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Replace this with your actual data source (e.g., Eloquent query or array).
        // For this example, we'll use a simple collection.
        return collect([
            ["1", "Rokan Uddin", "রোকন উদ্দীন", "Al Jaber Institute", "Jamal Khan, Chittagong", "5", "24/12/1999", "01832---", "rokan@gmail.com"],
            // Add more rows here if needed.
        ]);
    }

    public function headings(): array
    {
        return ['SL No', 'Name', 'Bangla Name', 'Institue Name', 'Institue Address', 'Class', 'Date of Birth', 'Phone', 'Email']; // Sample heading row

    }
}
