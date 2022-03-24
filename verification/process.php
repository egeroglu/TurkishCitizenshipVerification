<?php
    // It is a saop api
    if(isset($_GET['submit'])){
        // creating client via this link https://tckimlik.nvi.gov.tr/Service/KPSPublic.asmx?WSDL
        $client = new SoapClient("https://tckimlik.nvi.gov.tr/Service/KPSPublic.asmx?WSDL");

        // taking datas from frontend
        $firstName = $_GET['firstName']; 
        $lastName = $_GET['lastName'];   
        $id = $_GET['id']; 
        $birthYear = $_GET['birthYear'];
        
        //creating data to post
        $postData = array(
            "TCKimlikNo" => $id,// number (long)
            // $id must consist of numbers and its length is 11
            "Ad" => $firstName,  // Name should be capital letters
            "Soyad" => $lastName, // Surname should be capital letters
            "DogumYili" => $birthYear // (4) four digit number
        );
        // TCKimlikNoDogrula sends our data to the api
        // result variable is the answer from api 
        // and its a boolean variable
        $result = $client->TCKimlikNoDogrula($postData);
        try {
            if($result->TCKimlikNoDogrulaResult){
                echo "<script>alert('Kimlik Doğrulandı');</script>";
            }else{
                echo "<script>alert('Böyle bir kişi yok!!!');</script>";
            }
    
        } catch (Expection $e) {
            echo $e->getMessage();
        }
    }
?>


