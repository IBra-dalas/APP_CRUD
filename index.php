<?php
//variable empeche la redirection du system de connexion
$page_no_redirection = '1';
include ('Views/shared/header.php');

//si la connexion a été établi
if($_SESSION['login'] == TRUE){
    echo"
        <div class='project_foreach flex'>
            <button type='button' class='create' onclick='createProduit();'>Create</button>";
            //requette qui permet de recuperer les tickets lier a l'utilisateur
            $url = "http://localhost/API_CRUD/front/readProduit/";
            $raw = file_get_contents($url);
            $json = json_decode($raw);
            if(!empty($json[0] -> idprod)){
                $nb = 0;
                $nb_json = 0;
                //boucle qui permet l'affichage des tickets
                while ($nb <= 1) {
                    if(!empty($json[$nb_json] -> idprod)){
                        echo"
                            <div id='".$json[$nb_json] -> idprod."' class='bloc_crud'>
                                <text>id : ".$json[$nb_json] -> idprod."</text></br>
                                Titre : <input id='titre_".$json[$nb_json] -> idprod."' type='text' value='".$json[$nb_json] -> titre."'></br>
                                Prix  : <input id='Prix_".$json[$nb_json] -> idprod."' type='text' value='".$json[$nb_json] -> Prix."'></br>
                                <button type='button' class='crud_deleteProduit' onclick='deleteProduit(".$json[$nb_json] -> idprod.");'>deleteProduite</button>
                                </br><button type='button' onclick='updateProduit(".$json[$nb_json] -> idprod.");'>updateProduit</button>
                                </br><text></text></br></br>
                            </div>
                        ";
                        $nb_json = $nb_json  + 1;
                    }else{
                        $nb = 10;
                    }
                }
            }
            echo"
        </div>
    ";
}
?><script src='service/jquery.js'></script>
<script>
    //function pour create
    function createProduit(){
		$.ajax({
		    type:'post',
		    url:'service/ajax api.php',
		    data:'id_api=' + 1,
		    dataType:'json'
		});
        window.location.reload();
	}
    //function pour updateProduit
    function updateProduit(idProduit){
        var Prix = document.getElementById("Prix_"+idProduit).value;
        var titre = document.getElementById("titre_"+idProduit).value;
		$.ajax({
		    type:'post',
		    url:'service/ajax api.php',
		    data:'id_api=' + 2 + '&idProduit=' + idProduit + '&prix=' + Prix + '&titre=' + titre,
		    dataType:'json'
		});
	}
    //function pour deleteProduit
    function deleteProduit(idProduit){
		$.ajax({
		    type:'post',
		    url:'service/ajax api.php',
		    data:'id_api=' + 3 +'&idProduit=' + idProduit,
		    dataType:'json'
		});
        document.getElementById(idProduit).remove();
	}
</script>
<?php
include ('Views/shared/footer.php');
?>