<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    @include('admin.css');

    <style type="text/css">
        .title_deg {
            text-align: center;
            font-size: 25px;
            font-weight: bold;
            padding-bottom: 40px;
        }

        .table_deg {
            border: 2px solid white;
            width: 70%;
            margin: auto;
            text-align: center;
            background-color: white;
            color: black;
        }

        .th_deg {
            background-color: skyblue;
        }

        table,
        th,
        td {
            border: 1px solid grey;
            text-align: center;
        }

        .img_size {
            width: 100px;
            height: 150px;
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
            <h1 class="title_deg">All Orders</h1>

            <div style="padding-left: 400px; padding-bottom: 30px; color: black;">
                <form action="{{url('search')}}" method="get">

                    @csrf

                    <input type="text" style="color: black;"  name="search" placeholder="Search For Something">

                    <input type="submit" value="Search" class="btn btn-outline-primary">
                </form>
            </div>

            <table class="table_deg">
                <tr class="th_deg">
                    <th style="padding: 10px;">Name</th>
                    <th style="padding: 10px;">Email</th>
                    <th style="padding: 10px;">Address</th>
                    <th style="padding: 10px;">Phone</th>
                    <th style="padding: 10px;">Product_title</th>
                    <th style="padding: 10px;">Quantity</th>
                    <th style="padding: 10px;">Price</th>
                    <th style="padding: 10px;">Payment Status</th>
                    <th style="padding: 10px;">Delivery Status</th>
                    <th style="padding: 10px;">Image</th>
                    <th style="padding: 10px;">Delivered</th>


                </tr>

                @forelse($order as $order)

                <tr>
                    <td>{{$order->name}}</td>
                    <td>{{$order->email}}</td>
                    <td>{{$order->address}}</td>
                    <td>{{$order->phone}}</td>
                    <td>{{$order->product_title}}</td>
                    <td>{{$order->quantity}}</td>
                    <td>{{$order->price}}</td>
                    <td>{{$order->payment_status}}</td>
                    <td>{{$order->delivery_status}}</td>
                    <td>
                        <img class="img_size" src="/product/{{$order->image}}">
                    </td>

                    <td>
                        @if($order->delivery_status == 'processing')

                        <a href="{{url('delivered', $order->id)}}" class="btn btn-primary">Delivered</a>

                        @else

                        <p style="color: blue;">Delivered</p>

                        @endif
                    </td>

                   
                </tr>

                @empty

                <tr>
                    <td colspan="16">
                        No data found
                    </td>
                </tr>

                @endforelse



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