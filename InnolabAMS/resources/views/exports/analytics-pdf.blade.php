<!DOCTYPE html>
<html>
<head>
    <title>Analytics Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .section {
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f5f5f5;
        }
        h1 {
            color: #2d3748;
            margin-bottom: 10px;
        }
        h2 {
            color: #4a5568;
            margin-bottom: 15px;
        }
        .timestamp {
            color: #718096;
            font-style: italic;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <h1>Analytics Report</h1>
    <div class="timestamp">Generated at: {{ now()->format('Y-m-d H:i:s') }}</div>

    <div class="section">
        <h2>Admissions</h2>
        <table>
            <tr>
                <th>New</th>
                <th>Accepted</th>
                <th>Rejected</th>
            </tr>
            <tr>
                <td>{{ $analytics['admissions']['new'] }}</td>
                <td>{{ $analytics['admissions']['accepted'] }}</td>
                <td>{{ $analytics['admissions']['rejected'] }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h2>Inquiries</h2>
        <table>
            <tr>
                <th>New</th>
                <th>Resolved</th>
            </tr>
            <tr>
                <td>{{ $analytics['inquiries']['new'] }}</td>
                <td>{{ $analytics['inquiries']['resolved'] }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h2>Scholarships</h2>
        <table>
            <tr>
                <th>Total</th>
                <th>Approved</th>
            </tr>
            <tr>
                <td>{{ $analytics['scholarships']['total'] }}</td>
                <td>{{ $analytics['scholarships']['approved'] }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h2>Monthly Trend</h2>
        <table>
            <tr>
                @foreach($analytics['monthlyTrend']['labels'] as $month)
                    <th>{{ $month }}</th>
                @endforeach
            </tr>
            <tr>
                @foreach($analytics['monthlyTrend']['data'] as $value)
                    <td>{{ $value }}</td>
                @endforeach
            </tr>
        </table>
    </div>
</body>
</html>
