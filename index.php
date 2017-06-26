<?php
    session_start();
    include "header.php";
   // include "function.php";
    
?>    
    <!-- Header Carousel -->
    <header id="myCarousel" class="carousel slide">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <div class="fill" style="background-image:url('img/pilote.jpg');"></div>
                <div class="carousel-caption">
                    <h2></h2>
                </div>
            </div>
            <div class="item">
                <div class="fill" style="background-image:url('img/aeroclub.jpg');"></div>
                <div class="carousel-caption">
                    <h2></h2>
                </div>
            </div>
            <div class="item">
                <div class="fill" style="background-image:url('img/avionbapteme.jpg');"></div>
                <div class="carousel-caption">
                    <h2></h2>
                </div>
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>
    </header>

    <!-- Page Content -->
    <div class="container">

        <!-- Marketing Icons Section -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Aérodrome D'Evreux Normandie
                </h1>
            </div>
            <div class="col-md-3 col-xs-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-fw fa-check"></i> Pour tous,pour toutes et la famille</h4>
                    </div>
                    <div class="panel-body">
                        <p>Vous êtes pilote, ou tout simplement passioné par le monde et les activités aéronautiques ? Vous souhaitez vous perfectionner sur une flotte d'avions modernes et équipé ? Ou tout simplement effectuer votre premiere chute libre ? </p>
                        <p> L'Aérodrome d'Evreux Normandie est fait pour vous !</p>
                        <a href="#" class="btn btn-default">Voir plus</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-xs-4 ">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-fw fa-gift"></i> Une histoire mais surtout un loisir</h4>
                    </div>
                    <div class="panel-body">
                        <p>Créée en 1978, l'AEN est un équipement qui participe au développement de l'Eure. Situé à 4 km du centre-ville et à moins de 100km de Paris. </p>
                        <p>De plus, un aéroclub localisé dans l'aérodrome offre une panoplie d'activités très demandées dans la region pour les amateurs de sensations fortes.</p>
                        <a href="#" class="btn btn-default"> Voir plus</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-xs-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-fw fa-compass"></i>Un grand nombre d'activités</h4>
                    </div>
                    <div class="panel-body">
                        <p>L'aérodrome propose également au grand public, par le biais d'une association nommée Aéroclub, la possibilité de s'initier à toutes les activités liées au monde des aéronefs.</p>
                         <p>   Nous offrons également les données météorologiques de notre région afin de faciliter le choix de vos activités.</p>
                            <p></p>
                        <a href="#" class="btn btn-default">Voir plus</a>
                    </div>
                </div>
            </div>
            <?php
                $db = connect();
                $select_meteo = "SELECT * from meteo ";
                $insertion_prep_meteo = $db->prepare($select_meteo);
                $insertion_prep_meteo->execute();
                $fetch_query = $insertion_prep_meteo->fetch();

                /*$id = $fetch_query['weather'];
                $req = $connect->query('SELECT icone FROM correspondanceIDWeather WHERE IDWeather = "'.$id.'"');

                $d = $req->fetch();*/

            

            ?>
            <div class="row">
                <div class="col-md-3 col-xs-4">
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
                            <li class="list-group-item"><strong>Direction du vent</strong> : <?php 
                            if($fetch_query['winddegree'] >= 0 && $fetch_query['winddegree'] <  45 || $fetch_query['winddegree'] == 360){
                                echo "Nord";
                            }
                            if($fetch_query['winddegree'] >= 45 && $fetch_query['winddegree'] < 90 ){
                                 echo "Nord-Est";
                            }
                            if($fetch_query['winddegree'] >= 90 && $fetch_query['winddegree'] < 135){
                                echo "Est";
                            }
                            if($fetch_query['winddegree'] >= 135 && $fetch_query['winddegree'] < 180){
                                echo "Sud-Est";
                            }
                            if($fetch_query['winddegree'] >= 180 && $fetch_query['winddegree'] < 225){
                                echo "Sud";
                            }
                            if($fetch_query['winddegree'] >= 225 && $fetch_query['winddegree'] < 270){
                                echo "Sud-Ouest";
                            }
                            if($fetch_query['winddegree'] >= 270 && $fetch_query['winddegree'] < 315){
                                echo "Ouest";
                            }
                            if($fetch_query['winddegree'] >= 315 && $fetch_query['winddegree'] < 360){
                                echo "Norf-Ouest";
                            }
                                
                             ?> </li>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
                
        
        <!-- /.row -->

        <!-- Portfolio Section -->
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Portfolio Heading</h2>
            </div>
            <div class="col-md-4 col-sm-6">
                    <img class="img-responsive img-portfolio img-hover" src="img/parachutism.jpeg" alt="">
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                    <img class="img-responsive img-portfolio img-hover" src="img/flyingLesson.jpeg" alt="">
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                    <img class="img-responsive img-portfolio img-hover" src="img/ulm.jpeg" alt="">
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                    <img class="img-responsive img-portfolio img-hover" src="img/ulm2.jpg" alt="">
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                    <img class="img-responsive img-portfolio img-hover" src="img/parachut_jump.jpeg" alt="">
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                    <img class="img-responsive img-portfolio img-hover" src="img/bapteme_de_lair.jpeg" alt="">
                </a>
            </div>
        </div>
        <!-- /.row -->

        <!-- Features Section -->
        
        <!-- /.row -->

        <hr>

        <!-- Call to Action Section -->
        <div class="well">
            <div class="row">
                <div class="col-md-8">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias, expedita, saepe, vero rerum deleniti beatae veniam harum neque nemo praesentium cum alias asperiores commodi.</p>
                </div>
                <div class="col-md-4">
                    <a class="btn btn-lg btn-default btn-block" href="#">Call to Action</a>
                </div>
            </div>
        </div>
        </div>
        <hr>

        <!-- Footer -->
        <footer>
<?php 
    include "footer.php";
?>   
</div>
    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>

</body>

</html>
