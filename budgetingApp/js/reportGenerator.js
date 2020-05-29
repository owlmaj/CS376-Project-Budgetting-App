function generatePDF(){
	html2canvas(document.body).then(function (canvas) {
			console.log("IN RENDER");
			
			var img = canvas.toDataURL("image/png");
			var report = new jsPDF("p", "mm", "a4");
			var width = report.internal.pageSize.getWidth();
			var height = report.internal.pageSize.getHeight();
			report.addImage(img, "JPEG", 2, 2, width, height);
			report.save("user_report.pdf");
	});
}
