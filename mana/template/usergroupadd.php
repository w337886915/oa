<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html>
<head>
<title>信息添加编辑</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="template/default/content/css/style.css">
</head>
<body class="bodycolor">
<table width="90%" border="0" align="center" cellpadding="3" cellspacing="0" class="small">
  <tr>
    <td class="Big">
	<img src="template/default/content/images/notify_new.gif" align="absmiddle"><span class="big3">权限组信息<?php echo $_title['name']?></span>&nbsp;&nbsp;&nbsp;&nbsp;
	<span style="font-size:12px; float:right; margin-right:20px;">
	<a href="?ac=<?php echo $ac?>&fileurl=<?php echo $fileurl?>" style="font-size:12px;"><<返回列表页</a></span>
    </td>
  </tr>
</table>
<script Language="JavaScript"> 
function CheckForm()
{
   if(document.save.groupname.value=="")
   { alert("名称不能为空！");
     document.save.groupname.focus();
     return (false);
   }
   return true;
}
function sendForm()
{
   if(CheckForm())
      document.save.submit();
}
 
</script>
<form name="save" method="post" action="?ac=<?php echo $ac?>&fileurl=<?php echo $fileurl?>&do=save">
<input type="hidden" name="savetype" value="<?if($_GET[id]==''){?>new<?}else{?>edit<?}?>" />
<input type="hidden" name="id" value="<?php echo $usergroup['id']?>" />
 <table class="TableBlock" border="0" width="90%" align="center">
  	<tr>
  		<td nowrap class="TableContent" width="90">名称：<? get_helps()?></td>
  	  <td class="TableData">
  	  	<input type="text" class="BigInput" name="groupname" value="<?php echo $usergroup['groupname']?>" size=40 <?php echo $usergroup['locked'] ? 'readonly="true"' : ''?>>  	  </td>  	  	
	</tr>
 </table>
  
  
	<?php
	//读取顶级目录
	$query = $db->query("SELECT * FROM ".DB_TABLEPRE."keytable where fatherid='0'  ORDER BY number Asc");
	while ($row = $db->fetch_array($query)) {
	?>
  <table width="90%" border="0" align="center" cellpadding="3" cellspacing="0" class="small">
  <tr>
    <td class="Big"><img src="template/default/content/images/notify_new.gif" align="absmiddle"><span class="big3"> <?php echo $row["name"]?> 
	
	<?php
	if($row["inputname"]!='0'){
		echo '<input type="checkbox" class="select_one" name="purview['.$row["inputname"].']" value="'.$row["inputvalue"].'"';
		if($_GET['do']=='edit'){
			echo checked(''.$row["inputname"].'',$row["inputvalue"]);
		}else{
			if($row["inputchecked"]=='1'){
				echo 'checked="checked" ';
			}
		}
		echo '>';
	}
	?>
	</span>
    </td>
  </tr>
</table>

<?
if($_GET['do']=='edit'){
	get_keytable_list($row["id"],1);
}else{
	get_keytable_list($row["id"],0);
}
?>


  
<?php
}
?>
<table class="TableBlock" border="0" width="90%" align="center">
    <tr align="center" class="TableControl">
    	<td colspan="4" nowrap>
    	<input type="button" value="保存" class="BigButtonBHover" onClick="sendForm();">&nbsp;
 
	    </td>
  </tr>
 </table>
</form>

 
</body>
</html>
<script src="/template/default/home/lib/js/jquery/jquery-1.8.2.min.js"></script>
<script>
  $(".select_one").on('change',function(){
   $(this).closest('table').next().find('input[type=checkbox]').prop('checked',$(this).prop('checked'));
  });
  $(".TableContent input[type=checkbox]").on('change',function(){
    $(this).closest('td').next().find('input[type=checkbox]').prop('checked',$(this).prop('checked'));
  })
</script>
