<?php

namespace App\Exports;

use OpenSpout\Common\Entity\Row;
use OpenSpout\Common\Entity\Style\Style;
use OpenSpout\Writer\XLSX\Writer;

class AnalyticsExport
{
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function export(string $filePath)
    {
        // Set timezone to Asia/Manila
        date_default_timezone_set('Asia/Manila');

        $writer = new Writer();
        $writer->openToFile($filePath);

        // Add header with style and generated timestamp
        $headerStyle = (new Style())->setFontBold();

        // Add report title and timestamp
        $writer->addRow(Row::fromValues([
            'Analytics Report'
        ], $headerStyle));

        $writer->addRow(Row::fromValues([
            'Generated at: ' . now()->timezone('Asia/Manila')->format('Y-m-d H:i:s')
        ]));

        // Add blank row for spacing
        $writer->addRow(Row::fromValues(['']));

        // Add data headers
        $writer->addRow(Row::fromValues([
            'Category',
            'Metric',
            'Count'
        ], $headerStyle));

        // Add Admissions data
        foreach ($this->data['admissions'] as $status => $count) {
            $writer->addRow(Row::fromValues([
                'Admissions',
                ucfirst($status),
                $count
            ]));
        }

        // Add Inquiries data
        foreach ($this->data['inquiries'] as $status => $count) {
            $writer->addRow(Row::fromValues([
                'Inquiries',
                ucfirst($status),
                $count
            ]));
        }

        // Add Scholarships data
        foreach ($this->data['scholarships'] as $status => $count) {
            $writer->addRow(Row::fromValues([
                'Scholarships',
                ucfirst($status),
                $count
            ]));
        }

        // Add Monthly Trend data
        foreach (array_combine($this->data['monthlyTrend']['labels'], $this->data['monthlyTrend']['data']) as $month => $count) {
            $writer->addRow(Row::fromValues([
                'Monthly Trend',
                $month,
                $count
            ]));
        }

        $writer->close();
    }
}
