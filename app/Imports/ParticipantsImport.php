<?php
namespace App\Imports;

use App\Models\Participant;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ParticipantsImport implements ToModel,WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        $data = [
            'serial_no' => $row['sl_no'] ?? "Null",
            'name_en' => $row['name'] ?? "Null",
            'name_bn' => $row['bangla_name']??"Null",
            'event_id' => session('event_id'),
            'class' => $row['class'] ?? "Null",
            'inst_name' => $row['institue_name']??"Null",
            'inst_address' => $row['institue_address'] ?? "Null",
            'dob' => $row['date_of_birth'] ?? "Null",
            'email' => $row['email'] ?? "Null",
            'phone' => $this->addLeadingZeroIfNeeded((string) $row['phone']),
        ];
        Participant::create($data);
    }
    function addLeadingZeroIfNeeded($inputString)
    {
        if (!empty($inputString) && $inputString[0] !== '0' && strlen($inputString) == 10) {
            return '0' . $inputString;
        }
        return $inputString;
    }
}
