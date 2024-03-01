<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
    <hr>
    <div class="container bootstrap snippets bootdey">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box no-header clearfix">
                    <div class="main-box-body clearfix">
                        <div class="table-responsive">
                            <table class="table user-list">
                                <thead>
                                    <tr>
                                        <th><span>Title</span></th>
                                        <th><span>description</span></th>
                                        <th><span>category</span></th>
                                        <th>Images</th>
                                        <th>title</th>
                                        <th>link</th>
                                        <th>button</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($blogs as $b)
                                        <tr>
                                            <td>
                                                <span class="user-subhead">{{ $b['title'] }}</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="label label-default">
                                                    <p class="user-subhead w-75">{{ Str::limit($b['description'], 50) }}
                                                    </p>
                                                </span>
                                            </td>
                                            <td>
                                                <a href="#">{{ $b['category'] }}</a>
                                            </td>
                                            <td>
                                                @if ($b->images->count() > 0)
                                                    <div class="overflow-auto" style="height: 200px;width:440px;">
                                                        @foreach ($b->images as $image)
                                                            <img src="{{ URL::to('/') }}/blogs_images/{{ $image['images'] }}"
                                                                class="d-block w-100 " alt="{{ $image['images'] }}">
                                                        @endforeach
                                                    </div>
                                                @else
                                                    No Images
                                                @endif
                                            </td>
                                            <td>
                                                @if ($b->links->count() > 0)
                                                    @foreach ($b->links as $link)
                                                        <a href="#">{{ $link->link_title }}</a>
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>
                                                @if ($b->links->count() > 0)
                                                    @foreach ($b->links as $link)
                                                        <a href="{{ $link->links }}"
                                                            target="_blank">{{ $link->links }}</a>
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ URL::to('/') }}/blogs/{{ $b['id'] }}/edit"
                                                    class="btn btn-primary">Edit</a>
                                            </td>
                                            <td>
                                                <form action="{{URL::to('/')}}/blogs/{{$blogs['id']}}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn bg-red-500 btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $blogs->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
