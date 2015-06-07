<?php

include_once 'News.php';

class NewsFactory {

    //put your code here

    public static function &getNewsList() {
        $news = array();
        $news[] = new News();
        $news[0]->setId(0);
        $news[0]->setHeading("Letta: \"L'Europa non sia una gabbia ma un aiuto per la crescita\"");
        $news[0]->setImage("http://www.repubblica.it/images/2013/05/21/102623051-b95046ad-9378-417e-85be-795333c9aff6.jpg");
        $news[0]->setText("\"L'Europa non deve tradursi in una gabbia di vincoli 
                   regole e procedure che finiscono spesso per limitare l'azione 
                   di tutti, cittadini, famiglie e imprese\". 
                   E soprattutto: non basta l'unione monetaria, 
                   ma servono \"gli Stati Uniti d'Europa\". 
                   Ne è convinto il premier Enrico Letta, intervenuto questa mattina 
                   nell'Aula del Senato in occasione delle comunicazioni sul vertice 
                   straordinario dell'Ue in programma per domani, ricordando 
                   come il decreto approvato all'ultimo Cdm vada in questa direzione.");
        
        $news[] = new News();
        $news[1]->setId(1);
        $news[1]->setHeading("Ineleggibilita Berlusconi, oggi al Senato la partita decisiva sul presidente della Giunta");
        $news[1]->setImage("http://www.repubblica.it/images/2013/05/21/113947815-87009ff5-1c9d-4886-b6c8-e2221c85a622.jpg");
        $news[1]->setText("E' un passaggio decisivo per le sorti del governo 
            quello in programma oggi pomeriggio al Senato. 
            Nella sede di Sant'Ivo alla Sapienza si riunisce la Giunta per le immunità e le elezioni. 
            All'ordine del giorno c'è l'elezione del presidente e a breve la 
            proposta per le ineleggibilità di Silvio Berlusconi, che 
            il Movimento Cinque Stelle ha già detto di voler depositare.
            Gli equilibri politici in giunta si decidono oggi. 
            E cruciale sarà la compattezza del Pd. Il centrodestra con Lega e 
            Gal ha infatti otto senatori. Otto ne ha il Pd, quattro M5S, e uno Sel. 
            Se tiene l'asse tra il Pdl, la Lega e il Pd potrebbe essere eletto il 
            leghista Raffaele Volpi. Ma se una parte del Pd (ne bastano quattro) 
            seguirà le indicazioni espresse nei giorni scorsi da Felice Casson 
            (contrario a votare un leghista presidente), allora la Giunta avrà 
            un altro presidente e virerà verso posizioni ostili a Silvio Berlusconi, 
            che potrebbe essere dichiarato ineleggibile in quanto 
            concessionario pubblico, ai sensi della legge 361 del 1957.");
        
        $news[] = new News();
        $news[2]->setId(2);
        $news[2]->setHeading("Meteo, è autunno anche sull'Isola Pioggia prevista per tutto il weekend");
        $news[2]->setImage("http://www.unionesarda.it/foto/PreviewFoto/2013/05/21/meteo_autunno_anche_sull_isola_pioggia_prevista_per_tutto_il_weekend-330-0-364388.jpg");
        $news[2]->setText("Tornano pioggia e freddo sulla Penisola. 
            Anche in Sardegna le atmosfere sono autunnali: ulteriori peggioramenti previsti per domani.
            Pioggia e freddo su tutta la Penisola. Peggioramenti anche in Sardegna. 
            Per domani sull'Isola si prevedono violenti nubifragi. Breve tregua soltanto per venerdì.
            Nel weekend si annunciano ancora pioggia e freddo.
            Carlo Spanu, maggiore in servizio all'Aeronautica di Decimomannu, 
            illustrerà la situazione meteo sul Tg di Videolina, a partire dall'edizione delle 13.");
        
        return $news;
    }

}

?>
