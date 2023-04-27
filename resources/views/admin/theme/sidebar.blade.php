    <nav id="sidebar">
        <div class="p-4 pt-5">
        <a href="#" class="img logo rounded-circle mb-5" style="background-image: url({{asset('admin/images/logo.jpg')}});"></a>
        <ul class="list-unstyled components mb-5">
            <li class="active">
            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
            Quản lý tài khoản
            </a>
      <ul class="collapse list-unstyled" id="homeSubmenu">
            <li>
                <a href="{{route('user.index')}}">Tài khoản của tôi</a>
            </li>
            <li>
                <a href="#">Tất cả tài khoản</a>
            </li>
            </ul>
            </li>
            
            <li>
            <a href="#product" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
            Quản lý sản phẩm
            </a>
            <ul class="collapse list-unstyled" id="product">
                <li>
                    <a href="{{route('category.index')}}">Danh mục sản phẩm</a>
                </li>
                <li>
                    <a href="{{route('product.index')}}">Sản phẩm</a>
                </li>
            </ul>
           
            </li>

            <li>
            <a>Portfolio</a>
            </li>
            <li>
            <a>Contact</a>
            </li>
         </ul>

    <div class="footer">
        <p>WEBPJ</p>
    </div>

    </div>
</nav>