<?php

namespace App\Imports;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\HrAttendance;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;

class AttendanceImport implements ToModel, WithHeadingRow
{
    private $emp_id;

    public function __construct($emp_id)
    {
        $this->emp_id = $emp_id;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $formattedDate = Carbon::parse($row['date'])->format('Y-m-d');

        return new HrAttendance([
            "finger_id"         => $row['id'],
            "date"              => $formattedDate,
            "in_time"           => $row['in'],
            "out_time"          => $row['out'],
            "location"          => $row['location'],
            "description"       => $row['description'],
            "attendance_type"   => 1,
            "status"            => 1,
            // "finger_id"         => $row[7],
            // "emp_id"            => $emp_id,
            "user_id"           => Auth::user()->id,
        ]);

    }
}
