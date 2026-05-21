<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration Invoice</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#fff;
            font-family: Arial, sans-serif;
            color:#000;
        }

        .invoice-box{
            max-width:900px;
            margin:30px auto;
            border:1px solid #000;
            padding:30px;
        }

        .invoice-title{
            text-align:center;
            margin-bottom:30px;
        }

        .invoice-title h2{
            margin:10px 0 5px;
            font-size:30px;
            font-weight:bold;
            text-transform:uppercase;
        }

        .invoice-title p{
            margin:0;
            font-size:14px;
            line-height:22px;
        }

        .school-logo{
            width:90px;
            height:90px;
            object-fit:contain;
        }

        .details-table{
            width:100%;
        }

        .details-table td{
            padding:6px 0;
            vertical-align:top;
            font-size:15px;
        }

        .table{
            border:1px solid #000;
            margin-top:20px;
        }

        .table th,
        .table td{
            border:1px solid #000 !important;
            padding:10px;
            color:#000;
        }

        .table thead th{
            background:#f5f5f5;
            font-weight:bold;
        }

        .table tfoot th{
            font-size:16px;
        }

        .signature{
            margin-top:60px;
            text-align:right;
        }

        .signature-line{
            border-top:1px solid #000;
            width:220px;
            margin-left:auto;
            margin-bottom:5px;
        }

        .terms{
            margin-top:25px;
            font-size:14px;
        }

        .btn-print{
            margin-top:30px;
        }

        @media print{

            .no-print{
                display:none;
            }

            body{
                margin:0;
                background:#fff;
            }

            .invoice-box{
                border:none;
                margin:0;
                width:100%;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="invoice-box">

        <!-- Header -->
        <div class="invoice-title">
            <h2>GYANPITH HIGH SCHOOL</h2>
        </div>

        <!-- Student Information -->
        <div class="row mb-4">

            <!-- Left Side -->
            <div class="col-md-6">
                <table class="details-table">

                    <tr>
                        <td width="45%"><strong>Student Name</strong></td>
                        <td>: {{ $student->student_name ?? 'Aarav Sharma' }}</td>
                    </tr>

                    <tr>
                        <td><strong>Father Name</strong></td>
                        <td>: {{ $student->father_name ?? 'Rajesh Sharma' }}</td>
                    </tr>

                    <tr>
                        <td><strong>Mother Name</strong></td>
                        <td>: {{ $student->mother_name ?? 'Neha Sharma' }}</td>
                    </tr>

                    <tr>
                        <td><strong>Class</strong></td>
                        <td>: {{ $student->classData->name ?? '10th' }}</td>
                    </tr>

                    <tr>
                        <td><strong>Section</strong></td>
                        <td>: {{ $student->section ?? 'A' }}</td>
                    </tr>

                </table>
            </div>

            <!-- Right Side -->
            <div class="col-md-6">
                <table class="details-table">

                    <tr>
                        <td width="45%"><strong>Registration No</strong></td>
                        <td>: {{ $student->reg_no ?? 'REG2025/101' }}</td>
                    </tr>

                    <tr>
                        <td><strong>SR No</strong></td>
                        <td>: {{ $student->sr_no ?? 'SR-1001' }}</td>
                    </tr>

                    <tr>
                        <td><strong>Date</strong></td>
                        <td>: {{ date('d-m-Y') }}</td>
                    </tr>

                    <tr>
                        <td><strong>Session</strong></td>
                        <td>: 2025-26</td>
                    </tr>

                </table>
            </div>

        </div>

        <!-- Fee Details Table -->
        <table class="table">

            <thead>
                <tr>
                    <th width="10%">S.No</th>
                    <th>Description</th>
                    <th width="25%" class="text-end">Amount (₹)</th>
                </tr>
            </thead>

            <tbody>

                <tr>
                    <td>1</td>
                    <td>Monthly Tuition Fee</td>
                    <td class="text-end">
                        ₹ {{ number_format($student->monthly ?? 4500, 2) }}
                    </td>
                </tr>

                <tr>
                    <td>2</td>
                    <td>Discount</td>
                    <td class="text-end">
                        - ₹ {{ number_format($student->discount ?? 500, 2) }}
                    </td>
                </tr>

                <tr>
                    <td>3</td>
                    <td>Fee After Discount</td>
                    <td class="text-end">
                        ₹ {{ number_format($student->after_discount ?? 4000, 2) }}
                    </td>
                </tr>

                <tr>
                    <td>4</td>
                    <td>Total Yearly Fee</td>
                    <td class="text-end">
                        ₹ {{ number_format($student->total_for_year ?? 48000, 2) }}
                    </td>
                </tr>

            </tbody>

            <tfoot>
                <tr>
                    <th colspan="2" class="text-end">Grand Total</th>
                    <th class="text-end">
                        ₹ {{ number_format($student->total_for_year ?? 48000, 2) }}
                    </th>
                </tr>
            </tfoot>

        </table>

        <!-- Signature -->
        <div class="signature">
            <div class="signature-line"></div>
            <strong>Authorized Signature</strong>
        </div>

        <!-- Print Button -->
        <div class="text-center no-print">
            <button onclick="window.print()" class="btn btn-dark btn-print">
                Print Invoice
            </button>
        </div>

    </div>
</div>

</body>
</html>