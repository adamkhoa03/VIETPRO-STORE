@extends('Backend.Master.master')
@section('title', 'Danh sách đơn hàng')
@section('order')
    <!--main-->
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><svg class="glyph stroked home">
                            <use xlink:href="#stroked-home"></use>
                        </svg></a></li>
                <li class="active">Đơn hàng</li>
            </ol>
        </div>
        <!--/.row-->
        <div class="row">
            <div class="col-xs-12 col-md-12 col-lg-12">

                <div class="panel panel-primary">
                    <div class="panel-heading">Danh sách đơn đặt hàng chưa xử lý</div>
                    <div class="panel-body">
                        <div class="bootstrap-table">
                            <div class="table-responsive">

                                <a href="{{route('order.processed')}}" class="btn btn-success">Đơn đã xử lý</a>
                                <!-- Laravel scout + agolia -->
                                <div style="float: right" class="aa-input-container" id="aa-input-container">
                                    <form action="{{route('order.searchSubmit')}}" method="get">
                                        <input type="search" id="aa-search-input" class="aa-input-search"
                                            placeholder="Nhập từ khóa tìm kiếm" name="search" autocomplete="off" />
                                            <svg class="aa-input-icon"
                                            viewBox="654 -372 1664 1664">
                                            <path
                                                d="M1806,332c0-123.3-43.8-228.8-131.5-316.5C1586.8-72.2,1481.3-116,1358-116s-228.8,43.8-316.5,131.5  C953.8,103.2,910,208.7,910,332s43.8,228.8,131.5,316.5C1129.2,736.2,1234.7,780,1358,780s228.8-43.8,316.5-131.5  C1762.2,560.8,1806,455.3,1806,332z M2318,1164c0,34.7-12.7,64.7-38,90s-55.3,38-90,38c-36,0-66-12.7-90-38l-343-342  c-119.3,82.7-252.3,124-399,124c-95.3,0-186.5-18.5-273.5-55.5s-162-87-225-150s-113-138-150-225S654,427.3,654,332  s18.5-186.5,55.5-273.5s87-162,150-225s138-113,225-150S1262.7-372,1358-372s186.5,18.5,273.5,55.5s162,87,225,150s113,138,150,225  S2062,236.7,2062,332c0,146.7-41.3,279.7-124,399l343,343C2305.7,1098.7,2318,1128.7,2318,1164z" />
                                        </svg>
                                    </form>
                                </div>
                                <!-- /Laravel scout + agolia -->
                                <table class="table table-bordered" style="margin-top:20px;">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th>ID</th>
                                            <th>Tên khách hàng</th>
                                            <th>Sđt</th>
                                            <th>Địa chỉ</th>
                                            <th>Xử lý</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order as $key=> $item)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>{{$item->ord_fullname}}</td>
                                            <td>{{$item->ord_phone}}</td>
                                            <td>{{$item->ord_address}}</td>
                                            <td>
                                                <a href="{{route('order.detail',['id'=>$item->ord_id])}}" class="btn btn-warning"><i class="fa fa-pencil"
                                                        aria-hidden="true"></i>Xử lý</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        <!--/.row-->
    </div>
    <!--end main-->
    <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
    <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
    <script src="{{ asset('Backend/js/algolia-order-search.js') }}"></script>
@endsection
