<meta charset='utf-8'>
<?php
	$num = $_GET["num"];
	$page = $_GET["page"];
?>
<Script type="text/javascript">
function delete_confirm(){
	answer = confirm("장바구니에서 삭제하시겠습니까?");
	if (answer){
		location.href='basket_delete_02.php?num=<?=$num?>&page=<?=$page?>';
	}
	else{
		history.back();
	}
}
</script>
<body onload="delete_confirm()">
</body>
