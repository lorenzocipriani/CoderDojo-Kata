<script type="text/javascript">
	function initTutorial(){
		$( "div.kata-tutorial-step-element" ).each(function( index, element ) {
			var idx = (index + 1);
			var title = $.trim($( "td.kata-tutorial-step-title", element ).text());
			var content = $.trim($( "td.kata-tutorial-step-content", element ).text());
			var navigationId = "kata-tutorial-navigation-item-" + index;
			var navigationTitle = idx + ". " + title;
			var navigationCssClass = "kata-tutorial-navigation-item" + ((index == 0) ? " kata-tutorial-navigation-item-selected" : "");
	
			$( "table.kata-tutorial-navigation" ).append( "<tr><td id='" + navigationId + "' class='" + navigationCssClass + "' onclick='javascript:selectStep(" + index + ");'>" + navigationTitle + "</td></tr>" );
	
			if(index == 0)
				$( element ).removeClass("kata-tutorial-step-hidden");
		});
	}

	function selectStep(stepIndex){
		console.log("clicked" + stepIndex );

		$("div.kata-tutorial-step-element").each(function( index, element ) {
			var navigationId = "#kata-tutorial-navigation-item-" + index;

			if(index == stepIndex){
				$( navigationId ).addClass("kata-tutorial-navigation-item-selected");
				$( element ).removeClass("kata-tutorial-step-hidden");
			}else{
				$( navigationId ).removeClass("kata-tutorial-navigation-item-selected");
				$( element ).addClass("kata-tutorial-step-hidden");
			}
		})
	}
	
	$(function() {
		initTutorial(); 
	});
</script>
<div class="kata-mentors">
	<div class="row kata-box">
		<div class="kata-breadcrumbs">
			<div class="kata-breadcrumb">Categories</div>
			<div class="kata-breadcrumb">Design</div>
			<div class="kata-breadcrumb kata-breadcrumb-selected">Tutorial</div>
		</div>
	</div>
	<div class="row kata-mentors-group">
		<table class="kata-tutorial-container">
			<tr>
				<td colspan="2">
					<table class="kata-tutorial-selection">
						<tr>
							<td class="kata-tutorial-selection-label">Session:</td>
							<td class="kata-tutorial-selection-options"><select
								class="kata-select"><option>Beginner</option></select></td>
							<td class="kata-tutorial-selection-pagination">Session 1 of 10</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td class="kata-tutorial-navigation-container">
					<table class="kata-tutorial-navigation"></table>
				</td>
				<td class="kata-tutorial-content-container">
                	<?php $this->html( 'bodycontent' )?>
                </td>
			</tr>
		</table>
	</div>

	<div>&nbsp;</div>
</div>
