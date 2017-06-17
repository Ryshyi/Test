function dwnld(){
	var xhr = new XMLHttpRequest();
	
	xhr.open('GET', 'https://www.reddit.com/r/funny/.json', false);
	xhr.send();

	if (xhr.status != 200) {
	 document.write( xhr.status + ': ' + xhr.statusText ); 
	} else {
	  document.write( xhr.responseText ); 
	}
}
