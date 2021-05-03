<?php
    if ( isset($_GET['searchLatitude']) && !empty($_GET['searchLatitude']) && isset($_GET['searchLongitude']) && !empty($_GET['searchLongitude']) ) {
        // 1. Create $data
        $data = array(
            "term" => $_GET["searchTerm"],
            "latitude" => $_GET['searchLatitude'],
            "longitude" => $_GET['searchLongitude']
        );
        if ( isset($_GET["searchBy"]) && !empty($_GET["searchBy"]) ) {
            $data["sort_by"] = $_GET["searchBy"];
        }

        // 2. Determine URL
        $full_url = "https://api.yelp.com/v3/businesses/search?" . http_build_query($data);

        // 3. Make Request
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $full_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' 
                . "-yUZz3zLYk9VTAR9McffsbpMlZRM3cyu5dT8n9hDteuEovOELLXeA5H1DT2NxDzdsb_BqqnyvY5m12Qk_YOW4GiXqFAmjqKBcidh0-qU7u3_qSLAZd7BDyeUcxl8XnYx" //API Key from Yelp
            ),
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false 
        ));

        // 4. Parse Response
        $response = curl_exec($curl);
        $response = json_decode($response, true);

        // 5. Filter Response (only get what you need)
        $filteredResponse = array();
        foreach($response["businesses"] as $business) {
            $categories = array();
            foreach($business["categories"] as $category) {
                $categories[] = $category["title"];
            }

            $price = "";
            if(isset($business["price"])) {
                $price = $business["price"];
            }

            $businessInfo = array(
                "name" => $business["name"],
                "rating" => $business["rating"],
                "price" => $price,
                "phone" => $business["phone"],
                "image_url" => $business["image_url"],
                "url" => $business["url"],
                "cuisine" => implode(", ", $categories),
                "address" => $business["location"]
            );
        
            $filteredResponse[] = $businessInfo;
        }
        
        // If you set this, response will be sent already formatted as JSON
        header('Content-Type: application/json');
        echo json_encode($filteredResponse);
    }
?>