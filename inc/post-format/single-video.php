    	<!--POST - TEXT - START -->
    	<div class="post">
        	<div class="left-info">
            	<a href="#<?php //Author Page ?>"><img src="http://dummyimage.com/50x50/000/fff&text=AUTH" alt="Author" /></a>
                <div class="clearfix"></div>
                <div class="categories">
                	<a href="#">PHP/MySql</a>
                </div><!--END CATEGORIES-->
            </div><!--END L-INFO-->
            
            <div class="content">
                <!--VİDEO TEST-->
                <?php 
					$content = get_post_meta($post->ID, '_format_video_embed', true);
					$content = preg_replace('#\<iframe(.*?)\ssrc\=\"(.*?)\"(.*?)\>#i', '<iframe$1 src="$2?wmode=opaque"$3>', $content);
					$content = preg_replace('#\<iframe(.*?)\ssrc\=\"(.*?)\?(.*?)\?(.*?)\"(.*?)\>#i', '<iframe$1 src="$2?$3&$4"$5>', $content);
					
					if(!empty($content)){ ?>
					<div class="entry-video">
				<?php echo $content; ?>
					</div>
				<?php } ?>
                <!--VİDEO TEST END-->
        		<a href="<?php the_permalink(); ?>"><h3><?php the_title();?></h3></a>
                <div class="text"><?php the_content();?>
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
            
        </div><!--POST - TEXT - END -->
