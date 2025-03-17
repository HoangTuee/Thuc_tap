@extends('master')

@section('main')

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách Laptop</title>
    <link rel="stylesheet" href="{{ asset('laptop_new.css') }}">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li>Thương hiệu</li>
                <li>Giá</li>
                <li>CPU</li>
                <li>Card VGA</li>
                <li>RAM</li>
                <li>Ổ cứng</li>
                <li>Màn hình</li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="filter">
            <label for="sort">Sắp xếp theo</label>
            <select id="sort">
                <option value="newest">Mới nhất</option>
                <option value="newest">Mới nhất</option>
                <option value="newest">Mới nhất</option>
                <option value="newest">Mới nhất</option>
                <option value="newest">Mới nhất</option>
            </select>
        </div>
        <div class="product-list">
            <div class="product">
                <span class="discount">-32%</span>
                <a href="./chi_tiet_sp.html"><img src="../img/acces.jpg" alt="Laptop 1"></a>
                <p>[Like New] Dell Latitude 7400 (Core i7-8665U, 16GB, 256GB, VGA Intel UHD Graphics 620, 14.0 FHD IPS)</p>
                <p class="price"><span class="new-price">8.190.000</span> <span class="old-price">11.990.000</span></p>
            </div>
            <div class="product">
                <span class="discount">-32%</span>
                <a href="./chi_tiet_sp.html"><img src="../img/acces.jpg" alt="Laptop 1"></a>
                <p>[Like New] Dell Latitude 7400 (Core i7-8665U, 16GB, 256GB, VGA Intel UHD Graphics 620, 14.0 FHD IPS)</p>
                <p class="price"><span class="new-price">8.190.000</span> <span class="old-price">11.990.000</span></p>
            </div>
            <div class="product">
                <span class="discount">-32%</span>
                <a href="./chi_tiet_sp.html"><img src="../img/acces.jpg" alt="Laptop 1"></a>
                <p>[Like New] Dell Latitude 7400 (Core i7-8665U, 16GB, 256GB, VGA Intel UHD Graphics 620, 14.0 FHD IPS)</p>
                <p class="price"><span class="new-price">8.190.000</span> <span class="old-price">11.990.000</span></p>
            </div>
            <div class="product">
                <span class="discount">-32%</span>
                <a href="./chi_tiet_sp.html"><img src="../img/acces.jpg" alt="Laptop 1"></a>
                <p>[Like New] Dell Latitude 7400 (Core i7-8665U, 16GB, 256GB, VGA Intel UHD Graphics 620, 14.0 FHD IPS)</p>
                <p class="price"><span class="new-price">8.190.000</span> <span class="old-price">11.990.000</span></p>
            </div>
            <div class="product">
                <span class="discount">-32%</span>
                <a href="./chi_tiet_sp.html"><img src="../img/acces.jpg" alt="Laptop 1"></a>
                <p>[Like New] Dell Latitude 7400 (Core i7-8665U, 16GB, 256GB, VGA Intel UHD Graphics 620, 14.0 FHD IPS)</p>
                <p class="price"><span class="new-price">8.190.000</span> <span class="old-price">11.990.000</span></p>
            </div>
            <div class="product">
                <span class="discount">-32%</span>
                <a href="./chi_tiet_sp.html"><img src="../img/acces.jpg" alt="Laptop 1"></a>
                <p>[Like New] Dell Latitude 7400 (Core i7-8665U, 16GB, 256GB, VGA Intel UHD Graphics 620, 14.0 FHD IPS)</p>
                <p class="price"><span class="new-price">8.190.000</span> <span class="old-price">11.990.000</span></p>
            </div>
        </div>
    </main>
    <script src="script.js"></script>
</body>
</html>

@stop()
