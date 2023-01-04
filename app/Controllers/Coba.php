<?php

namespace App\Controllers;

class Coba extends BaseController
{
    public function index(){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://script.googleusercontent.com/macros/echo?user_content_key=ZK-bzJ3N4u5JMPypWCv-drZYZdjU2Q9BRtOKtvWtyqAKWlq8KbCedNRNkNtBMj8dgjWO_8pG_ZcwoP8Bxwo8KyNjTa7Po0SEm5_BxDlH2jW0nuo2oDemN9CCS2h10ox_1xSncGQajx_ryfhECjZEnFUiaXIcCKpGp1pu3a5DtQOxUjiqEtGW1I4KIxw2KE0UqHzZCrw8n99Z_xYvnyYEJOY0MFkb0ILrxb-DOhl_Qc9DbX1nMxRQaQ&lib=MTmlr5VLM9l5t8PAOGkxIShmYa9l_pTPD");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $output = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($output);
        print_r($output);

    }

    

}
