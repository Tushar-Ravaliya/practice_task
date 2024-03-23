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
            background-color: #00ADB5;
        }

        .card {
            padding: 30px 40px;
            margin-top: 60px;
            margin-bottom: 60px;
            border: none !important;
            box-shadow: 0 6px 12px 0 rgba(0, 0, 0, 0.2);
        }

        .blue-text {
            color: #799195
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
    </style>
</head>

<body>
    <div class="container-fluid px-1 py-5 mx-auto">

        <div class="row d-flex justify-content-center">
            <div class="col-xl-6 col-lg-8 col-md-9 col-11 text-center text-white ">
                <h3>Create a Blog</h3>

                <div class="card">

                    <form class="form-card" action="blogs" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row justify-content-end  text-left ">
                            <div class="form-group  flex-column d-flex "> <label
                                    class="form-control-label px-3 ">Title<span class="text-danger">*</span></label>
                                <input type="text" name="title" placeholder="Enter your first name" value="{{old('title')}}">
                            </div>
                            @error('title')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                            <div class="form-group col-12 flex-column d-flex"> <label
                                    class="form-control-label px-3">Description<span
                                        class="text-danger">*</span></label>
                                <textarea type="text" id="ans" name="description" placeholder="">{{old('description')}} </textarea>
                            </div>
                            @error('description')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                            <div class="image_box">
                                <div class="form-group  flex-column d-flex image"> <label
                                        class="form-control-label px-3">Images<span class="text-danger">*</span></label>
                                    <input type="file" id="images" name="blog_images[]"accept="image/*"value="{{old('blog_images[]')}}" onchange="preview_image(event)" multiple>
                                </div>
                            </div>
                            @error('blog_images[]')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div id="preview" class="d-flex justify-content-around flex-wrap"></div>
                        <div class="d-flex flex-column col-3">
                            @foreach ($data as $d)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $d['categories'] }}"
                                        id="flexCheckDefault"name="categories[]" >
                                    <label class="form-check-label" for="flexCheckDefault">
                                        {{ $d['categories'] }}
                                    </label>
                                </div>
                            @endforeach

                        </div>
                        @error('categories')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                        <div class="row justify-content-between text-left links_box" id='links_box'>
                            <div class="form-group col-sm-3  flex-column d-flex  title" id='title'> <label
                                    class="form-control-label px-3 ">Title<span class="text-danger">*</span></label>
                                <input type="text" id="fname"
                                    name="blog_title[]"placeholder="Enter your link name" value="{{old('title[]')}}">
                            </div>
                            @error('blog_title')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                            <div class="form-group col-sm-9  flex-column d-flex  links" id='links'>
                                <label class="form-control-label px-3 ">Links<span class="text-danger">*</span></label>
                                <input type="text" id="fname" name="blog_link[]" value="{{old('blog_link[]')}}" placeholder="Enter your link">
                            </div>
                            @error('blog_link')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="button" class="btn-block bg-danger text-white " onclick='remove_links()'>remove
                            more link</button>
                        <button type="button" class="btn-block bg-primary text-white " onclick='add_links()'>add more
                            link</button>
                        <div class="row justify-content-end">
                            <div class="form-group col-sm-6"> <button type="submit"
                                    class="btn-block btn-primary">Upload Blog</button> </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="js/addblogs.js"></script>
    <script src="js/image_preview.js"></script>
</body>

</html>
