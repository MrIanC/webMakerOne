<?php

if (isset($_POST['saying']) && !empty($_POST['saying'])) {
    $apikeyfile = __DIR__ . "/settings.php";;
    if (file_exists($apikeyfile)) {
        $apiKey = json_decode(str_replace("<?php","",file_get_contents($apikeyfile)), true)['apiKey'];
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent?key=" . $apiKey;

        $data = [
            "contents" => [
                [
                    "parts" => [
                        [
                            "text" => "Generate a paragraph with regards to '{$_POST['saying']}'. The output format should be <div class=\"alt_saying\">Alturnate Saying</div>div>"
                        ],
                    ]
                ]
            ]
        ];

        $options = [
            "http" => [
                "header" => "Content-Type: application/json\r\n",
                "method" => "POST",
                "content" => json_encode($data)
            ]
        ];

        $context = stream_context_create($options);
        $response = file_get_contents($url, false, $context);

        if ($response === FALSE) {
            die('Error occurred');
        }

        file_put_contents(__DIR__ . '/response.json', $response);

        $r = json_decode(file_get_contents(__DIR__ . '/response.json'), true);
        if (isset($r['candidates'][0]['content']['parts'][0]['text'])) {
            echo $r['candidates'][0]['content']['parts'][0]['text'];
        }
    } else {
        echo "<div class=\"alt_saying\">No API Key has been defined</div>";
    }
} else {
    echo "<div class=\"alt_saying\">A problem has. Darn, Its a problem </div>";
}