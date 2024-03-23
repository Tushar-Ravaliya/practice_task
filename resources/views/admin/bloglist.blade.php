<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/jquery.dataTables.css') }}" rel="stylesheet">

    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-primary ">
        <a class="navbar-brand text-white" href="#">Navbar</a>

        <div class="collapse navbar-collapse " id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link active text-white" href="#">Home</a>
                <a class="nav-item nav-link active text-white" href="feth_cat">Add catagories</a>
                <a class="nav-item nav-link active text-white" href="feth_cat">Blogs list</a>
                <a class="nav-item nav-link active text-white" href="logout">logout</a>


            </div>
        </div>
    </nav>
    <table id="td" border='1'>
        <thead>
            <tr>
                <td>title</td>
                <td>description</td>
                <td>category</td>
                <td>User name</td>
                <td>user email</td>
                <td>blog count</td>
                <td>status</td>
            </tr>
        </thead>
    </table>
    <script>
        $(document).ready(function() {
            $('#td').DataTable({
                processing: true,
                serverSide: true,
                order: [
                    [0, "desc"]
                ],
                ajax: "{{ url('showblog') }}",
                columns: [{
                    data: 'title'
                }, {
                    data: 'description'
                }, {
                    data: 'category'
                }, {
                    data: 'members.name'
                }, {
                    data: 'members.email'
                },{
                    data: 'blogs_count'
                }, {
                    data: 'status'
                }],



            });
        });
    </script>

</body>

</html>
