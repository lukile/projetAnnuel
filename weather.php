<?php 
	session_start();
	include "header.php";

	if(connect()){
		$hostname = "localhost";
        $database = "aen";
        $username = "root";
        $password = "";

        /* Désactive l'éumlateur de requêtes préparées (hautement recommandé)  */
        $pdo_options[PDO::ATTR_EMULATE_PREPARES] = false;
                    
        /* Active le mode exception */
        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                    
        /* Indique le charset */
        $pdo_options[PDO::MYSQL_ATTR_INIT_COMMAND] = "SET NAMES utf8";
                    
        /* Connexion */
		try{
            $connect = new PDO('mysql:host='.$hostname.';dbname='.$database, $username, $password, $pdo_options);
        }catch (PDOException $e){
            exit('problème de connexion à la base');
        }

        $select_meteo = "SELECT * from meteo ";
        $insertion_prep_meteo = $connect->prepare($select_meteo);
        $insertion_prep_meteo->execute();
		$fetch_query = $insertion_prep_meteo->fetch();

		/*$id = $fetch_query['weather'];
		$req = $connect->query('SELECT icone FROM correspondanceIDWeather WHERE IDWeather = "'.$id.'"');

 		$d = $req->fetch();*/

	
	}
?>

<body>
		<div class="container">

	        <!-- Page Heading/Breadcrumbs -->
	        <div class="row">
	            <div class="col-lg-12">
	                <h1 class="page-header">Météo du jour
	                </h1>
	                <ol class="breadcrumb">
	                    <li><a href="index.html">Accueil</a>
	                    </li>
	                    <li class="active">Météo du jour</li>
	                </ol>
	            </div>
	        </div>

	        <div class="row">
	            <div class="col-md-3">
	                <div class="panel panel-default text-center">
	                    <div class="panel-heading">
	                        <h3 class="panel-title">Météo</h3>
	                    </div>
	                    <div class="panel-body">
	                        <span class="price"><!--<?php echo $d['icone']?>--></span>
	                        <span class="period"><?php echo $fetch_query['description']?></span>
	                    </div>
	                    <ul class="list-group">
	                        <li class="list-group-item"><strong>Température actuelle</strong> : <?php echo $fetch_query['tempnow'] - 273.15?>°C</li>
	                        <li class="list-group-item"><strong>Pression atmosphérique</strong> : <?php echo $fetch_query['pressure']?>hPa</li>
	                        <li class="list-group-item"><strong>Température minimale</strong> : <?php echo $fetch_query['tempsmin'] - 273.15?>°C</li>
	                        <li class="list-group-item"><strong>Température maximale</strong> : <?php echo $fetch_query['tempsmax'] - 273.15?>°C</li>
	                        <li class="list-group-item"><strong>Vitesse du vent</strong> : <?php echo $fetch_query['windspeed']?> m/s</li>
	                        <li class="list-group-item"><strong>Direction du vent</strong> : <?php echo $fetch_query['winddegree']?> degré</li>
	                        </li>
	                    </ul>
	                </div>
	            </div>
	        </div>
	  
<?php 
	include "footer.php";
?>	
  </div>        


</body>	

