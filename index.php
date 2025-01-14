<?php
$status = "";
$msg = "";
$city = "";

if (isset($_POST['submit'])) {
    $city = $_POST['city'];
    $url = "http://api.openweathermap.org/data/2.5/weather?q=$city&appid=49c0bad2c7458f1c76bec9654081a661";
    $result = file_get_contents($url);
    $result = json_decode($result, true);

    if ($result['cod'] == 200) {
        $status = "yes";
    } else {
        $msg = $result['message'];
    }
}
?>


<html lang="en" class=" -webkit-">

<head>
    <meta charset="UTF-8">
    <title>Weather Card</title>
    <link rel="stylesheet" href="./style.css"/>
</head>

<body>
    <div class="form">
        <form style="width:100%;" method="post">
            <input type="text" class="text" placeholder="Enter city name" name="city" value="<?php echo $city ?>" required />
            <input type="submit" value="Submit" class="submit" name="submit" />
            <?php echo $msg ?>
        </form>
    </div>

    <?php if ($status == "yes") { ?>
        <div class="widget">
            <div class="weatherIcon">
                <img src="http://openweathermap.org/img/wn/<?php echo $result['weather'][0]['icon'] ?>@4x.png" />
            </div>
            <div class="weatherInfo">
                <div class="temperature">
                    <span><?php echo round($result['main']['temp'] - 273.15) ?>°</span>
                </div>
                <div class="description mr45">
                    <div class="weatherCondition"><?php echo $result['weather'][0]['main'] ?></div>
                    <div class="place"><?php echo $result['name'] ?></div>
                </div>
                <div class="description">
                    <div class="weatherCondition">Wind</div>
                    <div class="place"><?php echo $result['wind']['speed'] ?> M/H</div>
                </div>
            </div>
            <div class="date">
                <?php echo date('d M', $result['dt']) ?>
            </div>
        </div>
    <?php } ?>
</body>

</html>