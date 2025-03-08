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
        $writer = new Writer();
        $writer->openToFile($filePath);

        // Add header with style
        $headerStyle = (new Style())->setFontBold();
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
