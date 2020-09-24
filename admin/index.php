<?php 

include_once 'includes/header.php';






?>
    <div id="wrapper">





        <!-- Navigation -->
        <?php 
        
        include_once 'includes/navigation.php';

        ?>





        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome To Admin
                            <small>author</small>
                        </h1>
 
                    </div>
                </div>
                <!-- /.row -->
                <?php 
                
                    include_once 'includes/dashboard.php';
                   

                
                ?>


                <!-- Grapical representation -->
                <div class="row">
                
                
                    <script type="text/javascript">
                        google.charts.load('current', {'packages':['bar']});
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() 
                        {
                            var data = google.visualization.arrayToDataTable([
                            ['Data','Count'],
                            
                            
                            <?php 

                                $element_text = ['All Posts','Comments','Users','Categories'];
                                $element_count = [$posts_count,$comments_count,$users_count,$categories_count];
                                for($i=0;$i<4;$i++)
                                {
                                    echo "['{$element_text[$i]}','{$element_count[$i]}'],";
                                }
                            ?>

                            
                            //['Posts',10000]
                            // ['2014', 1000, 400, 200],
                            // ['2015', 1170, 460, 250],
                            // ['2016', 660, 1120, 300]
                            // ['2017', 1030, 540, 350]
                            ]);

                            var options = {
                            chart: {
                                title: '',
                                subtitle: '',
                            }
                            };

                            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                            chart.draw(data, google.charts.Bar.convertOptions(options));
                        }
                    </script>

                    <div id="columnchart_material" style="width:auto; height: 500px;"></div>
                
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->





<?php
    include_once 'includes/footer.php';
?>