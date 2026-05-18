<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background: #f5f6fa;
    margin: 0;
    padding: 0;
}

.container {
    width: 90%;
    margin: 40px auto;
}

.title {
    text-align: center;
    margin-bottom: 30px;
}

.profiles-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 20px;
}

.profile-card {
    background: #fff;
    border-radius: 12px;
    padding: 20px;
    text-align: center;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    transition: 0.3s;
}

.profile-card:hover {
    transform: translateY(-5px);
}

.profile-card img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
    margin-bottom: 15px;
}

.profile-card h3 {
    margin: 10px 0 5px;
}

.profile-card p {
    color: #777;
    font-size: 14px;
}

/* Pagination */
.pagination {
    margin-top: 30px;
    text-align: center;
}

.pagination a {
    display: inline-block;
    margin: 0 5px;
    padding: 8px 14px;
    background: #fff;
    border-radius: 6px;
    text-decoration: none;
    color: #333;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    transition: 0.3s;
}

.pagination a:hover {
    background: #3490dc;
    color: #fff;
}

.pagination .active {
    background: #3490dc;
    color: #fff;
}
    </style>
</head>
<body>
    <div class="container">
    <h1 class="title">User Profiles</h1>

    <div class="profiles-grid">
        <!-- Profile Card -->
        <div class="profile-card">
         @foreach ($products as $product)
                
         <img src="https://via.placeholder.com/150" alt="Profile">
         <h3>{{$product->name}}</h3>
         <p>{{$product->price}}</p>
            @endforeach
        </div>

        <!-- كرر حسب البيانات -->
    </div>

    <!-- Pagination -->
    <div class="pagination">
        <a href="#">Prev</a>
        <a href="#" class="active">1</a>
        <a href="#">2</a>
        <a href="#">3</a>
        <a href="#">Next</a>
    </div>
</div>
</body>
</html>