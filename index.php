<?php 
    require_once __DIR__.'/backend/helpers.php';
    $base = getConfig('base');
?>

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
        h3{
            margin-bottom : 40px;
        }
        form{
            padding : 20px;
            background-color : #f2f2f2f2;
            border : 1px solid #CCC;
            border-radius : 10px;
        }
        .clickable-icon{
            cursor: pointer;
            font-size : 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>


    <?php require_once __DIR__.'/backend/navbar.php'; ?>



    <div class="content">
        <h3 class="text-center">Welcome To Affise - Admarketplace APIs Connector</h3>
        <div class="container">
            <div class="col-md-6 offset-3">
                <form action="backend/serve.php">
                    <!-- removed for the new api -->
                    <!-- QT value for qt param in admarketplace API -->
                    <!-- <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="qt">QT</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="qt" value="tiktok" id="qt" class="form-control" placeholder="Admarketplace QT Column">
                            </div>
                        </div>
                    </div> -->

                    <!-- sub1 value for admarketplace -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="sub1">Sub 1</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="sub1" value="10130" id="sub1" class="form-control" placeholder="Admarketplace sub1 Column">
                            </div>
                        </div>
                    </div>

                    <!-- sub1 value for admarketplace -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="fakeSub1">Fake Sub 1</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="fakeSub1" value="10130" id="fakeSub1" class="form-control" placeholder="Fake Sub1 To Store in Affise">
                            </div>
                        </div>
                    </div>

                    <!-- sub2 list values for admarketplace -->
                    <div class="form-group">
                        <div class="row" id="sub2Container">
                        </div>
                    </div>
                    
                    <!-- the real sub2 list values -->
                    <input type="hidden" name="sub2" id="sub2" value="1">
                    
                    <!-- m-aaid value for m-aaid for admarketplace -->
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
                    
                    <!-- Referrer value for rfr for admarketplace -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="rfr">Referrer</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="rfr" id="rfr" class="form-control" placeholder="Admarketplace Referrer URL">
                            </div>
                        </div>
                    </div>

                    <!-- start the script value, must be 1 to start the script -->
                    <input type="hidden" name="serve" value="1">
                    <!-- submit button -->
                    <div class="row">
                        <div class="col-md-6 offset-3">
                            <button class="btn btn-success btn-block">Start Script</button>
                        </div>
                        <div class="col-md-12 text-center">
                            <a href="<?php echo $base; ?>/config.php?target=config">Configuration API</a>
                        </div>
                    </div>
                </form> 
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            let counter = 1;
            let content;
            let container = $("#sub2Container");
            let results = ['com.chess'];
            $("#sub2").val(JSON.stringify(results));
            const updateHandlers = () => {
                $(".add-sub2").click(() => {
                    addSub2();
                });

                $(".remove-sub2").click(function(){
                    removeSub2(parseInt($(this).data('id')) - 1);
                });

                $(".sub2").keyup(function(){
                    let id = $(this).data('id');
                    results[id - 1] = $(this).val();
                    $("#sub2").val(JSON.stringify(results));
                });
            }

            const serveSub2Generator = () => {
                content = ``;
                for(let x = 1; x <= counter; x++){
                    content += `
                        <div class="col-md-3">
                            <label for="sub2.${x}">Sub 2.${x}</label>
                        </div>
                        <div class="col-md-7">
                            <input type="text" name="sub2" value="${results[x - 1] != undefined ? results[x - 1] : ''}" id="sub2.${x}" data-id="${x}" class="form-control sub2" placeholder="Admarketplace sub2 Column">
                        </div>
                        <div class="col-md-1"><i class="clickable-icon add-sub2">&plus;</i></div>
                        <div class="col-md-1"><i class="clickable-icon remove-sub2" data-id="${x}">&times;</i></div>
                    `;
                } 

                $(container).html(content);

                updateHandlers();
            };
            serveSub2Generator();

            const addSub2 = () => {
                counter += 1;
                serveSub2Generator();
            };

            const removeSub2 = (id) => {
                counter -= 1;
                console.log(id);
                results = results.filter((item, index) => {
                    return index != id;
                });
                serveSub2Generator();
            }


            console.log(content);
        });
    </script>   
</body>
</html>