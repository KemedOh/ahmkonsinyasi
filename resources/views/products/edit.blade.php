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
                    <div class="card col-lg-4 mx-auto">
                        <div class="card-body px-5 py-5">
                            <h3 class="card-title text-left mb-3">Edit Product</h3>
                            <form action="{{ route('products.update', $user->id) }} " method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Product Name</label>
                                    <input type="text" class="form-control p_input" name="product_name">
                                    @if ($errors->has('product_name'))
                                        <span class="text-danger">{{ $errors->first('product_name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Selling Price</label>
                                    <input type="text" class="form-control p_input" name="selling_price">
                                    @if ($errors->has('selling_price'))
                                        <span class="text-danger">{{ $errors->first('selling_price') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Buying Price</label>
                                    <input type="text" class="form-control p_input" name="buying_price">
                                    @if ($errors->has('buying_price'))
                                        <span class="text-danger">{{ $errors->first('buying_price') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Qty</label>
                                    <input type="text" class="form-control p_input" name="qty">
                                    @if ($errors->has('qty'))
                                        <span class="text-danger">{{ $errors->first('qty') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <select class="form-select p_input" id="product_type" name="product_type"
                                        aria-label="product_type">
                                        <option value="">Choose</option>
                                        @foreach($product_types as $val)
                                            <option value="{{$val->id}}">{{$val->product_type_name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('product_type'))
                                        <span class="text-danger">{{ $errors->first('product_type') }}</span>
                                    @endif
                                </div>
                                <div class="form-group d-flex align-items-center justify-content-between">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input"> Remember me </label>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-block enter-btn">Submit</button>
                                </div>
                                <p class="sign-up text-center">Already have an Account?<a href="login"> Sign In</a></p>
                                <p class="terms">By creating an account you are accepting our<a href="#"> Terms &
                                        Conditions</a></p>
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