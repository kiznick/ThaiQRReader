<?php
    namespace kiznick;
    
    class ThaiQRReader {
        private $remain = '';
        
        public function is_valid_qrcode($data) {
            return $this->get_qrdata($data, true) === false ? false : true;
        }
        
        public function get_qrdata($data, $checksum = false) {
            if(empty($data) || strlen($data) < 22) {
                return false;
            }

            if($checksum && (substr($data, -4) != strtoupper(dechex($this->crc16(substr($data, 0, -4)))))) {
                return false;
            }
    
            $this->remain = $data;
            $res = [];

            while($this->remain != '') {
                $field_name = $this->get_and_remove(2);
                if(!is_numeric($field_name)) {
                    return false;
                }

                $field_length = $this->get_and_remove(2);
                if(!is_numeric($field_length)) {
                    return false;
                }

                if($field_length == 0) {
                    return false;
                }

                if(strlen($this->remain) == $field_length) {
                    $field_value = $this->remain;
                    $this->remain = '';
                } else {
                    $field_value = $this->get_and_remove($field_length);
                }

                if($field_length != strlen($field_value)) {
                    return false;
                }
                
                $res[$field_name] = [
                    'length' => $field_length,
                    'value' => $field_value
                ];
            }

            return $res;
        }
        
        private function get_and_remove($length) {
            $data = substr($this->remain, 0, $length); // Get first n characters
            $this->remain = substr($this->remain, $length); // Remove first n characters
            return $data;
        }
        
        // https://stackoverflow.com/questions/14018508/how-to-calculate-crc16-in-php
        private function crc16($data) {
            $crc = 0xFFFF;
            for ($i = 0; $i < strlen($data); $i++) {
                $x = (($crc >> 8) ^ ord($data[$i])) & 0xFF;
                $x ^= $x >> 4;
                $crc = (($crc << 8) ^ ($x << 12) ^ ($x << 5) ^ $x) & 0xFFFF;
            }
            return $crc;
        }
    }
?>