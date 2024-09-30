<?php
$menu['media'] = [
    "sequence"=>1,
    "link" => "?pluginpage=media",
    "title" => '<i class="display-5 bi bi-image"></i><div>Media</div>',
    "description" => "Upload Pictures, Videos, Audio for your project",
    "page" => "mediaPage",
];
function mediaPage()
{
    include __DIR__ . "/page.php";
}