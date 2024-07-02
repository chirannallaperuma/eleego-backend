<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Limousine Quotation Received</title>
    <style>
        /* Reset styles */
        body, h1, h2, h3, h4, h5, h6, p, ul, ol {
            margin: 0;
            padding: 0;
        }
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header {
            background-color: #007bff;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            border-radius: 5px 5px 0 0;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 20px 0;
        }
        .content p {
            margin-bottom: 10px;
        }
        .content strong {
            font-weight: bold;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>New Limousine Quotation Received</h1>
        </div>
        <div class="content">
            <p>Hello,</p>
            
            <p>We are pleased to inform you that a new limousine quotation has been received. Below are the details of the quotation:</p>
            
            <p><strong>Quotation Details:</strong></p>
            
            <p><strong>Quotation ID:</strong> {{ $quotation->id }}</p>
            <p><strong>Vehicle ID:</strong> {{ $quotation->vehicle_id }}</p>
            <p><strong>Service Type:</strong> {{ $quotation->service_type }}</p>
            <p><strong>Pickup Date and Time:</strong> {{ $quotation->pickup_date_time }}</p>
            <p><strong>Drop Date and Time:</strong> {{ $quotation->drop_date_time }}</p>
            <p><strong>Pickup Address:</strong> {{ $quotation->pickup_address }}</p>
            <p><strong>Drop Address:</strong> {{ $quotation->drop_address }}</p>
            <p><strong>Number of Persons:</strong> {{ $quotation->no_of_persons }}</p>
            <p><strong>Customer Name:</strong> {{ $quotation->customer_name }}</p>
            <p><strong>Customer Email:</strong> {{ $quotation->customer_email }}</p>
            <p><strong>Customer Phone:</strong> {{ $quotation->customer_phone }}</p>
            <p><strong>Payment Method:</strong> {{ $quotation->payment_method }}</p>
            
            <p><strong>Additional Services:</strong></p>
            @foreach ($quotation->additional_services as $service)
            <p>- {{ $service }}</p>
            @endforeach
            
            <p><strong>Additional Information:</strong> {{ $quotation->additional_information }}</p>
            <p><strong>Total Amount:</strong> ${{ $quotation->total_amount }}</p>
            
            <p>Please review and take the necessary actions regarding this quotation.</p>
            
            <p>Thank you.</p>
        </div>
        <div class="footer">
            <p>This is an automated message. Please do not reply.</p>
        </div>
    </div>
</body>
</html>
