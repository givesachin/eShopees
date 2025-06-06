@extends('layouts.admin_settings')

@section('main-content')

    <script type="text/javascript" src="{{ URL('public/js/angular/admin/all_products_controller.js') }}?v={{ $organization->version }}"></script>

    <div ng-app="eShopees" ng-controller="allProductsController">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">List of Products</h1>

        <div class="alert alert-danger border-left-danger"
             role="alert" ng-show="errors.length > 0" style="width: fit-content !important;">
            <ul class="pl-4 my-2">
                <li ng-repeat="error in errors"><%error%></li>
            </ul>
        </div>

        <input type="file" id="file_select" class="d-none"
               accept="image/*" ng-files="setDocument($files)">

        <div class="row">
            <div class="col-lg-12 mb-4">

                <!-- Approach -->
                <div class="card shadow mb-4">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto py-2">
                                <div class="form-group mb-0">
                                    <label>Product Name :</label>
                                    <input type="text" class="form-control"
                                        style="width: 250px" placeholder="Enter product to search" autocomplete="off"
                                        ng-model="filters.search_term" ng-blur="getDataByFilters()">
                                </div>
                            </div>
                            <div class="col-auto py-2">
                                <div class="form-group mb-0">
                                    <label>Category :</label>
                                    <select class="form-control d-inline-block w-100"
                                            style="min-width: 110px" ng-model="filters.category_id" ng-change="getDataByFilters()"
                                            ng-options="s.id as s.title for s in categories">
                                            <option value="">ALL</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-auto py-2">
                                <div class="form-group mb-0">
                                    <label>Vendor :</label>
                                    <select class="form-control d-inline-block w-100"
                                            style="min-width: 110px" ng-model="filters.vendor_id" ng-change="getDataByFilters()"
                                            ng-options="s.id as s.name for s in vendors">
                                            <option value="">ALL</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-auto py-2">
                                <div class="form-group mb-0">
                                    <label>Marketing Tier :</label>
                                    <select class="form-control d-inline-block w-100"
                                            style="min-width: 110px" ng-model="filters.tier_id" ng-change="getDataByFilters()"
                                            ng-options="s.id as s.title for s in tiers">
                                            <option value="">ALL</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-auto py-2">
                                <div class="d-flex align-items-end h-100 pb-1">
                                    <button class="btn btn-success mr-2"
                                            ng-click="init()">Search
                                    </button>
                                    <button class="btn btn-outline-secondary mr-2"
                                            ng-click="resetFilters()">Reset
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Approach -->
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-end">
                            <div class="ml-1 pl-2">
                                <button class="btn btn-primary radius-md mr-1"
                                        ng-click="openEditor(null, null)">Add New Product
                                </button>
                                <button class="btn btn-success radius-md mr-1"
                                        ng-click="Save()">Save
                                </button>
                            </div>

                            <div class="mr-3 mr-sm-0" ng-show="data.length > 0">
                                Showing
                                <strong><%pagination.from%></strong>
                                to
                                <strong ng-show="data.length > pagination.per_page">
                                    <%pagination.from - 1 + pagination.per_page%>
                                </strong>
                                <strong ng-hide="data.length > pagination.per_page"><%data.length%></strong>
                                out of
                                <strong><%data.length%></strong>
                            </div>
                        </div>
                    </div>

                    <div class="card-body px-0 px-sm-3 mx-sm-1" ng-show="data.length > 0">
                        <div class="table-responsive">
                            <table class="table d-table table-sm-stack table-sm-striped mb-0" id="table">
                                <thead>
                                <tr>
                                    <th class="d-none d-sm-table-cell">#</th>
                                    <th style="min-width: 250px">Product</th>
                                    <th style="min-width: 250px">Details</th>
                                    <th style="min-width: 250px">Vendor</th>
                                    <th style="max-width: 150px">Preview</th>
                                    <th style="min-width: 130px">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat="t in data | limitTo: pagination.per_page : pagination.from-1 as paginated_data">
                                    <td class="d-none d-sm-table-cell align-middle"><%$index + pagination.from%></td>
                                    <td data-title="# : " class="d-table-cell d-sm-none"><%$index + pagination.from%></td>
                                    <td data-title="Product : " class="align-middle" style="min-width: 100%">
                                        <div ng-if="t.id"><strong>Category : </strong><%t.category%></div>
                                        <div ng-if="!t.id" class="form-group my-1 mr-2 w-100">
                                            <select class="form-control d-inline-block w-100"
                                                    ng-model="t.category_id"
                                                    ng-options="s.id as s.title for s in categories">
                                            </select>
                                        </div>
                                        <div class="form-group my-1 mr-2 d-inline-block w-100">
                                            <input type="text" class="form-control"
                                                   style="min-width: 110px" placeholder="Enter product name" autocomplete="off"
                                                   ng-model="t.name">
                                        </div>
                                        <div><strong>Marketing Tier : </strong></div>
                                        <div class="form-group my-1 mr-2 d-inline-block w-100">
                                            <select class="form-control d-inline-block w-100"
                                                    ng-model="t.tier_id"
                                                    ng-options="s.id as s.title for s in tiers">
                                                    <option value="">None</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td data-title="Details : " class="align-middle" style="min-width: 100%">
                                        <div>
                                            <div class="d-inline-block" style="width: 40px"><strong>Price : </strong></div>
                                            <div class="form-group my-1 mr-2 d-inline-block" style="width: calc(100% - 60px)">
                                                <input type="text" class="form-control"
                                                       style="min-width: 110px" placeholder="Enter price" autocomplete="off"
                                                       ng-model="t.price">
                                            </div>
                                        </div>
                                        <div>
                                            <div class="d-inline-block" style="width: 40px"><strong>Qty : </strong></div>
                                            <div class="form-group my-1 mr-2 d-inline-block" style="width: calc(100% - 60px)">
                                                <input type="text" class="form-control"
                                                    style="min-width: 110px" placeholder="Enter quantity" autocomplete="off"
                                                    ng-model="t.qty">
                                            </div>
                                        </div>
                                        <div>
                                            <div class="d-inline-block" style="width: 40px"><strong>D.% : </strong></div>
                                            <div class="form-group my-1 mr-2 d-inline-block" style="width: calc(100% - 60px)">
                                                <input type="text" class="form-control"
                                                       style="min-width: 110px" placeholder="Enter discount percentage" autocomplete="off"
                                                       ng-model="t.discounted_percentage">
                                            </div>
                                        </div>
                                    </td>
                                    <td data-title="Vendor : " class="align-middle" style="min-width: 100%">
                                        <div class="form-group my-1 mr-2 d-inline-block w-100">
                                            <select class="form-control d-inline-block w-100"
                                                    ng-model="t.vendor_id"
                                                    ng-options="s.id as s.name for s in vendors">
                                                    <option value="">None</option>
                                            </select>
                                        </div>
                                        <div class="form-group my-1 mr-2 w-100">
                                            <textarea ng-show="t.vendor_id" class="form-control" rows="2" placeholder="Enter vendor reference link" autocomplete="off"
                                                   ng-model="t.vendor_references">
                                            </textarea>
                                        </div>
                                    </td>
                                    <td data-title="Preview : " class="align-middle" style="min-width: 150px">
                                        <div>
                                            <img ng-if="!t.path || (t.path && t.path == '')" style="height: 130px; width: 130px; object-fit: contain;"
                                                 src="{{ URL('public/uploads/130x130.png') }}"
                                                 alt="" class="img-fluid">
                                            <img ng-if="t.path && t.path != ''" ng-src="<%t.path%>" style="height: 130px; width: 130px; object-fit: contain;"
                                                 onError="this.src='{{ URL('public/uploads/130x130.png') }}'"
                                                 alt="" class="img-fluid">
                                        </div>
                                    </td>
                                    <td data-title="Action : " class="align-middle" style="max-width: 150px">
                                        <div ng-if="t.id">
                                            <button class="btn btn-info m-1 d-inline-block"
                                                    ng-click="openMore(t, $index)">
                                                <i class="fas fa-fw fa-info mr-1"></i>More
                                            </button>
                                            <button class="btn btn-warning m-1 d-inline-block"
                                                    ng-click="openEditor(t, $index)">
                                                <i class="fas fa-fw fa-upload mr-1"></i>Edit
                                            </button>
                                            <button class="btn btn-outline-secondary m-1 d-inline-block"
                                                    ng-click="chooseDocument(t.id, $index)">
                                                <i class="fas fa-fw fa-upload mr-1"></i>Upload
                                            </button>
                                            <button class="btn btn-danger m-1 d-inline-block"
                                                    ng-click="openDelete(t)">
                                                <i class="fas fa-fw fa-trash mr-1"></i>Delete
                                            </button>
                                        </div>
                                        <div ng-if="!t.id">
                                            <button class="btn btn-danger m-1 d-inline-block"
                                                    ng-click="removeRow($index)">
                                                <i class="fas fa-fw fa-trash mr-1"></i>Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card-footer" ng-show="data.length > 0">
                        <div class="ml-1 pl-2 mb-3">
                            <button class="btn btn-primary radius-md mr-1"
                                    ng-click="openEditor(null, null)">Add New Product
                            </button>
                            <button class="btn btn-success radius-md mr-1"
                                    ng-click="Save()">Save
                            </button>
                        </div>

                        <!-- pagination area -->
                        <ul class="pagination d-inline-block" ng-show="data.length > 10">
                            <li class="paginate_button page-item">
                                <a href="#"
                                ng-click="pagination.current_page > 1 ? goPaginateData(pagination.current_page - 1) : ''">
                                    <i class="icofont-double-left"></i>
                                </a>
                            </li>
                            <li class="paginate_button page-item"
                                ng-show="pagination.current_page > 2">
                                <a href="#" ng-class="pagination.current_page === 1 ? 'active' : ''"
                                ng-click="goPaginateData(1)">1
                                </a>
                            </li>
                            <li class="paginate_button page-item"
                                ng-show="pagination.current_page > 3">
                                <a href="#">...
                                </a>
                            </li>
                            <li class="paginate_button page-item"
                                ng-show="pagination.current_page > 1">
                                <a href="#"
                                ng-click="goPaginateData(pagination.current_page - 1)"><%pagination.current_page-1%>
                                </a>
                            </li>
                            <li class="paginate_button page-item">
                                <a href="#" class="active"
                                ng-click="goPaginateData(pagination.current_page)"><%pagination.current_page%>
                                </a>
                            </li>
                            <li class="paginate_button page-item"
                                ng-show="pagination.current_page < pagination.last_page">
                                <a href="#"
                                ng-click="goPaginateData(pagination.current_page + 1)">
                                    <%pagination.current_page+1%>
                                </a>
                            </li>
                            <li class="paginate_button page-item"
                                ng-show="pagination.current_page < pagination.last_page - 2">
                                <a href="#">...
                                </a>
                            </li>
                            <li class="paginate_button page-item"
                                ng-show="pagination.current_page < pagination.last_page - 1">
                                <a href="#"
                                ng-class="pagination.current_page === pagination.last_page ? 'active' : ''"
                                ng-click="goPaginateData(pagination.last_page)">
                                    <%pagination.last_page%>
                                </a>
                            </li>
                            <li class="paginate_button page-item mr-2">
                                <a href="#"
                                ng-click="pagination.current_page < pagination.last_page ? goPaginateData(pagination.current_page + 1) : ''">
                                    <i class="icofont-double-right"></i>
                                </a>
                            </li>
                            <li class="paginate_button page-item">
                                <a style=" padding: 0 !important; border: 0 !important;">
                                    <select class="form-control"
                                            ng-change="calcPaginateData()"
                                            ng-options="p as p for p in page_size"
                                            ng-model="pagination.per_page">
                                    </select>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>

        <div class="modal-basic modal fade show" id="modal-product-edit" tabindex="-1" role="dialog" aria-modal="true">
            <div class="modal-dialog modal-xl modal-info" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="modal-info-body d-flex">
                            <div class="modal-info-text">
                                <h3 class="h3" ng-show="modal_row.id">Edit Product Details</h3>
                                <h3 class="h3" ng-show="!modal_row.id">Add Product Details</h3>
                            </div>
                        </div>
                        <div ng-show="!modal_row.id" class="row">
                            <div class="col-12 col-md-6">
                                <div><strong>Category : </strong></div>
                                <div class="form-group my-1 mr-2 w-100">
                                    <select class="form-control d-inline-block w-100"
                                            ng-model="modal_row.category_id"
                                            ng-options="s.id as s.title for s in categories">
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div><strong>Product Name : </strong></div>
                                <div class="form-group my-1 mr-2 d-inline-block w-100">
                                    <input type="text" class="form-control"
                                            style="min-width: 110px" placeholder="Enter product name" autocomplete="off"
                                            ng-model="modal_row.name">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div><strong>Marketing Tier : </strong></div>
                                <div class="form-group my-1 mr-2 d-inline-block w-100">
                                    <select class="form-control d-inline-block w-100"
                                            ng-model="modal_row.tier_id"
                                            ng-options="s.id as s.title for s in tiers">
                                            <option value="">None</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div><strong>Price : </strong></div>
                                <div class="form-group my-1 mr-2 d-inline-block w-100">
                                    <input type="text" class="form-control"
                                            style="min-width: 110px" placeholder="Enter price" autocomplete="off"
                                            ng-model="modal_row.price">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div><strong>Qty : </strong></div>
                                <div class="form-group my-1 mr-2 d-inline-block w-100">
                                    <input type="text" class="form-control"
                                        style="min-width: 110px" placeholder="Enter quantity" autocomplete="off"
                                        ng-model="modal_row.qty">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div><strong>D.% : </strong></div>
                                <div class="form-group my-1 mr-2 d-inline-block w-100">
                                    <input type="text" class="form-control"
                                            style="min-width: 110px" placeholder="Enter discount percentage" autocomplete="off"
                                            ng-model="modal_row.discounted_percentage">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div><strong>Vendor : </strong></div>
                                <div class="form-group my-1 mr-2 d-inline-block w-100">
                                    <select class="form-control d-inline-block w-100"
                                            ng-model="modal_row.vendor_id"
                                            ng-options="s.id as s.name for s in vendors">
                                            <option value="">None</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div><strong>Vendor References : </strong></div>
                                <div class="form-group my-1 mr-2 w-100">
                                    <textarea class="form-control" rows="2" placeholder="Enter vendor references" autocomplete="off"
                                            ng-model="modal_row.vendor_references">
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div ng-show="modal_row.id">
                            <h4 class="text-secondary my-3">Highlights</h4>
                            <textarea id="editor1" ng-model="modal_row.highlights"></textarea>

                            <h4 class="text-secondary my-3">Product Description</h4>
                            <textarea id="editor2" ng-model="modal_row.description"></textarea>

                            <h4 class="text-secondary my-3">Specifications</h4>
                            <textarea id="editor3" ng-model="modal_row.specifications"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success btn-sm" data-bs-dismiss="modal" ng-show="!modal_row.id"
                            ng-click="Save(modal_row)">Save</button>
                        <button type="button" class="btn btn-success btn-sm" data-bs-dismiss="modal" ng-show="modal_row.id"
                            ng-click="saveProduct(modal_row, modal_index)">Save</button>
                        <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Info Modal -->
        <div class="modal fade" id="moreModal" tabindex="-1" role="dialog" aria-labelledby="infoModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">More Information</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card mb-3">
                        <table class="table d-table mb-0">
                        <tbody>
                            <tr>
                                <td class="align-middle">
                                    <div>
                                        <img ng-if="!modal_row.path1 || (modal_row.path1 && modal_row.path1 == '')" style="height: 130px; width: 130px; object-fit: contain;"
                                             src="{{ URL('public/uploads/130x130.png') }}"
                                             alt="" class="img-fluid">
                                        <img ng-if="modal_row.path1 && modal_row.path1 != ''" ng-src="<%modal_row.path1%>" style="height: 130px; width: 130px; object-fit: contain;"
                                             onError="this.src='{{ URL('public/uploads/130x130.png') }}'"
                                             alt="" class="img-fluid">
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <button class="btn btn-outline-secondary m-1 d-inline-block"
                                            ng-click="chooseDocument(modal_row.id, modal_index, 'product1')">
                                        <i class="fas fa-fw fa-upload mr-1"></i>Upload
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle">
                                    <div>
                                        <img ng-if="!modal_row.path2 || (modal_row.path2 && modal_row.path2 == '')" style="height: 130px; width: 130px; object-fit: contain;"
                                             src="{{ URL('public/uploads/130x130.png') }}"
                                             alt="" class="img-fluid">
                                        <img ng-if="modal_row.path2 && modal_row.path2 != ''" ng-src="<%modal_row.path2%>" style="height: 130px; width: 130px; object-fit: contain;"
                                             onError="this.src='{{ URL('public/uploads/130x130.png') }}'"
                                             alt="" class="img-fluid">
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <button class="btn btn-outline-secondary m-1 d-inline-block"
                                            ng-click="chooseDocument(modal_row.id, modal_index, 'product2')">
                                        <i class="fas fa-fw fa-upload mr-1"></i>Upload
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle">
                                    <div>
                                        <img ng-if="!modal_row.path3 || (modal_row.path3 && modal_row.path3 == '')" style="height: 130px; width: 130px; object-fit: contain;"
                                             src="{{ URL('public/uploads/130x130.png') }}"
                                             alt="" class="img-fluid">
                                        <img ng-if="modal_row.path3 && modal_row.path3 != ''" ng-src="<%modal_row.path3%>" style="height: 130px; width: 130px; object-fit: contain;"
                                             onError="this.src='{{ URL('public/uploads/130x130.png') }}'"
                                             alt="" class="img-fluid">
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <button class="btn btn-outline-secondary m-1 d-inline-block"
                                            ng-click="chooseDocument(modal_row.id, modal_index, 'product3')">
                                        <i class="fas fa-fw fa-upload mr-1"></i>Upload
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>


        @include('layouts.partials.action_modal')

    </div>

@endsection
