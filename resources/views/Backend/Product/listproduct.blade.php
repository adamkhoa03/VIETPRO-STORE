@extends('Backend.Master.master')
@section('title', 'Danh sách sản phẩm')
@section('product_list')
    <!--main-->
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><svg class="glyph stroked home">
                            <use xlink:href="#stroked-home"></use>
                        </svg></a></li>
                <li class="active">Danh sách sản phẩm</li>
            </ol>
        </div>
        <!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Danh sách sản phẩm</h1>
            </div>
        </div>
        <!--/.row-->

        <div class="row">
            <div class="col-xs-12 col-md-12 col-lg-12">

                <div class="panel panel-primary">

                    <div class="panel-body">
                        <div class="bootstrap-table">
                            <div class="table-responsive">
								@if (session('success'))									
									<div class="alert bg-success" role="alert">
										<svg class="glyph stroked checkmark">
											<use xlink:href="#stroked-checkmark"></use>
										</svg>{{ session('success') }}<a href="#" class="pull-right"></a>
									</div>
                                @endif
                                @can('add')
                                <a href="{{ route('product.create') }}" class="btn btn-primary">Thêm sản phẩm</a>
                                @endcan
                                <!-- Laravel scout + agolia -->
                                <div style="float: right" class="aa-input-container" id="aa-input-container">
                                    <form action="{{ route('product.searchSubmit') }}" method="get">
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
                                            <th>Thông tin sản phẩm</th>
                                            <th>Giá sản phẩm</th>
                                            <th>Tình trạng</th>
                                            <th>Danh mục</th>
                                            @canany(['edit','delete'])
                                            <th width='18%'>Tùy chọn</th>
                                            @endcanany
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-md-3"><img src="{{asset('/uploads')}}/{{ $item->prd_image }}"
                                                                alt="Áo đẹp" width="100px" class="thumbnail"></div>
                                                        <div class="col-md-9">
                                                            <p><strong>Mã sản phẩm : {{ $item->prd_id }}</strong></p>
                                                            <p>Tên sản phẩm :{{ $item->prd_name }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ number_format($item->prd_price, 0, '', '.') }} VND</td>
                                                <td>
                                                    {{-- <a class="btn btn-success" href="#" role="button"> --}}
                                                        {!!$item->prd_state == 1 ?
                                                    '<p class="btn btn-success">Còn hàng</p>'
                                                    :
                                                    '<p class="btn btn-danger">Hết hàng</p>'
                                                    !!}
                                                    </a>
                                                </td>
                                                <td>{{ $item->Categories->cat_name }}</td>
                                                @canany(['edit','delete'])
                                                <td>
                                                    @can('edit')
                                                    <a href="{{ route('product.edit', ['id' => $item->prd_id]) }}"
                                                        class="btn btn-warning"><i class="fa fa-pencil"
                                                            aria-hidden="true"></i> Sửa</a>
                                                    @endcan
                                                    @can('delete')
                                                    <a href="{{ route('product.delete', ['id' => $item->prd_id]) }}"
                                                       onclick="return confirm('Xác nhận xóa sản phẩm: {{$item->prd_name}}');" class="btn btn-danger"><i class="fa fa-trash"
                                                            aria-hidden="true"></i> Xóa</a>
                                                    @endcan
                                                </td>
                                                @endcanany
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div align='right'>
                                    {{ $product->links() }}
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                    </div>
                </div>
                <!--/.row-->


            </div>
            <!--end main-->

            <!-- Laravel scout + agolia -->
            <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
            <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
            <script>
                (function() {
                    var client = algoliasearch('WKMELACEWN', 'c3e198de17c44f9703f94af6adf6460e');
                    var index = client.initIndex('products_index');
                    var enterPressed = false;
                    autocomplete('#aa-search-input', {
                        hint: false
                    }, {
                        // cau hinh hien thi
                        source: autocomplete.sources.hits(index, {
                            hitsPerPage: 1
                        }),
                        displayKey: 'prd_name',
                        templates: {
                            // hien thi de xuat
                            suggestion: function(suggestion) {
                                const markup = `
                            <div class="algolia-result">
                                <span>
                                    ${suggestion._highlightResult.prd_name.value}
                                </span>
                                <span>${(suggestion.prd_price / 100).toFixed(3)} vnd</span>
                            </div>
                        `;

                                return markup;
                            },
                            empty: function(result) {
                                return 'Xin lỗi, chúng tôi không tìm thấy kết quả với từ khóa "' + result
                                    .query + '"';
                            }
                        }
                    }).on('autocomplete:selected', function(event, suggestion, dataset) {
                        window.location.href = window.location.origin +
                            '/VIETPRO-STORE/public/trang-quản-trị/sản-phẩm/search/' + suggestion.prd_id;
                        enterPressed = true;
                    });
                })();

            </script>
        @endsection
