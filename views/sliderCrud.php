<?php
    include "connection.php";

    if(isset($_POST['idDelete'])){
        $id_slider = $_POST['idDelete'];

        $querry = "DELETE FROM slider where id_slider = :id_slider";
        $statement = $connection -> prepare($querry);
        $statement -> bindParam(":id_slider", $id_slider);


        $result = $statement->execute() ? 201 : 500;

        //var_dump($result);

        if($result){
            http_response_code($result);
            header('Content-Type: application/json');
            echo json_encode(['message'=>"Slider item deleted"]);
        }
        else{
			echo "Slider item not found in database";
		}
    }
    else if(isset($_POST['slider_pic_btn'])){

        
        //picture
        $tmp = $_FILES['slider_pic_nm']['tmp_name'];
        
        $pathPicture = '../pictures/slider/';
        $fileName = $_FILES['slider_pic_nm']['name'];
        $timeName = time().$fileName;
        $path = $pathPicture.$timeName;
        $res = move_uploaded_file($tmp, $path);
        
        //ALT
        $arrAlt = explode(".", $fileName);
        $num = count($arrAlt)-1;
        //echo $arrAlt[2];
        //echo $num;

        $alt="";
        for($i=0; $i<$num; $i++){
            $alt.=$arrAlt[$i]." ";
        }
        //var_dump($alt);
        
        
        //regex
        $regPic = "/^.*\.(jpg|jpeg|png)$/";
        


        $errBack = [];
        if(!preg_match($regPic, $fileName)){
            $errBack[] = "Invalid picture format!";
        }

    //If there are no errors, entering in the database
    if(count($errBack) > 0){
        echo "Invalid entry";
    }
    else{
        $querry = "INSERT INTO slider VALUES(null, :href, :alt)";
        $statement = $connection -> prepare($querry);
        $statement -> bindParam(":href", $timeName);
        $statement -> bindParam(":alt", $alt);
    
        $result = $statement->execute() ? 201 : 500;
    
        //var_dump($result);
    
        if($result){
            header("Location: /PHP1/BabyRoller/admin.php");
        }
        
        
        
    }
    
    }
?>