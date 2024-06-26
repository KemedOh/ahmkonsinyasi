<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Corona Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('/assets/images/favicon.png') }}" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="row w-100 m-0">
                <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
                    <div class="card col-lg-7 mx-auto">
                        <div class="card-body px-5 py-5">
                            <h3 class="card-title text-left mb-3">Create Selling</h3>
                            <form action="{{ route('sellings.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Code Trans:</strong>
                                            <input type="text" name="code_trans" class="form-control"
                                                placeholder="No TRX">
                                            @error('code_trans')
                                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Date Sell :</strong>
                                            <input type="date" name="date_sell" class="form-control"
                                                placeholder="Date Sell">
                                            @error('date_sell')
                                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Customer:</strong>
                                            <select name="customer_id" id="customer_id" class="form-select">
                                                <option value="">Pilih</option>
                                                @foreach($customers as $item)
                                                    <option value="{{ $item->id }}">{{ $item->customer_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('customer_id')
                                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Sales :</strong>
                                            <select name="cashier_id" id="cashier_id" class="form-select">
                                                <option value="">Pilih</option>
                                                @foreach($sales as $item)
                                                    <option value="{{ $item->id }}" {{ Auth()->user()->id == $item->id ? 'selected' : ''}}>
                                                        {{ $item->fullname }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('cashier_id')
                                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row col-xs-12 col-sm-12 col-md-12 mt-3">
                                        <div class="col-md-10 form-group">
                                            <input type="text" name="search" id="search" class="form-control"
                                                placeholder="Masukan Nama / Kode Product">
                                            @error('name')
                                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-2 form-group text-center">
                                            <button class="btn btn-secondary" type="button" name="btnAdd" id="btnAdd"><i
                                                    class="fa fa-plus"></i>Tambah</button>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
                                        <table id="example" class="table table-striped" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Nama</th>
                                                    <th scope="col">Harga</th>
                                                    <th scope="col">QTY</th>
                                                    <th scope="col">Sub Total</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="detail">

                                            </tbody>
                                        </table>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <input type="text" name="jml" class="form-control">
                                            <div class="form-group">
                                                <strong>Grand Total:</strong>
                                                <input type="text" name="grand_total" class="form-control"
                                                    placeholder="Rp. 0">
                                                @error('grand_total')
                                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-3 ml-3">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
            </div>
            <!-- row ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script type="text/javascript">
        var path = "{{ url('api/products') }}";

        $("#search").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: path,
                    type: 'GET',
                    dataType: "json",
                    data: {
                        search: request.term,
                        list: true
                    },
                    success: function (result) {
                        response(result);
                        console.log(result);

                    }
                });
            },
            select: function (event, ui) {
                $('#search').val(ui.item.label);
                if ($("input[name=jml]").val() > 0) {
                    for (let i = 1; i <= $("input[name=jml]").val(); i++) {
                        id = $("input[name=id_product" + i + "]").val();
                        if (id == ui.item.id) {
                            alert(ui.item.value + ' sudah ada!');
                            break;
                        } else {
                            add(ui.item.id);
                        }
                    }
                } else {
                    add(ui.item.id);
                }
                return false;
            }
        });

        function add(id) {
            const path = "{{ url('api/products') }}/" + id;
            var html = "";
            var no = 0;
            if ($('#detail tr').length > no) {
                html = $('#detail').html();
                no = no + $('#detail tr').length;
            }
            $.ajax({
                url: path,
                type: 'GET',
                dataType: "json",
                success: function (data) {
                    console.log(data.qty);
                    if (data.qty <= 0) {
                        alert('Maaf ' + data.product_name + ' kosong');
                        return false;
                    }

                    no++;
                    html += '<tr>' +
                        '<td>' + no + '<input type="hidden" name="id_product' + no + '" class="form-control" value="' + data.id + '"></td>' +
                        '<td><input type="text" name="product_name' + no + '" class="form-control" value="' + data.product_name + '"></td>' +
                        '<td><input type="text" name="price' + no + '" class="form-control" value="' + data.selling_price + '"></td>' +
                        '<td><input type="text" name="qty' + no + '" class="form-control" oninput="sumQty(' + no + ', this.value)" value="1"></td>' +
                        '<td><input type="text" name="sub_total' + no + '" class="form-control"></td>' +
                        '<td><button type="button" class="btn btn-sm btn-danger" id="deleteDetail">X</button></td>' +
                        '</tr>';
                    $('#detail').html(html);
                    $("input[name=jml]").val(no);
                    sumQty(no, 1);
                }
            });
        }

        function sumQty(no, q) {
            var price = $("input[name=price" + no + "]").val();
            var subtotal = q * parseInt(price);
            $("input[name=sub_total" + no + "]").val(subtotal);
            console.log(q + "*" + price + "=" + subtotal);
            sumTotal();
        }

        function sumTotal() {
            var total = 0;
            for (let i = 1; i <= $("input[name=jml]").val(); i++) {
                var sub = $("input[name=sub_total" + i + "]").val();
                total = total + parseInt(sub);
            }
            $("input[name=grand_total]").val(total);
        }

        $(document).ready(function () {
            $('#detail').on('click', 'button.btn', function () {
                let row = $(this).closest('tr');
                row.remove();
            });

        });
    </script>
    <script src="{{ asset('/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('/assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('/assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('/assets/js/misc.js') }}"></script>
    <script src="{{ asset('/assets/js/settings.js') }}"></script>
    <script src="{{ asset('/assets/js/todolist.js') }}"></script>
    <!-- endinject -->
</body>

</html>