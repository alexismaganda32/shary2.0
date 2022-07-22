<div class="alert alert-mini alert-danger nomargin alertMessageError" ng-style="{ display : showMsg }">
	<button type="button" class="close" aria-label="Close" ng-click="setMessage()" style="position: initial; margin-left: 10px;">
	  	<span aria-hidden="true">&times;</span>
	</button>
	<strong>Error!</strong> @{{ msgError }}
</div>