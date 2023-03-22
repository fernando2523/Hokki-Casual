<!-- BEGIN #sidebar -->
<div id="sidebar" class="app-sidebar">
    <!-- BEGIN scrollbar -->
    <div class="app-sidebar-content" data-scrollbar="true" data-height="100%">
        <!-- BEGIN menu -->
        @if (Auth::user()->role === 'SUPER-ADMIN')
            <div class="menu">
                <div class="menu-header">Navigation</div>
                <div class="menu-item {{ Request::is('dashboard/dashboards') ? 'active' : '' }}">
                    <a href="/dashboard/dashboards" class="menu-link">
                        <span class="menu-icon"><i class="bi bi-cpu text-theme"></i></span>
                        <span class="menu-text">Dashboard</span>
                    </a>
                </div>

                <div class="menu-header">Data Master</div>
                <div
                    class="menu-item has-sub {{ Request::is('employee/employees') ? 'active' : '' }}{{ Request::is('supplier/suppliers') ? 'active' : '' }}{{ Request::is('reseller/resellers') ? 'active' : '' }}">
                    <a href="#" class="menu-link">
                        <span class="menu-icon">
                            <i class="bi bi-person-rolodex text-theme"></i>
                        </span>
                        <span class="menu-text">Account</span>
                        <span class="menu-caret"><b class="caret"></b></span>
                    </a>
                    <div class="menu-submenu">
                        <div class="menu-item {{ Request::is('employee/employees') ? 'active' : '' }}">
                            <a href="/employee/employees" class="menu-link">
                                <span class="menu-icon"><i class="bi bi-person-rolodex text-theme"></i></span>
                                <span class="menu-text">Employee</span>
                            </a>
                        </div>
                        <div class="menu-item {{ Request::is('supplier/suppliers') ? 'active' : '' }}">
                            <a href="/supplier/suppliers" class="menu-link">
                                <span class="menu-icon"><i class="bi bi-person-check text-theme"></i></span>
                                <span class="menu-text">Supplier</span>
                            </a>
                        </div>
                        <div class="menu-item {{ Request::is('reseller/resellers') ? 'active' : '' }}">
                            <a href="/reseller/resellers" class="menu-link">
                                <span class="menu-icon"><i class="bi bi-people text-theme"></i></span>
                                <span class="menu-text">Reseller</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div
                    class="menu-item has-sub {{ Request::is('area/areas') ? 'active' : '' }}{{ Request::is('warehouse/warehouses') ? 'active' : '' }}{{ Request::is('store/stores') ? 'active' : '' }}">
                    <a href="#" class="menu-link">
                        <span class="menu-icon">
                            <i class="bi bi-house-door-fill text-theme"></i>
                        </span>
                        <span class="menu-text">Warehouse / Store</span>
                        <span class="menu-caret"><b class="caret"></b></span>
                    </a>
                    <div class="menu-submenu">
                        <div class="menu-item {{ Request::is('area/areas') ? 'active' : '' }}">
                            <a href="/area/areas" class="menu-link">
                                <span class="menu-icon"><i class="bi bi-geo-alt-fill text-theme"></i></span>
                                <span class="menu-text">Area</span>
                            </a>
                        </div>
                        <div class="menu-item {{ Request::is('warehouse/warehouses') ? 'active' : '' }}">
                            <a href="/warehouse/warehouses" class="menu-link">
                                <span class="menu-icon"><i class="bi bi-house-door-fill text-theme"></i></span>
                                <span class="menu-text">Warehouse</span>
                            </a>
                        </div>
                        <div class="menu-item {{ Request::is('store/stores') ? 'active' : '' }}">
                            <a href="/store/stores" class="menu-link">
                                <span class="menu-icon"><i class="bi bi-shop text-theme"></i></span>
                                <span class="menu-text">Store</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div
                    class="menu-item has-sub {{ Request::is('repeat/repeatorders') ? 'active' : '' }}{{ Request::is('purchase/purchaseorder') ? 'active' : '' }}{{ Request::is('brand/brands') ? 'active' : '' }}{{ Request::is('category/categories') ? 'active' : '' }}{{ Request::is('barcode/barcodes') ? 'active' : '' }}{{ Request::is('productTransfer/productTransfers') ? 'active' : '' }}">
                    <a href="#" class="menu-link">
                        <span class="menu-icon">
                            <i class="bi bi-clipboard2-data-fill text-theme"></i>
                        </span>
                        <span class="menu-text">Management Stock</span>
                        <span class="menu-caret"><b class="caret"></b></span>
                    </a>
                    <div class="menu-submenu">
                        <div class="menu-item {{ Request::is('repeat/repeatorders') ? 'active' : '' }}">
                            <a href="/repeat/repeatorders" class="menu-link">
                                <span class="menu-icon"><i class="bi-arrow-repeat text-theme"></i></span>
                                <span class="menu-text">Release / Repeat</span>
                            </a>
                        </div>
                        <div class="menu-item {{ Request::is('purchase/purchaseorder') ? 'active' : '' }}">
                            <a href="/purchase/purchaseorder" class="menu-link">
                                <span class="menu-icon"><i class="bi bi-clipboard-data text-theme"></i></span>
                                <span class="menu-text">Data Purchase Order</span>
                            </a>
                        </div>
                        <div class="menu-item {{ Request::is('productTransfer/productTransfers') ? 'active' : '' }}">
                            <a href="/productTransfer/productTransfers" class="menu-link">
                                <span class="menu-icon"><i class="bi bi-arrow-left-right text-theme"></i></span>
                                <span class="menu-text">Product Transfer</span>
                            </a>
                        </div>
                        <div class="menu-item {{ Request::is('brand/brands') ? 'active' : '' }}">
                            <a href="/brand/brands" class="menu-link">
                                <span class="menu-icon"><i class="fab fa-firstdraft text-theme"></i></span>
                                <span class="menu-text">Brand</span>
                            </a>
                        </div>
                        <div class="menu-item {{ Request::is('category/categories') ? 'active' : '' }}">
                            <a href="/category/categories" class="menu-link">
                                <span class="menu-icon"><i class="bi bi-bookmarks-fill text-theme"></i></span>
                                <span class="menu-text">Category</span>
                            </a>
                        </div>
                        <div class="menu-item {{ Request::is('barcode/barcodes') ? 'active' : '' }}">
                            <a href="/barcode/barcodes" class="menu-link">
                                <span class="menu-icon"><i class="bi bi-upc-scan text-theme"></i></span>
                                <span class="menu-text">Barcode</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="menu-header">Assets</div>
                <div class="menu-item {{ Request::is('asset/assets') ? 'active' : '' }}">
                    <a href="/asset/assets" class="menu-link">
                        <span class="menu-icon"><i class="bi bi bi-wallet text-theme"></i></span>
                        <span class="menu-text">Assets</span>
                    </a>
                </div>

                <div class="menu-header">Products</div>
                <div class="menu-item {{ Request::is('product/products') ? 'active' : '' }}">
                    <a href="/product/products" class="menu-link">
                        <span class="menu-icon"><i class="bi bi-search text-theme"></i></span>
                        <span class="menu-text">Search Products</span>
                    </a>
                </div>

                <div class="menu-item {{ Request::is('displays_product') ? 'active' : '' }}">
                    <a href="/displays_product" class="menu-link">
                        <span class="menu-icon"><i class="bi bi-shop-window text-theme"></i></span>
                        <span class="menu-text">Displays Products</span>
                    </a>
                </div>


                <div class="menu-header">Sales</div>
                <div class="menu-item {{ Request::is('sale/sale') ? 'active' : '' }}">
                    <a href="/sale/sales" class="menu-link">
                        <span class="menu-icon"><i class="bi bi-cart-check text-theme"></i></span>
                        <span class="menu-text">Sales</span>
                    </a>
                </div>
                <div class="menu-item {{ Request::is('store_expense/store_expenses') ? 'active' : '' }}">
                    <a href="/store_expense/store_expenses" class="menu-link">
                        <span class="menu-icon"><i class="bi bi-cash-coin text-theme"></i></span>
                        <span class="menu-text">Store Expenditure</span>
                    </a>
                </div>

                <div
                    class="menu-item has-sub {{ Request::is('order/orders') ? 'active' : '' }} {{ Request::is('orderPaid/order_paids') ? 'active' : '' }} {{ Request::is('orderPending/order_pendings') ? 'active' : '' }}">
                    <a href="#" class="menu-link ">
                        <span class="menu-icon">
                            <i class="fa fa-calendar-alt text-theme"></i>
                        </span>
                        <span class="menu-text">Report Orders</span>
                        <span class="menu-caret"><b class="caret"></b></span>
                    </a>
                    <div class="menu-submenu">
                        <div class="menu-item {{ Request::is('order/orders') ? 'active' : '' }}">
                            <a href="/order/orders" class="menu-link">
                                <span class="menu-icon"><i class="fa fa-calendar-alt text-theme"></i></span>
                                <span class="menu-text">Retail</span>
                            </a>
                        </div>
                        <div class="menu-item {{ Request::is('orderPaid/order_paids') ? 'active' : '' }}">
                            <a href="/orderPaid/order_paids" class="menu-link">
                                <span class="menu-icon"><i class="fa fa-calendar-check text-theme"></i></span>
                                <span class="menu-text">Reseller Paid</span>
                            </a>
                        </div>
                        <div class="menu-item {{ Request::is('orderPending/order_pendings') ? 'active' : '' }}">
                            <a href="/orderPending/order_pendings" class="menu-link">
                                <span class="menu-icon"><i class="fa fa-calendar-times text-theme"></i></span>
                                <span class="menu-text">Reseller Pending</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div
                    class="menu-item has-sub {{ Request::is('ordercancel/cancel') ? 'active' : '' }} {{ Request::is('orderreturn/return') ? 'active' : '' }} {{ Request::is('orderrefund/refund') ? 'active' : '' }}">
                    <a href="#" class="menu-link ">
                        <span class="menu-icon">
                            <i class="bi bi-clock-history text-theme"></i>
                        </span>
                        <span class="menu-text">Histories</span>
                        <span class="menu-caret"><b class="caret"></b></span>
                    </a>
                    <div class="menu-submenu">
                        <div class="menu-item {{ Request::is('ordercancel/cancel') ? 'active' : '' }}">
                            <a href="/ordercancel/cancel" class="menu-link">
                                <span class="menu-icon"><i class="bi bi-x-circle-fill text-theme"></i></span>
                                <span class="menu-text">Cancel</span>
                            </a>
                        </div>
                        <div class="menu-item {{ Request::is('orderreturn/return') ? 'active' : '' }}">
                            <a href="/orderreturn/return" class="menu-link">
                                <span class="menu-icon"><i class="bi bi-shuffle text-theme"></i></span>
                                <span class="menu-text">Return</span>
                            </a>
                        </div>
                        <div class="menu-item {{ Request::is('orderrefund/refund') ? 'active' : '' }}">
                            <a href="/orderrefund/refund" class="menu-link">
                                <span class="menu-icon"><i class="bi bi-recycle text-theme"></i></span>
                                <span class="menu-text">Refund</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="menu-header">Report</div>
                <div
                    class="menu-item has-sub {{ Request::is('reportSummary/summary') ? 'active' : '' }}{{ Request::is('reportProduct/product') ? 'active' : '' }}{{ Request::is('reportStore/store') ? 'active' : '' }}{{ Request::is('reportBrand/brand') ? 'active' : '' }}{{ Request::is('reportQuality/quality') ? 'active' : '' }}">
                    <a href="#" class="menu-link">
                        <span class="menu-icon">
                            <i class="bi bi-graph-up-arrow text-theme"></i>
                        </span>
                        <span class="menu-text">Report Profit</span>
                        <span class="menu-caret"><b class="caret"></b></span>
                    </a>
                    <div class="menu-submenu">
                        <div class="menu-item {{ Request::is('reportSummary/summary') ? 'active' : '' }}">
                            <a href="/reportSummary/summary" class="menu-link">
                                <span class="menu-text">Summary</span>
                            </a>
                        </div>
                        <div class="menu-item {{ Request::is('reportProduct/product') ? 'active' : '' }}">
                            <a href="/reportProduct/product" class="menu-link">
                                <span class="menu-text">Product</span>
                            </a>
                        </div>
                        <div class="menu-item {{ Request::is('reportStore/store') ? 'active' : '' }}">
                            <a href="/reportStore/store" class="menu-link">
                                <span class="menu-text">Store</span>
                            </a>
                        </div>
                        <div class="menu-item {{ Request::is('reportBrand/brand') ? 'active' : '' }}">
                            <a href="/reportBrand/brand" class="menu-link">
                                <span class="menu-text">Brand</span>
                            </a>
                        </div>
                        <div class="menu-item {{ Request::is('reportQuality/quality') ? 'active' : '' }}">
                            <a href="/reportQuality/quality" class="menu-link">
                                <span class="menu-text">Quality</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="menu-divider"></div>
                <div class="menu-header">Settings</div>
                <div class="menu-item {{ Request::is('setting/setting') ? 'active' : '' }}">
                    <a href="/setting/setting" class="menu-link">
                        <span class="menu-icon"><i class="bi bi-gear text-theme"></i></span>
                        <span class="menu-text">Settings</span>
                    </a>
                </div>
            </div>
        @elseif (Auth::user()->role === 'HEAD-AREA')
            <div class="menu">
                <div class="menu-header">Navigation</div>
                <div class="menu-item {{ Request::is('dashboard/dashboards') ? 'active' : '' }}">
                    <a href="/dashboard/dashboards" class="menu-link">
                        <span class="menu-icon"><i class="bi bi-cpu text-theme"></i></span>
                        <span class="menu-text">Dashboard</span>
                    </a>
                </div>

                <div class="menu-header">Data Master</div>
                <div class="menu-item has-sub {{ Request::is('reseller/resellers') ? 'active' : '' }}">
                    <a href="#" class="menu-link">
                        <span class="menu-icon">
                            <i class="bi bi-person-rolodex text-theme"></i>
                        </span>
                        <span class="menu-text">Account</span>
                        <span class="menu-caret"><b class="caret"></b></span>
                    </a>
                    <div class="menu-submenu">
                        <div class="menu-item {{ Request::is('reseller/resellers') ? 'active' : '' }}">
                            <a href="/reseller/resellers" class="menu-link">
                                <span class="menu-icon"><i class="bi bi-people text-theme"></i></span>
                                <span class="menu-text">Reseller</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div
                    class="menu-item has-sub {{ Request::is('repeat/repeatorders') ? 'active' : '' }}{{ Request::is('purchase/purchaseorder') ? 'active' : '' }}{{ Request::is('brand/brands') ? 'active' : '' }}{{ Request::is('category/categories') ? 'active' : '' }}{{ Request::is('barcode/barcodes') ? 'active' : '' }}{{ Request::is('productTransfer/productTransfers') ? 'active' : '' }}">
                    <a href="#" class="menu-link">
                        <span class="menu-icon">
                            <i class="bi bi-clipboard2-data-fill text-theme"></i>
                        </span>
                        <span class="menu-text">Management Stock</span>
                        <span class="menu-caret"><b class="caret"></b></span>
                    </a>
                    <div class="menu-submenu">
                        <div class="menu-item {{ Request::is('repeat/repeatorders') ? 'active' : '' }}">
                            <a href="/repeat/repeatorders" class="menu-link">
                                <span class="menu-icon"><i class="bi-arrow-repeat text-theme"></i></span>
                                <span class="menu-text">Release / Repeat</span>
                            </a>
                        </div>
                        <div class="menu-item {{ Request::is('purchase/purchaseorder') ? 'active' : '' }}">
                            <a href="/purchase/purchaseorder" class="menu-link">
                                <span class="menu-icon"><i class="bi bi-clipboard-data text-theme"></i></span>
                                <span class="menu-text">Data Purchase Order</span>
                            </a>
                        </div>
                        <div class="menu-item {{ Request::is('productTransfer/productTransfers') ? 'active' : '' }}">
                            <a href="/productTransfer/productTransfers" class="menu-link">
                                <span class="menu-icon"><i class="bi bi-arrow-left-right text-theme"></i></span>
                                <span class="menu-text">Product Transfer</span>
                            </a>
                        </div>
                        <div class="menu-item {{ Request::is('brand/brands') ? 'active' : '' }}">
                            <a href="/brand/brands" class="menu-link">
                                <span class="menu-icon"><i class="fab fa-firstdraft text-theme"></i></span>
                                <span class="menu-text">Brand</span>
                            </a>
                        </div>
                        <div class="menu-item {{ Request::is('category/categories') ? 'active' : '' }}">
                            <a href="/category/categories" class="menu-link">
                                <span class="menu-icon"><i class="bi bi-bookmarks-fill text-theme"></i></span>
                                <span class="menu-text">Category</span>
                            </a>
                        </div>
                        <div class="menu-item {{ Request::is('barcode/barcodes') ? 'active' : '' }}">
                            <a href="/barcode/barcodes" class="menu-link">
                                <span class="menu-icon"><i class="bi bi-upc-scan text-theme"></i></span>
                                <span class="menu-text">Barcode</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="menu-header">Products</div>
                <div class="menu-item {{ Request::is('product/products') ? 'active' : '' }}">
                    <a href="/product/products" class="menu-link">
                        <span class="menu-icon"><i class="bi bi-search text-theme"></i></span>
                        <span class="menu-text">Search Products</span>
                    </a>
                </div>


                <div class="menu-header">Sales</div>
                <div class="menu-item {{ Request::is('sale/sale') ? 'active' : '' }}">
                    <a href="/sale/sales" class="menu-link">
                        <span class="menu-icon"><i class="bi bi-cart-check text-theme"></i></span>
                        <span class="menu-text">Sales</span>
                    </a>
                </div>
                <div class="menu-item {{ Request::is('store_expense/store_expenses') ? 'active' : '' }}">
                    <a href="/store_expense/store_expenses" class="menu-link">
                        <span class="menu-icon"><i class="bi bi-cash-coin text-theme"></i></span>
                        <span class="menu-text">Store Expenditure</span>
                    </a>
                </div>
                {{-- <div class="menu-item {{ Request::is('order/orders') ? 'active' : '' }}">
                    <a href="/order/orders" class="menu-link">
                        <span class="menu-icon"><i class="bi bi-inboxes-fill text-theme"></i></span>
                        <span class="menu-text">Orders</span>
                    </a>
                </div> --}}

                <div
                    class="menu-item has-sub {{ Request::is('order/orders') ? 'active' : '' }} {{ Request::is('orderPaid/order_paids') ? 'active' : '' }} {{ Request::is('orderPending/order_pendings') ? 'active' : '' }}">
                    <a href="#" class="menu-link ">
                        <span class="menu-icon">
                            <i class="fa fa-calendar-alt text-theme"></i>
                        </span>
                        <span class="menu-text">Report Orders</span>
                        <span class="menu-caret"><b class="caret"></b></span>
                    </a>
                    <div class="menu-submenu">
                        <div class="menu-item {{ Request::is('order/orders') ? 'active' : '' }}">
                            <a href="/order/orders" class="menu-link">
                                <span class="menu-icon"><i class="fa fa-calendar-alt text-theme"></i></span>
                                <span class="menu-text">Retail</span>
                            </a>
                        </div>
                        <div class="menu-item {{ Request::is('orderPaid/order_paids') ? 'active' : '' }}">
                            <a href="/orderPaid/order_paids" class="menu-link">
                                <span class="menu-icon"><i class="fa fa-calendar-check text-theme"></i></span>
                                <span class="menu-text">Reseller Paid</span>
                            </a>
                        </div>
                        <div class="menu-item {{ Request::is('orderPending/order_pendings') ? 'active' : '' }}">
                            <a href="/orderPending/order_pendings" class="menu-link">
                                <span class="menu-icon"><i class="fa fa-calendar-times text-theme"></i></span>
                                <span class="menu-text">Reseller Pending</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div
                    class="menu-item has-sub {{ Request::is('ordercancel/cancel') ? 'active' : '' }} {{ Request::is('orderreturn/return') ? 'active' : '' }} {{ Request::is('orderrefund/refund') ? 'active' : '' }}">
                    <a href="#" class="menu-link ">
                        <span class="menu-icon">
                            <i class="bi bi-clock-history text-theme"></i>
                        </span>
                        <span class="menu-text">Histories</span>
                        <span class="menu-caret"><b class="caret"></b></span>
                    </a>
                    <div class="menu-submenu">
                        <div class="menu-item {{ Request::is('ordercancel/cancel') ? 'active' : '' }}">
                            <a href="/ordercancel/cancel" class="menu-link">
                                <span class="menu-icon"><i class="bi bi-x-circle-fill text-theme"></i></span>
                                <span class="menu-text">Cancel</span>
                            </a>
                        </div>
                        <div class="menu-item {{ Request::is('orderreturn/return') ? 'active' : '' }}">
                            <a href="/orderreturn/return" class="menu-link">
                                <span class="menu-icon"><i class="bi bi-shuffle text-theme"></i></span>
                                <span class="menu-text">Return</span>
                            </a>
                        </div>
                        <div class="menu-item {{ Request::is('orderrefund/refund') ? 'active' : '' }}">
                            <a href="/orderrefund/refund" class="menu-link">
                                <span class="menu-icon"><i class="bi bi-recycle text-theme"></i></span>
                                <span class="menu-text">Refund</span>
                            </a>
                        </div>
                    </div>
                </div>


                <div class="menu-divider"></div>
                <div class="menu-header">Settings</div>
                <div class="menu-item {{ Request::is('setting/setting') ? 'active' : '' }}">
                    <a href="/setting/setting" class="menu-link">
                        <span class="menu-icon"><i class="bi bi-gear text-theme"></i></span>
                        <span class="menu-text">Settings</span>
                    </a>
                </div>
            </div>
        @elseif (Auth::user()->role === 'HEAD-WAREHOUSE')
            <div class="menu">
                <div class="menu-header">Navigation</div>
                <div class="menu-item {{ Request::is('dashboard/dashboards') ? 'active' : '' }}">
                    <a href="/dashboard/dashboards" class="menu-link">
                        <span class="menu-icon"><i class="bi bi-cpu text-theme"></i></span>
                        <span class="menu-text">Dashboard</span>
                    </a>
                </div>

                <div class="menu-header">Data Master</div>
                <div class="menu-item has-sub {{ Request::is('reseller/resellers') ? 'active' : '' }}">
                    <a href="#" class="menu-link">
                        <span class="menu-icon">
                            <i class="bi bi-person-rolodex text-theme"></i>
                        </span>
                        <span class="menu-text">Account</span>
                        <span class="menu-caret"><b class="caret"></b></span>
                    </a>
                    <div class="menu-submenu">
                        <div class="menu-item {{ Request::is('reseller/resellers') ? 'active' : '' }}">
                            <a href="/reseller/resellers" class="menu-link">
                                <span class="menu-icon"><i class="bi bi-people text-theme"></i></span>
                                <span class="menu-text">Reseller</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div
                    class="menu-item has-sub {{ Request::is('repeat/repeatorders') ? 'active' : '' }}{{ Request::is('purchase/purchaseorder') ? 'active' : '' }}{{ Request::is('brand/brands') ? 'active' : '' }}{{ Request::is('category/categories') ? 'active' : '' }}{{ Request::is('barcode/barcodes') ? 'active' : '' }}{{ Request::is('productTransfer/productTransfers') ? 'active' : '' }}">
                    <a href="#" class="menu-link">
                        <span class="menu-icon">
                            <i class="bi bi-clipboard2-data-fill text-theme"></i>
                        </span>
                        <span class="menu-text">Management Stock</span>
                        <span class="menu-caret"><b class="caret"></b></span>
                    </a>
                    <div class="menu-submenu">
                        <div class="menu-item {{ Request::is('repeat/repeatorders') ? 'active' : '' }}">
                            <a href="/repeat/repeatorders" class="menu-link">
                                <span class="menu-icon"><i class="bi-arrow-repeat text-theme"></i></span>
                                <span class="menu-text">Release / Repeat</span>
                            </a>
                        </div>
                        <div class="menu-item {{ Request::is('purchase/purchaseorder') ? 'active' : '' }}">
                            <a href="/purchase/purchaseorder" class="menu-link">
                                <span class="menu-icon"><i class="bi bi-clipboard-data text-theme"></i></span>
                                <span class="menu-text">Data Purchase Order</span>
                            </a>
                        </div>
                        <div class="menu-item {{ Request::is('productTransfer/productTransfers') ? 'active' : '' }}">
                            <a href="/productTransfer/productTransfers" class="menu-link">
                                <span class="menu-icon"><i class="bi bi-arrow-left-right text-theme"></i></span>
                                <span class="menu-text">Product Transfer</span>
                            </a>
                        </div>
                        <div class="menu-item {{ Request::is('brand/brands') ? 'active' : '' }}">
                            <a href="/brand/brands" class="menu-link">
                                <span class="menu-icon"><i class="fab fa-firstdraft text-theme"></i></span>
                                <span class="menu-text">Brand</span>
                            </a>
                        </div>
                        <div class="menu-item {{ Request::is('category/categories') ? 'active' : '' }}">
                            <a href="/category/categories" class="menu-link">
                                <span class="menu-icon"><i class="bi bi-bookmarks-fill text-theme"></i></span>
                                <span class="menu-text">Category</span>
                            </a>
                        </div>
                        <div class="menu-item {{ Request::is('barcode/barcodes') ? 'active' : '' }}">
                            <a href="/barcode/barcodes" class="menu-link">
                                <span class="menu-icon"><i class="bi bi-upc-scan text-theme"></i></span>
                                <span class="menu-text">Barcode</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="menu-header">Products</div>
                <div class="menu-item {{ Request::is('product/products') ? 'active' : '' }}">
                    <a href="/product/products" class="menu-link">
                        <span class="menu-icon"><i class="bi bi-search text-theme"></i></span>
                        <span class="menu-text">Search Products</span>
                    </a>
                </div>


                <div class="menu-header">Sales</div>
                <div class="menu-item {{ Request::is('sale/sale') ? 'active' : '' }}">
                    <a href="/sale/sales" class="menu-link">
                        <span class="menu-icon"><i class="bi bi-cart-check text-theme"></i></span>
                        <span class="menu-text">Sales</span>
                    </a>
                </div>
                <div class="menu-item {{ Request::is('store_expense/store_expenses') ? 'active' : '' }}">
                    <a href="/store_expense/store_expenses" class="menu-link">
                        <span class="menu-icon"><i class="bi bi-cash-coin text-theme"></i></span>
                        <span class="menu-text">Store Expenditure</span>
                    </a>
                </div>
                {{-- <div class="menu-item {{ Request::is('order/orders') ? 'active' : '' }}">
                    <a href="/order/orders" class="menu-link">
                        <span class="menu-icon"><i class="bi bi-inboxes-fill text-theme"></i></span>
                        <span class="menu-text">Orders</span>
                    </a>
                </div> --}}

                <div
                    class="menu-item has-sub {{ Request::is('order/orders') ? 'active' : '' }} {{ Request::is('orderPaid/order_paids') ? 'active' : '' }} {{ Request::is('orderPending/order_pendings') ? 'active' : '' }}">
                    <a href="#" class="menu-link ">
                        <span class="menu-icon">
                            <i class="fa fa-calendar-alt text-theme"></i>
                        </span>
                        <span class="menu-text">Report Orders</span>
                        <span class="menu-caret"><b class="caret"></b></span>
                    </a>
                    <div class="menu-submenu">
                        <div class="menu-item {{ Request::is('order/orders') ? 'active' : '' }}">
                            <a href="/order/orders" class="menu-link">
                                <span class="menu-icon"><i class="fa fa-calendar-alt text-theme"></i></span>
                                <span class="menu-text">Retail</span>
                            </a>
                        </div>
                        <div class="menu-item {{ Request::is('orderPaid/order_paids') ? 'active' : '' }}">
                            <a href="/orderPaid/order_paids" class="menu-link">
                                <span class="menu-icon"><i class="fa fa-calendar-check text-theme"></i></span>
                                <span class="menu-text">Reseller Paid</span>
                            </a>
                        </div>
                        <div class="menu-item {{ Request::is('orderPending/order_pendings') ? 'active' : '' }}">
                            <a href="/orderPending/order_pendings" class="menu-link">
                                <span class="menu-icon"><i class="fa fa-calendar-times text-theme"></i></span>
                                <span class="menu-text">Reseller Pending</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div
                    class="menu-item has-sub {{ Request::is('ordercancel/cancel') ? 'active' : '' }} {{ Request::is('orderreturn/return') ? 'active' : '' }} {{ Request::is('orderrefund/refund') ? 'active' : '' }}">
                    <a href="#" class="menu-link ">
                        <span class="menu-icon">
                            <i class="bi bi-clock-history text-theme"></i>
                        </span>
                        <span class="menu-text">Histories</span>
                        <span class="menu-caret"><b class="caret"></b></span>
                    </a>
                    <div class="menu-submenu">
                        <div class="menu-item {{ Request::is('ordercancel/cancel') ? 'active' : '' }}">
                            <a href="/ordercancel/cancel" class="menu-link">
                                <span class="menu-icon"><i class="bi bi-x-circle-fill text-theme"></i></span>
                                <span class="menu-text">Cancel</span>
                            </a>
                        </div>
                        <div class="menu-item {{ Request::is('orderreturn/return') ? 'active' : '' }}">
                            <a href="/orderreturn/return" class="menu-link">
                                <span class="menu-icon"><i class="bi bi-shuffle text-theme"></i></span>
                                <span class="menu-text">Return</span>
                            </a>
                        </div>
                        <div class="menu-item {{ Request::is('orderrefund/refund') ? 'active' : '' }}">
                            <a href="/orderrefund/refund" class="menu-link">
                                <span class="menu-icon"><i class="bi bi-recycle text-theme"></i></span>
                                <span class="menu-text">Refund</span>
                            </a>
                        </div>
                    </div>
                </div>


                <div class="menu-divider"></div>
                <div class="menu-header">Settings</div>
                <div class="menu-item {{ Request::is('setting/setting') ? 'active' : '' }}">
                    <a href="/setting/setting" class="menu-link">
                        <span class="menu-icon"><i class="bi bi-gear text-theme"></i></span>
                        <span class="menu-text">Settings</span>
                    </a>
                </div>
            </div>
        @elseif (Auth::user()->role === 'HEAD-STORE')
            <div class="menu">
                <div class="menu-header">Navigation</div>
                <div class="menu-item {{ Request::is('dashboard/dashboards') ? 'active' : '' }}">
                    <a href="/dashboard/dashboards" class="menu-link">
                        <span class="menu-icon"><i class="bi bi-cpu text-theme"></i></span>
                        <span class="menu-text">Dashboard</span>
                    </a>
                </div>

                <div class="menu-header">Products</div>
                <div class="menu-item {{ Request::is('product/products') ? 'active' : '' }}">
                    <a href="/product/products" class="menu-link">
                        <span class="menu-icon"><i class="bi bi-search text-theme"></i></span>
                        <span class="menu-text">Search Products</span>
                    </a>
                </div>

                <div class="menu-item {{ Request::is('displays_product') ? 'active' : '' }}">
                    <a href="/displays_product" class="menu-link">
                        <span class="menu-icon"><i class="bi bi-shop-window text-theme"></i></span>
                        <span class="menu-text">Displays Products</span>
                    </a>
                </div>


                <div class="menu-header">Sales</div>
                <div class="menu-item {{ Request::is('sale/sale') ? 'active' : '' }}">
                    <a href="/sale/sales" class="menu-link">
                        <span class="menu-icon"><i class="bi bi-cart-check text-theme"></i></span>
                        <span class="menu-text">Sales</span>
                    </a>
                </div>
                <div class="menu-item {{ Request::is('store_expense/store_expenses') ? 'active' : '' }}">
                    <a href="/store_expense/store_expenses" class="menu-link">
                        <span class="menu-icon"><i class="bi bi-cash-coin text-theme"></i></span>
                        <span class="menu-text">Store Expenditure</span>
                    </a>
                </div>

                <div
                    class="menu-item has-sub {{ Request::is('order/orders') ? 'active' : '' }} {{ Request::is('orderPaid/order_paids') ? 'active' : '' }} {{ Request::is('orderPending/order_pendings') ? 'active' : '' }}">
                    <a href="#" class="menu-link ">
                        <span class="menu-icon">
                            <i class="fa fa-calendar-alt text-theme"></i>
                        </span>
                        <span class="menu-text">Report Orders</span>
                        <span class="menu-caret"><b class="caret"></b></span>
                    </a>
                    <div class="menu-submenu">
                        <div class="menu-item {{ Request::is('order/orders') ? 'active' : '' }}">
                            <a href="/order/orders" class="menu-link">
                                <span class="menu-icon"><i class="fa fa-calendar-alt text-theme"></i></span>
                                <span class="menu-text">Retail</span>
                            </a>
                        </div>
                        <div class="menu-item {{ Request::is('orderPaid/order_paids') ? 'active' : '' }}">
                            <a href="/orderPaid/order_paids" class="menu-link">
                                <span class="menu-icon"><i class="fa fa-calendar-check text-theme"></i></span>
                                <span class="menu-text">Reseller Paid</span>
                            </a>
                        </div>
                        <div class="menu-item {{ Request::is('orderPending/order_pendings') ? 'active' : '' }}">
                            <a href="/orderPending/order_pendings" class="menu-link">
                                <span class="menu-icon"><i class="fa fa-calendar-times text-theme"></i></span>
                                <span class="menu-text">Reseller Pending</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div
                    class="menu-item has-sub {{ Request::is('ordercancel/cancel') ? 'active' : '' }} {{ Request::is('orderreturn/return') ? 'active' : '' }} {{ Request::is('orderrefund/refund') ? 'active' : '' }}">
                    <a href="#" class="menu-link ">
                        <span class="menu-icon">
                            <i class="bi bi-clock-history text-theme"></i>
                        </span>
                        <span class="menu-text">Histories</span>
                        <span class="menu-caret"><b class="caret"></b></span>
                    </a>
                    <div class="menu-submenu">
                        <div class="menu-item {{ Request::is('ordercancel/cancel') ? 'active' : '' }}">
                            <a href="/ordercancel/cancel" class="menu-link">
                                <span class="menu-icon"><i class="bi bi-x-circle-fill text-theme"></i></span>
                                <span class="menu-text">Cancel</span>
                            </a>
                        </div>
                        <div class="menu-item {{ Request::is('orderreturn/return') ? 'active' : '' }}">
                            <a href="/orderreturn/return" class="menu-link">
                                <span class="menu-icon"><i class="bi bi-shuffle text-theme"></i></span>
                                <span class="menu-text">Return</span>
                            </a>
                        </div>
                        <div class="menu-item {{ Request::is('orderrefund/refund') ? 'active' : '' }}">
                            <a href="/orderrefund/refund" class="menu-link">
                                <span class="menu-icon"><i class="bi bi-recycle text-theme"></i></span>
                                <span class="menu-text">Refund</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="menu-divider"></div>
                <div class="menu-header">Settings</div>
                <div class="menu-item {{ Request::is('setting/setting') ? 'active' : '' }}">
                    <a href="/setting/setting" class="menu-link">
                        <span class="menu-icon"><i class="bi bi-gear text-theme"></i></span>
                        <span class="menu-text">Settings</span>
                    </a>
                </div>
            </div>
        @elseif (Auth::user()->role === 'CASHIER')
            <div class="menu">
                <div class="menu-header">Navigation</div>
                <div class="menu-item {{ Request::is('dashboard/dashboards') ? 'active' : '' }}">
                    <a href="/dashboard/dashboards" class="menu-link">
                        <span class="menu-icon"><i class="bi bi-cpu text-theme"></i></span>
                        <span class="menu-text">Dashboard</span>
                    </a>
                </div>

                <div class="menu-header">Products</div>
                <div class="menu-item {{ Request::is('product/products') ? 'active' : '' }}">
                    <a href="/product/products" class="menu-link">
                        <span class="menu-icon"><i class="bi bi-search text-theme"></i></span>
                        <span class="menu-text">Search Products</span>
                    </a>
                </div>

                <div class="menu-header">Sales</div>
                <div class="menu-item {{ Request::is('sale/sale') ? 'active' : '' }}">
                    <a href="/sale/sales" class="menu-link">
                        <span class="menu-icon"><i class="bi bi-cart-check text-theme"></i></span>
                        <span class="menu-text">Sales</span>
                    </a>
                </div>
                <div class="menu-item {{ Request::is('store_expense/store_expenses') ? 'active' : '' }}">
                    <a href="/store_expense/store_expenses" class="menu-link">
                        <span class="menu-icon"><i class="bi bi-cash-coin text-theme"></i></span>
                        <span class="menu-text">Store Expenditure</span>
                    </a>
                </div>

                <div
                    class="menu-item has-sub {{ Request::is('order/orders') ? 'active' : '' }} {{ Request::is('orderPaid/order_paids') ? 'active' : '' }} {{ Request::is('orderPending/order_pendings') ? 'active' : '' }}">
                    <a href="#" class="menu-link ">
                        <span class="menu-icon">
                            <i class="fa fa-calendar-alt text-theme"></i>
                        </span>
                        <span class="menu-text">Report Orders</span>
                        <span class="menu-caret"><b class="caret"></b></span>
                    </a>
                    <div class="menu-submenu">
                        <div class="menu-item {{ Request::is('order/orders') ? 'active' : '' }}">
                            <a href="/order/orders" class="menu-link">
                                <span class="menu-icon"><i class="fa fa-calendar-alt text-theme"></i></span>
                                <span class="menu-text">Retail</span>
                            </a>
                        </div>
                        <div class="menu-item {{ Request::is('orderPaid/order_paids') ? 'active' : '' }}">
                            <a href="/orderPaid/order_paids" class="menu-link">
                                <span class="menu-icon"><i class="fa fa-calendar-check text-theme"></i></span>
                                <span class="menu-text">Reseller Paid</span>
                            </a>
                        </div>
                        <div class="menu-item {{ Request::is('orderPending/order_pendings') ? 'active' : '' }}">
                            <a href="/orderPending/order_pendings" class="menu-link">
                                <span class="menu-icon"><i class="fa fa-calendar-times text-theme"></i></span>
                                <span class="menu-text">Reseller Pending</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="menu-divider"></div>
                <div class="menu-header">Settings</div>
                <div class="menu-item {{ Request::is('setting/setting') ? 'active' : '' }}">
                    <a href="/setting/setting" class="menu-link">
                        <span class="menu-icon"><i class="bi bi-gear text-theme"></i></span>
                        <span class="menu-text">Settings</span>
                    </a>
                </div>
            </div>
            @elseif (Auth::user()->role === 'BARCODE')
            <div class="menu">
                <div class="menu-header">Navigation</div>
                <div class="menu-item {{ Request::is('dashboard/dashboards') ? 'active' : '' }}">
                    <a href="/dashboard/dashboards" class="menu-link">
                        <span class="menu-icon"><i class="bi bi-cpu text-theme"></i></span>
                        <span class="menu-text">Dashboard</span>
                    </a>
                </div>

                <div
                    class="menu-item has-sub {{ Request::is('barcode/barcodes') ? 'active' : '' }}">
                    <a href="#" class="menu-link">
                        <span class="menu-icon">
                            <i class="bi bi-clipboard2-data-fill text-theme"></i>
                        </span>
                        <span class="menu-text">Management Stock</span>
                        <span class="menu-caret"><b class="caret"></b></span>
                    </a>
                    <div class="menu-submenu">
                        <div class="menu-item {{ Request::is('barcode/barcodes') ? 'active' : '' }}">
                            <a href="/barcode/barcodes" class="menu-link">
                                <span class="menu-icon"><i class="bi bi-upc-scan text-theme"></i></span>
                                <span class="menu-text">Barcode</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="menu-header">Products</div>
                <div class="menu-item {{ Request::is('product/products') ? 'active' : '' }}">
                    <a href="/product/products" class="menu-link">
                        <span class="menu-icon"><i class="bi bi-search text-theme"></i></span>
                        <span class="menu-text">Search Products</span>
                    </a>
                </div>

                <div class="menu-header">Sales</div>
                <div class="menu-item {{ Request::is('sale/sale') ? 'active' : '' }}">
                    <a href="/sale/sales" class="menu-link">
                        <span class="menu-icon"><i class="bi bi-cart-check text-theme"></i></span>
                        <span class="menu-text">Sales</span>
                    </a>
                </div>
                <div class="menu-item {{ Request::is('store_expense/store_expenses') ? 'active' : '' }}">
                    <a href="/store_expense/store_expenses" class="menu-link">
                        <span class="menu-icon"><i class="bi bi-cash-coin text-theme"></i></span>
                        <span class="menu-text">Store Expenditure</span>
                    </a>
                </div>

                <div
                    class="menu-item has-sub {{ Request::is('order/orders') ? 'active' : '' }} {{ Request::is('orderPaid/order_paids') ? 'active' : '' }} {{ Request::is('orderPending/order_pendings') ? 'active' : '' }}">
                    <a href="#" class="menu-link ">
                        <span class="menu-icon">
                            <i class="fa fa-calendar-alt text-theme"></i>
                        </span>
                        <span class="menu-text">Report Orders</span>
                        <span class="menu-caret"><b class="caret"></b></span>
                    </a>
                    <div class="menu-submenu">
                        <div class="menu-item {{ Request::is('order/orders') ? 'active' : '' }}">
                            <a href="/order/orders" class="menu-link">
                                <span class="menu-icon"><i class="fa fa-calendar-alt text-theme"></i></span>
                                <span class="menu-text">Retail</span>
                            </a>
                        </div>
                        <div class="menu-item {{ Request::is('orderPaid/order_paids') ? 'active' : '' }}">
                            <a href="/orderPaid/order_paids" class="menu-link">
                                <span class="menu-icon"><i class="fa fa-calendar-check text-theme"></i></span>
                                <span class="menu-text">Reseller Paid</span>
                            </a>
                        </div>
                        <div class="menu-item {{ Request::is('orderPending/order_pendings') ? 'active' : '' }}">
                            <a href="/orderPending/order_pendings" class="menu-link">
                                <span class="menu-icon"><i class="fa fa-calendar-times text-theme"></i></span>
                                <span class="menu-text">Reseller Pending</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="menu-divider"></div>
                <div class="menu-header">Settings</div>
                <div class="menu-item {{ Request::is('setting/setting') ? 'active' : '' }}">
                    <a href="/setting/setting" class="menu-link">
                        <span class="menu-icon"><i class="bi bi-gear text-theme"></i></span>
                        <span class="menu-text">Settings</span>
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
