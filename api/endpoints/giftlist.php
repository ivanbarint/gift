<?php

    session_start();

    include "../components/navbar.php";

    $keyword = $_POST['interest'];
    
    $curl = curl_init();

    $certificate_location = "C:\Program Files\Git\mingw64\ssl\certs\ca-bundle.crt";
    curl_setopt($ch, CURLOPT_CAINFO, $certificate_location);
    curl_setopt($ch, CURLOPT_CAPATH, $certificate_location);

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://amazon24.p.rapidapi.com/api/product?categoryID=aps&keyword=". $keyword ."&country=US&page=1",
        CURLOPT_CAINFO => $certificate_location,
        CURLOPT_CAPATH => $certificate_location,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "X-RapidAPI-Host: amazon24.p.rapidapi.com",
            "X-RapidAPI-Key: 18a2bb99e5msh9578e5c02a2d60bp140050jsn3e76e52955c9"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {

        // Article Titles

        $partsfortitles = explode('"product_title":', $response);

        $article_titles = [];
        
        foreach ($partsfortitles as $part) {
            $particles = explode(',', $part);
            $article_titles[] = str_replace('"', '', $particles[0]);
        }

        array_shift($article_titles);

        // Article Ratings

        $partsforratings = explode('"evaluate_rate":', $response);

        $ratings = [];
        $article_ratings = [];

        foreach($partsforratings as $part) {
            $particles = explode(' ', $part);
            $ratings[] = str_replace('"', '', $particles[0]);
        }

        foreach($ratings as $rating) {
            if ($rating[0] == "n") {
                $article_ratings[] = "Unknown";
            }
            else {
                $article_ratings[] = $rating;
            }
        }

        array_shift($article_ratings);

        // Article URLs

        $partsforurls = explode('"product_detail_url":', $response);

        $article_urls = [];

        foreach($partsforurls as $part) {
            $particles = explode(',', $part);
            $article_urls[] = str_replace('"', '', $particles[0]);
        }

        array_shift($article_urls);

        // Article Images

        $partsforimages = explode('"product_main_image_url":', $response);

        $article_images = [];

        foreach($partsforimages as $part) {
            $particles = explode(',', $part);
            $article_images[] = str_replace('"', '', $particles[0]);
        }

        array_shift($article_images);

        for($i = 0; $i < 10; $i++) {
            echo "<div class='gift-container'>";
            echo "<div class='article'>";
            echo "Article:";
            echo "<br>";
            echo "<img src='" . $article_images[$i] . "' . alt=" . $article_titles[$i] . ">";
            echo "<br>";
            echo $article_titles[$i];
            echo "<br>";
            echo "Rating: " . $article_ratings[$i] . "/5.0";
            echo "<br>";
            echo "Check article: <a href='" . $article_urls[$i] . "'>" . $article_urls[$i] . "</a>";
            echo "<br>";
            echo "<br>";
            echo "</div>";
            echo "</div>";
        }

    }

    echo "<a href='../../calendar.php'>Go back</a>";

?>