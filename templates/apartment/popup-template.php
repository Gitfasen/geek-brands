<?php
/**
 *
 * @package LPtheme
*/
?>

<div id="apartments-popup-item" class="modal form-style-1" >
	<div class="row">

		<div class="col-lg-7">
			<div class="apartments-popup-item-info">
				<div class="popup-title">
					<span class="title"></span>
				</div>
				<div class="popup-number">
					Номер - <span class="number"></span>
				</div>	
				<div class="popup-price">
					Цена - <span class="price"></span> 
				</div> 
				<div class="popup-m2">
					Общая площадь - <span class="m2"></span>
				</div>
				<a href="javascript:;" class="popup-btn btn-blue">Отправить заявку</a>
			</div>			
		</div>

		<div class="col-lg-5">
			<div class="popup-img active">
				<div class="img"></div>
			</div>
			<div class="popup-form"><?php echo do_shortcode('[contact-form-7 id="190" title="Заявка на квартиру"]')?></div>			
		</div>

	</div>
</div>