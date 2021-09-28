<?php 

require_once '../../config.php';
require_once '../../vendor/autoload.php';

$question = isset($_POST['question']) ?  trim($_POST['question']) : null ;
$answer   = isset($_POST['answer'])   ?  trim($_POST['answer'])   : null ;
$yesno    = isset($_POST['yesno'])    ?  trim($_POST['yesno'])    : null ;

if( $question != null 
    && $answer != null
    && $yesno != null ) {

    try { 
        $dbh = new PDO("mysql:dbname=".DB_BASE.";host=".DB_HOST, BD_USER, BD_PASSWORD);
    } catch ( PDOException $e ) { }

    $query = 'SELECT * FROM `yesno` WHERE `question` = :question;';
    $st = $dbh->prepare($query);
    $st->execute(array(':question' => $question));
    $rep = $st->fetch();
    $id = $rep['id'];

    if(empty($id)) {

        $yes = $no = 0;
        if(intval($yesno) == 0) {
            $yes = 1;
        } else if(intval($yesno) == 1) {
            $no = 1;
        }

        $query = 'INSERT INTO `yesno` (`question`, `answer`, `yes`, `no`) VALUES (:question, :answer, :yes, :no);';
		$st = $dbh->prepare($query);
		$st->execute(array(
			':question' => $question,
			':answer' => $answer,
			':yes' => $yes,
			':no' => $no,
		));

    } else {
        
        $yes = intval($rep['yes']);
        $no = intval($rep['no']);
        if(intval($yesno) == 0) {
            $yes += 1;
        } else if(intval($yesno) == 1) {
            $no += 1;
        }

        $query = 'UPDATE yesno SET yes=?, no=? WHERE id=?';
        $st = $dbh->prepare($query);
        $st->execute([$yes, $no, $id]);

    }

}
