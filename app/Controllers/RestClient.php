<?php

namespace App\Controllers;

class RestClient extends BaseController
{
    public function index()
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
          CURLOPT_URL => "https://map.bpkp.go.id/v2/auth/client/encrypt",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "{\"parameter\": \"{{PERSONAL_ACCESS_TOKEN}}\"}",
          CURLOPT_HTTPHEADER => [
            "Authorization: Bearer {{CLIENT_TOKEN}}",
            "Content-Type: application/json"
          ],
        ]);
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        $data = json_encode($response);
        
        curl_close($curl);
        
        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          echo($data);
        }

        // $client = \Config\Services::curlrequest();
        // $token = "";
        // $url = "https://map.bpkp.go.id/api/v2/kinerja/penugasan?api_token=${token}";
        // $headers = [
        //     'Authorization' => 'Bearer' . $token
        // ];

        // $response = $client->request('GET', $url, ['headers' => $headers]);
        // print_r($response);
    }

}
