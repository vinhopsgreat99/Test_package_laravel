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

        .font_size {
            font-size: 40px;
            padding-top: 40px;
        }

        .text_color {
            color: black;
            padding-bottom: 20px;
        }

        .div_design {
            padding-bottom: 15px;
        }

        label {
            display: inline-block;
            width: 200px;
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
            @if(session()->has('massage'))

            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>

                {{session()->get('message')}}

            </div>

            @endif


            <div class="div_center">
                <h1 class="font_size">Add product</h1>

                <form action="{{url('/add_product')}}" method="POST" enctype="multipart/form-data">

                    @csrf

                    <div class="div_design">
                        <label>Product Title: </label>
                        <input class="text_color" type="text" name="title" placeholder="Write a title" required="">
                    </div>

                    <div class="div_design">
                        <label>Product Description: </label>
                        <input class="text_color" type="text" name="description" placeholder="Write a description">
                    </div>

                    <div class="div_design">
                        <label>Product Price: </label>
                        <input class="text_color" type="number" name="price" placeholder="Write a price" required="">
                    </div>

                    <div class="div_design">
                        <label>Discount Price: </label>
                        <input class="text_color" type="number" min="0" name="dis_price" placeholder="Write a discount price">
                    </div>

                    <div class="div_design">
                        <label>Product Quantity: </label>
                        <input class="text_color" type="number" min="0" name="quantity" placeholder="Write a quantity" required="">
                    </div>

                    <div class="div_design">
                        <label>Product Category: </label>
                        <select class="text_color" name="category">
                            <option value="" selected="">Add a category here</option>

                            @foreach($category as $category)
                            <option>{{$category->category_name}}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="div_design">
                        <label>Product Image Here: </label>
                        <input type="file" name="image">
                    </div>

                    <div class="div_design">
                        <input class="btn btn-primary" type="submit" value="Add Product">
                    </div>
                </form>
            </div>
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