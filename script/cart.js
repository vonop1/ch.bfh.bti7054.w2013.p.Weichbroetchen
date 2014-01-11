/**
 * 
 */
function confirmOrder(text)
{
	var retrunVal = window.confirm(text);
	return retrunVal;	
}

function openPdf()
{
	window.open("./html/pdfGenerator.php",'_blank');
}