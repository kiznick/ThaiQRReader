# ThaiQRReader
valid and parse data follow Thai Qr Standard

[![Creative Commons License](https://i.creativecommons.org/l/by-sa/4.0/88x31.png)](http://creativecommons.org/licenses/by-sa/4.0/)  
This work is licensed under a [Creative Commons Attribution-ShareAlike 4.0 International License](http://creativecommons.org/licenses/by-sa/4.0/).

## Get Start
```php
<?php
    use kiznick\ThaiQRReader;
    
    require_once __DIR__.'/ThaiQRReader.class.php';
    
    $kiznick = new ThaiQRReader();
```

## Example
```php
<?php
    use kiznick\ThaiQRReader;
    
    require_once __DIR__.'/ThaiQRReader.class.php';
    
    $kiznick = new ThaiQRReader();

    var_dump($kiznick->is_valid_qrcode('00020101021129370016A000000677010111011300660000000005802TH530376463048956')); // return true or false

    var_dump($kiznick->get_qrdata('00020101021129370016A000000677010111011300660000000005802TH530376463048956', true)); // return array or false (check sum)

    var_dump($kiznick->get_qrdata('00020101021129370016A000000677010111011300660000000005802TH5303764', false)); // return array or false (not check sum)
```

## Document
### is_valid_qrcode(data)
is_valid_qrcode use function get_qrdata and always checksum.
Arguments
 - data: data in qrcode
Return
 - boolean (true, false)

### get_qrdata(data[, checksum])
read data follow thai qr standard and return false is not follow standard.
Arguments
 - data: data in qrcode
 - checksum: boolean (default: false)
Return
 - false (error)
 - array

### Array Example
```php
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
 ```