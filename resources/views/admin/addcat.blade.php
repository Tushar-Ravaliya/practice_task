<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            color: #000;
            overflow-x: hidden;
            height: 100%;
            background-image: url("css/log.jpg");
            background-repeat: no-repeat;
            background-size: 100% 100%;
        }

        .card {
            padding: 30px 40px;
            margin-top: 60px;
            margin-bottom: 60px;
            border: none !important;
            box-shadow: 0 6px 12px 0 rgba(0, 0, 0, 0.2);
        }

        .blue-text {
            color: #00BCD4
        }

        .form-control-label {
            margin-bottom: 0;
        }

        input,
        textarea,
        button {
            padding: 8px 15px;
            border-radius: 5px !important;
            margin: 5px 0px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            font-size: 18px !important;
            font-weight: 300;
        }

        input:focus,
        textarea:focus {
            -moz-box-shadow: none !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            border: 1px solid #00BCD4;
            outline-width: 0;
            font-weight: 400;
        }

        .btn-block {
            text-transform: uppercase;
            font-size: 15px !important;
            font-weight: 400;
            height: 43px;
            cursor: pointer;
        }

        .btn-block:hover {
            color: #fff !important;
        }

        button:focus {
            -moz-box-shadow: none !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            outline-width: 0;
        }
        .left{
            display: flex;
            flex-direction: column;
            align-items: ;
            justify-content: left;
            list-style: none;
        }
    </style>
</head>

<body>
    <div class="container-fluid px-1 py-5 mx-auto">
        
        <div class="row d-flex justify-content-center">
            <div class="col-xl-6 col-lg-8 col-md-9 col-11 text-center">
                <h3>Add catagories</h3>

                <div class="card">

                    <form class="form-card" action="addcat_action" method="post">
                        @csrf
                        <div class="row justify-content-between text-left ">
                            <div class="form-group  flex-column d-flex "> <label
                                    class="form-control-label px-3 ">catagory name<span class="text-danger">
                                        *</span></label> <input type="text" id="cat" name="cat"
                                    placeholder="Enter your first name" onblur="validate(1)"> </div>
                            
                        
                            
                        </div>
                       
                        <div class="row justify-content-end">
                            <div class="form-group col-sm-6"> <button type="submit"
                                    class="btn-block btn-primary">Add</button> </div>
                        </div>
                    </form>
                    <div class="left">
                        @foreach ($data as $d)
                        <li>{{$d['categories']}}</li>
                      @endforeach
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</body>

</html>
