<?php

namespace App\Exports;

use OpenSpout\Common\Entity\Style\Style;
use OpenSpout\Writer\XLSX\Writer;
use OpenSpout\Writer\XLSX\Options;

class AnalyticsExport
{
    protected array $analytics;

    public function __construct(array $analytics)
    {
        $this->analytics = $analytics;
    }

    public function export(string $filePath): void
    {
        $options = new Options();
        $writer = new Writer($options);

        $headerStyle = (new Style())->setFontBold();

        $writer->openToFile($filePath);

        // Write headers
        $writer->addRow(['Analytics Report'], $headerStyle);
        $writer->addRow(['Generated at: ' . now()->format('Y-m-d H:i:s')]);
        $writer->addRow([]);

        // Admissions section
        $writer->addRow(['Admissions'], $headerStyle);
        $writer->addRow(['New', 'Accepted', 'Rejected']);
        $writer->addRow([
            $this->analytics['admissions']['new'],
            $this->analytics['admissions']['accepted'],
            $this->analytics['admissions']['rejected']
        ]);
        $writer->addRow([]);

        // Inquiries section
        $writer->addRow(['Inquiries'], $headerStyle);
        $writer->addRow(['New', 'Resolved']);
        $writer->addRow([
            $this->analytics['inquiries']['new'],
            $this->analytics['inquiries']['resolved']
        ]);
        $writer->addRow([]);

        // Scholarships section
        $writer->addRow(['Scholarships'], $headerStyle);
        $writer->addRow(['Total', 'Approved']);
        $writer->addRow([
            $this->analytics['scholarships']['total'],
            $this->analytics['scholarships']['approved']
        ]);
        $writer->addRow([]);

        // Monthly Trend section
        $writer->addRow(['Monthly Trend'], $headerStyle);
        $writer->addRow($this->analytics['monthlyTrend']['labels']);
        $writer->addRow($this->analytics['monthlyTrend']['data']);

        $writer->close();
    }
}
