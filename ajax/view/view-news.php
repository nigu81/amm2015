<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>News viewer</title>
        <script type="text/javascript" src="lib/jquery-1.9.1.min.js"></script>
        <link href="css/common.css" rel="stylesheet" type="text/css" media="screen" />
        <link href="css/fixed.css" rel="Stylesheet" type="text/css" media="screen" />
        <script type="text/javascript">
            $(document).ready(function(){
               $("#next-news").click(function(){
                    $.ajax({
                        url: "index.php",
                        data:{
                          cmd: "next",
                          id: $("#id-news").attr("value")
                        },
                        dataType: 'json',
                        success : function(data, state){
                            changeNews(data);
                        },
                        error : function(data, state){
                            
                        }
                    })
               });
               
               $("#prev-news").click(function(){
                    $.ajax({
                        url: "index.php",
                        data:{
                          cmd: "prev",
                          id: $("#id-news").attr("value")
                        },
                        dataType: 'json',
                        success : function(data, state){
                            changeNews(data);
                        },
                        error : function(data, state){
                            
                        }
                    })
               });
               
               
               function changeNews(news){
                   $("#hd-news").text(news.heading);
                   $("#img-news").attr("src", news.image);
                   $("#id-news").attr("value", news.id);
                   $("#txt-news").text(news.text);
               }
            });
        </script>
    </head>
    <body>
        <div id="page">
            <!--  header -->
            <div id="header">
                <div id="logo">
                    <h1>AMM News</h1>
                    <p>Tutte le ultime notizie con ajax</p>
                </div>

                <!-- tabs -->
                <div id="menu">
                    <ul>
                        <li class="current_page_item"><a href="#">Home</a></li>
                        
                    </ul>
                </div>
            </div>

            <!-- start page -->
            <!--  sidebar 1 -->
            <div id="sidebar1">
                <ul>
                    <li id="categories">
                        <h2 class="icon-title">Navigazione</h2>
                        <ul>
                            <li><a href="#">Home</a></li>
                        </ul>
                    </li>
                    <li id="external">
                        <h2 class="icon-title">Link esterni</h2>
                        <ul>
                            <li><a href="http://www.repubblica.it/">La Repubblica</a></li>
                            <li><a href="www.unionesarda.it">L'Unione Sarda</a></li>
                            <li><a href="lanuovasardegna.gelocal.it">La nuova Sardegna</a></li>
                        </ul>
                    </li>

                </ul>
            </div>

            <div id="sidebar2">
                <h2 id="help" class="icon-title">Istruzioni</h2>
                <p>
                   Usare i bottoni Avanti/Indietro per cambiare la notizia
                </p>
               

            </div>

            <!-- contenuto -->
            <div id="content">
                <h2 class="icon-title" id="hd-news"><?= $news->getHeading();?></h2>
                <p>
                    <input type ="hidden" value="<?=$news->getId(); ?>" name="id-news" id ="id-news"/>
                    <img id="img-news" class="news-img" src="<?= $news->getImage()?>" alt="News image"/>
                    <span id="txt-news"><?=$news->getText(); ?></span>
                </p>
                <div class="btn-group">
                    <button id="prev-news">Indietro</button>
                    <button id="next-news">Avanti</button>
                    
                </div>
                


            </div>

            <div style="clear: both; width: 0px; height: 0px;"></div>
            <!--  footer -->
            <div id="footer">
                <p>
                    Applicazione d'esempio per l'esame di Amministrazione di Sistema
                </p>
                <p>
                     <a href="http://validator.w3.org/check/referer" class="xhtml" title="Questa pagina contiene HTML valido">
                        <abbr title="eXtensible HyperText Markup Language">HTML</abbr> Valido</a>
                    <a href="http://jigsaw.w3.org/css-validator/check/referer" class="css" title="Questa pagina ha CSS validi">
                        <abbr title="Cascading Style Sheets">CSS</abbr> Valido</a>
                </p>

            </div>
        </div>
    </body>
</html>

