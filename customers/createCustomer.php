<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NewItems</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <style>
        .wrap {
            width: 100%;
            max-width: 400px;
            margin: 40px auto;
        }
    </style>
</head>
<body class="text-center">
    <div class="wrap">
        <h1 class="h3 mb-3">Create New Item</h1>
        
        <?php if(isset($_GET['error'])): ?>
            <div class="alert alert-warning">
                Cannot create new customer. Please try again.
            </div>
        <?php endif; ?>

        <?php if(isset($_GET['inserted'])): ?>
            <div class="alert alert-success">
                Successfully created
            </div>
        <?php endif; ?>

        <form action="../_actions/customers/create.php" method="post">
            <input type="text" name="name" class="form-control mb-2" placeholder="Name" required>
            <button class="w-100 btn btn-primary">Save</button>
        </form>
        <br>
        <a href="../customers/index.php" class="w-100 btn btn-outline-danger">Go Back</a>
    </div>
    
</body>
</html>