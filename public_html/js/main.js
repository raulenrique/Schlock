$(function(){

	var newTags = [];

	if(inputTags !== ""){
		newTags = inputTags.split(',');
	}
	new Taggle("tags",{
		tags : newTags,
		hiddenInputName: 'tags[]'

	});

});