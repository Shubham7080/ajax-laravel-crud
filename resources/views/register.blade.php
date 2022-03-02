<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="_token" content="{{csrf_token()}}">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>    
    <script>
        var siteURL = '{{url('')}}';
    </script>
</head>
<body>
    <form  id="Form">
        @csrf
        <input type="hidden" name="post_id" id="post_id"/>
        <input type="text" name="title" id="title" /> <br>
        <input type="text" name="desc" id="desc" /> <br>
        <input type="submit" id="button" value="submit" /> <br>
    </form>
    <table id="tbl_data" style="margin-top: 100px">
        <th>Id</th>
        <th>tile</th>
        <th>description</th>
        <th>action</th>
        <th>action1</th>
    </table>
    <script src="{{url('savedata.js')}}"></script>
</body>
</html>
