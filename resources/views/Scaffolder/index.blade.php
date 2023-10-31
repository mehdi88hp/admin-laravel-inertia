<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="./node_modules/vue/index.js"
</head>
<body>

<div class="container-fluid">
    <h2>Inline form</h2>
    <form id="form" method="post" class="form-inline" action="{{route('com-builder.store')}}">
        {{csrf_field()}}
        <div class="form-group">
            <label for="model-name">Model name: (singular and lower case)</label>
            <input type="text" class="form-control" id="model-name" placeholder="Enter model name" name="model-name">
        </div>

        <div class="row">
            <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
            </div>
        </div>

        <button type="submit" class="btn btn-default">Submit</button>
    </form>
</div>
</body>
</html>
