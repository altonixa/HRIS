<?php

namespace App\Exports;

use App\Models\AttendanceLog;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AttendanceExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        return AttendanceLog::with(['employee.department'])
            ->whereBetween('clock_in', [$this->startDate, $this->endDate])
            ->orderBy('clock_in', 'desc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Date',
            'Employee ID',
            'Employee Name',
            'Department',
            'Clock In',
            'Clock Out',
            'Duration (Hours)',
            'Status',
        ];
    }

    public function map($attendance): array
    {
        $duration = null;
        if ($attendance->clock_in && $attendance->clock_out) {
            $duration = round($attendance->clock_in->diffInHours($attendance->clock_out), 2);
        }

        return [
            $attendance->clock_in->format('Y-m-d'),
            $attendance->employee->employee_code,
            $attendance->employee->first_name . ' ' . $attendance->employee->last_name,
            $attendance->employee->department->name ?? 'N/A',
            $attendance->clock_in->format('H:i:s'),
            $attendance->clock_out ? $attendance->clock_out->format('H:i:s') : 'Not clocked out',
            $duration ?? 'N/A',
            $attendance->clock_out ? 'Complete' : 'In Progress',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true], 'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8B5CF6']]],
        ];
    }
}
