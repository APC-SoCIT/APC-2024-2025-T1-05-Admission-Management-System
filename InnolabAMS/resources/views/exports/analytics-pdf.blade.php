<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Analytics Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .report-header {
            margin-bottom: 20px;
        }
        .report-title {
            font-size: 18px;
            font-weight: bold;
        }
        .timestamp {
            margin-top: 5px;
            font-style: italic;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="report-header">
        <div class="report-title">Insights Report</div>
        <div class="timestamp">Generated at: {{ now()->timezone('Asia/Manila')->format('Y-m-d H:i:s') }}</div>
    </div>

    <!-- Admissions Section -->
    <h3>Admissions</h3>
    <table>
        <thead>
            <tr>
                <th>Status</th>
                <th>Count</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>New</td>
                <td>{{ $analytics['admissions']['new'] }}</td>
            </tr>
            <tr>
                <td>Accepted</td>
                <td>{{ $analytics['admissions']['accepted'] }}</td>
            </tr>
            <tr>
                <td>Rejected</td>
                <td>{{ $analytics['admissions']['rejected'] }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Inquiries Section -->
    <h3>Inquiries</h3>
    <table>
        <thead>
            <tr>
                <th>Status</th>
                <th>Count</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>New</td>
                <td>{{ $analytics['inquiries']['new'] }}</td>
            </tr>
            <tr>
                <td>Resolved</td>
                <td>{{ $analytics['inquiries']['resolved'] }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Scholarships Section -->
    <h3>Scholarships</h3>
    <table>
        <thead>
            <tr>
                <th>Status</th>
                <th>Count</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Total</td>
                <td>{{ $analytics['scholarships']['total'] }}</td>
            </tr>
            <tr>
                <td>Approved</td>
                <td>{{ $analytics['scholarships']['approved'] }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Monthly Trend Section -->
    <h3>Monthly Trend</h3>
    <table>
        <thead>
            <tr>
                <th>Month</th>
                <th>Applications</th>
            </tr>
        </thead>
        <tbody>
            @foreach(array_combine($analytics['monthlyTrend']['labels'], $analytics['monthlyTrend']['data']) as $month => $count)
            <tr>
                <td>{{ $month }}</td>
                <td>{{ $count }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="timestamp">
        Last Updated: {{ $analytics['lastUpdated'] }}
    </div>
</body>
</html>
