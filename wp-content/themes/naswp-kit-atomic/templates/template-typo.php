<?php
/**
 * Template Name: Typo - testovací stránka
 *
 * Typo testing
 *
 * @package Atomic Blocks
 */ 

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
        <p style="margin: 20px 0;"><em>Zde je váš testovací obsah</em></p>
		<?php while ( have_posts() ) : the_post();

			// Post content template
			get_template_part( 'template-parts/content' );

		endwhile; ?>


        <p style="margin: 20px 0;"><em>Zde je testovací obsah šablony (pokud je definovaný)</em></p>
        <?php
        if( function_exists('naswp_typo_demo') ) {
                   naswp_typo_demo();
                } 
        
        ?>
        
        <p style="margin: 20px 0;"><em>Zde je obecný testovací obsah</em></p>
        
        <h1>Nadpis H1</h1>
        <h2>Nadpis H2</h2>
        <h3>Nadpis H3</h3>
        <h4>Nadpis H4</h4>
        <h5>Nadpis H5</h5>
        
        <h2>Text</h2>
        
        <p>Odstavec lákamí <strong>tučný</strong> úmyval <em>kurzíva</em> jednovod lek <span>span</span> jít zteprozzá dobzor zápresivý. Básný z <a href="#">odkaz</a> umyslupos klad ječní mat zápresivý jít lžičkou Depicí. Busluncen znou se kytanesiv buby školiv Podlou říkemi podtrojdi depresiv Měsí. Aut Umyslemi lva boutný ne poci ří pa nalem bolý znovu. Partavěď lákaje lák boliv bájedpodl vá dopis magnednem rozem krádní Měsí. Ští napně ko a povodlobi málně úmyvaledn znadloval magne.</p>

        <p>Druhý odstavec nač drávadlov umítky bývá vese bývá úmyvalem alehlínům řícit nám. Sudí úmyva umí umrad oba dráček lušledně Tajakkoli sou Marásná moc. Lválně Ra Je dechyňsko Dobzor obolekno směsí anadobra alem ačkový ští. Lunce ačkový tlínkat málobrazy al boliv vestupoči Umrabus a smělý Nedno. Oba školiv aut krát ně parcipáda umítky lesmělý Lemí štíně dostrojsk. Hou rojskočár bájedpodl.</p>

        <h2>Seznamy</h2>

        <ul><li> Nasy halekamat  </li><li> Pa ško Záprazy  </li><li> Škovat drásníky  </li><li> Rozzáprad projedpok  </li></ul>
        <ol><li> Nasy halekamat  </li><li> Pa ško Záprazy  </li><li> Škovat drásníky  </li><li> Rozzáprad projedpok  </li></ol>
        
        <h2>Odkazy a tlačítka</h2>
        
        <p><a href="#">Textový odkaz</a></p>
        <p><a href="#" class="button">Odkaz se třídou "button"</a></p>
        <p><button>Formulářové tlačítko</button></p>
        <p>
        <div class="wp-block-buttons">
<div class="wp-block-button"><a class="wp-block-button__link">WP tlačítko s výplní</a></div>



<div class="wp-block-button is-style-outline"><a class="wp-block-button__link">WP tlačítko s obrysem</a></div>
</div>
</p>


		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
