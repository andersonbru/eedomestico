<?php
class Template {
	
	public function iniciarForm($action, $method='POST', $class='', $aux='', $validar=TRUE){
		$form = '<form action="'.$action.'" method="'.$method.'" class="form-horizontal '.($validar?'validarForm':'').' '.$class.'" '.$aux.' enctype="multipart/form-data">';
		echo $form;
	}
	
	public function finalizarForm(){
		echo '</form>';
	}
	
	//Inputs
	public function gerarInputText($label, $name, $value, $placeholder, $obrigatorio=false, $class='', $aux='', $label_md=2, $label_lg=2, $input_md=10, $input_lg=10, $type="text", $max=''){
		
		$input = '<div class="form-group">';
			$input.= '<label class="col-xs-12 col-sm-12 col-md-'.$label_md.' col-lg-'.$label_lg.' control-label" for="'.$name.'">'.$label.':'.($obrigatorio?'*':'').'</label>';
			$input.= '<div class="col-xs-12 col-sm-12 col-md-'.$input_md.' col-lg-'.$input_lg.'">';
				$input.= '<input type="'.$type.'" class="form-control '.$class.' '.($obrigatorio?'obrigatorio':'').'" 
								 id="'.$name.'" name="'.$name.'" value="'.$value.'" placeholder="'.$placeholder.'" '.$aux.' maxlength="'.$max.'">';
			$input.= '</div>';
		$input.= '</div>';				
				
		echo $input;
	}
	
	public function gerarInputHidden($name, $value){
		$input = '<input type="hidden" class="" id="'.$name.'" name="'.$name.'" value="'.$value.'">';
		echo $input;
	}
	
	//Selects
	public function gerarSelect($label, $name, $opt=array(), $value, $class='', $obrigatorio=TRUE, $label_md=2, $label_lg=2, $input_md=10, $input_lg=10){
		$select = '<div class="form-group">';
			$select.= '<label class="col-xs-12 col-sm-12 col-md-'.$label_md.' col-lg-'.$label_lg.' control-label" for="'.$name.'">'.$label.':'.($obrigatorio?'*':'').'</label>';
			$select.= '<div class="col-xs-12 col-sm-12 col-md-'.$input_md.' col-lg-'.$input_lg.'">';
			
				$select.= '<select class="form-control '.$class.' '.($obrigatorio?'obrigatorio':'').'" id="'.$name.'" name="'.$name.'" data-width="100%">';
					if ($opt) {
						$select.= '<option value="">--Selecione--</option>';
						foreach ($opt as $key => $v) {
							$select.= '<option value="'.$key.'" '.(trim($key)==trim($value)?'selected="selected"':'').'>'.$v.'</option>';
						}
					}else{
						$select.= '<option value="">--Nenhum Registro Localizado--</option>';
					}						
				$select.= '</select>';
			
			$select.= '</div>';
		$select.= '</div>';				
						
		echo $select;
	}
	
	public function gerarSelectMultiple($label, $name, $opt=array(), $value=array(), $class='', $obrigatorio=TRUE, $label_md=2, $label_lg=2, $input_md=10, $input_lg=10, $aux=''){
		$select = '<div class="form-group">';
			$select.= '<label class="col-xs-12 col-sm-12 col-md-'.$label_md.' col-lg-'.$label_lg.' control-label" for="'.$name.'">'.$label.':</label>';
			$select.= '<div class="multi-select-full col-xs-12 col-sm-12 col-md-'.$input_md.' col-lg-'.$input_lg.'">';
				$select.= '<select class="multiselect '.$class.' '.($obrigatorio?'obrigatorio':'').'" id="'.$name.'" name="'.$name.'" data-width="100%" multiple="multiple" '.$aux.' >';
					if ($opt) {
						foreach ($opt as $key => $v) {
							$select.= '<option value="'.$key.'" '.($key==(isset($value[$key])?$value[$key]:'')?'selected="selected"':'').' >'.$v.'</option>';
						}
					}						
				$select.= '</select>';
			$select.= '</div>';
		$select.= '</div>';
		
		echo $select;
	}
	
	public function gerarSelectMultipleList($label, $name, $opt=array(), $value=array(), $aux=''){
		$select = '<div class="form-group">';
			$select.= '<p class="content-group">'.$label.'</p>';
			$select.= '<select multiple="multiple" name="'.$name.'" class="form-control listbox">';
				if ($opt) {
					foreach ($opt as $key => $v) {
						$select.= '<option value="'.$key.'" '.($key==(isset($value[$key])?$value[$key]:'')?'selected="selected"':'').' >'.$v.'</option>';
					}
				}
			$select.= '</select>';
		$select.= '</div>';
		
		echo $select;
	}
	
	public function gerarTextArea($label, $name, $value, $obrigatorio=false, $class='', $aux='', $label_md=2, $label_lg=2, $input_md=10, $input_lg=10, $max='', $row=5){
		
		$input = '<div class="form-group">';
			$input.= '<label class="col-xs-12 col-sm-12 col-md-'.$label_md.' col-lg-'.$label_lg.' control-label" for="'.$name.'">'.$label.':'.($obrigatorio?'*':'').'</label>';
			$input.= '<div class="col-xs-12 col-sm-12 col-md-'.$input_md.' col-lg-'.$input_lg.'">';
				$input.= '<textarea id="'.$name.'" name="'.$name.'" rows="'.$row.'" class="form-control '.$class.' '.($obrigatorio?'obrigatorio':'').'" '.$aux.' maxlength="'.$max.'">'.$value.'</textarea>';
			$input.= '</div>';
		$input.= '</div>';				
				
		echo $input;
	}
	
	public function buttonForm($text, $cor='primary', $align='right'){
		$btn = '<div class="text-'.$align.'">
					<button type="submit" class="btn btn-'.$cor.'"><i class="glyphicon glyphicon-floppy-disk"></i> '.$text.'</button>
				</div>';
		echo $btn;
	}
	
	public function gerarMensagem($type, $msg, $class=''){
		echo '<div class="alert alert-'.$type.' alert-styled-left alert-arrow-left alert-component '.$class.'">
					<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
					<h6 class="alert-heading text-semibold">'.$msg.'</h6>
				</div>';
	}
	
}
?>