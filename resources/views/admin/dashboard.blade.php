@extends('layouts.app')

@section('content')
    <!-- /section:basics/content.breadcrumbs -->
    <div class="page-content">
        <div class="page-header">
            <h1>
                Dashboard
            </h1>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="space-6"></div>

                <div class="row">
                    <div class="col-sm-12 infobox-container">
                        <div class="infobox infobox-green">
                            <div class="infobox-icon">
                                <i class="ace-icon fa fa-folder"></i>
                            </div>
                            <div class="infobox-data">
                                <span class="infobox-data-number"></span>
                                <div class="infobox-content"><a href="{{ url('/quantri/categories') }}">danh mục</a> </div>
                            </div>
                        </div>

                        <div class="infobox infobox-green">
                            <div class="infobox-icon">
                                <i class="ace-icon fa fa-cube"></i>
                            </div>
                            <div class="infobox-data">
                                <span class="infobox-data-number"></span>
                                <div class="infobox-content"><a href="{{ url('/quantri/manufacturers') }}">thương hiệu</a> </div>
                            </div>
                        </div>

                        <div class="infobox infobox-green">
                            <div class="infobox-icon">
                                <i class="ace-icon fa fa-users"></i>
                            </div>
                            <div class="infobox-data">
                                <span class="infobox-data-number"></span>
                                <div class="infobox-content"><a href="{{ url('/quantri/attributes') }}">thuộc tính</a> </div>
                            </div>
                        </div>

                        <div class="infobox infobox-green">
                            <div class="infobox-icon">
                                <i class="ace-icon fa fa-cubes"></i>
                            </div>
                            <div class="infobox-data">
                                <span class="infobox-data-number"></span>
                                <div class="infobox-content"><a href="{{ url('/quantri/products') }}">sản phẩm</a> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
@endsection
