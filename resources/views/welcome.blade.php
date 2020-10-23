<!DOCTYPE html>
<html>
<title>W3.CSS Template</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    body,h1 {font-family: "Raleway", Arial, sans-serif}
    h1 {letter-spacing: 6px}
    .w3-row-padding img {margin-bottom: 12px}
</style>
<body>

<!-- !PAGE CONTENT! -->
<div class="w3-content" style="max-width:1500px">

    <!-- Header -->
    <header class="w3-panel w3-center w3-opacity" style="padding:128px 16px">
        <h1 class="w3-xlarge">LOCALWEB</h1>
        <h1>Lorela Jano</h1>

        <div class="w3-padding-32">
            @if (Route::has('login'))
            <div class="w3-bar w3-border">
                @auth
                <a  href="{{ url('/home') }}" class="w3-bar-item w3-button">Home</a>
                @else
                    <a  href="{{ route('login') }}" class="w3-bar-item w3-button">Login</a>
                    @if (Route::has('register'))
                <a href="{{ route('register') }}" class="w3-bar-item w3-button w3-light-grey">Register</a>
                    @endif
                @endif
            </div>
                @endif
        </div>
    </header>



    <!-- End Page Content -->
</div>

<!-- Footer -->
<footer class="w3-container w3-padding-64 w3-light-grey w3-center w3-large">

    <p>Powered by <a href="https://github.com/lorelajano" target="_blank" class="w3-hover-text-green">Lorela Jano</a></p>
</footer>

</body>
</html>
