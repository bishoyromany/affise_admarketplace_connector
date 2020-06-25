<?php 
    require_once "backend/helpers.php";
    if(isset($_POST['serve'])){
        $data = [
            'base' => $_POST['base'],
            'admarketplace' => [
                'url' => $_POST['admarketplaceUrl'],
                'requestAddon' => [
                    'partner' => $_POST['partner'],
                    'ip' => $_POST['ip'],
                    'ua' => $_POST['ua'],
                    'v' => $_POST['v'],
                    'out' => $_POST['out'],
                    'results' => $_POST['results'],
                ]
            ],
            'affise' => [
                'url' => $_POST['affiseUrl'],
                'requestAddon' => [
                    'advertiser' => $_POST['advertiser']
                ],
                'headers' => [$_POST['header']]
            ],
            'sub2' => [],
            "database" => [
                "username" => $_POST['database_username'],
                "password" => $_POST['database_password'],
                "name" => $_POST['database_name'],
                "prefix" => $_POST['database_prefix']
            ]
        ];

        if(!empty($_POST['sub2'])){
            $filteredSub2 = [];
            $sub2Data = json_decode($_POST['sub2']);
            foreach($sub2Data as $s){
                if(!empty($s)){ $filteredSub2[] = $s; }
            }
            if(!empty($filteredSub2)){
                $data['sub2'] = $filteredSub2;
            }
        }

        file_put_contents(__DIR__.'/tokens.json', json_encode($data));
    }

    if(!file_exists(__DIR__.'/tokens.json')){
        file_put_contents(__DIR__.'/tokens.json', file_get_contents(__DIR__.'/.tokens.json'));
    }
    $tokens = json_decode(file_get_contents(__DIR__.'/tokens.json'));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuration Of The API</title>
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
            margin-bottom : 100px;
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
        <h3 class="text-center">API Configuration</h3>
        <div class="container">
            <div class="col-md-8 offset-2">
                <form action="config.php" method="POST">
                    <!-- Base URL -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="base">Base URL</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" name="base" value="<?php echo $tokens->base?>" id="base" class="form-control" placeholder="Base URL">
                            </div>
                        </div>
                    </div>

                    <!-- Admarketplace URL -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="admarketplaceUrl">Admarketplace URL</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" name="admarketplaceUrl" value="<?php echo $tokens->admarketplace->url ?>" id="admarketplaceUrl" class="form-control" placeholder="Admarketplace URL">
                            </div>
                        </div>
                    </div>

                    <!-- Admarketplace partner -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="partner">Admarketplace Partner</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" name="partner" value="<?php echo $tokens->admarketplace->requestAddon->partner ?>" id="partner" class="form-control" placeholder="Admarketplace Partner">
                            </div>
                        </div>
                    </div>

                    <!-- Admarketplace ip -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="ip">Admarketplace ip</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" name="ip" value="<?php echo $tokens->admarketplace->requestAddon->ip ?>" id="ip" class="form-control" placeholder="Admarketplace ip">
                            </div>
                        </div>
                    </div>

                    <!-- Admarketplace ua -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="ua">Admarketplace User Agent</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" name="ua" value="<?php echo $tokens->admarketplace->requestAddon->ua ?>" id="ua" class="form-control" placeholder="Admarketplace ua">
                            </div>
                        </div>
                    </div>

                    <!-- Admarketplace v -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="v">Admarketplace API Version</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" name="v" value="<?php echo $tokens->admarketplace->requestAddon->v ?>" id="v" class="form-control" placeholder="Admarketplace v">
                            </div>
                        </div>
                    </div>

                    <!-- Admarketplace out -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="out">Admarketplace Output</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" name="out" value="<?php echo $tokens->admarketplace->requestAddon->out ?>" id="out" class="form-control" placeholder="Admarketplace out">
                            </div>
                        </div>
                    </div>

                    <!-- Admarketplace results -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="results">Admarketplace Results</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" name="results" value="<?php echo $tokens->admarketplace->requestAddon->results ?>" id="results" class="form-control" placeholder="Admarketplace Max Results">
                            </div>
                        </div>
                    </div>

                    <!-- Affise URL -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="affiseUrl">Affise URL</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" name="affiseUrl" value="<?php echo $tokens->affise->url ?>" id="affiseUrl" class="form-control" placeholder="Affise Url">
                            </div>
                        </div>
                    </div>

                    <!-- Affise URL -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="advertiser">Affise Advertiser</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" name="advertiser" value="<?php echo $tokens->affise->requestAddon->advertiser ?>" id="advertiser" class="form-control" placeholder="Affise advertiser">
                            </div>
                        </div>
                    </div>

                    <!-- Affise URL -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="header">Affise Header</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" name="header" value="<?php echo $tokens->affise->headers[0] ?>" id="header" class="form-control" placeholder="Affise header">
                            </div>
                        </div>
                    </div>
                    <!-- sub2 list values for admarketplace -->
                    <div class="form-group">
                        <div class="row" id="sub2Container">
                            <!-- <div class="col-md-3">
                                <label for="sub2">Sub 2</label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" name="sub2" value="com.chess" id="sub2" class="form-control" placeholder="Admarketplace sub2 Column">
                            </div>
                            <div class="col-md-1"><i class="clickable-icon add-sub2">&plus;</i></div>
                            <div class="col-md-1"><i class="clickable-icon remove-sub2">&times;</i></div> -->
                        </div>
                    </div>
                    <!-- the real sub2 list values -->
                    <input type="hidden" name="sub2" id="sub2" value="1">
                    <!-- start the script value, must be 1 to start the script -->
                    <input type="hidden" name="serve" value="1">

                    <!-- Database Login Username -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="database_username">Database Username</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" name="database_username" value="<?php echo $tokens->database->username ?>" id="database_username" class="form-control" placeholder="Database Login Username">
                            </div>
                        </div>
                    </div>

                    <!-- Database Login Password -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="database_password">Database Password</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" name="database_password" value="<?php echo $tokens->database->password ?>" id="database_password" class="form-control" placeholder="Database Login Password">
                            </div>
                        </div>
                    </div>

                    <!-- Database Name -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="database_name">Database Name</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" name="database_name" value="<?php echo $tokens->database->name ?>" id="database_name" class="form-control" placeholder="Database Name">
                            </div>
                        </div>
                    </div>

                    <!-- Database Table Prefix -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="database_prefix">Database Prefix</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" name="database_prefix" value="<?php echo $tokens->database->prefix ?>" id="database_prefix" class="form-control" placeholder="Database Tables Prefix">
                            </div>
                        </div>
                    </div>


                    <!-- submit button -->
                    <div class="row">
                        <div class="col-md-6 offset-3">
                            <button class="btn btn-success btn-block">Update Configurations</button>
                        </div>
                        <div class="col-md-12 text-center">
                            <a href="index.php">Serve API</a>
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
            let content;
            let container = $("#sub2Container");
            <?php 
                $sub2 = '';
                for($x = 0; $x < count($tokens->sub2) ; $x++){
                    $sub2 .= '"'.$tokens->sub2[$x].'"';
                    if($x + 1 < count($tokens->sub2)){
                        $sub2 .= ",";
                    }
                }
            ?>
            let results = [<?php echo $sub2; ?>];
            if(results.length == 0){
                results.push('');
            }
            let counter = results.length;
            $("#sub2").val(JSON.stringify(results));
            const updateHandlers = () => {
                $(".add-sub2").click(() => {
                    addSub2();
                    $("#sub2").val(JSON.stringify(results));
                });

                $(".remove-sub2").click(function(){
                    removeSub2(parseInt($(this).data('id')) - 1);
                    $("#sub2").val(JSON.stringify(results));
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
                        <div class="col-md-4">
                            <label for="sub2.${x}">Sub 2.${x}</label>
                        </div>
                        <div class="col-md-5">
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