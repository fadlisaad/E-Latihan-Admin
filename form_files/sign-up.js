(function() {
	wFORMS.showAlertOnError = false;
	wFORMS.functionName_formValidation = function(e) {
		if(!wFORMS.behaviors['validation'].run(e)) 
			return wFORMS.helpers.preventEvent(e);
		if(!doStage1())
			return wFORMS.helpers.preventEvent(e);

		// do not let it happen twice
		var b = document.getElementById('submitRegistration');
		if(b.value!=' Wait...') b.value=' Wait...';
		else return wFORMS.helpers.preventEvent(e);
	}
})();


