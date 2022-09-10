<?php
    use kiznick\ThaiQRReader;
    
    require_once __DIR__.'/ThaiQRReader.class.php';
    
    $kiznick = new ThaiQRReader();

    var_dump($kiznick->is_valid_qrcode('00020101021129370016A000000677010111011300660000000005802TH530376463048956')); // return true or false

    var_dump($kiznick->get_qrdata('00020101021129370016A000000677010111011300660000000005802TH530376463048956', true)); // return array or false (check sum)

    var_dump($kiznick->get_qrdata('00020101021129370016A000000677010111011300660000000005802TH5303764', false)); // return array or false (not check sum)

    /*

    Sample array:

    [
        "field_id" => [
            "length" => field_length,
            "value" => field_value
        ],
        "01" => [
            "length" => 7,
            "value" => "kiznick"
        ]
    ]

    */
?>