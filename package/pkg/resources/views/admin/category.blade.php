<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    @include('admin.css');

    <style type="text/css">
        .div_center {
            text-align: center;
            padding-top: 40px;
        }

        .h2_font {
            font-size: 40px;
            padding-bottom: 40px;
        }

        .input_category {
            color: black;
        }

        .center {
            color: black;
            margin: auto;
            width: 40%;
            text-align: center;
            margin-top: 30px;
            border: 3px solid green;
            background-color: white;
        }
    </style>
</head>

<body>
    @include('admin.banner');
    <!-- partial:partials/_sidebar.html -->
    @include('admin.sidebar');
    <!-- partial -->
    @include('admin.header');

    <div class="main-panel">
        <div class="content-wrapper">

            @if(session()->has('massage'))

            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>

                {{session()->get('message')}}

            </div>

            @endif

            <div class="div_center">
                <h2 class="h2_font">Add Category</h2>
                <form action="{{url('/add_category')}}" method="POST">

                    @csrf

                    <input type="text" class="input_category" name="category" placeholder="Write category name" color: "black">

                    <input type="submit" class="btn btn-primary" name="submit" value="Add Category">
                </form>
            </div>
            <table class="center">
                <tr>
                    <td>Category Name</td>
                    <td>Action</td>
                </tr>

                @foreach($data as $data)

                <tr>
                    <td>{{$data->category_name}}</td>
                    <td>
                        <a onclick="return confirm('Are you sure to delete this ?')" class="btn btn-danger" href="{{url('delete_category', $data->id)}}">Delete</a>
                    </td>
                </tr>

                @endforeach

            </table>

        </div>
    </div>

    <!-- plugins:js -->
    <script src="admin/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    @include('admin.script');
</body>

</html>