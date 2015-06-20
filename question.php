<?php
/**
 * Template Name: Question Page
 *
 */

get_header(); ?>
	<div class="container body-wrapper">
		<div class="center-container">
			<div class="questions">
				<div class="question-top clearfix">
					<div class="dude-box">
						<img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/images/dude.png">
					</div>
					<div class="action">
						<svg width="299px" height="203px" viewBox="0 0 299 203" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="action-text">
							<g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
								<g id="Desktop-HD" sketch:type="MSArtboardGroup" transform="translate(-602.000000, -266.000000)" font-weight="normal" font-family="Lobster" fill="#000000" sketch:alignment="middle">
									<g id="Group" sketch:type="MSLayerGroup" transform="translate(486.000000, 252.000000)">
										<text id="passer" sketch:type="MSTextLayer" font-size="74">
											<tspan x="227.367676" y="108.332764">passer</tspan>
										</text>
										<text id="for" sketch:type="MSTextLayer" font-size="43">
											<tspan x="126.236328" y="136">for</tspan>
										</text>
										<text id="deg?" sketch:type="MSTextLayer" font-size="102">
											<tspan x="154.690918" y="190.44165">deg?</tspan>
										</text>
										<text id="linje" sketch:type="MSTextLayer" font-size="43">
											<tspan x="149.121582" y="100">linje</tspan>
										</text>
										<text id="Hvilken" sketch:type="MSTextLayer" font-size="62">
											<tspan x="148.453613" y="62">Hvilken</tspan>
										</text>
									</g>
								</g>
							</g>
						</svg>
					</div>
				</div>
                             <?php $questions=get_posts(array('post_type'=>questions,'posts_per_page'=>-1));
                             $counter=0;
                             foreach($questions as $question) {
                                   $counter++;
                             ?>
                            <div id="setup_<?php echo $counter; ?>" <?php if($counter > 1){ ?> style='display:none;' <?php } ?> data-question='<?php echo $question->ID; ?>' class='questions_div'>
                           
				<div class="question-holder">
					<div class="question-number">
						Sp&oslash;rsm&aring;l <?php echo $counter; ?>/<?php echo count($questions); ?>
					</div>
					<h2 class="question">
					<?php echo $question->post_title; ?>
					</h2>
				</div>
                                <?php $answers=get_post_meta($question->ID,'answers',true);
                               
                               ?>
				<div class="answers">
					<ul class="clearfix">
                                            <?php 
                                            for($iter=0;$iter<sizeof($answers);$iter++){ 
                                                $answeCounter++;
                                ?>
						<li>
							<div class="checkbox checkbox-circle">
								<input type="radio" name="answer" id="radio_<?php echo $answeCounter; ?>" value="<?php echo $answers[$iter]; ?>">
								<label for="radio_<?php echo $answeCounter; ?>">
									<?php echo get_the_title($answers[$iter]); ?>
								</label>
							</div>
						</li>
                                             <?php } ?>
						
					</ul>
					<div class="answer-actions">
                                                <?php if($counter > 1) { ?><a href="#" class="blue-btn back-button" data-value='<?php echo ($counter-1); ?>'>Back</a><?php } ?>
						<a href="#" class="blue-btn next-button"  data-value='<?php echo $counter; ?>'>Next</a>
					</div>
				</div>
                              
                        </div>
                               <?php } ?>
			</div>
		</div>
	</div>
<?php get_footer(); ?>