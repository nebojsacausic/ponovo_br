<?php
    include "views/fixed/head.php";
    include "views/fixed/header.php";
?>

<!-- Register page content -->

		<?php
			if(isset($_SESSION['users'])){
				if($_SESSION['users']->role_id == 2){
        ?>




				<!-- Breadcrumbs -->
				<div class="breadcrumbs">
					<div class="container">
						<div class="row">
							<div class="col-12">
								<div class="bread-inner">
									<ul class="bread-list">
										<li><a href="index1.html">Home<i class="ti-arrow-right"></i></a></li>
										<li class="active"><a href="blog-single.html">registration</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- End Breadcrumbs -->
						
				<!-- Start registration -->
				<section class="shop registration section">
					<div class="container">
						<div class="row"> 
							<div class="col-lg-8 col-12">
								<div id="message_cont">
									<div class="message_area">



                                        <?php

                                            $userId = $_SESSION['users']->user_id;

                                            $questionnaire_query = "SELECT * FROM questionnaire where active = 1"; //WHERE aktivna = 1
                                            $statement = $connection->query($questionnaire_query);
                                            $resultQuestion = $statement->fetch();
                                            $id_question = $resultQuestion->id_questionnaire;

                                            $if_questionnaire_done = "SELECT users.user_id 
                                            FROM user_response 
                                                    INNER JOIN users ON user_response.user_id = users.user_id
                                                    INNER JOIN response ON user_response.response_id = response.id_response 
                                                    INNER JOIN questionnaire ON response.questionnaire_id = questionnaire.id_questionnaire
                                                    WHERE users.user_id = $userId AND questionnaire.id_questionnaire = $resultQuestion->id_questionnaire";
                                            $statment = $connection->query($if_questionnaire_done);
                                            $is_vote = $statment->fetch();

                                            if(!$is_vote){
                                                $answer_query = "SELECT * FROM response where questionnaire_id = ?"; //WHERE aktivna = 1
                                                $prepare = $connection->prepare($answer_query);
                                                $prepare->bindParam(1, $id_question);
                                                $result = $prepare->execute();
                                                $resAnswers = $prepare->fetchAll();

                                                //var_dump($resAnswers);

                                                //var_dump($result->question);
                                                $content = '<div id="questionnaire-area">
                                                                <form action="views/questionnaireCrud.php" method="POST">
                                                                    <h3>'.$resultQuestion->question.'</h3>';
                                                foreach($resAnswers as $key => $red){
                                                    if($key == 0){
                                                        $content.='<div class="answers">
                                                                    <input type="radio" checked value="'.$red->id_response.'" name="questionnaire_answer" > '.$red->response.'
                                                                </div>';
                                                    }
                                                    else{
                                                        $content.='<div class="answers">
                                                                    <input type="radio" value="'.$red->id_response.'" name="questionnaire_answer" > '.$red->response.'
                                                                </div>';
                                                    }
                                                }
                                                $content.='
                                                                    <input type="submit" name="questionnaire_submit" id="questionnaire_submit">
                                                                </form>
                                                            </div>';
                                                echo $content;
                                            }

                                            else{
                                                $voting_result = "SELECT questionnaire.question, response.response, COUNT(response) as answers 
                                                                    FROM user_response 
                                                                        INNER JOIN response on user_response.response_id = response.id_response 
                                                                        INNER JOIN questionnaire ON response.questionnaire_id = questionnaire.id_questionnaire 
                                                                        WHERE questionnaire.id_questionnaire = $id_question
                                                                    GROUP BY response";
                                                $statment = $connection->query($voting_result);
                                                $questionnaire_ressult = $statment->fetchAll();
                                                //var_dump($questionnaire_ressult);

                                                $cont_result = "<h3>".$resultQuestion->question."</h2>
                                                                <h6>You have already answered on this question</h6>
                                                                <table>
                                                                        <tr>
                                                                            <th>Answer</th>
                                                                            <th>Votes</th>
                                                                        </tr>";
                                                foreach ($questionnaire_ressult as $res) {
                                                    $cont_result .= "
                                                                        <tr>
                                                                            <td>".$res->response."</td>
                                                                            <td>".$res->answers."</td>
                                                                        </tr>";
                                                }
                                                $cont_result.= "</table>";


                                                echo $cont_result;
                                            }


                                        ?>  

									</div>
								</div>
							</div>
						</div>
					</div>
				</section>

				<?php
				}
				else{
					echo '<!DOCTYPE html>
							<html lang="en">
							<head>
								<meta charset="UTF-8">
								<meta name="viewport" content="width=device-width, initial-scale=1.0">
								<title>Document</title>
							</head>
								<body>
							
									<div class="container">
										<div class="row">
											<div class="message_contact">
												<h2>This page is only for users.</h2>
											</div>
										</div>
									</div>
							
									
								</body>
							</html>';
				}
			}
			else{
				echo '<!DOCTYPE html>
						<html lang="en">
						<head>
							<meta charset="UTF-8">
							<meta name="viewport" content="width=device-width, initial-scale=1.0">
							<title>Document</title>
						</head>
							<body>
						
								<div class="container">
									<div class="row">
										<div class="message_contact">
											<h2>Please login to send message.</h2>
										</div>
									</div>
								</div>
						
								
							</body>
						</html>';
			}
		?>

		
	



<?php
    include "views/fixed/footer.php";
?>