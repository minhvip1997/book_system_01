$(function () {
	$("#cart-status").change(function () {
		let url = "admin/cart/type/" + $(this).val();
		document.location.href = url;
	});
});

$(function () {
	$("#tag-status").change(function () {
		let url = "admin/tag/type/" + $(this).val();
		document.location.href = url;
	});
});
