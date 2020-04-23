# naswp-kit-atomic

WordPress startovací kit od [NášWP](https://naswp.cz).
Kit by měl být použit jako child theme k šabloně [Atomic Blocks](https://wordpress.org/themes/atomic-blocks/).

Šablona Atomic Block byla vybrána, protože je velmi jednoduchá, neobsahuje zbytečně mnoho balastu a počítá s využíváním blokového editoru Gutenberg. Protože má jen minimum funkcí, je při správném použití velmi rychlá. Kit tuto šablonu dále vyladí.

Kit dále do šablony doplňuje řadu pomocných funkcí, díky kterým je možné získat užitečné a potřebné funkcionality bez použití dalších pluginů. Těmto funkcím říkáme NášWP Helpery a nalezete je ve složce classess s prefixem class-naswp-*.

Aktuálně kit umí rozšířit funkcionalitu následovně:
-   jednoduše nadefinovat vlastní palety barev a gradientů do Gutenbergu
-   zobrazit tipy na WP nástěnce a zkraty pro instalaci doporučených pluginů
-   jednoduše na web dostat GA nebo GTM
-   jednoduše nadefinovat povolené formáty souborů pro upload
-   nadefinovat si vlastní meta description jako post meta v metaboxu gutenbergu + nastavit og:image když je nastaven náhledový obrázek
-   vygenerovat sitemapu
-   udělat anglickou mutaci webu (beta)
-   zapnout si ohraničení sloupců a skupin v gutenbergu pro lepší orientaci
-   doplnit obrázky a galerie WP o jednoduchý LightBox
-   vytvořit jednoduchou členskou sekce náhradou funkce heslem chráněných příspěvků za nutnost přihlášení

Jednotlivé helpery se povolují a případně nastavují ve functions.php zavoláním příslušných funkcí:

    //zapnutí tipů na WP nástěnce
    $helpers->intro();
    
    //zapnutí ohraničení bloků v Gutenbergu pro lepší orientaci
    $helpers->blocks_helper();
    
    //vyřešení jazykové mutace bez dalších pluginů
    //definice jazyků
    $languages = array(
	    'en' => 'en_US',
	    'de' => 'de_DE',
    );
    
    //seznam náhrad menu - měníme primární menu za menu s id 4 pro ENG a za 5 pro DE
    $menus = array(
	    'en' => array(
    	    'primary' => 4,
	    	),
	    'de' => array(
    	    'primary' => 5,
		    ),
    );
    
    //seznam náhrad sidebarů - vytvoří a zaregistruje 3 nové lokalizované sidebary dle původních a bude mezi nimi přepínat
    $sidebars = array(
       'footer-1' => 'Footer - Column 1',
       'footer-2' => 'Footer - Column 2',
       'footer-3' => 'Footer - Column 3',
    );

    $helpers->localization($menus, $sidebars);
    
    //zapnutí malých SEO doplňků
    $helpers->seo();
    
    //vygenerování sitemapy
    $helpers->sitemap();
    
    //vložení Google Analytics kódu
    $helpers->ga('UA-0');
    
    //vložení GTM kódu
    $helpers->gtm('GTM-0');
    
    //povolení uploadu vybraných typů souborů do galerie WP
    $mimes_array = array('svg' => 'image/svg+xml');
    
    $helpers->mimes($mimes_array);
    
    //použití lightboxu na obrázky (je využit BaguetteBox)
    $helpers->lightbox();

    //definování vlastní barevné palety pro Gutenberg
    $colors = array(
    	'Light' => '#EAF7FF',
    	'Dark' => '#002140',
    );
    
    $gradients = array(
    	'Light' => 'linear-gradient(90deg, rgba(0,183,255,1) 0%, rgba(4,89,170,1) 100%)',
    	'Dark' => 'linear-gradient(90deg, rgba(4,89,170,1) 0%, rgba(0,33,64,1) 100%)',
    );
    
    $helpers->colors($colors, true, $gradients, true);
    
    //zapnutí jednoduché členské sekce - nahradí funkci příspěvků chráněných heslem
    $helpers->protected_member();


Pokud nějakou funkci nechete využívat, nebo ji nahradit jiným komplexnějším pluginem, stačí zakomentovat/odstranit volání příslušného Helperu.
