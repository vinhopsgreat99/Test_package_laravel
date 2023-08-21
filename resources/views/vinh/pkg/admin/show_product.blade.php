<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    @include('admin.css');

    <style type="text/css">
        .center {
            margin: auto;
            width: 50%;
            border: 2px solid white;
            margin-top: 40px;
            background-color: white;
            color: black;
        }

        .font_size {
            text-align: center;
            font-size: 40px;
            padding-top: 20px;
        }

        .img_size {
            width: 100px;
            height: 100px;
        }

        .first_row {
            background-color: skyblue;
        }

        .th_pos {
            padding: 15px;
        }

        table,
        th,
        td {
            border: 1px solid grey;
            text-align: center;
        }
    </style>
</head>

<body>
    @include('admin.banner');
    <!-- partial:partials/_sidebar.html -->
    @include('admin.sidebar');
    <!-- partial -->
    @include('admin.header');
    <!-- partial -->

    <div class="main-panel">
        <div class="content-wrapper">

            <h2 class="font_size">All Products</h2>

            <table class="center">
                <tr class="first_row">
                    <th class="th_pos">Product Title</th>
                    <th class="th_pos">Desccription</th>
                    <th class="th_pos">Quantity</th>
                    <th class="th_pos">Category</th>
                    <th class="th_pos">Price</th>
                    <th class="th_pos">Discount Price</th>
                    <th class="th_pos">Product Image</th>
                    <th class="th_pos">Delete</th>
                    <th class="th_pos">Edit</th>
                </tr>

                @foreach($product as $product)

                <tr>
                    <td>{{$product->title}}</td>
                    <td>{{$product->description}}</td>
                    <td>{{$product->quantity}}</td>
                    <td>{{$product->category}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->discount_price}}</td>
                    <td>
                        <img class="img_size" src="/product/{{$product->image}}">
                    </td>

                    <td>
                        <a class="btn btn-danger" onclick="return confirm('Are You Sure To Delete This Product')" href="{{url('delete_product', $product->id)}}">Delete</a>
                    </td>

                    <td>
                        <a class="btn btn-primary" href="{{url('update_product', $product->id)}}">Edit</a>
                    </td>
                </tr>

                @endforeach

            </table>
        </div>
    </div>


    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="admin/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    @include('admin.script');
</body>

</html>