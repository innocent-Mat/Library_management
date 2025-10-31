<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Privacy – Library System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .icon {
            color: #007bff;
        }
        .card {
            margin-top: 50px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="text-center my-4">
        <h1><i class="fas fa-user-shield icon"></i> Do Not Sell or Share My Personal Information</h1>
        <p class="lead">Your privacy is important to us at the Library System.</p>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <h4><i class="fas fa-info-circle icon"></i> What This Means</h4>
            <p>
                Under various privacy laws (like the CCPA), you have the right to request that your personal information not be sold or shared. We respect that right and provide you with a way to exercise it.
            </p>

            <h5><i class="fas fa-user-lock icon"></i> Our Commitment</h5>
            <ul>
                <li>We never sell your data to third parties for profit.</li>
                <li>We use data strictly for library system functionality and service improvement.</li>
                <li>You may opt out of any sharing related to analytics or marketing.</li>
            </ul>

            <h5><i class="fas fa-paper-plane icon"></i> Submit a Request</h5>
            <form>
                <div class="mb-3">
                    <label for="email" class="form-label">Your Email Address</label>
                    <input type="email" class="form-control" id="email" placeholder="you@example.com">
                </div>
                <div class="mb-3">
                    <label for="requestDetails" class="form-label">Additional Details</label>
                    <textarea class="form-control" id="requestDetails" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Submit Request</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
