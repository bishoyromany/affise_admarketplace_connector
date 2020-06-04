<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Connector Homepage</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        .content{
            margin-top : 100px;
        }
        form{
            padding : 20px;
            background-color : #f2f2f2f2;
            border : 1px solid #CCC;
            border-radius : 10px;
        }
    </style>
</head>
<body>
    <div class="content">
        <div class="container">
            <div class="col-md-6 offset-3">
                <form action="backend/serve.php">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="qt">QT</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="qt" value="tiktok" id="qt" class="form-control" placeholder="Admarketplace QT Column">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="sub1">Sub 1</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="sub1" value="tiktok" id="sub1" class="form-control" placeholder="Admarketplace sub1 Column">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="sub2">Sub 2</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="sub2" value="com.chess" id="sub2" class="form-control" placeholder="Admarketplace sub2 Column">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="m-aaid">m-aaid</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="m-aaid" id="m-aaid" class="form-control" placeholder="Admarketplace m-aaid Column">
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="serve" value="1">

                    <div class="row">
                        <div class="col-md-6 offset-3">
                            <button class="btn btn-success btn-block">Start</button>
                        </div>
                    </div>
                </form> 
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>