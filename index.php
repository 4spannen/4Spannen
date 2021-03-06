<?php get_header(); ?>

    <div class="contents">
    	<!--POST - TEXT - START -->
    	<div class="post">
        	<div class="left-info">
            	<a href="#"><img src="http://dummyimage.com/50x50/000/fff&text=AUTH" alt="Author" /></a>
                <div class="clearfix"></div>
                <div class="categories">
                	<a href="#">PHP/MySql</a>
                </div><!--END CATEGORIES-->
            </div><!--END L-INFO-->
            
            <div class="content">
        		<h3>Lorem Ipsum ...</h3>
                <div class="text">
                	Lorem Ipsum, dizgi ve baskı endüstrisinde kullanılan mıgır metinlerdir. Lorem Ipsum, adı bilinmeyen bir matbaacının bir hurufat numune kitabı oluşturmak üzere bir yazı galerisini alarak karıştırdığı 1500'lerden beri endüstri standardı sahte metinler olarak kullanılmıştır. Beşyüz yıl boyunca varlığını sürdürmekle kalmamış, aynı zamanda pek değişmeden elektronik dizgiye de sıçramıştır. 1960'larda Lorem Ipsum pasajları da içeren Letraset yapraklarının yayınlanması ile ve yakın zamanda Aldus PageMaker gibi Lorem Ipsum sürümleri içeren masaüstü yayıncılık yazılımları ile popüler olmuştur.
                    
                    <a href="#"> Devamını oku <i class="glyphicon glyphicon-arrow-right"></i> </a>
                </div>        
            </div><!--END content-->
            
			<div class="right-info">
            	<div class="post-type-icon">
                	<i class="glyphicon glyphicon-camera"></i>
                </div>
                <div class="review">
                	<i class="glyphicon glyphicon glyphicon-eye-open"></i> 1.654 <br/>
                    <i class="glyphicon glyphicon glyphicon-calendar"></i> 14.03.14
                </div>
            </div><!--END R-INFO-->
            
        </div><!--POST - TEXT - START -->
        
		<?php if ( have_posts() ){?>
			<?php while ( have_posts() ) : the_post(); ?>
                <?php get_template_part( 'inc/post-format/content', get_post_format() );?>     			
            <?php endwhile;?>
        <?php }?>   
        
        </div><!--END CONTENTS-->
    
    <div class="sidebar">
        <?php get_sidebar(); ?>
    </div><!--END SIDEBAR-->

<?php get_footer(); ?>