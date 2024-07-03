<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Limousine Quotation Received</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border-top: 5px solid #007bff;
        }
        .header {
            background-color: #007bff;
            color: #fff;
            text-align: center;
            padding: 20px 0;
            border-radius: 10px 10px 0 0;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            text-transform: uppercase;
        }
        .content {
            padding: 20px;
        }
        .content p {
            margin: 10px 0;
            line-height: 1.6;
        }
        .content p strong {
            color: #007bff;
        }
        .footer {
            text-align: center;
            padding: 20px;
            font-size: 12px;
            color: #888;
            border-top: 1px solid #ddd;
            margin-top: 20px;
        }
        .content .quotation-details {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            border: 1px solid #ddd;
            margin-bottom: 20px;
        }
        .content .quotation-details p {
            margin: 5px 0;
        }
        .highlight {
            color: #007bff;
        }
        .cta {
            display: inline-block;
            padding: 10px 20px;
            background-color: #28a745;
            color: #fff;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>New Limousine Quotation</h1>
        </div>
        <div class="content">
            <p>Hello {{ $email }},</p>
            
            <p>We are pleased to inform you that a new limousine quotation has been received. Below are the details of the quotation:</p>
            
            <div class="quotation-details">
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
                <p><strong>Total Amount:</strong> <span class="highlight">${{ $quotation->total_amount }}</span></p>
                <p><strong>Status:</strong> {{ $quotation->status }}</p>
            </div>
            
            <p>Please review and take the necessary actions regarding this quotation.</p>
            
            <p>Thank you.</p>

            <a href="[Your Action URL]" class="cta">View Quotation</a>
        </div>
        <div class="footer">
            <p>This is an automated message. Please do not reply.</p>
        </div>
    </div>
</body>
</html>
